jQuery( function ( $ ) {
	"use strict";
    $('#process-slider').slick({
        dots: false,
        infinite: true,
        fade: false,
        autoplay: false,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: false,
        swipeToSlide: true,
        cssEase: 'ease-in-out',
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 821,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });


    $('.process-slider-nav .slick-custom-prev').on('click', function() {
        $('#process-slider').slick('slickPrev');
    });
    $('.process-slider-nav .slick-custom-next').on('click', function() {
        $('#process-slider').slick('slickNext');
    });

});