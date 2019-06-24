<div class="post-meta">

  <?php if ( !is_author() ) : ?>
  <dl class="post-author">
    <dt><?php _e('By:', 'mad'); ?> </dt>
    <dd>
      <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author(); ?></a>
    </dd>
  </dl>
  <?php endif; ?>

  <dl class="post-date first">
    <dt><i class="icon-mw-clock"></i> <span class="visuallyhidden"><?php _e('Posted on:', 'mad'); ?></span></dt>
      <dd>
        <time itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>">
          <?php echo sprintf(__('%s', 'mad'), get_the_date(), get_the_time()) ?>
        </time>
    </dd>
  </dl>

  <dl class="post-cats">
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
  <?php endif; ?>
  
  <?php edit_post_link( __( '<i class="icon-mw-edit"></i> Edit Post', 'mad' ), '<p>', '</p>' ); ?>

</div>