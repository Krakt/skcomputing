<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!-- start whole content -->
        <div class="skc-whole-content">
            <!-- start header -->
            <header class="skc-header" role="banner">
                <div class="skc-container">
                    
                    <nav role="navigation" class="skc-nav">
                        <div class="skc-logo">
                            <a href="<?php echo home_url(); ?>" class="no-text-decoration">
                                <img src="http://www.skcomputing.ch/wp-content/uploads/2015/05/SKComputing_Title_2015.png" alt="logo placeholder" />
                            </a>
                        </div>
                        <div class="skc-nav-primary">
                            <?php $args = array('theme_location'    => 'primary',
                                                'menu'              => 'primary'
                                                );
                            ?>
                            <?php wp_nav_menu($args); ?>
                        </div>
                    </nav>
                </div>
            </header> <!-- end header -->