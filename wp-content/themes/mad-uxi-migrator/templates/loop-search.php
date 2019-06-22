<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-info">
    <?php _e('Sorry, no results were found.', 'mad'); ?>
  </div>
<?php endif; ?>

<ul class="search-results products">
  <?php /* Start loop */ ?>
  <?php while (have_posts()) : the_post(); ?>
  
    <?php if (get_post_type()=='product') :  ?>
    
      <?php woocommerce_get_template_part( 'content', 'product' ); ?>    
      
    <?php else : ?>

      <li>
        <?php mad_post_before(); ?>
          <section <?php post_class('search-result'); ?>>
          <?php mad_post_inside_before(); ?>    
          
            <header class="post-header">
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
            
            <div class="post-description clearfix">
            <?php if ( has_post_thumbnail()) : ?>
              <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                <?php the_post_thumbnail('thumbnail', 'itemprop=image'); ?>
              </a>
            <?php endif; ?>
              <?php mad_the_excerpt( POST_EXCERPT_LENGTH ); ?>
            </div>
          
            <?php mad_post_inside_after(); ?>
          </section>
        <?php mad_post_after(); ?>
      </li>
      
    <?php endif; ?>
  
  <?php /* End loop */ ?>
  <?php endwhile; wp_reset_query(); ?>

</ul>

<?php mad_posts_pagination(); ?>