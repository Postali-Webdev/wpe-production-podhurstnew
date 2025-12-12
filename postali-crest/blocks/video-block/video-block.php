<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

 $video_embed_url = get_field('video_embed_url');
 $video_title = get_field('video_title');
 $video_copy = get_field('video_copy');
 $video_link = get_field('video_link');
 $video_thumbnail = get_field('video_thumbnail');
 $video_el = "";

 if( $video_embed_url ) {

    $video_el .= "<div class='video-block'>";

    $video_el .= "<div class='video-wrapper'>";

    if( $video_thumbnail ) {
        $video_el .= "<div class='video-block-thumbnail'>". wp_get_attachment_image( $video_thumbnail['ID'], 'full' ). "</div>";
    }

    if( $video_embed_url ) {
        $video_el .= "<div class='responsive-iframe'><iframe class='video-embed' src='$video_embed_url' title='$video_title' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe></div>";
    }

    $video_el .= "</div>";

    if( $video_copy || $video_embed_url ) {
        $video_el .= "<div class='video-block-content'>";

        if( $video_copy ) {
            $video_el .= "<div class='video-block-copy'>$video_copy</div>";
        }

        if( $video_embed_url ) {
            $video_el .= "<div class='video-block-link'><p>Watch Video</p></div>";
        }

        $video_el .= "</div>";        
    }

    $video_el .= "</div>";

    echo $video_el;

 }
?>



