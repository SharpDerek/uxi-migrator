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

   				<style>
   					#migrator-progress-wrap {
   						width:100%;
   						max-width:500px;
   						background: #737373;
   						overflow:hidden;
   						border-radius: 50px;
   						position:relative;
   						height:50px;
   					}
   					#migrator-progress-inner {
   						position:absolute;
   						top:0;
   						bottom:0;
   						left:0;
   						width:0;
   						height:100%;
   						background: #66ff33;
   						border-radius:50px;
   						text-align:center;
   						overflow:hidden;
   						display:table;
   						transition: 0.3s;
   					}
   					#migrator-progress-percent {
   						vertical-align:middle;
   						color: white;
   						text-shadow: 1px 1px 2px black;
   						display:table-cell;
   						width:0;
   					}
   				</style>

   				<div id="migrator-progress-wrap">
   					<div id="migrator-progress-inner">
   						<span id="migrator-progress-percent"></span>
   					</div>
   				</div>
			
			<?php
			
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
					'post_type' => array (
						'post',
						'page',
						'mad360_testimonial'
					),
					'posts_per_page' => -1,
				);
				$posts_query = new WP_Query($args);
				if ($posts_query->have_posts()) {
					echo "var slugArray=[";
					while($posts_query->have_posts()) {
						$posts_query->the_post();
						echo '"'.get_post_field('post_name',get_the_ID()).'"';
						echo ",\n";
					}
					echo "];";
				}
				echo "var nonce = '".$nonce."';\n </script>";

				$response = uxi_curl($_POST['uxi-url']);

				define('UXI_URL',trailingslashit($_POST['uxi-url']));

				require(UXI_MIGRATOR_PATH.'migrator/migrations/uxi-migrations-loader.php');
				
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