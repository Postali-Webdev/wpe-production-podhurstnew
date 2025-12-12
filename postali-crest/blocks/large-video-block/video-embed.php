<?php

$section_title = get_field('video_title');
$embed_url = get_field('video_embed_url');
$schema = get_field('video_schema');
$schema_name = $schema['name'];
$schema_description = $schema['description'];
$schema_thumbnail = $schema['thumbnail_url'];
$schema_upload_date = $schema['upload_date'];
$schema_duration = $schema['duration'];
$video_copy = get_field('video_copy');
$video_thumbnail = get_field('video_thumbnail');
$video_el = '';

if( $embed_url ) {
    $video_el .= '<div id="video-embed-wrapper">';
    if( $section_title ) {
        $video_el .= '<h3>' . $section_title . '</h3>';   
    }

    $video_el .= "<div class='video-wrapper'>";

    $video_el .= '<div class="responsive-iframe"><iframe class="video-embed" src="' . $embed_url . '" allowfullscreen></iframe></div>';

    if( $video_thumbnail ) {
        $video_el .= "<div class='video-block-thumbnail'>". wp_get_attachment_image( $video_thumbnail['ID'], 'full' ). "</div>";
    }
    $video_el .= "</div>";
    
    if( $video_copy ) {
        $video_el .= "<div class='video-copy'>$video_copy</div>";
    }

    $video_el .= '</div>';

    echo $video_el;

    $video_schema = '"@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "'.$schema_name.'",
    "description": "'.$schema_description.'",
    "thumbnailUrl": "'.$schema_thumbnail.'",
    "uploadDate": "'.$schema_upload_date.'",
    "duration": "'.$schema_duration.'",
    "embedUrl": "'.$embed_url.'"';

    echo '<script type="application/ld+json"> {' . strip_tags($video_schema) . '}</script>';
}

?>
