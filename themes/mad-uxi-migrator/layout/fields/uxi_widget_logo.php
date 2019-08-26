<?php
	$content = get_sub_field('content', false);
	$class = get_sub_field('class');
	$id = get_sub_field('id');
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
    <?php echo do_shortcode($content); ?>
		<a class="uxi-logo" href="<?php echo home_url(); ?>">
			<img src="<?php echo get_field('uxi_logo', 'option'); ?>">
		</a>
	</div>
</div>
