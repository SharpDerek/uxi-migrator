<?php

/**
* custom admin bar logo
*/

if(CUSTOM_ADMIN_BAR_LOGO) {
  if ( is_admin_bar_showing() ) {
    function mad_admin_bar_logo() {
      echo '<style>#wp-admin-bar-wp-logo > .ab-item .ab-icon { background: url('.get_stylesheet_directory_uri().'/img/admin-logo.png) no-repeat 0px 0px; } #wpadminbar.nojs #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon, #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { background-position: 0 -20px; }</style>';
    }
    add_action('wp_head', 'mad_admin_bar_logo');
    add_action('admin_head', 'mad_admin_bar_logo');
  }
}

add_action('mad_posts_pagination', 'mad_posts_nav');