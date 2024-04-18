<!-- The content of the post -->

<div class="archive-wrapper">
    <div class="archive-post">
        <div class="archive-post-thumbnail">
            <img src="<?php the_post_thumbnail_url() ?>" alt="">
        </div>
        <div class="archive-post-content">
            <div class="archive-title-container">
                <?php
                the_title('<h2>', '</h2>');
                $author = get_the_author();
                if (!empty($author)) {
                    echo '<h5 class="secondary-font"><i class="fa-solid fa-pen-clip"></i> Written by: ' . $author . '</h5>';
                }
                the_date('F j, Y', '<h6 class="secondary-font"><i class="fa-regular fa-calendar m-1"></i>Published at: ', '</h6>');
                ?>
            </div>
            <div class="excerpt-container">

                <?php
                $excerpt = get_the_excerpt();
                echo "<div class='content'>" . $excerpt . "</div>";
                ?>
            </div>
            <div class="read-more-container">
                <a href="<?php the_permalink(); ?>">Read article &rarr;</a>
            </div>
            <div class="footer-archive">
                <?php
                $tags = get_the_tags();
                if ($tags) {
                    foreach ($tags as $tag) {
                        echo "<span class='tag'><i class='fa-solid fa-hashtag'></i>" . $tag->name . "</span>";
                    }
                }
                echo '<span><i class="fa-regular fa-comment"></i> ' . get_comments_number() . ' replies</span>';
                ?>
            </div>
        </div>
    </div>
</div>