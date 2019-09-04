<?php /* If there are no posts to display, such as an empty archive page */ ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-info">
    <?php _e('Sorry, no results were found.', 'mad'); ?>
  </div>
<?php endif; ?>

<ol class="search-results posts">
  <?php /* Start loop */ ?>
  <?php while (have_posts()) : the_post(); ?>
  
    <?php if (get_post_type()=='product') :  ?>
    
      <?php woocommerce_get_template_part( 'content', 'product' ); ?>    
      
    <?php else : ?>

      <li <?php post_class('search-result'); ?>>

        <div class="post-body">
          
            <div class="post-header">
              <h2 class="post-header-title inherit"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
            
            <div class="post-description clearfix">
            <p>
              <b><?php echo sprintf(__('%s', 'mad'), get_the_date(), get_the_time()) ?> | <?php echo get_the_permalink(); ?></b>
            </p>
              <?php mad_excerpt(); ?>
            </div>
        </div>
      </li>
      
    <?php endif; ?>
  
  <?php /* End loop */ ?>
  <?php endwhile; wp_reset_query(); ?>

</ul>

<?php mad_posts_nav(); ?>