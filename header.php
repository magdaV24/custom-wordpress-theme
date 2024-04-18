<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    ?>
</head>

<body>
    <!-- The menu -->
    <div class="collapse" id="navbarToggleExternalContent">
        <div class='menu-wrapper'>
            <div class="menu-col-one">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<div id="menu-items" class="navbar-nav me-auto mb-2 mb-lg-0 text-body-emphasis h4">%3$s</div>'
                    )
                );
                ?>
            </div>

            <div class="menu-col-two">
               <div>Customize:</div>
               <div style="display: flex; gap: 1rem">
               <?php get_template_part('template-parts/components', 'theme-button'); ?>
                <?php get_template_part('template-parts/components', 'font-dropdown'); ?>
               </div>
            </div>

            <div class="menu-col-three">

                <div class="sm-icon-wrapper twitter">
                    <div class="sm-icon">
                        <i class="fa-brands fa-twitter"></i>
                        <span>Follow me on Twitter!</span>
                    </div>
                </div>

                <div class="sm-icon-wrapper instagram">
                    <div class="sm-icon">
                        <i class="fa-brands fa-square-instagram"></i>
                        <span>Check out my Instagram!</span>
                    </div>
                </div>

                <div class="sm-icon-wrapper facebook">
                    <div class="sm-icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <span>Add me on Facebook!</span>
                    </div>
                </div>

                <div class="sm-icon-wrapper email">
                    <div class="sm-icon">
                        <i class="fa-regular fa-paper-plane"></i>
                        <span>Reach out with an Email!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The navbar -->

    <nav class="navbar">
        <div class="navbar-container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars navbar-btn"></i>
            </button>

            <form role="search" method="get" class="search-bar" action="<?php echo esc_url(home_url('/')); ?>">
                <label>
                    <span class="screen-reader-text"><?php echo _x('Search for:', 'label'); ?></span>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search post here...', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                </label>
                <button type="submit" class="btn search-submit"><?php echo _x('<i class="fa-solid fa-magnifying-glass"></i>', 'submit button'); ?></button>
            </form>

            <div class="blog-title">
                <div class="logo-btn-wrapper">
                    <?php
                    get_template_part('template-parts/components', 'logo-button');
                    ?>
                </div>

                <div class="blog-name"><?php echo get_bloginfo('name'); ?></div>
            </div>
        </div>
    </nav>