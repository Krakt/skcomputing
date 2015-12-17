<article class="skc-post skc-post-home">
    
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
    
    <div>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </div>
    <nav class="skc-nav">
         <?php printf(__( 'Written by', 'skcomputing' )); ?> <cite><a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></cite>
         <?php
            echo ' '.__( 'published in', 'skcomputing' ).' ';
            the_category(', ');
            echo ' '.__('the', 'skcomputing').' ';
            echo get_the_date('D d M Y').'.';
         ?>
    </nav>
    <main>
        <p>

            <?php if($post->post_excerpt){ ?>
                
                <?php echo get_the_excerpt(); ?>

                <p>
                    <a href="<?php the_permalink(); ?>"><?php _( 'Continue reading &raquo;', 'skcomputing' ); ?></a>
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