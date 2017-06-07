<?php
/*
 Template Name: Full Width
*/
get_header();

if( have_posts() ) : while( have_posts() ) :

the_post();

?>
    <div class="main">
        <div class="wrap">
            <div class="g-1up">
                <div class="gi">
                    <?php the_content(); ?>
                </div>
                <div class="gi">
		<?php 
    		global $post;
    		$post_slug=$post->post_name;
		if($post_slug == "referral"){
		$ref_link = get_field('downloadable_form', get_ID_by_slug('referral'));
                if(!empty($ref_link)) { ?>
                    <a href="<?php echo $ref_link; ?>"><div class="icon referral"></div><span>Downloadable Referral Form</span></a>
                <?php } } ?>
                </div>
            </div>
        </div>
    </div><!--End main-->

<?php endwhile; endif;
get_footer();
?>