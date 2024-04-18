<!-- A page that lists all the results that match the searched input -->

<?php
get_header();

?>

<div class="list-wrapper">

    <?php

    $search_query = get_search_query();

    $args = array(
        's'                   => $search_query,
        'post_type'           => 'post',
        'posts_per_page'      => -1,
        'orderby'             => 'title',
        'order'               => 'ASC',
        'suppress_filters'    => false,
    );

    $custom_query = new WP_Query($args);

    if ($custom_query->have_posts()) :
        echo '<h2>Search Results for: ' . esc_html($search_query) . '</h2>';
        echo '<div class="list">';
        while ($custom_query->have_posts()) : $custom_query->the_post();
            echo '<div class="list-item">
                    <div class="list-item-thumbnail">';
            if (has_post_thumbnail()) {
                echo '<img src="' . get_the_post_thumbnail_url() . '" alt="">';
            } else {
                echo '<img src="http://localhost/wordpress/wp-content/uploads/2024/03/Not-Found.jpg" alt="Placeholder Image">';
            }
            echo '</div>
                    <div><span><a href="' . get_permalink() . '">' . get_the_title() . '&rarr;</a></span></div>
                </div>';
        endwhile;
        echo '</div>';

        wp_reset_postdata();
    else :
        echo '<h2>No results found for: ' . esc_html($search_query) . '</h2>';
    endif;
    ?>

</div>

<div class="footer">
    <?php
    get_footer();
    ?>
</div>