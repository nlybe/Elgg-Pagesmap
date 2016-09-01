##PagesMap Plugin for Elgg##

Elgg plugin for showing pages posts on a Google Map, offering multiple search options.

This plugin requires the Maps API plugin (https://github.com/nlybe/Elgg-MapsAPI)

Demo: http://nikos.lyberakis.gr/elgg/pages/map

== Contents ==

1. Features
2. Installation

###1. Features###

- Option to redirect the standard pages menu item to map of pages
- Option to display pages around current logged-in user's location
- Option to show initially all pages, newest pages or pages around current loggedin user's location
- Optionally, a list of pages, which are displayed on map, is loaded on sidebar
- Search pages on map using location, radius and keyword
- Requires Elgg Pages plugin
- Based on Google Geocoding API
- Elgg caching of pages location
- On pages edit form added a new field for location
- Use of MarkerClusterer for improving map view when a large number of pages are displayed on map
- When multiple markers are located at the same or nearby location, they are splitted out so they are clickable
- Search for pages entries based on a given address and radius
- Visit pages from map
- Option to select marker in settings
- A new tab "Pages Map" added on Pages
- Multiple configuration options about google maps

###2. Installation###

Requires: Elgg 2.1 or higher

1. Upload amap_maps_api plugin in "/mod/" elgg folder and activate it
2. In "Administration/Configure/Settings/AgoraMap Maps API" you must enter API keys and basic map options
3. Upload pagesmap in "/mod/" elgg folder and activate it
4. In "Administration/Configure/Settings/Map of Pages" you can configure several plugin options





