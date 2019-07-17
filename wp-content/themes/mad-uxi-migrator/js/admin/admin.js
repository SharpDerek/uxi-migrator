(function($) {
	function assignLayers() {
		var curlayer = 0;
		$('.layout[data-layout]').each(function() {
			var layout = $(this).attr('data-layout');
			switch(layout) {
				case 'row':
					$(this).attr('layer', curlayer++);
					break;
				case 'row_close':
					$(this).attr('layer', --curlayer);
					break;
				case 'grid_item':
					$(this).attr('layer', curlayer++);
					break;
				case 'grid_item_close':
					$(this).attr('layer', --curlayer);
					break;
				default:
					$(this).attr('layer', curlayer);
					break;
			}
			$(this).css('margin-left',$(this).attr('layer') * 15 + "px");
		});
	}

	var refreshHierarchyCallback = function() {
		assignLayers();
	}

	$(document).ready(function() {
		if (typeof acf !== "undefined") {
			acf.addAction('ready',refreshHierarchyCallback);
			acf.addAction('remove',refreshHierarchyCallback);
			acf.addAction('append',refreshHierarchyCallback);
			acf.addAction('sortstop',refreshHierarchyCallback);
		}
	});
})(jQuery);