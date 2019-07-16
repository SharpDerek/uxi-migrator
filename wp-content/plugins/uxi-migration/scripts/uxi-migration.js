(function($) {

	function hit_endpoint(index) {
		if (index < postArray.length) {
			$.ajax({
				type: "POST",
				url: "/wp-json/uxi-migrator/page-scraper",
				data: {
					'_wpnonce': nonce,
					'post_id': postArray[index],
					'uxi_url': uxi_url
				}

			})
			.done(function(response) {
				hit_endpoint(++index);
				updateProgress(index,postArray.length);
				updateProgressLog(response);
			})
			.fail(function() {
				updateProgressLog(skipStep());
				hit_endpoint(++index);
			})
		}
	}

	function skipStep() {
		return '<em>Something went wrong. Skipping this post.</em><br>';
	}

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
			proglog.scrollTop(proglog.prop('scrollHeight'));
		}
	}

	$(document).ready(function() {
		if (typeof do_rest !== "undefined") {
			hit_endpoint(0);
		}
	});

})(jQuery);