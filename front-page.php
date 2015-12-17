<?php

get_header();
?>
<div class="skc-home-wraper">

    <?php get_template_part('section/section', 'title'); ?>
    <?php get_template_part('section/section', 'news'); ?>
    <?php get_template_part('section/section', 'services'); ?>

    <section id="skc-contactus" class="bg-color-white">
        <div class="skc-container">
            blabla
            <br/>
            bla
        </div>
    </section>
    <section id="skc-google-map">
        <div class="skc-container">
            <div id="map"></div>
        </div>
    </section>
</div>
<?php
get_footer();

?>

