<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-info">
    <?php _e('Sorry, no results were found.', 'mad'); ?>
  </div>
<?php else: ?>
  <ol class="posts">

    <?php while (have_posts()) : the_post(); ?>
      <li <?php post_class(); ?>>
      <blockquote>
        <?php if ( has_post_thumbnail()) : ?>
          <div class="post-image post-image-left">
              <a class="post-image-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                <?php the_post_thumbnail('mad_featured_archive', 'itemprop=image'); ?>
              </a>
          </div>
        <?php endif; ?>
        <div class="testimonial-body">
          <header class="testimonial-header">
            <h2 class="testimonial-title h3">
              <a href="<?php the_permalink(); ?>" title="Permanent Link to Full Post" rel="bookmark"><span><?php the_title(); ?></span></a>
            </h2>
            <?php //get_template_part('templates/post-meta'); ?>
          </header>
          <?php edit_post_link( __( '<span class="icon-uxis-pencil"></span> Edit Testimonial', 'mad' ), '<p class="post-edit">', '</p>' ); ?>
          <div class="testimonial-content">
            <p class="post-excerpt">
              <?php mad_excerpt(); ?>
            </p>
          </div>
          <footer class="testimonial-source"><?php echo get_field('testimonial_author', get_the_ID()); ?></footer>
        </div>  
      </blockquote>
    </li>

    <?php endwhile; wp_reset_query(); ?>

    <?php mad_posts_nav(); ?>
  </ol>

<?php endif; ?>