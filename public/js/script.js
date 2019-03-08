var $=jQuery.noConflict();

jQuery(document).ready(function($){

     // hide #backToTop first
    var top = $('#backToTop');
    var linkTop = $('#back-top a');
    top.hide();

    // fade in #backToTop
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				top.fadeIn();
			} else {
				top.fadeOut();
			}
		});

		// scroll body to 0px on click
		linkTop.click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

	$('.textarea-wysiwyg').trumbowyg({
		btns: ['strong', 'em', '|', 'link'],
		autogrow: true,
		svgPath: '/icons/trumbowyg-icons.svg'
	});

	$('[data-toggle="tooltip"]').tooltip();

	$('.slider').slick({
		draggable: true,
		arrows: false,
		dots: false,
		fade: true,
		speed: 900,
		autoplay: true,
		infinite: true,
		cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
		touchThreshold: 100
	});
	$('.featured-p').slick({
		slidesToShow: 3,
		autoplay: true,
		infinite: true,
		speed: 800,
		prevArrow: '<div class="slick-prev slick-arrow"><i class="fa fa-angle-left"></i></span>',
		nextArrow: '<div  class="slick-next slick-arrow"><i class="fa fa-angle-right"></i></span>'
 		
	})
	$('.last-post').slick({
		centerMode: true,
		slidesToShow: 2,
		autoplay: true,
		infinite: true,
		speed: 900,
		dots: false,
		arrows: false,
		prevArrow: '<div class="slick-prev slick-arrow"><i class="fa fa-angle-left"></i></span>',
		nextArrow: '<div  class="slick-next slick-arrow"><i class="fa fa-angle-right"></i></span>'

	})
	$('[data-fancybox="gallery"]').fancybox({
		// Options will go here
	});
 
	
});


