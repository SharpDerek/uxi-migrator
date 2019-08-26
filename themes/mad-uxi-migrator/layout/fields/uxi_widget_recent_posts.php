<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$content = get_sub_field('content', false);
	$num_posts = (int)get_sub_field('num_posts');
	$column_width = 12 / get_sub_field('num_columns');
	$title = get_sub_field('title');
	$title_class = get_sub_field('title_class');
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<?php echo do_shortcode($content); ?>
		<section class="uxi-widget-recent-posts">
			<h2 class="<?php echo $title_class; ?>"><?php echo $title; ?></h2>
			<?php
			$args = array (
				'post_type' => 'post',
				'posts_per_page' => $num_posts
			);

			$post_query = new WP_Query($args);

			if (have_posts($post_query)): ?>
				<ol class="posts recent-posts row recent-posts-row">
					<?php while ($post_query->have_posts()): $post_query->the_post(); ?>
						<li class="recent-posts grid-tab-<?php echo $column_width; ?>">
							  <article>
						          <header class="post-header">
						            <h3 class="post-header-title h4">
						              <a href="<?php the_permalink(); ?>" title="Permanent Link to Full Post" rel="bookmark">
						                <span><?php the_title(); ?></span>
						              </a>
						            </h3>
						            <?php //get_template_part('templates/post-meta'); ?>
						          </header>
						          <div class="post-description clearfix">
						            <?php mad_excerpt(); ?>
						          </div>
						      </article>
						</li>
					<?php endwhile; ?>
				</ol>
			<?php endif; ?>
		</section>
	</div>
</div>
