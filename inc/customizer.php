<?php

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
