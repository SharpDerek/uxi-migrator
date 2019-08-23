(function($) {

	function hit_endpoint(index, subindex) {
		if (index < Object.keys(postObj).length) {
			updateProgress(Object.keys(postObj).length, index + 1, Object.keys(postObj)[index], subindex, postObj[Object.keys(postObj)[index]].length);
			var ajaxData = {};
			switch(Object.keys(postObj)[index]) {
				case 'assets':
					ajaxData = {
						'_wpnonce': nonce,
						'do_assets': 1,
						'uxi_url': uxi_url
					}
					break;
				case 'scripts':
					ajaxData = {
						'_wpnonce': nonce,
						'do_scripts': 1,
						'uxi_url': uxi_url
					}
					break;
				case 'mobile':
					ajaxData = {
						'_wpnonce': nonce,
						'do_mobile': 1,
						'uxi_url': uxi_url
					}
					break;
				case 'do_location_settings':
					ajaxData = {
						'_wpnonce': nonce,
						'do_location_settings': 1,
						'uxi_url': uxi_url
					}
					break;
				case 'do_finalization':
					ajaxData = {
						'_wpnonce': nonce,
						'do_finalization': 1,
						'uxi_url': uxi_url
					}
					break;
				default:
					if (postObj[Object.keys(postObj)[index]][subindex] == 'finalize') {
						ajaxData = {
							'_wpnonce': nonce,
							'finalize_post_type': Object.keys(postObj)[index],
							'uxi_url': uxi_url
						}
					} else {
						ajaxData = {
							'_wpnonce': nonce,
							'post_id': postObj[Object.keys(postObj)[index]][subindex],
							'uxi_url': uxi_url
						}
					}
					break;
			}
			if (subindex < postObj[Object.keys(postObj)[index]].length) {
				$.ajax({
					type: "POST",
					url: "/wp-json/uxi-migrator/page-scraper",
					data: ajaxData

				})
				.done(function(response) {
					hit_endpoint(index, ++subindex);
					updateProgress(Object.keys(postObj).length, index + 1, Object.keys(postObj)[index], subindex, postObj[Object.keys(postObj)[index]].length);
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

	function updateProgress(totalsteps, curstep, type, curvalue, maxvalue) {
		var progwrap = $('#migrator-progress-wrap');
		var progAwrap = $('#migrator-accordion-progress-wrap');
		if (typeof progwrap !== "undefined") {
			var proginner = progwrap.find("#migrator-progress-inner");
			var progpercent = progwrap.find("#migrator-progress-percent");
			var progAinner = progAwrap.find("#migrator-accordion-progress-inner");
			var progApercent = progAwrap.find("#migrator-accordion-progress-percent");
			var title = $('title');
			var value = Math.floor(curvalue/maxvalue * 100);

			proginner.css("width",value + "%");
			progAinner.css("width",value + "%");
			if (totalsteps/curstep == 1 && maxvalue/curvalue == 1) {
				progpercent.html("Migration complete!!");
				progApercent.html("Migration complete!!");
			} else {
				progpercent.html(type + ((type == 'assets' || type == 'mobile' || type == 'scripts') ? ": " : "s: ") + value + "%<br>Step "+curstep+"/"+totalsteps);
				progApercent.html(type + ((type == 'assets' || type == 'mobile' || type == 'scripts') ? ": " : "s: ") + value + "% | Step "+curstep+"/"+totalsteps);
			}
			title.html(progpercent.html().replace("<br>", " | "));
		}
	}

	function updateProgressLog(message) {
		var proglog = $('#migrator-progress-log');
		if (typeof proglog !== "undefined") {
			proglog.html(proglog.html() + message + "<br>");
			if (!proglog.is(":hover") && !proglog.is(":focus")) {
				proglog.scrollTop(proglog.prop('scrollHeight'));
			}
		}
	}

	$(document).ready(function() {
		if (typeof do_rest !== "undefined") {
			hit_endpoint(0, 0);
		}
		$('.migrator-accordion-item .migrator-accordion-title').each(function() {
			if (!$(this).parent().hasClass('active')) {
				$(this).parent().find('.migrator-accordion-content').hide();
			}
			$(this).click(function() {
				$(this).parent().toggleClass('active');
				$(this).parent().find('.migrator-accordion-content').slideToggle();
			});
		});
	});

})(jQuery);