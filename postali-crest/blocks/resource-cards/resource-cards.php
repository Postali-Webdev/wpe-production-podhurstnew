<?php 
$resource_el = '';
$card_columns = get_field('card_columns');
$add_title_card = get_field('add_title_card');
$enable_full_link = get_field('enable_full_link_card_style');
if( have_rows('resource_cards') ) {
    
    switch( $card_columns ) {
        case 'one':
            $resource_el .= '<div id="resource-cards" class="one-col">';
            break;
        case 'two':
            $resource_el .= '<div id="resource-cards" class="two-col">';
            break;
        case 'three':
            $resource_el .= '<div id="resource-cards" class="three-col">';
            break;
        case 'four':
            $resource_el .= '<div id="resource-cards" class="four-col">';
            break;
        case 'five':
            $resource_el .= '<div id="resource-cards" class="five-col">';
            break;
        default:
            $resource_el .= '<div id="resource-cards">';
            break;
    }

    if( $add_title_card ) {
        $title_card_name = get_field('title_card_name');
        $resource_el .= "<div class='title-card'><p>$title_card_name</p></div>";
    }
    
    while( have_rows('resource_cards') ) {
        the_row();        
        $copy = get_sub_field('copy');
        $link = get_sub_field('link');
        
        if( $enable_full_link ) {
            $resource_el .= '<div class="resource-card full-link-card">';
            if( $link['title'] || $copy ) {
                $resource_el .= '<div class="card-copy">';
                if( $link['title'] ) {
                    $resource_el .= '<p class="card-title">' . $link['title'] . '</p>';
                }
                if( $copy ) {
                    $resource_el .= '<p>' . $copy . '</p>';
                }
                $resource_el .= '</div>';
            }
            if( $link ) {
                $resource_el .= '<a class="fill-card-link" title="' . $link['title'] . '" href="' . $link['url'] . '" target="' . $link['target'] . '"></a>';
                $resource_el .= '<div class="arrow-icon"></div>';
            }
            $resource_el .= '</div>';
        } else {
            $resource_el .= '<div class="resource-card">';
            $resource_el .= '<a title="' . $link['title'] . '" class="fill-card-link" href="' . $link['url'] . '" target="' . $link['target'] . '"></a>';
            if( $copy ) {
                $resource_el .= '<div class="card-copy">';
                if( $copy ) {
                    $resource_el .= '<p>' . $copy . '</p>';
                }
                $resource_el .= '</div>';
            }

            if( $link ) {
                $resource_el .= '<div class="card-link"><p class="card-link-text">' . $link['title'] . '</p></div>';
            }
            $resource_el .= '</div>';
        }

        
    
    }

    $resource_el .= '</div>';
    echo $resource_el;
}

?>