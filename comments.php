<!-- Displays the comments under a post -->

<div class="comments-wrapper">
    <div class="comment-form">
        <div class="comment-form-wrapper">
            <?php
            if (comments_open()) {
                comment_form(array(
                    'title_reply'          => __('<div class="comment-form-title">Share your thoughts!</div>', 'your-theme-textdomain'),
                    'label_submit'         => __('POST COMMENT', 'your-theme-textdomain'),
                    'class_submit'         => 'btn comment-submit',
                    'comment_field'        => '
            <div class="comment-field-content">
                <label for="comment">' . __('COMMENT(*)', 'your-theme-textdomain') . '</label>
                <textarea id="comment" name="comment" class="form-control" rows="5" required></textarea>
            </div>'
                ));
            } else {
                echo '<p>' . __('Comments are closed.', 'your-theme-textdomain') . '</p>';
            }
            ?>
        </div>
    </div>
    <div class="btn" id="show-comments-button">Show Comments</div>
    <div class="comments-section hide">
        <div class="comments-header">
            <?php
            if (get_comments_number() > 0) {
                echo "<h5 class='comment-form-title'>Comments (" . get_comments_number() . " replies):</h5>";
                get_template_part('template-parts/form', 'comments-sorting');
            }
            ?>
        </div>
        <div class="comments-list">

            <?php
            if (have_comments()) {
                wp_list_comments(array(
                    'style'             => 'div',
                    'short_ping'        => true,
                    'avatar_size'       => 64,
                    'callback'          => 'custom_comment_output',
                    'reply_text'        => __('Reply', 'your-theme-textdomain'),
                    'format'            => 'html5',
                    'reverse_top_level' => false,
                    'per_page' => 5,
                ));
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
            ?>
        </div>
    </div>