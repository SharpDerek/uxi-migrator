<?php

	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$menu = get_sub_field('widget_uxi_menu');
	$menu_class = get_sub_field('menu_classes');
	$menu_style = get_sub_field('menu_style');
	$menu_title = get_sub_field('menu_title');
	$menu_title_class = get_sub_field('menu_title_classes');
?>

<div uxi-widget="widget_uxi_navigation" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
		<nav class="navbar" role="navigation">
			<?php
				switch ($menu_style) {
					case 'header':
						$walker = new UXi_Nav_Walker();
					break;
					case 'custom':
						$walker = ''; ?>
							<h2 class="<?php echo $menu_title_class; ?>"><?php echo $menu_title; ?></h2>
						<?php
					break;
				}
				wp_nav_menu(array (
					'menu' => $menu,
					'menu_class' => $menu_class,
					'container_class' => 'navbar-container',
					'walker' => $walker
				));
			?>
		</nav>
	</div>
</div>

