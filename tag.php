<!-- A page where displaying all the posts categorized under the same tag -->

<?php get_header(); ?>

<div id="primary" class="list-wrapper">
    <h2 class="page-title">
        <?php
        printf(__('Posts tagged with: %s', 'textdomain'), single_tag_title('', false));
        ?>
    </h2>

    <div class="list">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
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
        else :
            echo __('No posts found', 'textdomain');
        endif;
        ?>
    </div>
</div>

<div class="footer">
    <?php
    get_footer();
    ?>
</div>