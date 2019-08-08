<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$content = get_sub_field('content',false);
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<?php echo do_shortcode($content); ?>
	</div>
</div>
