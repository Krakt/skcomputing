<?php
/*
 * Function php is use to add a file with all custom function for the theme.
 */

//require_once('lib/wp_bootstrap_navwalker.php'); use to add boostrap in wp_menu
//require_once ( get_template_directory() . '/theme-options.php' );

/* include style */
add_action('wp_enqueue_scripts', 'skctheme_ressources');
function skctheme_ressources()
{
    
    wp_register_style('bootstrap.min',
                      get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap.min');
    
    wp_enqueue_style('style', get_stylesheet_uri());
}

/* Register jquery at init */
add_action( 'init', 'skc_register_js' );
function skc_register_js()
{
    wp_register_script('jquery.bootstrap.min',
                       get_template_directory_uri() . '/lib/jquery-2.1.4.min.js', 'jquery');
    wp_enqueue_script('jquery.bootstrap.min');
    
    wp_register_script('jquery-2.1.4.min.js',
                       get_template_directory_uri() . '/lib/jquery-2.1.4.min.js', 'jquery');
    wp_enqueue_script('jquery-2.1.4.min.js');
}

add_action('widgets_init', 'skc_add_section_widget');
function skc_add_section_widget()
{
    // Call widget in theme from twenty forteen
//    require get_template_directory() . '/inc/widgets.php';
//    register_widget( 'Skc_Recent_News' );
    require get_template_directory() . '/inc/widgets.php';
    register_widget('Skc_Breaking_News');
    
    register_sidebar(array(
        'id' => 'skc_services_section',
        'name' => __('Services section'),
        'description' => __('Display on the section services', 'skcomputing'),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>'));
}

add_action('wp_title', 'skc_modify_page_title', 20);
function skc_modify_page_title($title)
{
    return $title. ' '. get_bloginfo('name');
}

require get_template_directory() . '/inc/customizer.php';

/* Use to setup support to the theme */
add_action('after_setup_theme', 'skc_theme_setup');
function skc_theme_setup()
{
    /* Register menu location */
    register_nav_menus(array('primary' => 'Primary menu',
                             'footer' => 'Footer menu'));
    add_theme_support( 'title-tag' );
    /* Add support to theme for feature images */
    add_theme_support('post-thumbnails');
    
    /* add size for thumbnails horizontal */
    add_image_size('small-thumbnail', 180, 120, array('left', 'top'));
    add_image_size('medium-thumbnail', 360, 240, array('left', 'top'));
    add_image_size('large-thumbnail', 720, 480, array('left', 'top'));
    add_image_size('banner-image', 1070, 210, array('left', 'top'));
    
    /* add size for thumbnails vertical */
    add_image_size('small-thumbnail-v', 120, 180, array('left', 'top'));
    add_image_size('medium-thumbnail-v', 240, 360, array('left', 'top'));
    add_image_size('large-thumbnail-v', 480, 720, array('left', 'top'));
    add_image_size('banner-image-v', 210, 1100, array('left', 'top'));
}


/* customize Read More Links */
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link()
{
    return '<p><a href="'.get_permalink().'" class="btn btn-default more-link" role="button">'._( 'Continue reading &raquo;', 'skcomputing' ).'</a></p>';
}

add_shortcode('get_username_menu', 'get_username_menu');
function get_username_menu($args, $content)
{
    $a = $args;
    $username = wp_get_current_user();
    $a->title = $content. ' ' .$username->display_name;
    return $a;
}

add_shortcode('top_ancestor_menu', 'top_ancestor_menu');
function top_ancestor_menu($args, $content)
{
    $a = $args;
    if($args->url != 'javascript:void(0)')
    {
        $args->url = 'javascript:void(0)';
    }
//    var_dump($args->url);
    return $a;
}

add_filter('wp_nav_menu_objects', 'active_shortcode_menu');
function active_shortcode_menu($items)
{
    foreach ($items as $item)
    {
        if(!empty($item->title) && !empty($item->description))
        {
            global $shortcode_tags;
//            var_dump($item->description);
            $params = explode(',', $item->description);
            
            foreach ($params as $key => $value)
            {
                $shortcode = '';
                switch($value)
                {
                    case 'username_menu':
                        $shortcode = 'get_'.$item->description;
                        break;
                    case 'top_ancestor_menu':
                        $shortcode = $item->description;
                        break;
                    default:
                        break;
                }
                $args = $item; // Shortcode attributes.
                $content = $item->title; // Content for the shortcode.
                $item = call_user_func($shortcode_tags[$shortcode], $args, $content, $shortcode);
            }
        }
    }
    
    return $items;
}

//add_action( 'admin_init', function() {
//
//    add_meta_box(
//        'test',
//        'User menu',
//        'meta_box_user_menu',
//        'nav-menus',
//        'side',
//        'low'
//    );
//});
//
//function meta_box_user_menu()
//{
//    $username = wp_get_current_user();
//    $default = array('items_wrap' => '<a href="'.$atts['href'].'" target="'.$atts['target'].'">'.$content. ' ' .$username->display_name.'</a>');
//
//}

/* Find the ancestor of a post, use for breadcrum */
function get_top_ancestor_id()
{
    global $post;
    
    if($post->post_parent)
    {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}

/**
 * Goal: Find if a post has some children
 * return: the nummber of children
 */
function has_children()
{
    global $post;
    
    $childrens = get_pages('child_of='.$post->ID);
    
    return count($childrens);
}

/* Edit the comments template */
function mytheme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
    } else {
            $tag = 'li';
            $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php
        if ( $args['avatar_size'] != 0 )
        {
            echo get_avatar( $comment, $args['avatar_size'] );
        }

        $text = '<cite class="fn">%s</cite> <span class="says">';
        if(!empty($args['has_children'])) {
            $text .= 'says:</span>';
        }
        else
        {
            $nickname = get_user_meta(get_comment(get_comment(get_comment_ID())->comment_parent)->user_id, 'nickname', true);
            $text .= 'respond to</span>&nbsp;<cite class="fn">'.$nickname.'</cite>:';
        }
        printf( __($text), get_comment_author_link());
    ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
            <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                    /* translators: 1: date, 2: time */
                    printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
            ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
}

//add_filter("walker_nav_menu_start_el", "shortcode_menu" , 10 , 2);
///**
//* Hook to implement shortcode logic inside WordPress nav menu items
//* Shortcode code can be added using WordPress menu admin menu in description field
//*/
//function shortcode_menu( $item_output, $item ) {
//    if ( !empty($item->title))
//    {
//        $output = do_shortcode($item->title);
//        if ($output != $item->title)
//        {
//            $item_output = $output;
//        }
//    }
//    return $item_output;
//}
?>