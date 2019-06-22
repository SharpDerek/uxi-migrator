<div class="wrap">
<h1 class="wp-heading-inline">UXI MIGRATOR</h1>

<?php

if (!UXI_THEME_INSTALLED): ?>

<p>This migrator will not work unless the UXi Migration theme is installed</p>

<?php else: ?>

	<?php if (isset($_POST['uxi-url'])) {

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $_POST['uxi-url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo '<pre>'.htmlentities($response).'</pre>';
		}

	} ?>

   <form method="post" action="<?php menu_page_url('uxi-migration',true); ?>">
     <p class="submit">
       <input type="text" name="uxi-url" placeholder="type your URL here">
       <input name="do_it" type="submit" class="button-primary" value="Start Migration"> 
     </p>
   </form>
<?php endif; ?>
</div>
<?php 