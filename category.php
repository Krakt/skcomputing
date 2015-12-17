<?php

get_header(); ?>
<section class="skc-page bg-color-white">
    <div class="skc-container">
<?php
    if(have_posts()):
        while (have_posts()): the_post(); ?>
            <?php if(has_children() || $post->post_parent > 0): ?>
            <nav class="skc-breadcrumb">
                <ol class="breadcrumb">
                    <li class="skc-breadcrumb-parent"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></li>
                    <?php $args = array('child_of' => get_top_ancestor_id(),
                                        'title_li' => ''); ?>
                    <?php wp_list_pages($args); ?>
                </ol>
            </nav>
            <?php endif; ?>
            <article class="skc-post skc-page">
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
            </article>
        <?php endwhile;
    else:
        echo 'It seems that no posts have been created now!';
    endif;
    ?>
    </div>
</section>
<?php
get_footer();

?>