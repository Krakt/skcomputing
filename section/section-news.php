<section id="skc-news" class="bg-color-white">
    <div class="skc-container row">
    <?php
    if(have_posts()):
        while (have_posts()): the_post();
            get_template_part('content/content', 'news');
        endwhile;
    else:
        echo 'It seems that no posts have been created now!';
    endif;
    ?>
    </div>
</section>