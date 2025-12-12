jQuery(function ($) {
   
    $(document).ready(function () {
        $('.video-block-thumbnail').on('click', function (e) {
            var $video = $(this).siblings('.responsive-iframe').find('.video-embed');
            $(this).fadeOut();
              if ($video[0].contentWindow) {
                  $video[0].src += "&autoplay=1";
                  e.preventDefault();
            } else {
                  console.log('Video not loaded');
            }
        });
        $('.video-block-link p').on('click', function (e) {
            var $video = $(this).closest('.video-block-content').siblings('.video-wrapper').find('.video-embed');
            if( $('.video-block-thumbnail').length > 0 ) {
                $(this).closest('.video-block-content').siblings('.video-wrapper').find('.video-block-thumbnail').fadeOut();   
            }

            if ($video[0].contentWindow) {
                $video[0].src += "&autoplay=1";
                e.preventDefault();
            } else {
                    console.log('Video not loaded');
            }
        });
    })


});