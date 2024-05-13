$(document).ready(function() {
	var slidesWrapperWidth, slideWidth, slideNumber, imgSrc, sliderInterval;
	//animation controls
	var pause = 4000;
	var transition = 500;

	//turn img into repsonsive full-bg img
	function makeBgImg() {
		$(".slides-wrapper li").each(function(i) {
			imgSrc = $(this).find('img').attr('src');
			$(this).css({
				'background-image': 'url(' + imgSrc + ')'
			});
		});
	} //end makeBgImg

	makeBgImg();

	function refreshVars() {
		slideNumber = $('.slides-wrapper li').length;
		slideWidth = $('#slider').outerWidth();
		slidesWrapperWidth = slideWidth * slideNumber;

		$('.slides-wrapper').css("width", slidesWrapperWidth + 'px');
		$('.slides-wrapper li').css('width', slideWidth + 'px');
		$('.slides-wrapper').css('left', -slideWidth);
	} //end refreshVars

	refreshVars();
	$(window).resize(refreshVars);


	$('.slider-wrapper li:last-child').prependTo('.slider-wrapper');

	function ShowNextSlide() {
		$('.slides-wrapper').animate({
			marginLeft: -slideWidth
		}, transition, function() {
			$('.slides-wrapper li:first-child').appendTo('.slides-wrapper');
			$('.slides-wrapper').css('marginLeft', '');
		}); //end animate
	} //end show next slide

	function ShowPrevSlide() {
		$('.slides-wrapper').animate({
			marginLeft: +slideWidth
		}, transition, function() {
			$('.slides-wrapper li:last-child').prependTo('.slides-wrapper');
			$('.slides-wrapper').css('marginLeft', '');
		}); //end animate     

	} //end show prev slide

	$('.slide-right').on('click', ShowNextSlide);
	$('.slide-left').on('click', ShowPrevSlide);

	//autoplay 
	function startSlider() {
		sliderInterval = setInterval(ShowNextSlide, pause)
	}
	startSlider();
	$('#slider').mouseenter(function() {
		clearInterval(sliderInterval);
	});
	$('#slider').mouseleave(startSlider);
}); //end ready