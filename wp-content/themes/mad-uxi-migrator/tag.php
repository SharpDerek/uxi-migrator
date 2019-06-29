<?php get_header(); ?>

  <?php mad_content_before(); ?>
  
    <?php mad_main_before(); ?>
      <div class="main <?php echo mad_main_class(); ?>" role="main">
        <?php mad_main_inside_before(); ?>
        
          <?php get_template_part('templates/page-header'); ?>
          
          <?php
            $tag_description = tag_description();
            if ( ! empty( $tag_description ) )
              echo apply_filters( 'tag_archive_meta', '<div class="description">' . $tag_description . '</div>' );
          ?>
          
          <?php get_template_part('templates/loop'); ?>
          
        <?php mad_main_inside_after(); ?>
      </div>
      <!-- /.main -->
    <?php mad_main_after(); ?>
      
    <?php get_sidebar(); ?>
    
  <?php mad_content_after(); ?>
  
<?php get_footer(); ?>