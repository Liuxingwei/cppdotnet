
$(function() {

	// Do our DOM lookups beforehand
	var h1 = $(".h1");
	var header = $("#header");
	var nav_container = $(".nav-container");
	var nav = $("nav");
	
	var top_spacing = 0;
	var waypoint_offset = 50;

	nav_container.waypoint({
		handler: function(event, direction) {
			nav.toggleClass('sticky', direction=='down');
			
			if (direction == 'down') nav_container.css({ 'height':nav.outerHeight() });
			else nav_container.css({ 'height':'auto' });
		},
		offset: 0
	});
	
	var sections = $(".div_mark");
	var navigation_links = $("nav a");
	
	sections.waypoint({
		handler: function(event, direction) {
		
			var active_section;
			active_section = $(this);
			if (direction === "up") active_section = active_section.prev();

			var active_link = $('nav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("selected");
			active_link.addClass("selected");

		},
		offset: '25%'
	})
	
	
	navigation_links.click( function(event) {

		$.scrollTo(
			$(this).attr("href"),
			{
				duration: 200,
				offset: { 'left':0, 'top':-nav.height()-20 }
			}
		);
	});


});
