<?php
get_header();

if( have_posts() ) : while( have_posts() ) :

the_post();

?>
    <div class="main">
        <div class="wrap">
            <div class="g-3-1">
                <div class="gi g3 page">
                    <?php the_content(); ?>
                </div>
                <div class="gi g1">
                <?php
                $ref_link = get_field('downloadable_form', get_ID_by_slug('referral'));
                if(!empty($ref_link)) { ?>
                    <a href="<?php echo $ref_link; ?>"><div class="icon referral M-r"></div><span>Downloadable Referral Form</span></a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div><!--End main-->

<?php endwhile; endif;
get_footer();
?>