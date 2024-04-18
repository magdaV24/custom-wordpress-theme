<?php
/*
Template Name: Author Profile Template
*/

get_header(); 

// Get user ID from query parameter
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$current_user_id = get_current_user_id();
$user_data = get_userdata($user_id);

// Counting the number of posts a user has written:

$args = array(
    'author'        => $user_id,
    'post_type'     => 'post', 
    'post_status'   => 'publish',
    'posts_per_page'=> -1,  
);

$posts = new WP_Query($args);
$post_count = $posts->found_posts;
?>

<div class="user-page">
    <div class="user-profile">
        <div class="user-avatar">
        <?php 
            echo get_avatar($user_id, 200); 
            ?>
        </div>
        <div class="user-info">
            <h4>
                <?php 
                 echo '<h1>' . esc_html($user_data->display_name) . '</h1>';
                ?>
            </h4>
            <h6>E-mail:  <?php echo esc_html($user_data->user_email); ?></h6>
            <h6>Member since: <?php echo date('F j, Y', strtotime($user_data->user_registered)); ?></h6>
            <h6>Published articles: <?php echo $post_count; ?></h6>
        </div>

        <div class="form">
        <?php
if ($user_id === $current_user_id) {

    if ($user_data) {
        get_template_part('template-parts/content','edit-user');

    } else {
        echo '<p>User not found</p>';
    }
}
?>
        </div>
    </div>
    <div class="user-content-wrapper">
        <div class="about">
        <form id="bio-form" method="post">
    <label for="user_bio">Bio:</label><br>
    <textarea id="user_bio" name="user_bio" rows="5" cols="50"><?php echo esc_textarea(get_the_author_meta('user_bio', get_current_user_id())); ?></textarea><br>
    <input type="submit" name="submit_bio" value="Save Bio">
</form>

        </div>
        <div class="list-wrapper">
        <h2>User's Posts</h2>
            <div class="list">
            <?php
            if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                    $posts->the_post();
                    ?>
                    <div class="post-item">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p>No posts found for this user.</p>';
            }
            ?>
            </div>

        </div>
    </div>
</div>
<div class="footer">
<?php

get_footer(); 
?>
</div>
