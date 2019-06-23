<?php

function mad_get_all_wordpress_menus(){
	return get_terms( 'nav_menu', array( 'hide_empty' => false ) ); 
}

function mad_populate_menus( $field ) {
    
    // reset choices
    $field['choices'] = array();
        
        // while has rows
        foreach(mad_get_all_wordpress_menus() as $menu) {
            
            // append to choices
            $field['choices'][$menu->slug] = $menu->name;
            
        }


    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=widget_uxi_menu', 'mad_populate_menus');