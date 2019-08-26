<?php
	$content = get_sub_field('content', false);
	$class = get_sub_field('class');
	$id = get_sub_field('id');
?>
<div uxi-widget id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<?php echo do_shortcode($content); ?>
		<?php if (have_rows('social_links')): ?>
			<ul class="social-icons">
				<?php $index = 0; while (have_rows('social_links')): the_row(); ?>
					<li class="social-icon social-icon-<?php echo $index; ?>">
						<a href="<?php echo get_sub_field('link'); ?>" target="_blank" rel="external">
							<span class="<?php echo get_sub_field('icon'); ?>" aria-hidden="true"></span>
						</a>
					</li>
				<?php $index++; endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>