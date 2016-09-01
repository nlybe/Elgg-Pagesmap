<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */

$language = array(

    // general
    'pagesmap:label:map' => 'Pages Map', 
    'pagesmap:tab:label' => 'Map', 
    'pagesmap:form:setlocation' => 'Set page location', 
    'pagesmap:form:search' => 'Search', 
    'pagesmap:form:latlon' => 'Lat/Lon: ', 
    'pagesmap:search' => 'Search', 
    'pagesmap:search:location' => 'location', 
    'pagesmap:search:showradius' => 'Show search area', 
    'pagesmap:search:submit' => 'Search', 
    'pagesmap:searchnearby' => 'Search nearby', 
    'pagesmap:mylocationsis' => 'My location is: ', 
    'pagesmap:map:2' => 'No valid search address: ', 
    'pagesmap:settings:amap_maps_api:notenabled' => 'The AgoraMap Maps Api plugin is not enabled',
    'pagesmap:all' => 'Map of Pages',
	
    // nearby 
    'pagesmap:members:nearby:search' => 'Pages near "%s"', 
    'pagesmap:members:newest' => 'Map with %s newest pages', 	
   
    // settings
    'pagesmap:settings:markericon' => 'Marker Icon',
    'pagesmap:settings:markericon:note' => 'Select the color of marker for pages on map',
    'pagesmap:settings:markericon:pagesmap_blue' => 'Blue',
    'pagesmap:settings:markericon:pagesmap_royal_blue' => 'Blue Royal',
    'pagesmap:settings:markericon:pagesmap_forest_green' => 'Green',
    'pagesmap:settings:markericon:pagesmap_gray' => 'Gray',
    'pagesmap:settings:markericon:pagesmap_orange' => 'Orange',
    'pagesmap:settings:markericon:pagesmap_pink' => 'Pink',
    'pagesmap:settings:markericon:pagesmap_purple' => 'Purple',
    'pagesmap:settings:markericon:pagesmap_red' => 'Red',
    'pagesmap:settings:markericon:pagesmap_violet_red' => 'Red Violet',
    'pagesmap:settings:markericon:pagesmap_yellow' => 'Yellow',
    
    'pagesmap:settings:initial_load:title' => 'Initial map',
    'pagesmap:settings:initial_load:note' => 'Select what to show on initial map',
    'pagesmap:settings:initial_load:all' => 'All pages',
    'pagesmap:settings:initial_load:newest' => 'Newest pages',
    'pagesmap:settings:initial_load:mylocation' => 'User\'s location',
    'pagesmap:settings:initial_load:newest_no' => 'No of newest pages',
    'pagesmap:settings:initial_load:newest_no:note' => 'If <strong>pages users</strong> selected, enter the number of newest pages to display.',
    'pagesmap:settings:initial_load:mylocation_radius' => 'Radius',
    'pagesmap:settings:initial_load:mylocation_radius:note' => 'If <strong>User\'s location</strong> selected, enter the default radius for searching around user\'s location.',    
    'pagesmap:settings:sidebar_list' => 'Display list of pages on sidebar', 
    'pagesmap:settings:sidebar_list:note' => 'Select if you want to display list of pages in sidebar. The pages will be clickable displaying the info window of page on map.',  
    'pagesmap:settings:menu_item_tomaps' => 'Redirect pages menu item to map', 
    'pagesmap:settings:menu_item_tomaps:note' => 'Select if you want to redirect the standard pages menu item to map of pages.',  
    'pagesmap:settings:no' => 'No', 
    'pagesmap:settings:yes' => 'Yes',
    
);

add_translation("en", $language);
