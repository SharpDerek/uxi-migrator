<?php
/*
Template Name: Sitemap
*/
get_header(); ?>
  
  <?php mad_content_before(); ?>
  
    <?php mad_main_before(); ?>
      <div class="main <?php echo mad_main_class(); ?>" role="main">
        <?php mad_main_inside_before(); ?>
        
          <?php get_template_part('templates/loop', 'page'); ?>
          
          <h2><?php _e('Pages', 'mad'); ?></h2>
          <ul><?php wp_list_pages('sort_column=menu_order&depth=0&title_li='); ?></ul>

          <h2><?php _e('Posts', 'mad'); ?></h2>
          <ul><?php wp_list_categories('title_li=&hierarchical=0&show_count=1'); ?></ul>
        
        <?php mad_main_inside_after(); ?>
      </div>
      <!-- /.main -->
    <?php mad_main_after(); ?>
    
    <?php get_sidebar(); ?>
  
  <?php mad_content_after(); ?>
  
<?php get_footer(); ?>