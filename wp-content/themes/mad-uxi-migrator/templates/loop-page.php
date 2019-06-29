<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
  
  <?php get_template_part('templates/page-header'); ?> 

  <?php the_content(); ?>
  
  <?php wp_link_pages(array('before' => '<nav class="pagination-nav clearfix"><h2 class="visuallyhidden">'.__('Pagination Navigation', 'mad').'</h2>' . __('Pages:', 'mad'), 'after' => '</nav>' )); ?>

<?php /* End loop */ ?>
<?php endwhile; wp_reset_query(); ?>