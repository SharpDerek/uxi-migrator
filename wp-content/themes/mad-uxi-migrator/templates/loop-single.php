<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<?php mad_post_before(); ?>
  <article <?php post_class() ?> itemscope itemtype="http://schema.org/BlogPosting">
    <?php mad_post_inside_before(); ?>
    
    <header class="post-header">
      <div class="page-title">
        <h1 itemprop="headline"><?php the_title(); ?></h1>
      </div>
      <?php get_template_part('templates/post-meta'); ?>
    </header>
    
    <div class="post-body" itemprop="articleBody">
      <?php the_content(); ?>
    </div>
    
    <footer class="post-footer">
      <?php wp_link_pages(array('before' => '<nav class="pagination-nav clearfix"><h2 class="visuallyhidden">'.__('Pagination Navigation', 'mad').'</h2>' . __('Pages:', 'mad'), 'after' => '</nav>' )); ?>
      <div class="post-meta">
        <dl class="post-cats first">
          <dt><i class="icon-mw-folder-open"></i> <span class="visuallyhidden"><?php _e('Categories:', 'mad'); ?></span></dt>
          <dd itemprop="articleSection">
            <?php the_category(', '); ?>
          </dd>
        </dl>
        
        <?php if ( has_tag() ) : ?>
        <dl class="post-tags">
          <dt><i class="icon-mw-tags"></i> <span class="visuallyhidden"><?php _e('Tags:', 'mad'); ?></span></dt>
          <dd itemprop="articleSection">
            <?php the_tags('', ', ', ''); ?>
          </dd>
        </dl>
      </div>
      <?php endif; ?>
    </footer>
    
    <?php comments_template('/templates/comments.php'); ?>
    
    <?php mad_post_inside_after(); ?>
  </article>
<?php mad_post_after(); ?>

<?php /* End loop */ ?>
<?php endwhile; wp_reset_query(); ?>