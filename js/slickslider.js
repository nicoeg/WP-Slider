jQuery( document ).ready( function( $ ) {
	if (!ss_data) {
		return;
	}

	for (var i = 0; i < ss_data.length; i++) {
		ss_data[i].skip = 0;
		ss_data[i].element = $('.slick-slider[data-id=' + ss_data[i].id + ']');

		ss_data[i].element.find('.slide').first().fadeIn();

		intervaller(i, ss_data[i].duration)
	}

	$('.slider .arrow').click(function() {
		var element = $(this).closest('.slick-slider'),
			id = element.attr('data-id')

		if ($(this).hasClass('right')) 
			next = (!element.find('.slide.active').next().length) ? element.find('.slide').first() : element.find('.slide.active').next();
		else
			next = (!element.find('.slide.active').prev().length) ? element.find('.slide').last() : element.find('.slide.active').prev();

		element.find('.slide.active').fadeOut().removeClass('active');
		next.fadeIn().addClass('active');
		ss_data.find(slider => slider.id == id).skip = 1;
	});

	function intervaller(index, duration) {
		window.setInterval(function() {
			if (ss_data[index].skip) {	ss_data[index].skip = 0; return false;	}

			next = (!ss_data[index].element.find('.slide.active').next().length) ? ss_data[index].element.find('.slide').first() : ss_data[index].element.find('.slide.active').next();
			
			ss_data[index].element.find('.slide.active').fadeOut().removeClass('active');
			
			next.fadeIn().addClass('active');
		}, duration); //Wrong
	}
});
