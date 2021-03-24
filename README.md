# WordPress Code Snippets

I created this repo as a time saver for basic "WordPress Theme Development". These are basic starter snippets for thing such as Custom Pagination, Image Manipulation, Custom Post Types etc.

## Contents
[General WP Snippets](#general-wp-snippets)
[Loop](#loop)
[Page Conditional](page-conditional)

#Loop
```php
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
```

#Page Conditional
```php
if ( is_front_page() && is_home() ) {

    // Default homepage
    
} elseif ( is_front_page() ) {

    // static homepage
    
} elseif ( is_home() ) {

    // blog page
    
} else {

    //everything else
    
}

```




#Page Conditional
