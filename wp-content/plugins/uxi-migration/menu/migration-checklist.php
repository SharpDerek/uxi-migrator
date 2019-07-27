<?php function uxi_migration_check($check, $link, $text) {
	ob_start(); ?>
		<p>
			<span class="checkbox" <?php if($check){echo"checked";} ?>></span>
			<?php if(!$check): ?><a href="<?php echo $link; ?>"><?php endif; ?>
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
	<h3>Pre-migration checklist<br><small style="font-weight:400">Please complete these tasks <em><b>in order</b></em> before running the migrator.</small></h3>

	<ol>
		<li><?php echo uxi_migration_check(UXI_THEME_INSTALLED, get_dashboard_url(0, 'themes.php'), "UXi Migrator Theme installed"); ?></li>

		<li><?php echo uxi_migration_check(function_exists('acf_get_field_groups'), get_dashboard_url(0, 'plugins.php'), "Advanced Custom Fields (ACF) installed, updated and activated"); ?></li>

		<li><?php echo uxi_migration_check(uxi_check_acf_sync(), get_dashboard_url(0, 'edit.php?post_type=acf-field-group&post_status=sync'), "ACF field groups synchronized from theme"); ?></li>

		<li><?php echo uxi_migration_check(uxi_check_uploads() || uxi_check_default_posts_deleted(), get_dashboard_url(0, 'edit.php?post_type=post'), "Starter posts deleted"); ?></li>

		<li><?php echo uxi_migration_check(uxi_check_uploads() || uxi_check_default_pages_deleted(), get_dashboard_url(0, 'edit.php?post_type=page'), "Starter pages deleted"); ?></li>

		<li><?php echo uxi_migration_check(function_exists('wordpress_importer_init'),get_dashboard_url(0,'import.php'), "Wordpress Importer installed"); ?></li>

		<li><?php echo uxi_migration_check(uxi_check_uploads(),get_dashboard_url(0,'admin.php?import=wordpress'), "Wordpress Import run"); ?></li>

		<li><?php echo uxi_migration_check(uxi_check_reading_settings(),get_dashboard_url(0,'options-reading.php'), "Home & Blog pages set"); ?></li>
	</ol>

	<style>
		.checkbox {
			border: 1px solid #b4b9be;
		    background: #fff;
		    color: #555;
		    clear: none;
		    cursor: pointer;
		    display: inline-block;
		    line-height: 0;
		    height: 16px;
		    margin: -4px 4px 0 0;
		    outline: 0;
		    padding: 0!important;
		    text-align: center;
		    vertical-align: middle;
		    width: 16px;
		    min-width: 16px;
		    -webkit-appearance: none;
		    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
		    transition: .05s border-color ease-in-out;
		}
		.checkbox[checked]::before {
			content: "\f147";
	    	margin: -3px 0 0 -4px;
	    	color: #1e8cbe;
	    	float: left;
		    display: inline-block;
		    vertical-align: middle;
		    width: 16px;
		    font: normal 21px/1 dashicons;
		    speak: none;
		    -webkit-font-smoothing: antialiased;
		    -moz-osx-font-smoothing: grayscale;
		}
	</style>
</div>