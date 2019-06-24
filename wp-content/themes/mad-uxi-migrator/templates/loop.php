<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-info">
    <?php _e('Sorry, no results were found.', 'mad'); ?>
  </div>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<?php mad_post_before(); ?>
  <article <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
    <?php mad_post_inside_before(); ?>    
    
      <header class="post-header">
        <h2 itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php get_template_part('templates/post-meta'); ?>
      </header>
      
      <div class="post-description clearfix" itemprop="description"> 
        <?php if ( has_post_thumbnail()) : ?>
          <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
            <?php the_post_thumbnail('thumbnail', 'itemprop=image'); ?>
          </a>
        <?php endif; ?>
        <?php mad_the_excerpt( POST_EXCERPT_LENGTH ); ?>
      </div>
    
    <?php mad_post_inside_after(); ?>
  </article>
<?php mad_post_after(); ?>

<?php /* End loop */ ?>
<?php endwhile; wp_reset_query(); ?>

<?php mad_posts_pagination(); ?>