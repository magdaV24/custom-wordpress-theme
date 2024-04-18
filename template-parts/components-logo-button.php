<?php
$current_theme = get_theme_mod('color_scheme');
$url;

if($current_theme  === "one"){
    $url= "http://localhost/wordpress/wp-content/uploads/2024/04/light-theme-logo.png";
}else{
    $url="http://localhost/wordpress/wp-content/uploads/2024/04/dark-theme-logo.png";
}
?>

<div class="logo-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <img src=<?php  echo $url;?> alt="button">
</div>


<div class="offcanvas offcanvas-start sidebar-wrapper" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Our latest additions!</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div id="sidebar">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php endif; ?>
</div>

  </div>
</div>