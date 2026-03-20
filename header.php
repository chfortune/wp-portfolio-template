<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header class="site-header">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <?php 
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
                    }
                    ?>
                </div>
                
                <?php 
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'navbar-menu',
                    'fallback_cb'    => 'wp_page_menu',
                ) );
                ?>
            </div>
        </nav>
    </header>