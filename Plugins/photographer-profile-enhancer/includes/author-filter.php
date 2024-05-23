<?php
function custom_author_output($author_name) {
    if (is_author()) {
        return $author_name;
    }

    global $post;
    $author_id = $post->post_author;
    $user_data = get_userdata($author_id);
    $username = $user_data->user_login; 
    $first_name = $user_data->first_name; 
    $last_name = $user_data->last_name; 

    $author_url = get_author_posts_url($author_id);
    $author_avatar = get_avatar($author_id);

    $author_posts = new WP_Query([
        'author' => $author_id,
        'posts_per_page' => 3,
    ]);

    $author_posts_html = '<div class="author-posts-container" style="display: flex; justify-content: space-around; margin-bottom: 10px;">';
    while ($author_posts->have_posts()) {
        $author_posts->the_post();
        $post_thumbnail = get_the_post_thumbnail($post->ID, 'thumbnail', array('style' => 'width: 50px; height: 50px; object-fit: cover;'));
        $author_posts_html .= '<div class="author-post">';
        $author_posts_html .= $post_thumbnail;
        $author_posts_html .= '</div>';
    }
    wp_reset_postdata();

    $author_posts_html .= '</div>'; 

    $hover_content = "<div class='author-hover'>";
    $hover_content .= "<div class='author-avatar'>{$author_avatar}</div>";
    $hover_content .= "<div class='author-details'>";
    $hover_content .= "<h3>{$first_name} {$last_name}</h3>"; 
    $hover_content .= "<p>{$username}</p>";
    $hover_content .= $author_posts_html;
    $hover_content .= "<p><a href='{$author_url}' class='btn btn-light'>View Profile</a></p>";
    $hover_content .= "</div>";
    $hover_content .= "</div>";

    $output = "<span class='author-info' style='display: flex; align-items: center;'>";
    $output .= "<div class='author-avatar'>{$author_avatar}</div>";
    $output .= "<div style='margin-left: 10px;'>"; 
    $output .= "<h3>{$first_name} {$last_name}</h3>";
    $output .= "<p>{$username}</p>";
    $output .= "</div>"; 
    $output .= $hover_content;
    $output .= "</span>";

    return $output;
}

add_filter('the_author', 'custom_author_output');





?>
