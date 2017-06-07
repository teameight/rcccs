<?php get_header(); ?>
    <div class="main">
        <div class="wrap">
            <?php if( !have_posts() ) : ?>
                <h2>Sorry, no results were found. Try another search</h2>
            <?php else : ?>
            <h2><?php printf( __( 'Search Results for: %s', 'rcccs' ), get_search_query() ); ?></h2>
            <?php endif; ?>
            <div class="g-3-1">
                <div class="gi g3">
                    <ul class="post-list">
                        <?php while(have_posts()) : the_post(); ?>
                            <?php get_template_part('partials/content', 'excerpt'); ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php rcccs_paging_nav(); ?>
                </div>
                <div class="gi g1">
                    <?php get_template_part('partials/sidebar', 'blog'); ?>
                </div>
            </div>
        </div><!-- end wrap -->
    </div><!-- end main -->
<?php get_footer(); ?>