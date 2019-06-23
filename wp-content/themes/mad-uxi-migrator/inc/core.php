<?php

function mad_get_all_wordpress_menus(){
	return get_terms( 'nav_menu', array( 'hide_empty' => false ) ); 
}

function mad_populate_menus( $field ) {
    
    $field['choices'] = array();
        foreach(mad_get_all_wordpress_menus() as $menu) {
            $field['choices'][$menu->slug] = $menu->name;
            
        }
    return $field;
    
}

add_filter('acf/load_field/name=widget_uxi_menu', 'mad_populate_menus');