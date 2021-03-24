<!---------------------------------------------
    
    General WP Snippets

----------------------------------------------->

<!-- Loop -->
<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'post',
        'category_name' => 'blog',
        'posts_per_page' => 9,
        'paged' => $paged
    );
    $the_query = new WP_Query($args); 
?>

<?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    
    <!-- Content to be looped/repeated -->

    <?php endwhile; ?>

    <?php if (function_exists("pagination")) {
        pagination($the_query->max_num_pages);
    } ?>
    
    <?php wp_reset_postdata(); ?>
    <?php else : ?>
<?php endif; ?>



<!-- Page Conditional -->
<!-- Read more on Conditional Tags: https://codex.wordpress.org/Conditional_Tags -->
<?php
	if ( is_front_page() && is_home() ) {

    // Default homepage
    
	} elseif ( is_front_page() ) {

    // static homepage
    
	} elseif ( is_home() ) {

    // blog page
    
	} else {

    //everything else
    
	}
?>



<!-- Go to specific page -->
<a href="<?php echo get_permalink( get_page_by_path( 'about-us' ) ); ?>">About Us</a>

<a href="<?php echo esc_url( get_page_link(43) ); ?>"><!-- LINK TEXT --></a>

<a href="<?php echo home_url('/slug-of-the-page/'); ?>"><!-- LINK TEXT --></a>



<!-- Custom Post Type - Bare Minimum version -->
<?php

function name_of_post_type() {
	register_post_type( 'name-post-type',
		array(
			'labels' => array(
				'name' => __( 'Post Type' ),
				'singular_name' => __( 'Post Type' ),
				'add_new_item' => 'Add New Post Type',
				'add_new' => __('Add New Post Type'),
				'attributes' => __( 'Post Type Attributes', 'text_domain' ),
			),
			'public' => true,
			'rewrite' => array(
				'slug' => 'name-post-type'
            ),
			'supports' => array(
				'title',
				'thumbnail'
			),
			'menu_position' => 5,
			'menu_icon' => __('dashicons-images-alt2')
		)
	);
}

add_action( 'init', 'name_of_post_type' );

?>





<!---------------------------------------------
    
    Images in WordPress

----------------------------------------------->

<!-- Background-Image -->
<div style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/./path-to-image/the-image.jpg"/></div>



<!-- Image inside theme file/s -->
<img src="<?php echo get_stylesheet_directory_uri(); ?>/./path-to-image/the-image.jpg"/>



<!-- Background Image in DIV -->
<div style="background-image: url('<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true); echo $thumb_url[0]; ?>')">
	
	<!-- COntent Area -->

</div>



<!-- Create Default Image if no Thumbnail - Must be inside a loop. -->
<?php
	if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	}
	else {
		echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
			. '/images/thumbnail-default.jpg" />';
	}
?>





<!---------------------------------------------
    
    Advanced Custom Fields

----------------------------------------------->

<!-- Render Value -->
<?php the_field('field-value'); ?>



<!-- Conditional - If Else -->
<?php if ( get_field( 'field-value' ) ): ?>
            
    <!-- Render this if true -->

<?php else: ?>

    <!-- Else render FALSE or NULL if the field does not exist -->

<?php endif; ?>



<!-- Create Short Code from text space -->
<?php
    $shortcode = get_post_meta($post->ID,'field-value',true);
    echo do_shortcode($shortcode);
?>





<!---------------------------------------------
    
    Custom Blocks

----------------------------------------------->

<!-- Render Value -->
<?php echo block_field('block-value'); ?>



<!-- If Else -->
<?php
    if ( block_value( 'block-value' ) ) {
        
        // Render this if true

    } else {
        
        // Else render FALSE or NULL if the field does not exist
    }
?>




<!---------------------------------------------
    
    Language Settings

----------------------------------------------->
<!-- If else Lingo statement -->
<?php
    $currentlang = get_bloginfo('language');
    if($currentlang=="pt-PT"):
?>

<?php elseif($currentlang=="en-ZA"): ?>

<?php endif; ?>
