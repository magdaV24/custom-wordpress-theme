<?php
get_header();
?>
<div class="article">
    <?php

    if(have_posts()){
        while(have_posts()){
            the_post();
            get_template_part('template-parts/content','page');
        }
    }
    ?>

</div>


<div class="footer">
<?php
get_footer();
?>
</div>