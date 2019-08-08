<div class="post-meta">

  <?php /*if ( !is_author() ) : ?>
  <dl class="post-author">
    <dt><?php _e('By:', 'mad'); ?> </dt>
    <dd>
      <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author(); ?></a>
    </dd>
  </dl>
  <?php endif;*/ ?>

  <dl class="post-date first">
    <dt><span class="icon-uxis-clock"></span> <span class="sr-only"><?php _e('Date Published:', 'mad'); ?></span></dt>
      <dd>
        <time itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>">
          <?php echo sprintf(__('%s', 'mad'), get_the_date(), get_the_time()) ?>
        </time>
    </dd>
  </dl>

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
  <?php endif; ?>

</div>