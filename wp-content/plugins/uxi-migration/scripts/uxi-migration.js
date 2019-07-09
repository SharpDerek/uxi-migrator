jQuery(document).ready(function($) {
	if (typeof do_rest !== "undefined") {
		console.log(slugArray);

		function hit_endpoint(index) {
			if (index < slugArray.length) {
				console.log("/wp-json/uxi-migrator/page-scraper?_wpnonce="+nonce+"&slug="+slugArray[index]+"&uxi_url="+uxi_url);
				$.ajax({
					type: "POST",
					url: "/wp-json/uxi-migrator/page-scraper?_wpnonce="+nonce+"&slug="+slugArray[index]+"&uxi_url="+uxi_url,

				})
				.done(function(response) {
					hit_endpoint(++index);
					updateProgress(index,slugArray.length);
					updateProgressLog(response);
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

		function updateProgressLog(message) {
			var proglog = $('#migrator-progress-log');
			if (typeof proglog !== "undefined") {
				proglog.html(proglog.html() + message + "<br>");
			}
		}
	}
});