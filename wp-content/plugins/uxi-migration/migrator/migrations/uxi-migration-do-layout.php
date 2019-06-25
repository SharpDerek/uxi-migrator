<?php

function uxi_do_layout($dom) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		//var_dump(get_field('block','option'));
		//update_field('block', array(), 'option');

		$template_array = array(
			'uxi-header',
			'uxi-main',
			'uxi-footer',
		);

		foreach ($template_array as $template) {

			$query_array = array(
				array(
					'query' => '//*[@'.$template.']//*[@data-layout]',
					'layout' => 'row'
				),
				array(
					'query' => '//*[@data-layout]/*[@class="container"]/*[@class="container-inner"]/*[@class="row"]/*',
					'layout' => 'grid_item'
				),
				array(
					'query' => '//*[@class="row"]/*',
					'layout' => 'grid_item'
				),
				array(
					'query' => '//*[@uxi-widget]',
					'layout' => 'widget'
				)
			);

			$uxi_template_id = uxi_do_create_layout_post($xpath, $query_array[0]['query'],$template);

			if ($uxi_template_id) {
				uxi_print('Starting '.$template.' template.');
				update_field(
					'block',
					uxi_do_rows(
						$dom,
					 	$xpath,
					 	$query_array,
					 	0
					),
					$uxi_template_id
				);
				uxi_print('New '.$template.' template id: "'.$uxi_template_id.'" created.');
			} else {
				uxi_print('Matching '.$template.' template already exists. No need to overwrite.');
			}

		}

	}
}