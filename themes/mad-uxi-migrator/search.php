<?php ob_start();
                  
get_template_part('templates/loop', 'search');
  
$additional_content = ob_get_clean();

require_once(get_stylesheet_directory().'/layout/layout-loader.php');        
