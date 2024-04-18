<?php
get_header();
?>
<div class="article">
    <?php

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            get_template_part('template-parts/content', 'archive');
        }
    }
    ?>

    <!-- pagination -->

    <div class="pagination-container">
        <?php the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '&laquo; Previous', 'textdomain',
            'next_text' => 'Next &raquo;', 'textdomain',
        ));
        ?>
    </div>

</div>


<div class="footer">
<?php
get_footer();
?>
</div>