<?php
require_once __DIR__ . '/vendor/autoload.php';

function athena_theme_support(){
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'athena_theme_support');
function athena_register_styles(){
    $theme_version = wp_get_theme()->get('Version');
    $color_scheme = get_theme_mod('color_scheme', 'one');
    if ($color_scheme === 'one') {
        wp_enqueue_style('athena-style-one', get_template_directory_uri() . '/style-one.css', array(), $theme_version);
    } elseif ($color_scheme === 'two') {
        wp_enqueue_style('athena-style-two', get_template_directory_uri() . '/style-two.css', array(), $theme_version);
    }
    wp_enqueue_style('athena-stylesheet', get_template_directory_uri() . '/style.css', array(), $theme_version);

    wp_enqueue_style('athena-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" , array(), '5.3.3');
    wp_enqueue_style('athena-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css", array(), '6.5.1');

}

add_action("wp_enqueue_scripts", "athena_register_styles");

function athena_register_scripts(){

    wp_enqueue_script('athena-bootstrap', "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js", array(), '5.3.3', true );
    wp_enqueue_script('athena-popper', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js", array(), '2.11.8', true);
    wp_enqueue_script('athena-jquery', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js", array(), '3.7.1', true);
    wp_enqueue_script('athena-scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '3.7.1', true);
    wp_enqueue_script('theme-button', get_template_directory_uri() . '/assets/js/theme-button.js', array('jquery', 'customize-preview'), null, true);
    wp_enqueue_script('athena-fonts', get_template_directory_uri() . '/assets/js/font-dropdown.js', array('jquery', 'customize-preview'), null, true);
    wp_enqueue_script('athena-sorting-comments', get_template_directory_uri() . '/assets/js/comments-sorting.js', array('jquery'), null, true);
    
    wp_localize_script('theme-button', 'themeData', array(
        'color_scheme' => get_theme_mod('color_scheme', 'one'),
        'ajax_url' => admin_url('admin-ajax.php'),
        'post_id'      => get_the_ID(),
    ));

    wp_localize_script('athena-sorting-comments', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action("wp_enqueue_scripts", "athena_register_scripts");

include_once( WP_PLUGIN_DIR . '/recent-comments-custom-widget/recent-comments.php' );
include_once( WP_PLUGIN_DIR . '/recent-posts-custom-widget/recent-posts.php' );
include_once( WP_PLUGIN_DIR . '/like-dislike-custom-widget/like-dislike-buttons.php' );

function register_custom_widgets() {
    register_widget( 'Custom_Recent_Comments_Widget');
    register_widget( 'Custom_Recent_Posts_Widget');
    register_widget('Like_Dislike_Custom_Widget');
}
add_action( 'widgets_init', 'register_custom_widgets' );

// Adding the menu to the navbar

function athena_menus(){
    $locations=array(
        'primary'=>'Desktop Primary Left Side',
        'footer'=>'Footer Menu Items'
    );
    register_nav_menus($locations);
}

add_action('init', 'athena_menus');

// search functionality

function athena_search_function($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post', 'page'));
        $query->set('tag__in', array()); 
    }
    return $query;
}
add_filter('pre_get_posts','athena_search_function');

function athena_search_query($query) {
    if ($query->is_search) {
        $search_query = $query->get('s');
        $search_query_array = explode(' ', $search_query);
        $search_query_array = array_map('trim', $search_query_array);
        $search_query = implode(' ', $search_query_array);
        $query->set('s', $search_query);
    }
    return $query;
}

add_filter('pre_get_posts', 'athena_search_query');

function get_author_custom_page_url( $author_id ) {
    $author_template_page_id = 109;
    $author_template_page_url = get_permalink( $author_template_page_id );
    return add_query_arg( 'user_id', $author_id, $author_template_page_url );
}

// Theme toggling

// Function for adding the option of selecting the color scheme from the admin dashboard in wordpress
function custom_theme_customize_register($wp_customize) {

    $wp_customize->add_section('theme_color_scheme', array(
        'title' => __('Color Scheme', 'athena'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('color_scheme', array(
        'default' => 'one',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('color_scheme', array(
        'type' => 'radio',
        'label' => __('Select Color Scheme', 'athena'),
        'section' => 'theme_color_scheme',
        'choices' => array(
            'one' => __('One', 'athena'),
            'two' => __('Two', 'athena'),
        ),
    ));

    $wp_customize->add_control('theme_button', array(
        'type' => 'button',
        'settings' => '',
        'section' => 'theme_color_scheme',
        'label' => __('Blog Color Scheme', 'athena'),
        'input_attrs' => array(
            'id' => 'theme-button',
        ),
    ));
}
add_action('customize_register', 'custom_theme_customize_register');

// Updating the color scheme after the reader clicked the button from the frontend;
function update_color_scheme_callback() {
    $new_scheme = isset($_POST['color_scheme']) ? sanitize_text_field($_POST['color_scheme']) : 'one'; 
    set_theme_mod('color_scheme', $new_scheme);
    wp_die();
}
add_action('wp_ajax_update_color_scheme', 'update_color_scheme_callback');
add_action('wp_ajax_nopriv_update_color_scheme', 'update_color_scheme_callback');


// Sorting Comments

function comments_sorting() { 
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
    $sortingMethod = isset($_GET['sorting_method']) ? $_GET['sorting_method'] : 'oldest';

    $comments = sortComments($sortingMethod, $post_id);
    
    ob_start();

    if ($comments) {
        wp_list_comments(array(
            'style'       => 'div',
            'short_ping'  => true,
            'avatar_size' => 64,
            'callback'    => 'custom_comment_output',
            'reply_text'        => __('Reply', 'your-theme-textdomain'),
            'format'            => 'html5',
            'max_depth'   => 5, 
            'per_page'    => 5,
            'post_id'     => $post_id,
        ), $comments);
    // Pagination for the comments.
    if (get_comment_pages_count() > 1 && get_option('page_comments')) {
        echo '<nav class="navigation comment-navigation">';
        paginate_comments_links(array(
            'prev_text' => __('&laquo; Previous', 'your-theme-textdomain'),
            'next_text' => __('Next &raquo;', 'your-theme-textdomain')
        ));
        echo '</nav>';
    }
} else {
    echo '<p>' . __('No comments yet.', 'your-theme-textdomain') . '</p>';
}

    $sorted_comments_html = ob_get_clean();
    
    echo $sorted_comments_html;
    
    wp_die();
}

add_action('wp_ajax_comments_sorting','comments_sorting');
add_action('wp_ajax_nopriv_comments_sorting', 'comments_sorting');


function custom_comment_output($comment, $args, $depth)
{
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    $comment_class = empty($args['has_children']) ? '' : 'parent';

    if ($comment->comment_parent != '0') {
        $comment_class .= ' child-comment';
    }

?>
    <<?php echo $tag; ?> <?php comment_class($comment_class); ?> id="comment-<?php comment_ID(); ?>">
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <div class="comment-content">
        <div class="comment-author">
            <?php if ($args['avatar_size'] != 0) : ?>
                <div class="avatar-wrapper"><?php echo get_avatar($comment, $args['avatar_size']); ?></div>
            <?php endif; ?>
            <p class="comment-author-link"><?php echo get_comment_author_link(); ?></p>
            <span><?php esc_html_e('says:', 'your-theme-textdomain'); ?></span>
        </div>
        <div class="comment-metadata">
            <p href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>">
                <time datetime="<?php comment_time('c'); ?>">
                    <?php printf(__('%1$s at %2$s', 'your-theme-textdomain'), get_comment_date(), get_comment_time()); ?>
                </time>
            </p>
            <?php edit_comment_link(__('(EDIT)', 'your-theme-textdomain'), '<div class="btn">', '</div>'); ?>
        </div>
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
        <div class="custom-comment-widget">
            <?php the_widget('Like_Dislike_Custom_Widget'); ?>
        </div>
        <div class="reply">
            <?php comment_reply_link(array_merge($args, array(
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'reply_text' => __('REPLY', 'your-theme-textdomain')
            ))); ?>
        </div>
    </div>
</article>

    <?php
}
function sortComments($method, $post_id) {
    $comments = [];

    if ($method === 'oldest') {
        $args = array(
            'orderby' => 'comment_date',
            'order'   => 'ASC',
            'post_id' => $post_id,
        );
        $commentsQuery = new WP_Comment_Query;
        $comments = $commentsQuery->query($args);
    } elseif ($method === 'newest') {
        $args = array(
            'orderby' => 'comment_date',
            'order'   => 'DESC',
            'post_id' => $post_id,
        );
        $commentsQuery = new WP_Comment_Query;
        $comments = $commentsQuery->query($args);
    }elseif ($method === 'likes') {
        $args = array(
            'post_id' => $post_id,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'user_liked_', 
                    'compare' => 'EXISTS', 
                ),
                array(
                    'key'     => 'user_liked_',
                    'compare' => 'NOT EXISTS', 
                ),
            ),
            'orderby' => array(
                'meta_value_num' => 'DESC', 
                'comment_date'   => 'ASC',  
            ),
        );

        $commentsQuery = new WP_Comment_Query;
        $comments = $commentsQuery->query($args);
    }

    return $comments;
}

// Initializing the use of widgets in the sidebar;
function widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'athena' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'athena' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'widgets_init' );