(function($) {

	function hit_endpoint(index, subindex) {
		if (index < Object.keys(postObj).length) {
			if (subindex < postObj[Object.keys(postObj)[index]].length) {
				$.ajax({
					type: "POST",
					url: "/wp-json/uxi-migrator/page-scraper",
					data: {
						'_wpnonce': nonce,
						'post_id': postObj[Object.keys(postObj)[index]][subindex],
						'uxi_url': uxi_url
					}

				})
				.done(function(response) {
					hit_endpoint(index, ++subindex);
					updateProgress(Object.keys(postObj)[index], subindex, postObj[Object.keys(postObj)[index]].length);
					updateProgressLog(response);
				})
				.fail(function() {
					updateProgressLog(skipStep());
					hit_endpoint(index, ++subindex);
				});
			} else {
				hit_endpoint(++index,0);
			}
		}
	}

	function skipStep() {
		return '<em>Something went wrong. Skipping this post.</em><br>';
	}

	function updateProgress(type, curvalue, maxvalue) {
		var progwrap = $('#migrator-progress-wrap');
		if (typeof progwrap !== "undefined") {
			var proginner = progwrap.find("#migrator-progress-inner");
			var progpercent = progwrap.find("#migrator-progress-percent");
			var value = Math.floor(curvalue/maxvalue * 100);

			proginner.css("width",value + "%");
			progpercent.text(type+"s: " + value + "%");
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
			hit_endpoint(0, 0);
		}
	});

})(jQuery);