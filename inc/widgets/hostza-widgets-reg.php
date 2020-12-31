<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

/**
 * @Packge     : Hostza
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
 
function hostza_widgets_init() {
    // sidebar widgets 
    
    register_sidebar(array(
        'name'          => esc_html__('Sidebar widgets', 'hostza'),
        'description'   => esc_html__('Place widgets in sidebar widgets area.', 'hostza'),
        'id'            => 'sidebar_widgets',
        'before_widget' => '<div id="%1$s" class="widget single_sidebar_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget_title">',
        'after_title'   => '</h4>'
    ));

	// footer widgets register
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer One', 'hostza' ),
			'id'            => 'footer-1',
			'before_widget' => '<div id="%1$s" class="footer_widget footer_1 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Two', 'hostza' ),
			'id'            => 'footer-2',
			'before_widget' => '<div class="col-xl-3 col-md-6 col-lg-3"><div id="%1$s" class="footer_widget footer_2 %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="footer_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Three', 'hostza' ),
			'id'            => 'footer-3',
			'before_widget' => '<div class="col-xl-2 col-md-6 col-lg-2"><div id="%1$s" class="footer_widget footer_3 %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="footer_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Four', 'hostza' ),
			'id'            => 'footer-4',
			'before_widget' => '<div class="col-xl-4 col-md-6 col-lg-4"><div id="%1$s" class="footer_widget footer_4 %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="footer_title">',
			'after_title'   => '</h3>',
		)
	);
	

}
add_action( 'widgets_init', 'hostza_widgets_init' );
