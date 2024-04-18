<?php
get_header();
$current_theme = get_theme_mod('color_scheme');
$image_url;

if ($current_theme === 'two') {
    $image_url = 'http://localhost/wordpress-blog/wp-content/uploads/2024/04/pexels-isil-13139104.jpg';
} else {
    $image_url = "http://localhost/wordpress-blog/wp-content/uploads/2024/04/pexels-alina-vilchenko-2099266.jpg";
}
?>
<div class="front-page-wrapper">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
            <div class="front-page-thumbnail">
                <img src="<?php echo $image_url ?>" alt="front-page-image">
            </div>

    <?php
        }
    }
    ?>

    <div class="front-page-content">
        <?php the_content(); ?>
    </div>
</div>
<div class="footer">
<?php
get_footer();
?>
</div>