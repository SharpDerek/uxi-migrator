<?php
// This function scans the files folder recursively, and builds a large array
function content(WP_REST_Request $request){
  if ( check_ajax_referer('wp_rest', '_wpnonce') ){
    $slug = get_post($request['page_id'])->post_name;
    $uxi_url = $request['uxi_url'].$slug;
    //return $uxi_url;

    //require(UXI_MIGRATOR_PATH.'migrator/functions/uxi-functions-loader.php');
    //echo "something";

    // init curl object        
$ch = curl_init();

// define options
$optArray = array(
    CURLOPT_URL => 'https://woo360.fun',
    CURLOPT_RETURNTRANSFER => true
);

// apply those options
curl_setopt_array($ch, $optArray);

// execute request and get response
$result = curl_exec($ch);

// also get the error and response code
$errors = curl_error($ch);
$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

return $response;


    //return htmlentities($response)." Or something";

    //if ($response) {
      //require(UXI_MIGRATOR_PATH.'migrator/migrations/uxi-migrations-loader.php');
      //return $request;
    //}
  }
  //return false;
}
add_action('rest_api_init', function () {
  register_rest_route('uxi-migrator', '/page-scraper', array(
    'methods' => 'POST',
    'callback' => 'content'
  ));
});