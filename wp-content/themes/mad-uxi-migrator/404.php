<?php get_header(); ?>

  <?php mad_content_before(); ?>
  
    <?php mad_main_before(); ?>
      <div class="main <?php echo mad_main_class(); ?>" role="main">
        <?php mad_main_inside_before(); ?>
        
          <?php get_template_part('templates/page-header'); ?>
          
          <div class="alert">
            <?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'mad'); ?>
          </div>
          
          <p><?php _e('Please try the following:', 'mad'); ?></p>
          
          <ul> 
            <li><?php _e('Check your spelling', 'mad'); ?> </li>
            <li><?php printf(__('Return to the <a href="%s">home page</a>', 'mad'), home_url()); ?></li>
            <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'mad'); ?></li>
          </ul>
          
          <?php get_search_form(); ?>
          
        <?php mad_main_inside_after(); ?>
      </div>
      <!-- /.main -->
    <?php mad_main_after(); ?>
      
    <?php get_sidebar(); ?>
    
  <?php mad_content_after(); ?>
  
<?php get_footer(); ?>