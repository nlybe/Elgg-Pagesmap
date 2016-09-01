<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */

if (!elgg_is_xhr()) {
    register_error('Sorry, Ajax only!');
    forward(REFERRER);
}

if (!elgg_is_active_plugin("amap_maps_api")) {
    register_error(elgg_echo("pagesmap:settings:amap_maps_api:disabled"));
    forward(REFERER);
}

elgg_load_library('elgg:amap_maps_api');
elgg_load_library('elgg:amap_maps_api_geo');

// get variables
$s_location = get_input("s_location");
$s_radius = (int) get_input('s_radius', 0);
$s_keyword = get_input("s_keyword");
$showradius = get_input("showradius");
$initial_load = get_input("initial_load");

if ($s_radius > 0)
    $search_radius_txt = amap_ma_get_radius_string($s_radius);
else
    $search_radius_txt = amap_ma_get_default_radius_search_string();

$s_radius = amap_ma_get_default_radius_search($s_radius);

// retrieve coords of location asked, if any
$coords = amap_ma_geocode_location($s_location);

$title = elgg_echo('pagesmap:all');
$options = array(
    'type' => 'object',
    'subtype' => array('page', 'page_top'),
    'limit' => get_input('limit', 0),
    'offset' => get_input('proximity_offset', 0),
    'count' => false
);
$options['metadata_name_value_pairs'][] = array('name' => 'location', 'value' => '', 'operand' => '!=');
error_log('---->'.$initial_load);  
if ($initial_load) {
    
    if ($initial_load == 'newest') {
        if (!$options['limit']) {
            $options['limit'] = amap_ma_get_initial_limit('pagesmap');
        }
error_log($options['limit']);        
        $title = elgg_echo('pagesmap:newest', array($options['limit']));
    }
    else if ($initial_load == 'location') {
        // retrieve coords of location asked, if any
        $user = elgg_get_logged_in_user_entity();
        if ($user->location) {
            $s_lat = $user->getLatitude();
            $s_long = $user->getLongitude();

            if ($s_lat && $s_long) {
                $s_radius = amap_ma_get_initial_radius('pagesmap');
                $search_radius_txt = $s_radius;
                $s_radius = amap_ma_get_default_radius_search($s_radius);
                $options = add_order_by_proximity_clauses($options, $s_lat, $s_long);
                $options = add_distance_constraint_clauses($options, $s_lat, $s_long, $s_radius);

                $title = elgg_echo('pagesmap:pages:nearby:search', array($user->location));
            }
        }
    }
} 
else {
    if ($s_keyword) {
        $db_prefix = elgg_get_config("dbprefix");
        $query = sanitise_string($s_keyword);

        $options["joins"] = array("JOIN {$db_prefix}objects_entity ge ON e.guid = ge.guid");
        $where = "(ge.title LIKE '%$query%' OR ge.description LIKE '%$query%')";
        $options["wheres"] = array($where);
    }

    if ($coords) {
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

$entities = elgg_get_entities_from_metadata($options);

$map_objects = array();
if ($entities) {
    foreach ($entities as $entity) {
        $entity = amap_ma_set_entity_additional_info($entity, 'title', 'description', $entity->location);
    }

    foreach ($entities as $e) {
        if ($e->getLatitude() && $e->getLongitude())  {
            $object_x = array();
            $object_x['guid'] = $e->getGUID();
            $object_x['title'] = amap_ma_remove_shits($e->getVolatileData('m_title'));;
            $object_x['description'] = amap_ma_get_entity_description($e->getVolatileData('m_description'));
            $object_x['location'] = elgg_echo('amap_maps_api:location', array(amap_ma_remove_shits($e->getVolatileData('m_location'))));	
            $object_x['lat'] = $e->getLatitude();
            $object_x['lng'] = $e->getLongitude();
            $object_x['icon'] = $e->getVolatileData('m_icon');
            $object_x['other_info'] = $e->getVolatileData('m_other_info');
            $object_x['map_icon'] = $e->getVolatileData('m_map_icon');
            $object_x['info_window'] = $object_x['icon'].' '.$object_x['title'];
            $object_x['info_window'] .= ($object_x['location']?'<br/>'.$object_x['location']:'');
            $object_x['info_window'] .= ($object_x['other_info']?'<br/>'.$object_x['other_info']:'');
            $object_x['info_window'] .= ($object_x['description']?'<br/>'.$object_x['description']:'');            
            array_push($map_objects, $object_x);        
        }
    }

    $sidebar = '';
    if (amap_ma_check_if_add_sidebar_list('pagesmap')) {
        $box_color_flag = true;
        foreach ($entities as $entity) {
            $sidebar .= elgg_view('pagesmap/sidebar', array('entity' => $entity, 'box_color' => ($box_color_flag ? 'box_even' : 'box_odd')));
            $box_color_flag = !$box_color_flag;
        }
    }
} else {
    $content = elgg_echo('amap_maps_api:search:personalized:empty');
}

$result = array(
    'error' => false,
    'title' => $title,
    'location' => $search_location_txt,
    'radius' => $search_radius_txt,
    's_radius' => amap_ma_get_default_radius_search($s_radius, true),
    's_radius_no' => $s_radius,
    'content' => $content,
    'map_objects' => json_encode($map_objects),
    's_location_lat' => ($s_lat? $s_lat: ''),
    's_location_lng' => ($s_long? $s_long: ''),
    's_location_txt' => $search_location_txt,
    'sidebar' => $sidebar,
    's_change_title' => (isset($s_change_title) && $s_change_title==0?false:true),
);

// release variables
unset($entities);
unset($map_objects);

echo json_encode($result);
exit;
