<?php 

$ordered_list = get_field('list');
$list_el = "";

if( $ordered_list ) {
    $list_el .= "<ol class='ordered-list-block'><div class='columns'>";
    $count = 0;
    $list_total = count($ordered_list);
    foreach( $ordered_list as $list_item ) {
        $count++;
        if( $count ==  1 ) {
            $list_el .="<div class='column-50'>";
        }
        $list_title = $list_item['title'];
        $list_copy = $list_item['copy'];
        $list_el .= "<li><span class='list-item'>$list_title</span>$list_copy</li>";
        if( $count == ceil($list_total / 2) ) {
            $list_el .="</div><div class='column-50'>";
        }
        if( $count == $list_total ) {
            $list_el .="</div>";
        }
    }
    $list_el .= "</div></ol>";
    echo $list_el;
}
?>