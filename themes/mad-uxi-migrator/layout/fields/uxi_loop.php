<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$heading_tag = get_sub_field('heading_tag');
	if (is_404()){
		$post_title = "Not Found";
	} else if (is_search()) {
		global $wp_query;
		$post_title = "Search Results for '{$wp_query->query['s']}'";
	} else {
		if (is_home() || is_archive()) {
			$post = get_queried_object();
		} else {
			$post = get_post(MAIN_PAGE_ID);
		}
		$content = get_sub_field('content', false);
		if (property_exists($post, 'rewrite')) {
			$post_title = $post->label;
		} else {
			$post_title = $post->post_title;
		}
	}
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<main class="main" id="main-content" role="main" aria-labelledby="main-title">
			<div class="post-<?php echo MAIN_PAGE_ID; ?>">
				<?php if (is_home() || is_archive()): ?>
					<?php if ($heading_tag != 'hidden'): ?>
						<div class="page-header">
							<h1 class="page-header-title <?php echo $heading_tag; ?>" id="main-title"><?php echo $post_title; ?></h1>
						</div>
					<?php endif; ?>
					<?php if (is_post_type_archive('mad360_testimonial')): ?>
						<div id="testimonials-archive-list">
							<?php get_template_part('templates/loop', 'testimonials'); ?>
						</div>
					<?php else: ?>
						<div class="posts-archive-list">
							<?php get_template_part('templates/loop'); ?>
						</div>
					<?php endif; ?>
				<?php elseif (is_singular('mad360_testimonial')): ?>
					<?php get_template_part('templates/loop', 'testimonial'); ?>
				<?php elseif (is_single()): ?>
					<?php get_template_part('templates/loop', 'single'); ?>
				<?php elseif (is_search()): ?>
						<div class="page-header">
							<h1 class="page-header-title" id="main-title"><?php echo $post_title; ?></h1>
						</div>
					<?php get_template_part('templates/loop', 'search'); ?>
				<?php else: ?>
					<?php if ($heading_tag != 'hidden' || is_404()): ?>
						<div class="page-header">
							<h1 class="page-header-title <?php echo (is_404()) ? "" : $heading_tag; ?>" id="main-title"><?php echo $post_title; ?></h1>
						</div>
					<?php endif; ?>
					<div class="editor-content">
						<?php get_template_part('templates/loop','page'); ?>
						<?php echo do_shortcode($additional_content); ?>
					</div>
				<?php endif; ?>
			</div>
		</main>
	</div>
</div>