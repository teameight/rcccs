<?php
/*
 Template Name: About Us
*/
get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
    <?php
        $mission = get_field('mission_statement');
        $philosophy = get_field('philosophy');
        $history = get_field('history');
        $args = array(
            'post_type' => 'staff',
            'posts_per_page' => -1,
            'orderby' =>   'menu_order',
            'order' =>      'ASC'
        );
        $staff = get_posts($args);
    ?>
    <div class="subhead bg">
        <div class="wrap">
            <h3><?php echo $mission; ?></h3>
        </div>
    </div>
    <div class="main about">
        <div class="wrap">
            <div>
                <div class="gi">
                    <?php echo $philosophy; ?>
                </div>
                <div class="gi">
                    <?php echo $history; ?>
                </div>
            </div>
        </div><!-- end wrap -->
    </div><!-- end main -->
    <section>
        <div class="wrap">
            <h2>Who We Are</h2>
            <ul class="who-we-are">
            <?php
            foreach($staff as $member) :
                $id = $member->ID;
                $img = get_field('image', $id);
                $name = $member->post_title;
                $degree = get_field('degree', $id);
                $about = apply_filters('the_content', $member->post_content);
                $position = get_field('position', $id);
                if( $position ) $position = '<h3>'.$position.'</h3>';

//                echo var_dump($member);

            echo "<li class='staff-img'>
                    <img src=".$img[sizes][staff]." alt=".$img->alt." />
                    <span>$name<br>$degree</span>
                    <div class='about-staff two-col'>$position $about</div>
                </li>";

            endforeach; ?>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>