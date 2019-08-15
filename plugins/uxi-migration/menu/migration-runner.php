<?php if (!UXI_THEME_INSTALLED): ?>

<p>This migrator will not work unless the UXi Migration theme is installed</p>

<?php else: ?>
	<div class="migration-runner-wrap">

		<div class="migrator-form">

		   <form method="post" action="<?php menu_page_url('uxi-migration',true); ?>">
		     <p>
				<label for="uxi-url">UXI Homepage URL (no subpages)</label>
		        <input type="text" id="uxi-url" name="uxi-url" class="regular-text" required placeholder="type your URL here">
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
				<?php if (class_exists('WP_Store_locator')): ?>
					<input type="checkbox" id="migrate-locations" name="migrations[post_types][]" value="uxi_locations" checked>
					<label for="migrate-locations">Locations</label><br>
				<?php endif; ?>
		     </p>
		     <p>
		       <input name="start_migration" type="submit" class="button-primary" value="Start Migration"> 
		     </p>
		   </form>
		</div>

		<?php if (isset($_POST['uxi-url'])) { ?>

				<div class="migrator-progress">

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

				function uxi_do_locations() {
					if (class_exists('WP_Store_locator')) {

						// Change WPSL Settings
						$wpsl_settings = get_option('wpsl_settings');

						$wpsl_settings['permalinks'] = 1;
						$wpsl_settings['permalink_remove_front'] = 1;
						$wpsl_settings['permalink_slug'] = "locations";
						$wpsl_settings['category_slug'] = "locations-category";

						update_option('wpsl_settings', $wpsl_settings);

						// Move UXI Locations to WPSL Stores
						$args = array(
							'post_type' => 'uxi_locations',
							'posts_per_page' => -1,
							'post_status' => 'any'
						);

						$locations = new WP_Query($args);

						while($locations->have_posts()): $locations->the_post();

							$location = get_post()->to_array();
							$location['post_type'] = 'wpsl_stores';
							$location_id = $location['ID'];
							unset($location['guid']);
							unset($location['ID']);
							wp_insert_post(
								$location
							);
							wp_delete_post($location_id);
						endwhile;
						wp_reset_postdata();
					}
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
				
				?>


			</div>

		<?php } ?>
	</div>
<?php endif;