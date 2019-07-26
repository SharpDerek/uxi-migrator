<div class="wrap">
	<h1 class="wp-heading-inline">UXI MIGRATOR</h1>

	<div class="migrator-wrap">

	<?php

	require_once(plugin_dir_path(__FILE__).'migration-checklist.php');

	if (!UXI_THEME_INSTALLED): ?>

	<p>This migrator will not work unless the UXi Migration theme is installed</p>

	<?php else: ?>

		<div class="migrator-form">

		   <form method="post" action="<?php menu_page_url('uxi-migration',true); ?>">
		     <p>
				<label for="uxi-url">UXI Homepage URL (no subpages)</label>
		        <input type="text" id="uxi-url" name="uxi-url" required placeholder="type your URL here">
		     </p>
		     <p>
				<input type="checkbox" id="migrate-assets" name="migrations[]" value="assets" checked>
				<label for="migrate-assets">Assets</label><br>
				<input type="checkbox" id="migrate-scripts" name="migrations[]" value="scripts" checked>
				<label for="migrate-scripts">Scripts</label><br>
				<input type="checkbox" id="migrate-mobile" name="migrations[]" value="mobile" checked>
				<label for="migrate-mobile">Mobile</label><br>
				<input type="checkbox" id="migrate-pages" name="migrations[post_types][]" value="page" checked>
				<label for="migrate-pages">Pages</label><br>
				<input type="checkbox" id="migrate-posts" name="migrations[post_types][]" value="post" checked>
				<label for="migrate-posts">Posts</label><br>
				<input type="checkbox" id="migrate-testimonials" name="migrations[post_types][]" value="mad360_testimonial" checked>
				<label for="migrate-testimonials">Testimonials</label><br>
		     </p>
		     <p>
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
   						display:table;
   					}
   					#migrator-progress-inner {
   						position:absolute;
   						top:0;
   						bottom:0;
   						left:0;
   						width:0;
   						height:100%;
   						background: #F37530;
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
   						position:relative;
   						text-align:center;
   					}
   					.message-block {
   						padding-left:20px;
   					}
   					#migrator-progress-log {
   						max-height:500px;
   						margin-top:30px;
   						overflow:auto;
   					}
   				</style>

   				<div id="migrator-progress-wrap">
   					<div id="migrator-progress-inner"></div>
   					<span id="migrator-progress-percent"></span>
   				</div>

   				<div id="migrator-progress-log">
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

				echo "var postObj={\n";
					echo (in_array("assets", $_POST['migrations'])) ? '"assets":[true],'."\n" : '' ;
					echo (in_array("scripts", $_POST['migrations'])) ? '"scripts":[true],'."\n" : '' ;
					echo (in_array("mobile", $_POST['migrations'])) ? '"mobile":[true],'."\n" : '' ;

					if (array_key_exists('post_types',$_POST['migrations'])) {
						foreach($_POST['migrations']['post_types'] as $post_type) {
							$post_query = new WP_Query(
								array(
									'post_type' => $post_type,
									'posts_per_page' => -1
								)
							);
							if ($post_query->have_posts()) {
								echo '"'.$post_type.'":[';
								while($post_query->have_posts()) {
									$post_query->the_post();
									echo get_the_ID();
									echo ",";
								}
								echo "],\n";
							}
							wp_reset_postdata();

						}
					}
				echo "};\n";

				echo "var nonce = '".$nonce."';\n </script>";

				//$response = uxi_curl($_POST['uxi-url']);

				//define('UXI_URL',trailingslashit($_POST['uxi-url']));

				//require(UXI_MIGRATOR_PATH.'migrator/migrations/uxi-migrations-loader.php');
				
				?>


			</div>

		<?php } ?>
	<?php endif; ?>
	</div>
</div>
<?php 