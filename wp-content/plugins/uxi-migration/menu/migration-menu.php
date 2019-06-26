<div class="wrap">
	<h1 class="wp-heading-inline">UXI MIGRATOR</h1>

	<div class="migrator-wrap">

	<?php

	if (!UXI_THEME_INSTALLED): ?>

	<p>This migrator will not work unless the UXi Migration theme is installed</p>

	<?php else: ?>

		<div class="migrator-form">

		   <form method="post" action="<?php menu_page_url('uxi-migration',true); ?>">
		     <p class="submit">
		       <input type="text" name="uxi-url" placeholder="type your URL here">
		       <input name="do_it" type="submit" class="button-primary" value="Start Migration"> 
		     </p>
		   </form>
		</div>

		<?php if (isset($_POST['uxi-url'])) { ?>

   			<div class="migrator-progress">
			
			<?php
				/**
				 * Provide a admin area view for the plugin
				 *
				 * This file is used to markup the admin-facing aspects of the plugin.
				 *
				 */
				// check for admin role of current user
				function is_site_admin(){
				  return in_array('administrator',  wp_get_current_user()->roles);
				}

				// create nonce for auth if the user is admin
				if (is_site_admin()) {
				  $nonce = wp_create_nonce( 'wp_rest' );
				} else {
				  $nonce = 'none';
				}
				echo "<script>";
				echo "var do_rest = true;\n";
				echo "var uxi_url = '".trailingslashit($_POST['uxi-url'])."';\n";
				$args = array (
					'post_type' => 'page',
					'posts_per_page' => -1,
				);
				$pages_query = new WP_Query($args);
				if ($pages_query->have_posts()) {
					echo "var pageArray=[";
					while($pages_query->have_posts()) {
						$pages_query->the_post();
						echo get_the_ID();
						echo ",\n";
					}
					echo "];";
				}
				echo "var nonce = '".$nonce."';\n </script>";

				define('UXI_URL',trailingslashit($_POST['uxi-url']));
				
				?>


			</div>

		<?php } ?>
	<?php endif; ?>
	</div>
</div>
<style>
.migrator-progress .sub {
	padding-left:20px;
}
.migrator-progress .sub-sub {
	padding-left:40px;
}
</style>
<?php 