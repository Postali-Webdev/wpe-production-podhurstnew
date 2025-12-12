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
    var windowWidth = $(window).outerWidth();


    if (windowWidth <= 600) {
        $('.links-full .links').slick({
            dots: true,
            arrows: false,
            infinite: true,
            fade: false,
            autoplay: false,
            autoplaySpeed: 5000,
            speed: 1300,
            slidesToShow: 1,
            slidesToScroll: 1,
            swipeToSlide: false,
            cssEase: 'ease-in-out',
        });	        
    }
    
});