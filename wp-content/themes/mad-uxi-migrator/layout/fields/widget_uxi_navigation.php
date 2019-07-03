<?php

	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$menu = get_sub_field('widget_uxi_menu');
	$menu_class = get_sub_field('menu_classes');
?>

<div uxi-widget="widget_uxi_navigation" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<nav class="navbar" role="navigation">
			<?php wp_nav_menu(array (
				'menu' => $menu,
				'menu_class' => $menu_class,
				'container_class' => 'navbar-container',
				'walker' => new UXi_Nav_Walker()
			)); ?>
		</nav>
	</div>
</div>

