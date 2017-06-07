<?php get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
<?php $cat = get_the_category(); $cat = reset($cat); ?>
    <div class="subhead <?php echo $cat->slug; ?>">
        <div class="wrap">
            <h3><?php echo $cat->name ?></h3>
            <h4 class="font-secondary"><?php echo category_description($cat->cat_ID); ?></h4>
        </div>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="g-3-1">
                <div class="gi g3 post cf">
                    <?php get_template_part('partials/content', 'post'); ?>
                </div>
                <div class="gi g1">
                    <?php get_template_part('partials/sidebar', 'blog'); ?>
                </div>
            </div>
        </div><!-- end wrap -->
    </div><!-- end main -->
<?php endwhile; ?>
<?php get_footer(); ?>