jQuery(document).ready(function($) {


	if (typeof do_rest !== "undefined") {
		$.post("/uxi-migration/wp-json/uxi-migrator/page-scraper?_wpnonce="+nonce+"&page_id="+pageArray[0]+"&uxi_url="+uxi_url, function(data) {
			if (data) {
				console.log(data);
			}
		});
	}
});