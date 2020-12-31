<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package
 */

    $url = 'https://colorlib.com/';
    $copyText = sprintf( __( 'Theme by %s colorlib %s Copyright &copy; %s  |  All rights reserved.', 'hostza' ), '<a target="_blank" href="' . esc_url( $url ) . '">', '</a>', date( 'Y' ) );
    $copyRight = !empty( hostza_opt( 'hostza_footer_copyright_text' ) ) ? hostza_opt( 'hostza_footer_copyright_text' ) : $copyText;
    $footer_class = hostza_opt( 'hostza_footer_widget_toggle' ) == 1 ? 'footer_top' : 'footer_top no_widget';

    ?>

    <!-- footer -->
    <footer class="footer">
        <?php
        if( hostza_opt( 'hostza_footer_widget_toggle' ) == 1 ) {
            ?>
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <?php 
                        // Footer widget 1
                        if( is_active_sidebar( 'footer-1' ) ){
                            echo '
                            <div class="col-xl-3 col-md-6 col-lg-3">
                                <div class="footer_widget">
                                    <div class="footer_logo">';
                                        echo hostza_theme_logo();
                                        echo '
                                    </div>
                                </div>';
                                dynamic_sidebar( 'footer-1' );
                                echo '
                            </div>';
                        }
                        
                        // Footer widget 2
                        if( is_active_sidebar( 'footer-2' ) ){
                            dynamic_sidebar( 'footer-2' );
                        }

                        // Footer widget 3
                        if( is_active_sidebar( 'footer-3' ) ){
                            dynamic_sidebar( 'footer-3' );
                        }
                        
                        // Footer widget 4
                        if( is_active_sidebar( 'footer-4' ) ){
                            dynamic_sidebar( 'footer-4' );
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="copy-right_text">
            <div class="container">
                <?php
                if( hostza_opt( 'hostza_footer_widget_toggle' ) == 1 ) {
                    ?>
                    <div class="footer_border"></div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center"><?php echo wp_kses_post( $copyRight ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer -->
    <!-- link that opens popup -->
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>