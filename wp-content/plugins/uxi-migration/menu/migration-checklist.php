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
?>

<div id="migration-checklist">
	<h3>Pre-migration checklist</h3>

	<?php echo uxi_migration_check(UXI_THEME_INSTALLED, get_dashboard_url(0,'themes.php'), "UXI Migrator Theme Installed"); ?>

	<?php echo uxi_migration_check(function_exists('get_field'), get_dashboard_url(0,'plugins.php'), "Advanced Custom Fields (ACF) Installed and Active"); ?>

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