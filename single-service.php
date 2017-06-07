<?php get_header(); ?>
<?php while(have_posts()) : the_post();

$terms = wp_get_post_terms($post->ID, 'services');
// print_r($terms);

foreach ( $terms as $term ) :

    if ( $term->slug == 'rcic' ) :

        $rcic = true;

    endif;

endforeach;

?>
    <div class="subhead bg"<?php
        $heading_color = get_field('heading_color');
        if($heading_color){
            $h_font_color = "";
            if( $heading_color == '696C6F' || $heading_color == '8C8384'  || $heading_color == '8C9685'   || $heading_color == '84868D'){
                $h_font_color =  " color:#f9faee;";
            }
            echo ' style="background-color:#' . $heading_color. ';' . $h_font_color . '"';
        }
    ?>>
        <div class="wrap">
            <h1><?php the_title(); ?></h1>
            <h4 class="t8 font-secondary"><?php the_field('subheading'); ?></h4>
        </div>
    </div>

    <?php if ( $rcic ) : ?>

        <div class="subhead bg subsubhead">
            <div class="wrap">
                <h3>An Integrated Counseling Service</h3>
            </div>
        </div>

    <?php endif; ?>

    <div class="main">
        <div class="wrap">
            <div class="g-3-1">
                <div class="gi g3 service cf">
                    <?php get_template_part('partials/content', 'service'); ?>

                    <?php if ( $rcic ) : ?>
                        <p class="service-rcic">
                        <em>River City Integrative Counseling, Inc. is an affiliate of River City Comprehensive Counseling Services, Inc. River City Integrative Counseling Inc. is not a licensed program by Virginia Department of Behavioral Health and Developmental Services.</em>
                        </p>
                    <?php endif; ?>

                    <?php

                    if(have_rows('expandables')): ?>

                        <div class="expandables">

                       <?php while(has_sub_field('expandables')): ?>
                            <h4 class="trigger"><a href="#"><?php the_sub_field('title'); ?></a></h4>
                            <div class="toggle_container">
                                <?php the_sub_field('content'); ?>
                            </div>
                        <?php endwhile; ?>

                        </div>

                    <?php endif; ?>

                </div>
                <div class="gi g1">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div><!-- end wrap -->
    </div><!-- end main -->
<?php endwhile; ?>
<?php get_footer(); ?>