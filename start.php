<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */

require_once(dirname(__FILE__) . "/lib/hooks.php");

elgg_register_event_handler('init', 'system', 'pagesmap_init');

define('PAGESMAP_GENERAL_YES', 'yes');	// general purpose string for yes
define('PAGESMAP_GENERAL_NO', 'no');	// general purpose string for no

/**
 * PagesMap plugin initialization functions.
 */
function pagesmap_init() {  
    		
    // load maps api libraries if it's enabled. If not, it will not work
    if(elgg_is_active_plugin('amap_maps_api')){
        elgg_load_library('elgg:amap_maps_api');  
    }
	
    if (redirect_menu_to_maps()) {
        // make default pages map instead of all
        elgg_unregister_menu_item('pages', elgg_echo('pages'));
        $item = new ElggMenuItem('pages', elgg_echo('pages'), 'pages/map');
        elgg_register_menu_item('site', $item);
    }
    
    // Extend CSS
    elgg_extend_view('css/elgg', 'pagesmap/css');
    
    // Add filter-menu on groups
    elgg_register_plugin_hook_handler('register', 'menu:filter', 'add_pages_map_tab');    
    
    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('pages', 'pages_pagesmap_handler');

    // Register actions
    $action_path = elgg_get_plugins_path() . 'pagesmap/actions/pages';
    $action_path_map = elgg_get_plugins_path() . 'pagesmap/actions/pagesmap';
    elgg_unregister_action('pages/edit');	// unregister default pages edit action
    elgg_register_action("pages/edit", "$action_path/edit.php");	// register pagesmap edit action
    elgg_register_action('pagesmap/nearby_search', "$action_path_map/nearby_search.php", 'public');   
}

// this function has been taken from pages plugin
function pages_pagesmap_handler($page) {
    elgg_load_library('elgg:pages');

    if (!isset($page[0])) {
        $page[0] = 'all';
    }

    //elgg_push_breadcrumb(elgg_echo('pages'), 'pages/all');

    $page_type = $page[0];

    if ($page_type == 'map') {
        echo elgg_view_resource('pagesmap/nearby');
    }
    else {
        // return the original page handler
        return pages_page_handler($page);
    }

    return true;	
}

/**
 * Check in setting if redirect core pages plugin menu item to maps
 * 
 * @return boolean
 */
function redirect_menu_to_maps() {
    $what = trim(elgg_get_plugin_setting('menu_item_tomaps', 'pagesmap'));
    if ($what === PAGESMAP_GENERAL_YES) {
        return true;
    }    

    return false;
}





