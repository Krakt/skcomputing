<?php

get_header(); ?>
<section class="skc-page bg-color-white">
    <div class="skc-container">
<?php
if(have_posts()): // Enter the loop if some post exist
    // Start the loop.
    while (have_posts()): the_post();

        if(has_children() || $post->post_parent > 0): ?>

        <nav class="skc-breadcrumb">
            <ol class="breadcrumb">
                <li class="skc-breadcrumb-parent"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></li>
                <?php $args = array('child_of' => get_top_ancestor_id(),
                                    'title_li' => ''); ?>
                <?php wp_list_pages($args); ?>
            </ol>
        </nav>
        
<?php endif; ?>
        
        <div class="row">
            <div class="col-sm-12">
                <article class="skc-post">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_content(); ?></p>
                </article>
            </div>
        </div>
        <?php endwhile; // End the loop.
    else: // Display a message for no post
        echo 'It seems that no posts have been created now!';
    endif;
    ?>
    </div>
</section>
<?php
get_footer();

?>