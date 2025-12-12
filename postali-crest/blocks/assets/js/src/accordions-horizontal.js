jQuery( function ( $ ) {
    "use strict";

    //horizontal accordion
    $(document).ready(function () {
        $(".accordion-mobile").on("click", ".accordion_title", function() {
            // will (slide) toggle the related panel.
            $(this).toggleClass("active").next().slideToggle();
            $(this).parent().toggleClass("active");
        });
    });
    
    $(document).ready(function () {
        $(".acc_horiz_content").hide();
        $(".acc_horiz1").show();
    
        /* if in tab mode */
        $("ul.acc_horiz li").click(function() {
            $(".acc_horiz_content").hide();
            var activeTab = $(this).attr("rel"); 
            $("."+activeTab).fadeIn();		
                
            $("ul.acc_horiz li").removeClass("active");
            $(this).addClass("active");
        });
    });

    
});