jQuery( function ( $ ) {
    "use strict";
    if ($('.filters').length > 0) {
        
        $('.filters > .filter-btn').on('click', function () {
            $('.filters > .filter-btn').removeClass('active-filter');
            $(this).addClass('active-filter');
            var filter = $(this).data('filter');
            if (filter == "all") {
                $('.result').each(function () { 
                    if ($(this).hasClass('hide')) { 
                        $(this).removeClass('hide');
                    }
                })
            } else {
                $('.result').each(function () {
                    if (!$(this).hasClass(filter)) {
                        $(this).addClass('hide');
                    } else {
                        $(this).removeClass('hide');
                    }
                });
            }
        });
    }
});