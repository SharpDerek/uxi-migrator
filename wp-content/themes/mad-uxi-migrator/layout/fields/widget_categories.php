<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$title = get_sub_field('title');
	$title_class = get_sub_field('title_class');
	$count = get_sub_field('show_count');
	$hierarchical = get_sub_field('hierarchical');
	$dropdown = get_sub_field('dropdown');
?>
<div uxi-widget="widget_categories" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<?php the_widget(
			'WP_Widget_Categories',
			array (
				'dropdown' => $dropdown,
				'count' => $count,
				'hierarchical' => $hierarchical,
				'title' => $title,
			),
			array (
				'before_title' => '<h2 class="'.$title_class.'">'
			)
		); ?>
	</div>
</div>