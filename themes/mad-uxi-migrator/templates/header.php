<header uxi-header role="banner">
	<a class="sr-only" href="#main-content">Skip to main content area</a>
	<div class="site-header site-wrap clearfix visible-desk">
<?php

$layout_id = UXI_HEADER_LAYOUT;
require(get_stylesheet_directory().'/layout/layout.php'); ?>
</div><!-- site header-->
<div class="mobile-navbar visible-palm visible-tab">
	<?php
		while (have_rows('mobile_navigation','option')): the_row();
		$mobile_header = get_sub_field('header_content',false);
		$mobile_left_drawer = get_sub_field('widget_uxi_menu',false);
		$mobile_right_drawer = get_sub_field('mobile_drawer_right_content',false);
		endwhile;
	?>
	<div class="mobile-navbar-header" data-headroom>
		<?php echo $mobile_header; ?>
	</div>
	<?php if ($mobile_left_drawer): ?>
		<div class="mobile-drawer mobile-drawer-left">
			<nav role="navigation">
				<h2 class="sr-only">Site Mobile Navigation</h2>
				<?php
					wp_nav_menu(array (
						'menu' => $mobile_left_drawer,
						'menu_class' => 'mobile-nav',
						'walker' => new UXi_Mobile_Nav_Walker()
					));
				?>
		</div>
	<?php endif; ?>
	<?php if ($mobile_right_drawer): ?>
		<div class="mobile-drawer mobile-drawer-right">
			<?php echo do_shortcode($mobile_right_drawer); ?>
		</div>
	<?php endif; ?>
	<div class="mobile-content-overlay"></div>
</div><!-- mobile navbar -->
</header>