<?php
function uxi_migration_check($check, $link, $text) {
	ob_start(); ?>
		<p>
			<span class="checkbox" <?php if($check){echo"checked";} ?>></span>
			<?php if(!$check): ?><a href="<?php echo $link; ?>" target="_blank"><?php endif; ?>
				<?php echo $text; ?>
			<?php if(!$check): ?></a><?php endif; ?>
		</p>
	<?php return ob_get_clean();
}

function uxi_check_acf_sync() {
	if (function_exists('acf_get_field_groups')) {
		$sync = array();
		$groups = acf_get_field_groups();
		if( empty($groups) ) return false;

		foreach( $groups as $group ) {
			$local = acf_maybe_get($group, 'local', false);
			$modified = acf_maybe_get($group, 'modified', 0);
			$private = acf_maybe_get($group, 'private', false);
			
			// Ignore if is private.
			if( $private ) {
				continue;
			
			// Ignore not local "json".
			} elseif( $local !== 'json' ) {
				continue;
			
			// Append to sync if not yet in database.	
			} elseif( !$group['ID'] ) {
				$sync[ $group['key'] ] = $group;
			
			// Append to sync if "json" modified time is newer than database.
			} elseif( $modified && $modified > get_post_modified_time('U', true, $group['ID'], true) ) {
				$sync[ $group['key'] ]  = $group;
			}
		}
		return empty($sync);
	}
	return false;
}

function uxi_check_default_posts_deleted() {
	return !get_post_status(1);
}

function uxi_check_default_pages_deleted() {
	return !get_post_status(2) && !get_post_status(3);
}

function uxi_check_uploads() {
	return array_sum((array)wp_count_attachments($mime_type = 'image')) > 0;
}

function uxi_check_reading_settings() {
	return get_option('page_on_front') && get_option('page_for_posts');
}
?>

<div id="migration-checklist">
	<p>Please complete these tasks <em><b>in order</b></em> before running the migrator.</p>

	<ol>
		<li>
			<?php echo uxi_migration_check(
				UXI_THEME_INSTALLED,
				get_dashboard_url(0, 'themes.php'),
				"UXi Migrator Theme installed"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				function_exists('acf_get_field_groups'),
				get_dashboard_url(0, 'plugins.php'),
				"Advanced Custom Fields (ACF) plugin installed, updated and activated"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				class_exists('RegenerateThumbnails'),
				get_dashboard_url(0, 'plugin-install.php?tab=plugin-information&plugin=regenerate-thumbnails'),
				"Regenerate Thumbnails plugin installed, updated and activated"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				class_exists('A3_Lazy_Load'),
				get_dashboard_url(0, 'plugin-install.php?tab=plugin-information&plugin=a3+lazy+load'),
				"A3 Lazy Load plugin installed, updated and activated"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				class_exists('WP_Store_locator'),
				get_dashboard_url(0, 'plugin-install.php?tab=plugin-information&plugin=wp+store+locator'),
				"(Locations Only) WP Store Locator plugin installed, updated and activated"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				uxi_check_acf_sync(),
				get_dashboard_url(0, 'edit.php?post_type=acf-field-group&post_status=sync'),
				"ACF field groups synchronized from theme"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				uxi_check_uploads() || uxi_check_default_posts_deleted(),
				get_dashboard_url(0, 'edit.php?post_type=post'),
				"Starter posts deleted"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				uxi_check_uploads() || uxi_check_default_pages_deleted(),
				get_dashboard_url(0, 'edit.php?post_type=page'),
				"Starter pages deleted"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				function_exists('wordpress_importer_init'),
				get_dashboard_url(0, 'import.php'),
				"Wordpress Importer installed"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				uxi_check_uploads(),
				get_dashboard_url(0, 'admin.php?import=wordpress'),
				"Wordpress Importer run"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				uxi_check_reading_settings(),
				get_dashboard_url(0, 'options-reading.php'),
				"Home & Blog pages set"
			); ?>
		</li>

		<li>
			<?php echo uxi_migration_check(
				get_site_icon_url(),
				get_dashboard_url(0, 'customize.php'),
				"Favicon set"
			); ?>
		</li>
	</ol>
</div>