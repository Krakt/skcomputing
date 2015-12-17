<div class="col-sm-6 col-md-4">
    <main class="thumbnail">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> - featured image">
        <div class="caption">
            <div class="page-header">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <p><?php the_content(); ?></p>
        </div>
    </main>
</div>