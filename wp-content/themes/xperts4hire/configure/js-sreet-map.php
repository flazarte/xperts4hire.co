<?php

function street_map_js(){
			//<!-- Leaflet // Docs: https://leafletjs.com/ -->
			wp_enqueue_script('leaflet-min-js', get_template_directory_uri() . '/js/leaflet.min.js', array(), null, true );
			//<!-- Leaflet Maps Scripts (locations are stored in leaflet-hireo.js) -->
			wp_enqueue_script('leaflet-markercluster', get_template_directory_uri() . '/js/leaflet-markercluster.min.js', array(), null, true );
			wp_enqueue_script('leaflet-gesture-handling', get_template_directory_uri() . '/js/leaflet-gesture-handling.min.js', array(), null, true );
			wp_enqueue_script('leaflet-js', get_template_directory_uri() . '/js/leaflet-hireo.js', array(), null, true );
			//<!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
			wp_enqueue_script('leaflet-autocomplete', get_template_directory_uri() . '/js/leaflet-autocomplete.js', array(), null, true );
			wp_enqueue_script('leaflet-control-geocoder', get_template_directory_uri() . '/js/leaflet-control-geocoder.js', array(), null, true );
}
add_action('wp_enqueue_scripts', 'street_map_js', 100);	