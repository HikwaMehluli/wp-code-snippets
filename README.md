# WordPress Code Snippets

I created this repo as a time saver for basic "WordPress Theme Development". These are basic starter snippets for thing such as Custom Pagination, Image Manipulation, Custom Post Types etc.

# Contents
## General WP Snippets
- [Loop](#loop)
-- [Pagination Function](#pagination-function)
-- [Pagination SCSS](#pagination-scss)
- [Page Conditional](#page-conditional)
- [Go to specific page](#go-to-specific-page)
- [Custom Post Type Bare Minimum version](#custom-post-type-bare-minimum-version)

## Loop
```php
/* Place this loop where you want it on your theme page/s */
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

### Pagination Function
Place it in functions.php
```php
function pagination($pages = '', $range = 4) {
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;

         if(!$pages) {
             $pages = 1;
         }
     }   
     if(1 != $pages) {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++) {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
```

### Pagination SCSS
```scss
.pagination {
    clear: both;
    padding: 50px 0 80px 0;
    position: relative;
    font-size: 1.2em;
    line-height: 13px;

    a,
    span {
        display: block;
        float: left;
        font-weight: 100;
        margin: 2px 2px 2px 0;
        padding: 15px;
        text-decoration: none;
        width: auto;
        color: var(--black);
        background: var(--grey);
    }

    a:hover {
        color: var(--white);
        background: var(--primary-color);
    }

    .current {
        padding: 15px;
        background: var(--primary-color);
        color: var(--white);
    }
}

```

[Go Back Up](#contents)

## Page Conditional
```php
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
```
[Go Back Up](#contents)

## Go to specific page
```php
<a href="<?php echo get_permalink( get_page_by_path( 'about-us' ) ); ?>">About Us</a>

<a href="<?php echo esc_url( get_page_link(43) ); ?>"><!-- Link Text --></a>

<a href="<?php echo home_url('/slug-of-the-page/'); ?>"><!-- Link Text --></a>
```

## Custom Post Type Bare Minimum version
```php
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
```
[Go Back Up](#contents)
