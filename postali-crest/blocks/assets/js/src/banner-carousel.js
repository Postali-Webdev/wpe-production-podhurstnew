jQuery( function ( $ ) {
    "use strict";
    $('.hp-banner-carousel').slick({
        dots: false,
        infinite: true,
        fade: true,
        autoplay: true,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: false,
        swipeToSlide: false,
        cssEase: 'ease-in-out',
    });
    
});