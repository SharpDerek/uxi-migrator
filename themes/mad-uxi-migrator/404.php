<?php ob_start(); ?>

  <div class="alert">
    <?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'mad'); ?>
  </div>
  
  <p><?php _e('Please try the following:', 'mad'); ?></p>
  
  <ul> 
    <li><?php _e('Check your spelling', 'mad'); ?> </li>
    <li><?php printf(__('Return to the <a href="%s">home page</a>', 'mad'), home_url()); ?></li>
    <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'mad'); ?></li>
  </ul>
  
  <?php get_search_form(); 

  $additional_content = ob_get_clean();

require_once(get_stylesheet_directory().'/layout/layout-loader.php');