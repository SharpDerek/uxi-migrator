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
<<<<<<< Updated upstream
		$post_title = $post->label;
=======
		if (is_category()) {
			$post_title = $post->name;
		} else {
			if (property_exists($post, 'rewrite')) {
				$post_title = $post->label;
			} else {
				$post_title = $post->post_title;
			}
		}
>>>>>>> Stashed changes
	} else {
		$post = get_post(MAIN_PAGE_ID);
		$post_title = $post->post_title;
	}
<<<<<<< Updated upstream
=======
	$titleclass = get_sub_field('title_class');
	$subtitle = get_sub_field('subtitle');
	$subtitleclass = get_sub_field('subtitle_class');
	$bodyclass = get_sub_field('body_class');
	$body = is_category() ? category_description(): get_sub_field('body', false);
	$content = get_sub_field('content', false);
>>>>>>> Stashed changes
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<header class="jumbotron jumbotron-page-header">
			<h1 class="jumbotron-heading header-font" id="main-title">
				<div class="jumbotron-heading-inner"><?php echo $post_title; ?></div>
			</h1>
		</header>
	</div>
</div>