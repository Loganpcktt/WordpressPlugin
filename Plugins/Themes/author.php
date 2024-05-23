<?php get_header(); ?>

<div class="author-profile">
    <?php
    // Check if we have an author
    if (have_posts()) {
        the_post();

        // Display author's details
        $author_id = get_the_author_meta('ID');
        $author_display_name = get_the_author();
        $author_biography = get_the_author_meta('description');
        $author_email = get_the_author_meta('email');
        $author_avatar = get_avatar($author_id);
    ?>

    <div class="author-details">
        <div class="author-avatar">
            <?php echo $author_avatar; ?>
        </div>
        <div class="author-info">
            <h2><?php echo $author_display_name; ?></h2>
            <p><?php echo $author_biography; ?></p>
            <p>Email: <a href="mailto:<?php echo $author_email; ?>"><?php echo $author_email; ?></a></p>
        </div>
    </div>

    <div class="author-posts">
        <?php
        // Rewind the posts for the loop
        rewind_posts();

        // Posts loop
        while (have_posts()) {
            the_post();
            ?>
            <div class="post">
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
                <div class="post-summary">
                    <?php the_excerpt(); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    } else {
        echo '<p>No posts by this author.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>
