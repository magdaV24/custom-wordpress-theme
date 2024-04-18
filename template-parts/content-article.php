<!-- The content of the post -->

<?php

$current_theme = get_theme_mod('color_scheme');
$deco_url;

if($current_theme  === "one"){
    $deco_url= "/wordpress/wp-content/uploads/2024/03/deco.png";
}else{
    $deco_url="/wordpress/wp-content/uploads/2024/04/column-svgrepo-com.png";
}
?>

<div class="content-wrapper">
    <div class="title-wrapper">
        <div class='deco-right'>
            <img src=<?php echo $deco_url; ?> alt="deco-left">
        </div>
        <div class='title-container'>
        <?php
echo "<h1 class='title'>";
the_title();
echo "</h1>";
$author_url = esc_url( get_author_custom_page_url( get_the_author_meta( 'ID' ) ) );

// Output the link
echo "<a href='$author_url'>" . "Written by " . get_the_author() . "</a>";

echo '<span class="secondary-font"><i class="fa-regular fa-calendar m-1"></i>Published at: ';
the_date('F j, Y');
echo '</span>';
?>
        </div>
        <div class='deco-right'>
            <img src=<?php echo $deco_url; ?> alt="deco-right">
        </div>
    </div>

    <div class="content-container" id="comments-area">
        <div class="post-thumbnail-container">
            <img src="<?php the_post_thumbnail_url() ?>" alt="">
        </div>
        <?php
        $content = get_the_content();
        echo "<div class='content'>" . $content . "</div>";
        $tags = get_the_tags();
        if ($tags) {
            echo '<div class="tags-container">';
            foreach ($tags as $tag) {
                echo "<a href='" . get_tag_link($tag->term_id) . "' class='tag'><i class='fa-solid fa-hashtag'></i>" . $tag->name . "</a>";
            }
            echo '</div>';
        }
        ?>

    </div>
</div>