<?php

get_header(); ?>
<section class="skc-page bg-color-white">
    <div class="skc-container">
<?php
    if(have_posts()):
        while (have_posts()): the_post();
            get_template_part('content/content', 'single');
        endwhile;
    else:
        echo 'It seems that no posts have been created now!';
    endif;
    ?>
    </div>
</section>
<?php
get_footer();

?>