<?php get_header(); ?>
<?php $catvar = get_query_var('category_name'); $cat = get_category_by_slug($catvar); ?>
    <div class="subhead <?php echo $cat->slug; ?>">
        <div class="wrap">
            <h2>Join Our Team</h2>
            <h3><?php echo category_description($cat->cat_ID); ?></h3>
        </div>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="g-3-1">
                <div class="gi g3">
                    <ul class="post-list">
                        <?php while(have_posts()) : the_post(); ?>
                            <?php get_template_part('partials/content', 'post'); ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php rcccs_paging_nav(); ?>
                </div>
                <div class="gi g1">
                    <?php //no sidebar on careers page ?>
                </div>
            </div>
        </div><!-- end wrap -->
    </div><!-- end main -->
<?php get_footer(); ?>