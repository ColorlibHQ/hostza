<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <!-- For Resposive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <?php
                                    echo hostza_theme_logo( 'navbar-brand' );
                                ?>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <?php
                                    if(has_nav_menu('primary-menu')) {
                                        wp_nav_menu(array(
                                            'menu'           => 'primary-menu',
                                            'theme_location' => 'primary-menu',
                                            'menu_id'        => 'navigation',
                                            'container_class'=> false,
                                            'container_id'   => false,
                                            'menu_class'     => false,
                                            'walker'         => new hostza_bootstrap_navwalker,
                                            'depth'          => 3
                                        ));
                                    }
                                    ?>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-center">
                                <a href="#" class="login">
                                    <i class="flaticon-user"></i>
                                    <span>log in</span>
                                </a>
                                <div class="live_chat_btn">
                                    <a class="boxed_btn_green" href="#">
                                        <i class="flaticon-chat"></i>
                                        <span>Live Chat</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <?php
    //Page Title Bar
    if( function_exists( 'hostza_page_titlebar' ) ){
	    hostza_page_titlebar();
    }

