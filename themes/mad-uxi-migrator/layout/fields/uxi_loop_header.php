<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	if (is_404()){
		$post_title = "Not Found";
	} else if (is_search()) {
		global $wp_query;
		$post_title = "Search Results for '{$wp_query->query['s']}'";
	} else if (is_home() || is_archive()) {
		$post = get_queried_object();
		if (is_category()) {
			$post_title = $post->name;
		} else {
			if (property_exists($post, 'rewrite')) {
				$post_title = $post->label;
			} else {
				$post_title = $post->post_title;
			}
		}
	} else {
		$post = get_post(MAIN_PAGE_ID);
		$post_title = $post->post_title;
	}
	$titleclass = get_sub_field('title_class');
	$subtitle = get_sub_field('subtitle');
	$subtitleclass = get_sub_field('subtitle_class');
	$bodyclass = get_sub_field('body_class');
	$body = is_category() ? category_description(): get_sub_field('body', false);
	$content = get_sub_field('content', false);
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
    <?php echo do_shortcode($content); ?>
		<header class="jumbotron jumbotron-page-header">
			<h1 class="<?php echo $titleclass; ?>" id="main-title">
				<div class="jumbotron-heading-inner"><?php echo $post_title; ?></div>
			</h1>
			<?php if ($subtitle): ?>
				<div class="<?php echo $subtitleclass; ?>">
					<div class="jumbotron-subheading-inner">
						<p>
							<span><?php echo $subtitle; ?></span>
						</p>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($body): ?>
				<div class="<?php echo $bodyclass; ?>">
					<div class="jumbotron-paragraph">
						<div class="jumbotron-paragraph-inner">
							<?php echo do_shortcode($body); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</header>
	</div>
</div>