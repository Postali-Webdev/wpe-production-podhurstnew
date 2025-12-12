/**
 * Slick Custom
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

    $('#testimonials').slick({
		dots: false,
        arrows: false,
		infinite: true,
		fade: false,
		autoplay: false,
  		autoplaySpeed: 5000,
  		speed: 1300,
		slidesToShow: 3,
		slidesToScroll: 1,
    	swipeToSlide: false,
        cssEase: 'ease-in-out',
        centerMode: true,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,     
                    centerMode: false,
                    variableWidth: false,
                }
            }
        ]
    });	
    
    $('.testimonial-slick-custom-prev').on('click', function() {
        $('#testimonials').slick('slickPrev');
    });

    $('.testimonial-slick-custom-next').on('click', function() {
        $('#testimonials').slick('slickNext');
    });
});