<?php
/**
 * Elgg PagesMap  plugin
 * @package pagesmap
 */

$language = array(

    // general
    'pagesmap:label:map' => 'Χάρτης', 
    'pagesmap:tab:label' => 'Χάρτης', 
    'pagesmap:form:setlocation' => 'Καθορισμός τοποθεσίας', 
    'pagesmap:form:search' => 'Αναζήτηση', 
    'pagesmap:form:latlon' => 'Συντεταγμένες: ', 
    'pagesmap:search' => 'Αναζήτηση', 
    'pagesmap:search:location' => 'τοποθεσία', 
    'pagesmap:search:showradius' => 'προβολή περιοχής αναζήτησης', 
    'pagesmap:search:submit' => 'Αναζήτηση', 
    'pagesmap:searchnearby' => 'Κοντινή Αναζήτησης', 
    'pagesmap:mylocationsis' => 'Η τοποθεσία μου: ', 
    'pagesmap:map:2' => 'Μη έγκυρη διεύθυνση αναζήτησης: ', 
    'pagesmap:settings:amap_maps_api:notenabled' => 'To plugin Agoramap Maps Api δεν είναι ενεργοποιημένο',
    'pagesmap:all' => 'Χάρτης Σελίδων',
	
    // nearby 
    'pagesmap:members:nearby:search' => 'Σελίδες κοντά "%s"', 
    'pagesmap:members:newest' => 'Χάρτης με τις %s πιο πρόσφατες σελίδες', 	
   
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

add_translation("el", $language);
