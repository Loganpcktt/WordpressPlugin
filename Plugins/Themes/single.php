<?php

get_header();

while ( have_posts() ) : the_post();

    // Get this post instance
    $post = get_post();

    ?>
    
    <div class="">
        <!-- author -->
        <div class="">
        <span class="author"><?php the_author(); ?></span>
        </div>
    </div>

    <div class="post-content">
        <div class="d-flex justify-content-center mb-3">
            <?php the_post_thumbnail('large'); ?>
        </div>

        <h3><?php the_title(); ?></h3>

        <main><?php the_content(); ?></main>

        <div class="mb-3 post-categories">
            <?php
            // Get the category
            $categories = get_the_category($post->ID);

            foreach($categories as $category) { ?>
                <a href="<?php echo get_category_link($category->term_id); ?>" class="link-secondary text-decoration-none"><?php echo $category->name; ?></a>
            <?php } 
            ?>
        </div>

        <div class="post-tags">
            <?php
            // Get the tags
            $tags = get_the_tags($post->ID);

            foreach($tags as $tag){ ?>
                <span class="badge rounded-pill text-bg-light">
                    <a href="<?php echo get_tag_link($tag->term_id); ?>" class="link-secondary text-decoration-none"><?php echo $tag->name; ?></a>
                </span>
            <?php }
            ?>
        </div>
    </div>

<?php 

display_related_posts();

endwhile;

get_footer();
?>
