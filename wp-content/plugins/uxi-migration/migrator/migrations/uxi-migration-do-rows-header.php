<?php

function uxi_do_header_rows($dom) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		//var_dump(get_field('block','option'));
		//update_field('block', array(), 'option');

		$query_array = array(
			array(
				'query' => '//*[@uxi-header]//*[@data-layout]',
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

		uxi_print("Start Header Rows.");

		$field_array = uxi_do_rows(
			$dom,
			$xpath,
			$query_array,
			0
		);

		//var_dump($field_array);

		update_field('block',$field_array,'option');
		uxi_print("Header Rows Created.");

	}
}