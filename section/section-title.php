<section id="skc-title" class="bg-color-transparent text-center orange">
    <div class="skc-container skc-content aligncenter">
        <h1>
            <?php
            if(skc_theme_options('ckeckbox_main_title'))
            {
                echo skc_theme_options('main_title');
            }
            else
            {
                bloginfo('name');
            }
            
            ?>
        </h1>
        <h2>
            <?php
            if(skc_theme_options('ckeckbox_sub_title'))
            {
                echo skc_theme_options('sub_title');
            }
            else
            {
                bloginfo('description');
            }
            
            ?>
        </h2>
    </div>
</section>
