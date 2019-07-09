<?php

function uxi_rest_endpoint(WP_REST_Request $request){

  $GLOBALS['uxi_migrator_progress'] = "";

  if ( check_ajax_referer('wp_rest', '_wpnonce') ){
    $post_id = $request['post_id'];
    $slug = $request['slug'];
    if (!$slug) {
      $slug = get_post_field('post_name',$post_id);
    }
    $uxi_url = $request['uxi_url'].$slug;


    require(UXI_MIGRATOR_PATH.'migrator/functions/uxi-functions-loader.php');

    $response = uxi_curl($uxi_url);

    require(UXI_MIGRATOR_PATH.'migrator/migrations/uxi-migrations-loader.php');

    return $GLOBALS['uxi_migrator_progress'];

  }
  return false;
}

add_action('rest_api_init', function () {
  register_rest_route('uxi-migrator', '/page-scraper', array(
    'methods' => 'POST',
    'callback' => 'uxi_rest_endpoint'
  ));
});