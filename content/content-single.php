<article class="skc-post">
    
    <?php if(has_post_thumbnail()): ?>
    <!-- start thumbnails -->
    <div>
        
        <?php
        
        if(is_home()){
            the_post_thumbnail('small-thumbnail');
        }
        else{
            the_post_thumbnail('banner-image');
        }
        ?>
        
    </div> <!-- end thumbnails -->
    
    <?php endif; ?>
    
    <div class="page-header">
        <h2><?php the_title(); ?></h2>
    </div>
    <nav class="skc-nav">
         <?php printf(__( 'Written by', 'skcomputing' )); ?> <cite><a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></cite>
         <?php
            echo '&nbsp;'.__( 'published in', 'skcomputing' ).'&nbsp;';
            the_category('&#44;&nbsp;');
            echo '&nbsp;'.__('the', 'skcomputing').'&nbsp;';
            echo get_the_date('D d M Y').'.';
         ?>
    </nav>
    <main>
        <p>

            <?php if($post->post_excerpt){ ?>
                
                <?php echo get_the_excerpt(); ?>

                <p>
                    <a href="<?php the_permalink(); ?>"><?php __( 'Continue reading &raquo;', 'skcomputing' ); ?></a>
                </p>

            <?php } else{
                    the_content();
                } ?>

        </p>
    </main>
    <div>
        <?php comments_template(); ?>
    </div>
</article>