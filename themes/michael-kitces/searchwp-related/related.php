<?php
/**
 * SearchWP Engine: default
 * Maximum Results: 3
 */

/**
 * This is the default SearchWP Related results template. If you would like to
 * customize this template, DO NOT EDIT THIS FILE. Instead, create a folder
 * named 'searchwp-related' in your active theme, and copy this file inside.
 *
 * You may create multiple results templates based on the post being viewed,
 * simply append the post type name to the file name like so:
 *
 *      ~/your-theme-folder/searchwp-related/related-page.php
 *
 * That template file will be used whenever you view a Page on your site, while
 * the default (related.php) template would be used for everything else.
 *
 * You may customize the SearchWP engine used to find results by editing
 * the "SearchWP Engine" name at the top of this file.
 *
 * You may customize the number of related entries returned by that engine
 * by editing the "Maximum Results" at the top of this file.
 */

// DO NOT remove global $post; unless you're being intentional
global $post; ?>

<?php

/**
 * $searchwp_related is an array of posts, defined within the SearchWP Related plugin
 */

// Figure out whether we are doing regular related posts for this post in this category
if ( ! empty( $post ) ) {
    $current_post_id = $post->ID;
    $current_post_cat = wp_get_post_categories( $current_post_id )[0];
    $searchwp_related_overide_posts = false;

    $cat_overide_setting = get_field( 'searchwp_override', 'category_' . $current_post_cat );
    $cat_intro_text = get_field( 'related_posts_intro_text', 'category_' . $current_post_cat );

    if ( empty( $cat_intro_text ) ) {
        $cat_intro_text = 'A Few Related Articles You Might Also Be Interested In...';
    }

    if ( ! empty( $cat_overide_setting ) && $cat_overide_setting ) {
        $searchwp_related_overide_posts = true;
    }

}

// If we are overiding the searchwp functionality we'll display the three most recent posts in this category, excluding the current post
if ( $searchwp_related_overide_posts ) {

    $recent_args = array(
    	'posts_per_page'   => 3,
    	'category'         => $current_post_cat,
    	'orderby'          => 'date',
    	'order'            => 'DESC',
    	'exclude'          => $current_post_id,
    	'post_type'        => 'post',
    	'post_status'      => 'publish',
    	'suppress_filters' => true
    );
    $related_posts = wp_get_recent_posts( $recent_args );

    if ( ! empty( $related_posts ) ) { ?>
        <div class="searchwp-related">
            <?php if ( ! empty( $cat_intro_text ) ) : ?>
                <h3><?php echo $cat_intro_text ?></h3>
            <?php endif; ?>
            <div class="search-wp-related-posts">
                <?php
                    // Loop through each related entry and set up the main $post
                    foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>

                    <?php
                    $cat = get_the_category( $post["ID"] )[0]->name;
                    ?>
                    <a class="search-wp-related-post" href="<?php echo esc_url( get_permalink( $post["ID"] ) ); ?>">
                        <div class="search-wp-related-post-title">
                            <?php echo $post["post_title"]; ?>
                        </div>
                        <?php if ( ! empty( $cat ) ) : ?>
                            <div class="search-wp-related-post-categories">
                                Posted in: <?php echo $cat ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach;

                // You MUST reset the $post data once you're done looping through results
                wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
    }
// If we aren't overiding the searchwp_related posts we'll use them... as long as we have some.
} else {

    if ( ! empty( $searchwp_related ) ) : ?>
        <div class="searchwp-related">
            <?php if ( ! empty( $cat_intro_text ) ) : ?>
                <h3><?php echo $cat_intro_text ?></h3>
            <?php endif; ?>
            <div class="search-wp-related-posts">
                <?php
                    // Loop through each related entry and set up the main $post
                    foreach ( $searchwp_related as $post ) : setup_postdata( $post ); ?>

                    <?php
                    $cat = get_the_category( $post->ID )[0]->name;
                    ?>
                    <a class="search-wp-related-post" href="<?php echo esc_url( get_permalink() ); ?>">
                        <div class="search-wp-related-post-title">
                            <?php the_title(); ?>
                        </div>
                        <?php if ( ! empty( $cat ) ) : ?>
                            <div class="search-wp-related-post-categories">
                                Posted in: <?php echo $cat ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach;

                // You MUST reset the $post data once you're done looping through results
                wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif;
}