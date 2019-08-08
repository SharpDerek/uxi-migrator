<?php

function uxi_curl($input, $request = "GET") {



	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $input,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => $request,
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_FOLLOWLOCATION => true,
	));


	$response = curl_exec($curl);
	$err = curl_error($curl);



	curl_close($curl);

	if ($err) {
	  return "cURL Error #:" . $err;
	  return false;
	} else {
	  return $response;
	}
	return false;
}