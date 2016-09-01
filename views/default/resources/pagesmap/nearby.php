<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */

if(!elgg_is_active_plugin("amap_maps_api")){
    register_error(elgg_echo("pagesmap:settings:amap_maps_api:notenabled"));
    forward(REFERER);
}
 
elgg_load_library('elgg:amap_maps_api');
elgg_load_library('elgg:amap_maps_api_geo'); 

$user = elgg_get_logged_in_user_entity();

if (amap_ma_not_permit_public_access())	{
    gatekeeper();
}

// Retrieve map width 
$mapwidth = amap_ma_get_map_width();
// Retrieve map height
$mapheight = amap_ma_get_map_height();

// set default parameters
$limit = get_input('limit', 0);
$title = elgg_echo('pagesmap:all');
$options = array(
    'type' => 'object',
    'subtype' => array('page','page_top'),
);
	
// get variables
$s_location = $_GET["l"];
$s_radius = (int) $_GET["r"];
$s_keyword = $_GET["q"];
$showradius = $_GET["sr"];

if (($s_location && $s_radius) || $s_keyword) {
    if ($s_keyword) {
        $db_prefix = elgg_get_config("dbprefix");
        $query = sanitise_string($s_keyword);

        $options["joins"] = array("JOIN {$db_prefix}objects_entity ge ON e.guid = ge.guid");
        $where = "(ge.title LIKE '%$query%' OR ge.description LIKE '%$query%')";
        $options["wheres"] = array($where);
    }
    	
    $search_radius_txt = '';
    if ($s_radius>0) {
        $search_radius_txt = $s_radius;
    }

    // retrieve coords of location asked, if any
    $coords = amap_ma_geocode_location($s_location);
    
    if ($coords) {
        $s_radius = amap_ma_get_default_radius_search($s_radius);
        $search_location_txt = $s_location;
        $s_lat = $coords['lat'];
        $s_long = $coords['long'];
        
        if ($s_lat && $s_long) {
            $options = add_order_by_proximity_clauses($options, $s_lat, $s_long);
            $options = add_distance_constraint_clauses($options, $s_lat, $s_long, $s_radius);
        }
        $title = elgg_echo('pagesmap:members:nearby:search', array($search_location_txt));
    }
}
else {
    $initial_load = elgg_get_plugin_setting('initial_load', 'pagesmap');
    if ($initial_load == 'newest') {
        $limit = amap_ma_get_initial_limit('pagesmap');
        $title = elgg_echo('pagesmap:members:newest', array($limit));
    }
    else if ($initial_load == 'location') {
        // retrieve coords of location asked, if any
        if ($user->location)  {
            $s_lat = $user->getLatitude();
            $s_long = $user->getLongitude();

            if ($s_lat && $s_long) {
                $s_radius = amap_ma_get_initial_radius('pagesmap');
                $search_radius_txt = $s_radius;
                $s_radius = amap_ma_get_default_radius_search($s_radius);
                $options = add_order_by_proximity_clauses($options, $s_lat, $s_long);
                $options = add_distance_constraint_clauses($options, $s_lat, $s_long, $s_radius);

                $title = elgg_echo('pagesmap:members:nearby:search', array($user->location));
            }        
        }
    }
}

$options['limit'] = $limit;
$options['metadata_name_value_pairs'][] = array('name' => 'location', 'value' => '', 'operand' => '!=');

// set breadcrumb
elgg_push_breadcrumb(elgg_echo('pages'), 'pages/all');
elgg_push_breadcrumb(elgg_echo('pagesmap:label:map'));
$entities = elgg_get_entities_from_metadata($options);

// load the search form only in global view
$body_vars = array();
$body_vars['s_action'] = 'pagesmap/nearby_search';
$body_vars['initial_location'] = $search_location_txt;
$body_vars['initial_radius'] = $search_radius_txt;
$body_vars['initial_keyword'] = $s_keyword;
$body_vars['initial_load'] = $initial_load;
if ($user->location) {
    $body_vars['my_location'] = $user->location;
    if (isset($initial_load) && $initial_load == 'location') {
        $body_vars['initial_location'] = $user->location;
    }
}
$form_vars = array('enctype' => 'multipart/form-data');

$content =  elgg_view_form('amap_maps_api/nearby', $form_vars, $body_vars); 	

if ($entities) {
    foreach ($entities as $entity) {
        $entity = amap_ma_set_entity_additional_info($entity, 'title', 'description', $entity->location);
    }
}
 

if (!$entities) {
    $content .= elgg_echo('amap_maps_api:search:personalized:empty');
}
$content .= elgg_view('amap_maps_api/map_box', array(
    'mapwidth' => $mapwidth,
    'mapheight' => $mapheight,
));

$sidebar = '';
$layout = 'one_column';
if (amap_ma_check_if_add_sidebar_list('pagesmap')) {
    $layout = 'content';
    $sidebar = elgg_view('amap_maps_api/sidebar_elist', array(
        'mapheight' => $mapheight,
        'list_view' => 'pagesmap/sidebar'
    ));
}

$params = array(
    'content' => $content,
    'sidebar' => $sidebar,
    'title' => $title,
    'filter_context' => 'pagesmap',
    //'filter_override' => elgg_view('pages/nav', array('selected' => $page_type)), // pagesmap extra code 
);

$body = elgg_view_layout($layout, $params);

echo elgg_view_page($title, $body);

// release variables
unset($entities);
