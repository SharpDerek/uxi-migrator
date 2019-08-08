<div class="wrap">
	<h1 class="wp-heading-inline">UXI MIGRATOR</h1>
	
	<?php update_field('uxi_logo', attachment_url_to_postid('/wp-content/uploads/2019/02/touchicon-5c6b37fc72091.jpg'), 'option'); ?>

	<div class="migrator-wrap">

		<div class="migrator-accordion-wrap">
			<div class="migrator-accordion-item <?php echo (isset($_POST['uxi-url'])) ? '' : 'active'; ?>">
				<h3 class="migrator-accordion-title">Pre-Migration Checklist</h3>
				<div class="migrator-accordion-content">
					<?php require_once(plugin_dir_path(__FILE__).'pre-migration-checklist.php'); ?>
				</div>
			</div>

			<div class="migrator-accordion-item <?php echo (isset($_POST['uxi-url'])) ? 'active' : ''; ?>">
				<h3 class="migrator-accordion-title">Run Migrator</h3>
				<?php if (isset($_POST['uxi-url'])): ?>
					<div id="migrator-accordion-progress-wrap">
						<div id="migrator-accordion-progress-inner"></div>
						<span id="migrator-accordion-progress-percent"></span>
					</div>
				<?php endif; ?>
				<div class="migrator-accordion-content">
					<?php require_once(plugin_dir_path(__FILE__).'migration-runner.php'); ?>
				</div>
			</div>

			<div class="migrator-accordion-item">
				<h3 class="migrator-accordion-title">Post-Migration Checklist</h3>
				<div class="migrator-accordion-content">
					<?php require_once(plugin_dir_path(__FILE__).'post-migration-checklist.php'); ?>
				</div>
			</div>
		</div>

	</div>
</div>
<?php 