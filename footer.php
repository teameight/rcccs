</div> <!--End Content-->
<!-- Begin Footer -->
<footer class="footer" role="contentinfo">
    <div class="wrap">
        <div class="g g-half">
            <div class="gi">
                <?php if(is_page('contact')) {
                    echo '<h4><div class="icon referral contact"></div>Contact Us</h4>';
                    gravity_form(1, false, true, false, false, true);
                }
                else { ?>
                    <h2>Contact Us</h2>
                    <p class="blck-desc"><?php echo get_theme_mod('contact_text'); ?></p>
                    <div class="contact-links lf">
                        <a href="mailto:<?php echo get_theme_mod('email_address'); ?>"><div class="icon email"></div><span><?php echo get_theme_mod('email_address'); ?></span></a>
                        <a><div class="icon phone"></div><span><?php echo get_theme_mod('phone_number'); ?></span></a>
                        <a href="<?php echo get_bloginfo('url'); ?>/contact"><div class="icon map"></div><span>View our locations</span></a>
                    </div>
                <?php } ?>
            </div>
            <div class="gi">
                <?php if(is_page('contact')) { ?>
                <h4><a href="<?php echo get_bloginfo('url'); ?>/referral"><div class="icon referral contact M-r"></div><span>Submit a Referral</span></a></h4>
                <?php } ?>
                <div class="contact-links rt">
                    <?php if(is_page('contact')) { ?>
                        <?php
                        $ref_link = get_field('downloadable_form', get_ID_by_slug('referral'));
                        if(!empty($ref_link)) { ?>
                            <a href="<?php echo $ref_link; ?>"><div class="icon referral"></div><span>Downloadable Referral Form</span></a>
                        <?php
                            }
                        } else {
                        ?>
                        <a href="<?php echo get_bloginfo('url'); ?>/referral"><div class="icon referral"></div><span>Referral</span></a>
                        <a href="<?php echo get_bloginfo('url'); ?>/category/careers"><div class="icon careers"></div><span>Careers</span></a>
                        <a href="<?php echo get_bloginfo('url'); ?>/resources"><div class="icon resources"></div><span>Resources</span></a>
                        <a href="<?php echo get_theme_mod( 'facebook'); ?>"><div class="icon fb"></div><span>Connect on Facebook</span></a>
                        <a href="<?php echo get_theme_mod( 'twitter'); ?>"><div class="icon twi"></div><span>Connect on Twitter</span></a>
<a href="http://rivercityccs.com/wp-content/uploads/2014/10/2014InnerCity100_ReleaseTemplate-1-3-.pdf" style="margin-left:42px;" target="_blank"><img src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2014/11/100.jpeg" alt="ICIC and FORTUNE’s Inner City 100 winners"></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<?php wp_footer(); ?>
</body>
</html>