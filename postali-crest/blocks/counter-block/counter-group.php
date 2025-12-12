<?php
$counter_el = '';
$override_global = get_field('override_global_stats');



if( $override_global) {
 $counters_arr = get_field('counters');
} else {
    $counters_arr = get_field('global_counters', 'options');
}

if( $counters_arr ) {    
    $counter_total = count($counters_arr);
    $counter_el .= "<div id='counter-group' class='counter-group_$counter_total'>";

    foreach( $counters_arr as $counter ) {
        
        $number = $counter['number'];
        $add_plus = $counter['add_plus_symbol'];
        $title = $counter['title'];
        $copy  = $counter['short_copy'];

        $counter_el .= '<div class="counter">';

        if( $number || $add_plus ) {
            $counter_el .= '<div class="counter-number">';
            if( $number ) {
                $counter_el .= '<p class="lg-title counter-animation">' . number_format($number) . '</p>';
            }
            if( $add_plus ) {
                $counter_el .= '<span class="plus-symbol">+</span>';
            }
            $counter_el .= '</div>';
        }

        if( $title || $copy ) {
            $counter_el .= '<div class="counter-copy">';
            if( $title ) {
                $counter_el .= '<p class="md-title">' . $title . '</p>';
            }
            if( $copy ) {
                $counter_el .= '<p>' . $copy . '</p>';
            }
            $counter_el .= '</div>';
        }

        $counter_el .= '</div>';

    } 
    $counter_el .= '</div>';
    echo $counter_el;
}


?>