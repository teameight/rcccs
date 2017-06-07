<?php

if ( ! function_exists( 'rcccs_paging_nav' ) ) :
/**
* Display navigation to next/previous set of posts when applicable.
*
* @since Twenty Fourteen 1.0
*
* @return void
*/
function rcccs_paging_nav() {
// Don't print empty markup if there's only one page.
if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
return;
}

$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$pagenum_link = html_entity_decode( get_pagenum_link() );
$query_args   = array();
$url_parts    = explode( '?', $pagenum_link );

if ( isset( $url_parts[1] ) ) {
wp_parse_str( $url_parts[1], $query_args );
}

$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

$links   = paginate_links( array(
'base'     => $pagenum_link,
'type'     => 'array',
'format'   => $format,
'total'    => $GLOBALS['wp_query']->max_num_pages,
'current'  => $paged,
'mid_size' => 1,
'add_args' => array_map( 'urlencode', $query_args ),
'prev_text' => __( '< ...', 'rcccs' ),
'next_text' => __( '... >', 'rcccs' ),
) );

if ( $links ) :

?>
<nav class="navigation paging-navigation" role="navigation">
    <ol class="pagination loop-pagination">
        <li class="label">page</li>
        <?php
//            print_r($links);
            foreach($links as $link) {
                echo '<li>'.$link.'</li>';
            }
        ?>
    </ol><!-- .pagination -->
</nav><!-- .navigation -->
<?php
endif;
}
endif;