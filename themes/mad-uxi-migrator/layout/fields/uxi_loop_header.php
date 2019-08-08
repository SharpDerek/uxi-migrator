<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	if (is_home() || is_archive()) {
		$post = get_queried_object();
		$post_title = $post->label;
	} else {
		$post = get_post(MAIN_PAGE_ID);
		$post_title = $post->post_title;
	}
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