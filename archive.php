<!-- Responsible for displaying archived blog posts -->

<?php
get_header();
?>
<div class="article">
    <?php

    if(have_posts()){
        while(have_posts()){
            the_post();
            get_template_part('template-parts/content','archive');
        }
    }
    ?>
</div>
<div class="footer">
<?php
get_footer();
?>
</div>