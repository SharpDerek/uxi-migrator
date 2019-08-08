<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

  <article <?php post_class() ?> itemscope itemtype="http://schema.org/BlogPosting">
    
    <header class="post-header">
      <div class="page-header">
        <h1 class="page-header-title inherit" id="main-title"><?php the_title(); ?></h1>
      </div>
      <?php get_template_part('templates/post-meta'); ?>
    </header>
    <?php if ( has_post_thumbnail()) : ?>
      <figure class="post-image post-image-below-heading-center">
          <?php the_post_thumbnail('mad_featured_single', 'itemprop=image'); ?>
      </figure>
    <?php endif; ?>
  
    <?php edit_post_link( __( '<span class="icon-uxis-pencil"></span> Edit Post', 'mad' ), '<p class="post-edit">', '</p>' ); ?>
    
    <div class="post-body" itemprop="articleBody">
      <?php the_content(); ?>
    </div>
    
    <footer class="post-footer">
      <?php wp_link_pages(array('before' => '<nav class="pagination-nav clearfix"><h2 class="visuallyhidden">'.__('Pagination Navigation', 'mad').'</h2>' . __('Pages:', 'mad'), 'after' => '</nav>' )); ?>
      <div class="post-meta">
        <dl class="post-cats">
          <dt title="Categories"><span class="icon-uxis-folder-open"></span> <span class="sr-only"><?php _e('Categories:', 'mad'); ?></span></dt>
          <dd itemprop="articleSection">
            <?php the_category(', '); ?>
          </dd>
        </dl>

        <?php if ( has_tag() ) : ?>
        <dl class="post-tags">
          <dt title="Tags"><span class="icon-uxis-tags"></span> <span class="sr-only"><?php _e('Tags:', 'mad'); ?></span></dt>
          <dd itemprop="articleSection">
            <?php the_tags('', ', ', ''); ?>
          </dd>
        </dl>
      </div>
      <?php endif; ?>
    </footer>
    
    <?php comments_template('/templates/comments.php'); ?>
    
  </article>

<?php /* End loop */ ?>
<?php endwhile; wp_reset_query(); ?>