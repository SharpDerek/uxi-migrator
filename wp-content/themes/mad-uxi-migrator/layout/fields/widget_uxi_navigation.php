<?php

	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$menu = get_sub_field('widget_uxi_menu');
?>

<div uxi-widget="widget_uxi_navigation" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<nav class="navbar" role="navigation">
			<?php wp_nav_menu(array (
				'menu' => $menu,
				'menu_class' => 'nav navbar-nav navbar-center',
				'container_class' => 'navbar-container',
				'walker' => new Mad_Nav_Walker()
			)); ?>
		</nav>
	</div>
</div>