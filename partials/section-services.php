<div class="services g-2up">
    <?php
        $args = array(
            'post_type' => 'service',
            'numberposts' => '-1',
            'order' => 'ASC',
            'orderby' => 'menu_order'
        );
        $services = get_posts($args);

        // create array for default River City Comprehensive Counseling Services
        $rccc = array();

        // create array for special River City Integrative Counseling Services
        $rcic = array();

        foreach ( $services as $temp ) {

            $terms = wp_get_post_terms( $temp->ID, 'services' );


            // check if the service has a type
            if ( $terms ) :
                // if it does, does it have the rcic type?
                foreach ( $terms as $term ) {

                    if ( $term->slug === 'rcic' ) {
                        $is_rcic = true;
                    } else {
                        $is_rcic = false;
                    }

                }

            else :
                // if not, specify false
                $is_rcic = false;

            endif;

            if ( $is_rcic ) {

                $rcic[] = $temp;

            } else {

                $rccc[] = $temp;
            }
        }

    ?>
    <div class="gi">
        <h3>River City Comprehensive Counseling, Inc.</h3>
        <?php foreach($rccc as $service) :
            $id = $service->ID;
            $link = (get_field('external_link_radio', $id) == 'yes' ? get_field('link_url', $id) : get_post_permalink($id));
            ?>
            <li>
                <a href="<?php echo $link; ?>"><h4><?php echo $service->post_title; ?></h4>
                <h5 class="subheading"><?php the_field('subheading', $service->ID); ?></h5></a>
            </li>
        <?php endforeach; ?>
    </div>
    <div class="gi">
        <h3>River City Integrative Counseling, Inc.</h3>
        <?php foreach($rcic as $service) :
            $id = $service->ID;
            $link = (get_field('external_link_radio', $id) == 'yes' ? get_field('link_url', $id) : get_post_permalink($id));
            ?>
            <li>
                <a href="<?php echo $link; ?>"><h4><?php echo $service->post_title; ?></h4>
                <h5 class="subheading"><?php the_field('subheading', $service->ID); ?></h5></a>
            </li>
        <?php endforeach; ?>
    </div>
</div>