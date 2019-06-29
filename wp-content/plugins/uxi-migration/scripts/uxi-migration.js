jQuery(document).ready(function($) {
	if (typeof do_rest !== "undefined") {
		console.log(postArray);

		function hit_endpoint(index) {
			if (index < postArray.length) {
				console.log("/wp-json/uxi-migrator/page-scraper?_wpnonce="+nonce+"&page_id="+postArray[index]+"&uxi_url="+uxi_url);
				$.ajax({
					type: "POST",
					url: "/wp-json/uxi-migrator/page-scraper?_wpnonce="+nonce+"&page_id="+postArray[index]+"&uxi_url="+uxi_url,

				})
				.done(function() {
					hit_endpoint(++index);
					updateProgress(index,postArray.length);
				});
			}
		}

		hit_endpoint(0);

		function updateProgress(curvalue, maxvalue) {
			var progwrap = $('#migrator-progress-wrap');
			if (typeof progwrap !== "undefined") {
				var proginner = progwrap.find("#migrator-progress-inner");
				var progpercent = proginner.find("#migrator-progress-percent");
				var value = Math.floor(curvalue/maxvalue * 100);

				proginner.css("width",value + "%");
				progpercent.text(value + "%");
			}
		}
	}
});