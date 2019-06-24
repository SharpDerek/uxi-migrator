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

				define('UXI_URL',trailingslashit($_POST['uxi-url']));

				$response = uxi_curl($_POST['uxi-url']);

				if ($response) {
					require(UXI_MIGRATOR_PATH.'migrator/migrations/uxi-migrations-loader.php');
				} ?>


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