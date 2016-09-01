<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */
	
$plugin = $vars["entity"];

$potential_yesno = array(
    PAGESMAP_GENERAL_NO => elgg_echo('pagesmap:settings:no'),
    PAGESMAP_GENERAL_YES => elgg_echo('pagesmap:settings:yes'),
); 

// initial choice for loading map
$initial_load = $plugin->initial_load;
if (!$initial_load)
	$initial_load = 'all';
	
$options = array();
$options[elgg_echo('pagesmap:settings:initial_load:all')] = 'all';
$options[elgg_echo('pagesmap:settings:initial_load:newest')] = 'newest';
$options[elgg_echo('pagesmap:settings:initial_load:mylocation')] = 'location';
	
$initial = '<div class="amap_settings_box">';
$initial .= '<div class="elgg-subtext">'.elgg_echo('pagesmap:settings:initial_load:note').'</div>';
$initial .= elgg_view('input/radio', array('name' => 'params[initial_load]', 'value' => $initial_load, 'options' => $options));
$initial .= '</div>';

// no of newest groups
$initial .= '<div class="amap_settings_box">';
$initial .= "<div class='txt_label'>" . elgg_echo('pagesmap:settings:initial_load:newest_no') . ": </div>";
$initial .= elgg_view('input/text', array('name' => 'params[newest_no]', 'value' => (is_numeric($plugin->newest_no)?$plugin->newest_no:AMAP_MA_NEWEST_NO_DEFAULT), 'class' => 'txt_small'));
$initial .= "<span class='elgg-subtext'>".elgg_echo('pagesmap:settings:initial_load:newest_no:note')."</span>";
$initial .= '</div>';

// default radius
$initial .= '<div class="amap_settings_box">';
$initial .= "<div class='txt_label'>" . elgg_echo('pagesmap:settings:initial_load:mylocation_radius') . ": </div>";
$initial .= elgg_view('input/text', array('name' => 'params[mylocation_radius]', 'value' => (is_numeric($plugin->mylocation_radius)?$plugin->mylocation_radius:AMAP_MA_RADIUS_DEFAULT), 'class' => 'txt_small'));
$initial .= "<span class='elgg-subtext'>".elgg_echo('pagesmap:settings:initial_load:mylocation_radius:note')."</span>";
$initial .= '</div>';
echo elgg_view_module("inline", elgg_echo('pagesmap:settings:initial_load:title'), $initial);

// show list on sidebar
$sidebar_list = $plugin->sidebar_list;
if(empty($sidebar_list)){
    $sidebar_list = PAGESMAP_GENERAL_NO;
}    
$sidebar_list_view = '<div class="amap_settings_box">';
$sidebar_list_view .= elgg_view('input/dropdown', array('name' => 'params[sidebar_list]', 'value' => $sidebar_list, 'options_values' => $potential_yesno));
$sidebar_list_view .= "<span class='elgg-subtext'>" . elgg_echo('pagesmap:settings:sidebar_list:note') . "</span>";
$sidebar_list_view .= '</div>';
echo elgg_view_module("inline", elgg_echo('pagesmap:settings:sidebar_list'), $sidebar_list_view);


// redirect menu item to maps
$menu_item_tomaps = $plugin->menu_item_tomaps;
if(empty($menu_item_tomaps)){
    $menu_item_tomaps = PAGESMAP_GENERAL_NO;
}    
$menu_item_tomaps_view = '<div class="amap_settings_box">';
$menu_item_tomaps_view .= elgg_view('input/dropdown', array('name' => 'params[menu_item_tomaps]', 'value' => $menu_item_tomaps, 'options_values' => $potential_yesno));
$menu_item_tomaps_view .= "<span class='elgg-subtext'>" . elgg_echo('pagesmap:settings:menu_item_tomaps:note') . "</span>";
$menu_item_tomaps_view .= '</div>';
echo elgg_view_module("inline", elgg_echo('pagesmap:settings:menu_item_tomaps'), $menu_item_tomaps_view);


// set default icon
$markericon = $plugin->markericon;
if(empty($markericon)){
        $markericon = 'smiley';
}    
$potential_icon = array(
    "pages_blue" => elgg_echo('pagesmap:settings:markericon:pagesmap_blue'),
    "pages_royal_blue" => elgg_echo('pagesmap:settings:markericon:pagesmap_royal_blue'),
    "pages_forest_green" => elgg_echo('pagesmap:settings:markericon:pagesmap_forest_green'),
    "pages_gray" => elgg_echo('pagesmap:settings:markericon:pagesmap_gray'),
    "pages_orange" => elgg_echo('pagesmap:settings:markericon:pagesmap_orange'),
    "pages_pink" => elgg_echo('pagesmap:settings:markericon:pagesmap_pink'),
    "pages_purple" => elgg_echo('pagesmap:settings:markericon:pagesmap_purple'),
    "pages_red" => elgg_echo('pagesmap:settings:markericon:pagesmap_red'),
    "pages_violet_red" => elgg_echo('pagesmap:settings:markericon:pagesmap_violet_red'),
    "pages_yellow" => elgg_echo('pagesmap:settings:markericon:pagesmap_yellow'),
); 

$map_icon = elgg_view('input/dropdown', array('name' => 'params[markericon]', 'value' => $markericon, 'options_values' => $potential_icon));
$map_icon .= "<span class='elgg-subtext'>" . elgg_echo('pagesmap:settings:markericon:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('pagesmap:settings:markericon'), $map_icon);

