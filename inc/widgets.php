<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Skc_Breaking_News extends WP_Widget
{

    public function __construct() {
        parent::__construct( 'widget_skc_breaking_news', __( 'SK Computing - Breaking News', 'skcomputing' ), array(
                'classname'   => 'widget_skc_breaking_news',
                'description' => __( 'Use this widget to list your recent Aside, Quote, Video, Audio, Image, Gallery, and Link posts.', 'skcomputing' ),
        ) );
    }
    
    /* What to display in the admin widget page (option for widget) */
    public function form($instance)
    {
        $title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
        $nb_post = empty($instance['nb_post']) ? '' : esc_attr($instance['nb_post']);
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo  $title; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_name( 'nb_post' ); ?>"><?php _e( 'Nb post:' ); ?></label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id( 'nb_post' ); ?>"
                   name="<?php echo $this->get_field_name( 'nb_post' ); ?>"
                   type="text"
                   value="<?php echo $nb_post; ?>" />
        </p>

<?php
    }
    
    public function widget($args, $instance)
    {
        global $post;
        ?>
        <div class="skc-container row">
            <div class="page-header">
                
            </div>
            <?php
            if(have_posts())
            {
                $c = 0;
                while ($c < $instance['nb_post']): the_post();?>
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
                    <?php
                    $c++;
                endwhile;
                wp_reset_postdata();
            }
            else
            {
                echo 'It seems that no posts have been created now!';
            }
            ?>
        </div>
    <?php
    }
}