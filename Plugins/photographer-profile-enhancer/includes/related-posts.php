<?php
function display_related_posts() {
    if (!is_single()) {
        return; // Exit the function if not on a single post page
    }

    global $post;
    $tags = wp_get_post_tags($post->ID);
    
    if ($tags) {
        $tag_ids = array_map(function($tag) { return $tag->term_id; }, $tags);
        $related_posts = new WP_Query([
            'tag__in' => $tag_ids,
            'posts_per_page' => 3,
            'post__not_in' => [$post->ID]
        ]);
        
        if ($related_posts->have_posts()) {
            echo '<div class="related-posts" style="display: flex; justify-content: space-around;">'; 
            echo '<h3>Related</h3>';
            while ($related_posts->have_posts()) {
                $related_posts->the_post();
                $permalink = get_permalink();
                $title = get_the_title();
                $thumbnail = get_the_post_thumbnail(null, 'thumbnail', ['class' => 'related-post-thumbnail', 'alt' => $title]);

                echo "<div class='related-post-item'>";
                echo "<a href='{$permalink}' title='{$title}'>{$thumbnail}</a>";
                echo "</div>";
            }
            echo '</div>';
        }
        wp_reset_postdata();
    }
}




?>
