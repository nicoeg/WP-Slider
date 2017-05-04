jQuery( document ).ready( function( $ ) {
	var skip = 0;
	var duration = ss_data && ss_data.duration.length > 0 ? ss_data.duration : 10000;
	$('.slide').first().fadeIn();

	window.setInterval(function() {
		if (skip) {	skip = 0; return false;	}
		next = (!$('.slide.active').next().length) ? $('.slide').first() : $('.slide.active').next();
		$('.slide.active').fadeOut().removeClass('active');
		next.fadeIn().addClass('active');
	}, duration);

	$('.slider .arrow').click(function() {
		if ($(this).hasClass('right')) 
			next = (!$('.slide.active').next().length) ? $('.slide').first() : $('.slide.active').next();
		else
			next = (!$('.slide.active').prev().length) ? $('.slide').last() : $('.slide.active').prev();
		$('.slide.active').fadeOut().removeClass('active');
		next.fadeIn().addClass('active');
		skip = 1;
	});
});
