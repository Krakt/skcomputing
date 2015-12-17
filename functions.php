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

add_action( 'customize_register', 'skc_customize_register' );
function skc_customize_register( $wp_customize ) {
  // Do stuff with $wp_customize, the WP_Customize_Manager object.
    $wp_customize->add_section('skc_navigation', array(
        'title'       => __('Navigation', 'skcomputing'),
        'description' => __('Navigation settings', 'skcomputing')
    ));
    /***************************************************************************
     * main title checkbox
     **************************************************************************/
    $wp_customize->add_setting('skc_theme_options[ckeckbox_main_title]', array(
        'default'           => '1',
        'type'              => 'option',
        'capability'        => 'edit_theme_options'
    ));
    $wp_customize->add_control('skc_checkbox_main_title', array(
        'label'      => __( 'Used main title over site title', 'skcomputing' ),
        'section'    => 'title_tagline',
        'type'       => 'checkbox',
        'settings'   => 'skc_theme_options[ckeckbox_main_title]'
    ));
    
    /***************************************************************************
     * main title text
     **************************************************************************/
    $wp_customize->add_setting('skc_theme_options[main_title]', array(
        'default'           => 'Change thos titles in the theme customizer',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_title'
    ));
    $wp_customize->add_control('skc_main_title', array(
        'label'     => __( 'Main title', 'skcomputing' ),
        'section'   => 'title_tagline',
        'settings'  => 'skc_theme_options[main_title]'
    ));
    

    /***************************************************************************
     * sub title checkbox
     **************************************************************************/
    $wp_customize->add_setting('skc_theme_options[ckeckbox_sub_title]', array(
        'default'           => '1',
        'type'              => 'option',
        'capability'        => 'edit_theme_options'
    ));
    $wp_customize->add_control('skc_ckeckbox_sub_title', array(
        'label'      => __( 'Used sub title over tagline', 'skcomputing' ),
        'section'    => 'title_tagline',
        'type'       => 'checkbox',
        'settings'   => 'skc_theme_options[ckeckbox_sub_title]'
    ));
    
    /***************************************************************************
     * sub title text
     **************************************************************************/
    $wp_customize->add_setting('skc_theme_options[sub_title]', array(
        'default'           => 'under Site Title & Tagline',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_title'
    ));
    $wp_customize->add_control('skc_sub_title', array(
        'label'      => __( 'Sub title', 'skcomputing' ),
        'section'    => 'title_tagline',
        'settings'   => 'skc_theme_options[sub_title]'
    ));
    
    /***************************************************************************
     * link color :link :visited
     **************************************************************************/
    $wp_customize->add_setting('link_color', array(
        'default'           => '#999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'      => __( 'Link color link and visited', 'skcomputing' ),
        'section'    => 'colors',
        'settings'   => 'link_color'
    )));
    
    /***************************************************************************
     * link color :hover
     **************************************************************************/
    $wp_customize->add_setting('link_color_hover', array(
        'default'           => '#f59526',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color_hover', array(
        'label'      => __( 'Link color hover', 'skcomputing' ),
        'section'    => 'colors',
        'settings'   => 'link_color_hover'
    )));
    
    /***************************************************************************
     * menu dropdown sign
     **************************************************************************/
    $wp_customize->add_setting('menu_dropdown_sign', array(
        'default'           => '▼'
    ));
    
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'menu_dropdown_sign', array(
        'label'      => __( 'Menu drop down sign', 'skcomputing' ),
        'section'    => 'skc_navigation',
        'settings'   => 'menu_dropdown_sign'
    )));
}

function skc_theme_options($name, $default = false) {
    $options = ( get_option( 'skc_theme_options' ) ) ? get_option( 'skc_theme_options' ) : null;
    // return the option if it exists
    if ( isset( $options[ $name ] ) ) {
        return apply_filters( 'skc_theme_options_$name', $options[ $name ] );
    }
    // return default if nothing else
    return apply_filters( 'skc_theme_options_$name', $default );
}

add_action('wp_head', 'skctheme_css_customize');
function skctheme_css_customize()
{?>
    <style type="text/css">
        nav a:link,
        nav a:visited{color: <?php echo get_theme_mod('link_color'); ?>;}
        
        nav a:hover{color: <?php echo get_theme_mod('link_color_hover'); ?>;}
        
        .menu-item-has-children > a:after{
            content: ' <?php echo get_theme_mod('menu_dropdown_sign') ?>';
            font-size: 0.75em;
        }
    </style>
<?php
}

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

add_shortcode('get_username_menu', 'get_username_in_menu');
function get_username_in_menu($atts, $content)
{
    $username = wp_get_current_user();
    return '<a href="'.$atts['href'].'" target="'.$atts['target'].'">'.$content. ' ' .$username->display_name.'</a>';
}

add_filter('wp_nav_menu_objects', 'active_shortcode_menu');
function active_shortcode_menu($items)
{
    foreach ($items as $item) {
        
        if(!empty($item->title) && ($item->description === "user_menu"))
        {
            global $shortcode_tags;
            $shortcode = 'get_username_menu';
            
            $atts = array(); // Shortcode attributes.
            $content = $item->title; // Content for the shortcode.
            
            $item->title = call_user_func($shortcode_tags[$shortcode], $atts, $content, $shortcode);
        }
//        var_dump($item->title);
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
function mytheme_comment($comment, $args, $depth) {
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
?>