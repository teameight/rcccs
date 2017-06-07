<?php
/*
 Template Name: Contact
*/
get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
<?php
//    $mission = get_field('mission_statement');
//    $philosophy = get_field('philosophy');
//    $history = get_field('history');
//    $args = array(
//        'post_type' => 'staff',
//        'numberposts' => -1
//    );
//    $staff = get_posts($args);
    ?>
    <!--    <div class="g-map">-->
    <!--        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12657.675043716987!2d-77.44276890000013!3d37.5216248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b1110bc1051e4b%3A0x2c2d35afd93b34b1!2sriver+city+ccs!5e0!3m2!1sen!2sus!4v1386031689904" width="1400" height="650" frameborder="0" style="border:0"></iframe>-->
    <!--    </div>-->
    <?php if( have_rows('locations') ): ?>
        <div class="acf-map">
            <?php while ( have_rows('locations') ) : the_row();

                $location = get_sub_field('location');

                ?>
                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                    <h4><?php the_sub_field('title'); ?></h4>
                    <p class="address"><?php echo $location['address']; ?></p>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <section>
        <div class="wrap">
            <div class="g-half">
                <div class="gi">
                    <div class="contact-links lf">
                        <?php if( have_rows('locations') ): ?>
                            <?php while ( have_rows('locations') ) : the_row();
                                $location = get_sub_field('location');
                                $address = explode(',', $location['address']);
                                ?>
                                <div class="location" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                                    <div class="icon map"></div><?php the_sub_field('title'); ?>
                                    <p class="address">
                                        <?php echo $address[0].'<br/>'.$address[1].'<br/>'.$address[2].', '.$address[3]; ?>
                                        <?php if ( get_sub_field('directions') ) : ?>
                                            <a class="btn" href="<?php echo get_sub_field('directions'); ?>">Get Directions</a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="gi">
                    <div class="contact-links rt">
                        <a href="mailto:<?php echo get_theme_mod('email_address'); ?>"><div class="icon email"></div><span><?php echo get_theme_mod('email_address'); ?></span></a>
                        <a><div class="icon phone"></div><span><?php echo get_theme_mod('phone_number'); ?></span></a>
                        <a href="<?php echo get_theme_mod('facebook'); ?>"><div class="icon fb"></div><span>Connect on Facebook</span></a>
                        <a href="<?php echo get_theme_mod('twitter'); ?>"><div class="icon twi"></div><span>Connect on Twitter</span></a>
                        <a href="<?php echo get_bloginfo('url'); ?>/category/careers"><div class="icon careers"></div><span>Careers</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>