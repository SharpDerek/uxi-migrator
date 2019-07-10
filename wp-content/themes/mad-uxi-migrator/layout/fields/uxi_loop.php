<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$content = get_sub_field('content',false);
	$heading_tag = get_sub_field('heading_tag');
	if (is_home() || is_archive()) {
		$post = get_queried_object();
	} else {
		$post = get_post(MAIN_PAGE_ID);
	}
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<main class="main" id="main-content" role="main" aria-labelledby="main-title">
			<div class="post-<?php echo MAIN_PAGE_ID; ?>">
				<div class="page-header">
					<h1 class="page-header-title <?php echo $heading_tag; ?>" id="main-title"><?php echo $post->post_title; ?></h1>
				</div>
				<?php if (is_home()): ?>
					<div class="posts-archive-list">
						<?php get_template_part('templates/loop'); ?>
					</div>
				<?php elseif (is_single()): ?>
					<?php get_template_part('templates/loop','single'); ?>
				<?php else: ?>
					<div class="editor-content">
						<?php echo apply_filters('the_content', $post->post_content); ?>
					</div>
				<?php endif; ?>
			</div>
		</main>
	</div>
</div>