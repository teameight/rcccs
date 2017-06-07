<?php

get_search_form();

$id = get_category_by_slug('community');

$args = array(
    'parent' => $id->cat_ID,
    'hide_empty' => 0
);

$cats = get_categories($args);

foreach( $cats as $cat ) {
    echo '<a href="' . get_category_link($cat->cat_ID) .'" class="cat' . ' ' . $cat->slug . '">' . $cat->name . '</a>';
}

?>