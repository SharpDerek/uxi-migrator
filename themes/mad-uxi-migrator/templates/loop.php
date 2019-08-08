<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-info">
    <?php _e('Sorry, no results were found.', 'mad'); ?>
  </div>
<?php else: ?>
  <ol class="posts">

    <?php while (have_posts()) : the_post(); ?>
      <li <?php post_class(); ?>>
      <article>
        <?php if ( has_post_thumbnail()) : ?>
          <div class="post-image post-image-left">
              <a class="post-image-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                <?php the_post_thumbnail('mad_featured_archive', 'itemprop=image'); ?>
              </a>
          </div>
        <?php endif; ?>
        <div class="post-body">
          <header class="post-header">
            <h2 class="post-header-title h3">
              <a href="<?php the_permalink(); ?>" title="Permanent Link to Full Post" rel="bookmark">
                <span><?php the_title(); ?></span>
              </a>
            </h2>
            <?php //get_template_part('templates/post-meta'); ?>
          </header>
          <div class="post-description clearfix">
            <?php mad_excerpt(); ?>
          </div>
        </div>  
      </article>
    </li>

    <?php endwhile; wp_reset_query(); ?>

    <?php mad_posts_nav(); ?>
  </ol>

<?php endif; ?>