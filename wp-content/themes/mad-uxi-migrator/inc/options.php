<?php

function mad_add_options() {
	add_menu_page(
	 'Layout Templates',
	 'Layouts',
	 'manage_options',
	 'uxi-layout-templates',
	 '',
	 'dashicons-layout',
	 -1
	);
}
add_action('admin_init','mad_add_options');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Layout Settings',
		'menu_title'	=> 'Layout Settings',
		'menu_slug' 	=> 'layout-settings',
		'capability'	=> 'edit_posts',
	));
	
}

function mad_register_image_settings() {

	register_setting(
		"media",
		"mad_gallery_size_w",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_gallery_size_h",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_gallery_crop",
		array (
			"type" => "boolean"
		)
	);

	register_setting(
		"media",
		"mad_slideshow_size_w",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_slideshow_size_h",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_slideshow_crop",
		array (
			"type" => "boolean"
		)
	);

	register_setting(
		"media",
		"mad_featured_archive_size_w",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_featured_archive_size_h",
		array (
			"type" => "number",
			"default" => 250
		)
	);
	register_setting(
		"media",
		"mad_featured_archive_crop",
		array (
			"type" => "boolean"
		)
	);

	register_setting(
		"media",
		"mad_featured_single_size_w",
		array (
			"type" => "number",
			"default" => 1200
		)
	);
	register_setting(
		"media",
		"mad_featured_single_size_h",
		array (
			"type" => "number",
			"default" => 700
		)
	);
	register_setting(
		"media",
		"mad_featured_single_crop",
		array (
			"type" => "boolean"
		)
	);

	register_setting(
		"media",
		"mad_featured_page_size_w",
		array (
			"type" => "number",
			"default" => 1200
		)
	);
	register_setting(
		"media",
		"mad_featured_page_size_h",
		array (
			"type" => "number",
			"default" => 700
		)
	);
	register_setting(
		"media",
		"mad_featured_page_crop",
		array (
			"type" => "boolean"
		)
	);

}

function mad_add_image_settings() {

	mad_register_image_settings();

	function mad_gallery_field() {?>
		<fieldset>
			<label for="mad_gallery_size_w">Width</label>
			<input name="mad_gallery_size_w" type="number" step="1" min="0" id="mad_gallery_size_w" class="small-text" value="<?php form_option( 'mad_gallery_size_w' ); ?>">
			<br>
			<label for="mad_gallery_size_h">Height</label>
			<input name="mad_gallery_size_h" type="number" step="1" min="0" id="mad_gallery_size_h" class="small-text" value="<?php form_option( 'mad_gallery_size_h' ); ?>">
		</fieldset>
		<input name="mad_gallery_crop" type="checkbox" id="mad_gallery_crop" value="1" <?php checked( '1', get_option( 'mad_gallery_crop' ) ); ?>>
		<label for="mad_gallery_crop">Gallery Thumbnail Hard Crop</label>
	<?php }

	function mad_slideshow_field() { ?>
		<fieldset>
			<label for="mad_slideshow_size_w">Width</label>
			<input name="mad_slideshow_size_w" type="number" step="1" min="0" id="mad_slideshow_size_w" class="small-text" value="<?php form_option( 'mad_slideshow_size_w' ); ?>">
			<br>
			<label for="mad_slideshow_size_h">Height</label>
			<input name="mad_slideshow_size_h" type="number" step="1" min="0" id="mad_slideshow_size_h" class="small-text" value="<?php form_option( 'mad_slideshow_size_h' ); ?>">
		</fieldset>
		<input name="mad_slideshow_crop" type="checkbox" id="mad_slideshow_crop" value="1" <?php checked( '1', get_option( 'mad_slideshow_crop' ) ); ?>>
		<label for="mad_slideshow_crop">Slideshow Thumbnail Hard Crop</label>
	<?php }

	function mad_featured_field() { ?>
		<fieldset>
			<label for="mad_featured_archive_size_w">Archive Width</label>
			<input name="mad_featured_archive_size_w" type="number" step="1" min="0" id="mad_featured_archive_size_w" class="small-text" value="<?php form_option( 'mad_featured_archive_size_w' ); ?>">
			<br>
			<label for="mad_featured_archive_size_h">Archive Height</label>
			<input name="mad_featured_archive_size_h" type="number" step="1" min="0" id="mad_featured_archive_size_h" class="small-text" value="<?php form_option( 'mad_featured_archive_size_h' ); ?>">
		</fieldset>
		<input name="mad_featured_archive_crop" type="checkbox" id="mad_featured_archive_crop" value="1" <?php checked( '1', get_option( 'mad_featured_archive_crop' ) ); ?>>
		<label for="mad_featured_archive_crop">Archive Hard Crop</label>

		<fieldset>
			<label for="mad_featured_single_size_w">Single Width</label>
			<input name="mad_featured_single_size_w" type="number" step="1" min="0" id="mad_featured_single_size_w" class="small-text" value="<?php form_option( 'mad_featured_single_size_w' ); ?>">
			<br>
			<label for="mad_featured_single_size_h">Single Height</label>
			<input name="mad_featured_single_size_h" type="number" step="1" min="0" id="mad_featured_single_size_h" class="small-text" value="<?php form_option( 'mad_featured_single_size_h' ); ?>">
		</fieldset>
		<input name="mad_featured_single_crop" type="checkbox" id="mad_featured_single_crop" value="1" <?php checked( '1', get_option( 'mad_featured_single_crop' ) ); ?>>
		<label for="mad_featured_single_crop">Single Hard Crop</label>

		<fieldset>
			<label for="mad_featured_page_size_w">Page Width</label>
			<input name="mad_featured_page_size_w" type="number" step="1" min="0" id="mad_featured_page_size_w" class="small-text" value="<?php form_option( 'mad_featured_page_size_w' ); ?>">
			<br>
			<label for="mad_featured_page_size_h">Page Height</label>
			<input name="mad_featured_page_size_h" type="number" step="1" min="0" id="mad_featured_page_size_h" class="small-text" value="<?php form_option( 'mad_featured_page_size_h' ); ?>">
		</fieldset>
		<input name="mad_featured_page_crop" type="checkbox" id="mad_featured_page_crop" value="1" <?php checked( '1', get_option( 'mad_featured_page_crop' ) ); ?>>
		<label for="mad_featured_page_crop">Page Hard Crop</label>
	<?php }

	add_settings_field(
		'mad_gallery_size',
		'Gallery Thumbnail',
		'mad_gallery_field',
		'media',
		'default'
	);
	add_settings_field(
		'mad_slideshow_size',
		'Slideshow Thumbnail',
		'mad_slideshow_field',
		'media',
		'default'
	);
	add_settings_field(
		'mad_featured_size',
		'Featured Image Sizes',
		'mad_featured_field',
		'media',
		'default'
	);
}

add_action('admin_init','mad_add_image_settings');
/*
<tr>
<th scope="row"><?php _e( 'Large size' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Large size' ); ?></span></legend>
<label for="large_size_w"><?php _e( 'Max Width' ); ?></label>
<input name="large_size_w" type="number" step="1" min="0" id="large_size_w" value="<?php form_option( 'large_size_w' ); ?>" class="small-text" />
<br />
<label for="large_size_h"><?php _e( 'Max Height' ); ?></label>
<input name="large_size_h" type="number" step="1" min="0" id="large_size_h" value="<?php form_option( 'large_size_h' ); ?>" class="small-text" />
</fieldset></td>
*/