<?php
// This function scans the files folder recursively, and builds a large array
function content(WP_REST_Request $request){
  if ( check_ajax_referer('wp_rest', '_wpnonce') ){
    $slug = get_post($request['page_id'])->post_name;
    $uxi_url = $request['uxi_url'].$slug;

    require(UXI_MIGRATOR_PATH.'migrator/functions/uxi-functions-loader.php');

    return uxi_curl($uxi_url);

  }
  return false;
}
add_action('rest_api_init', function () {
  register_rest_route('uxi-migrator', '/page-scraper', array(
    'methods' => 'POST',
    'callback' => 'content'
  ));
});