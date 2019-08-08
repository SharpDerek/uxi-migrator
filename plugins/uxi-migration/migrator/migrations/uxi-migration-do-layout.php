<?php

function uxi_do_layout($dom, $post_id = false, $slug = false) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		$template_array = array(
			'uxi-header',
			'uxi-main',
			'uxi-footer',
		);

		foreach ($template_array as $template) {

			$row_start = '//*[@'.$template.']//*[@data-layout]';

			$uxi_template_id = uxi_do_create_layout_post($xpath, $row_start,$template, $slug);

			if ($uxi_template_id) {
				uxi_print('Starting '.$template.' template.','open');
				update_field(
					'block',
					uxi_do_rows(
						$dom,
					 	$xpath,
					 	'//*[@'.$template.']//*[@data-layout]',
					 	'row',
					 	false
					),
					$uxi_template_id
				);
				uxi_print('New '.$template.' template id: "'.$uxi_template_id.'" created.<br>','close');
			} else {
				uxi_print('Matching '.$template.' template already exists. No need to overwrite.');
			}

		}

	}
}