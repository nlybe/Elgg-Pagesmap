<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 *
 * All hooks are here
 */

/**
 * Add a new tab for maps on Pages list views
 * 
 * @param type $hook
 * @param type $type
 * @param type $menu
 * @param type $params
 * @return type
 */
function add_pages_map_tab($hook, $type, $menu, $params) {
    if(elgg_is_active_plugin('amap_maps_api')) {
        if(elgg_in_context('pages')) {
            $filter_context = $params['filter_context'];
            $options = array(
                'name' => 'pagesmap',
                'text' => elgg_echo("pagesmap:tab:label"),
                'href' => "pages/map",
                'priority' => '600',
            );	
            if ($filter_context == 'groupsmap') {
                $options['selected'] = true;
            }
            $menu[] = ElggMenuItem::factory($options);		
        }
        return $menu;
    }
}

