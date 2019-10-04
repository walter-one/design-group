<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
    
</head>

<body <?php body_class('animsition'); ?>>

    <header>
        <div class="container">
            <div class="logo">
                <a href="<?php echo home_url('/'); ?>">
                    <?php
                        $logo = TT::get_mod('logo');
                        if( !empty($logo) ){
                            echo "<img src='$logo'>";
                        }
                        else{
                            bloginfo( 'name' );
                        }
                    ?>
                </a>
            </div>
            <div class="nav-menu-icon">
                <a href="#"><i></i></a>
            </div>
            <nav class="menu building-menu" id="main-menu">
                <?php tt_print_main_menu(); ?>
            </nav>
        </div>
    </header>

