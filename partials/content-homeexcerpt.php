<?php
$postcat = get_the_category($post->ID);
$cat = $postcat[0];
foreach($postcat as $pcat) {
    if($pcat->category_nicename != 'community'){
        $cat = $pcat;
    }
}


?>
<li class="cf">
    <div class="block block-headline">
        <time datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
        <a href="<?php echo get_category_link($cat); ?>" class="cat <?php echo $cat->category_nicename; ?>"><?php echo $cat->cat_name; ?></a>
        <a href="<?php the_permalink(); ?>"><h2 class="alpha"><?php the_title(); ?></h2></a>
    </div>
    <?php 

		the_excerpt(); 
	
	?>
    <a href="<?php the_permalink(); ?>" class="more">Read More &gt;&gt;</a>
</li>
