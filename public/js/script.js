$(document).ready(function(){

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
})