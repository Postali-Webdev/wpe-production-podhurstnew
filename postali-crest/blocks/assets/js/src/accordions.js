jQuery( function ( $ ) {
    "use strict";
    //vertical accordion
	$(".accordion").on("click", ".accordion_title", function() {
        // will (slide) toggle the related panel.
        $(this).toggleClass("active").next().slideToggle();
        $(this).parent().toggleClass("active");
    });
    
});