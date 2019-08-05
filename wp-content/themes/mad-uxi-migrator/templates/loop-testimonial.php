<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

  <blockquote <?php post_class() ?> itemscope itemtype="http://schema.org/BlogPosting">
  
    <?php edit_post_link( __( '<span class="icon-uxis-pencil"></span> Edit Testimonial', 'mad' ), '<p class="post-edit">', '</p>' ); ?>
    
    <div class="testimonial-content editor-content">
      <?php the_content(); ?>
    </div>
    
    <footer class="testimonial-source"><?php echo get_field('testimonial_author', get_the_ID()); ?></footer>

  </blockquote>

<?php /* End loop */ ?>
<?php endwhile; wp_reset_query(); ?>