<?php
/* Template Name: Schedule Page */
get_header();

if( have_posts() ) : while( have_posts() ) :

the_post();

?>
    <div class="main">
        <div class="wrap">
            <div class="g-3-1">
                <div class="gi g3">
                    <?php the_content(); ?>
                    <?
                    if(get_field('sessions')):

                        echo '<table id="servicestbl"><tbody>'; 

                        while(has_sub_field('sessions')): ?>
                        <tr>
                            <td><?php the_sub_field('weekday-time'); ?></td>
                            <td><?php 
                                if(get_sub_field('link')){
                                    echo '<a href="' . get_sub_field('link') . '" >' . get_sub_field('name') . '</a>';
                                }else{
                                    the_sub_field('name');
                                }
                             ?></td>
                        </tr>
                        <?php
                        endwhile;

                        echo '</tbody></table>';

                    endif;
                    ?>
                </div>
                <div class="gi g1">
                </div>
            </div>
        </div>
    </div><!--End main-->

<?php endwhile; endif;
get_footer();
?>