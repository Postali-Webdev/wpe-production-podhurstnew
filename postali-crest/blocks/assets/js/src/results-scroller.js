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

    $('#results').slick({
		dots: false,
        arrows: false,
		infinite: true,
		fade: false,
		autoplay: false,
  		autoplaySpeed: 5000,
  		speed: 1300,
		slidesToShow: 3,
		slidesToScroll: 3,
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
                    dots: true
                }
            },
            {
                breakpoint: 601,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,     
                    centerMode: false,
                    variableWidth: false,
                    dots: true
                }
            }
        ]
    });	
    
    $('.slick-custom-prev').on('click', function() {
        $('#results').slick('slickPrev');
    });

    $('.slick-custom-next').on('click', function() {
        $('#results').slick('slickNext');
    });
});