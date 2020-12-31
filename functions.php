<?php 
/**
 * @Packge 	   : Colorlib
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Define constant
	 *
	 */
	
	 
	// Base URI
	if( !defined( 'HOSTZA_DIR_URI' ) )
		define( 'HOSTZA_DIR_URI', get_template_directory_uri().'/' );
	
	// assets URI
	if( !defined( 'HOSTZA_DIR_ASSETS_URI' ) )
		define( 'HOSTZA_DIR_ASSETS_URI', HOSTZA_DIR_URI.'assets/' );
	
	// Css File URI
	if( !defined( 'HOSTZA_DIR_CSS_URI' ) )
		define( 'HOSTZA_DIR_CSS_URI', HOSTZA_DIR_ASSETS_URI .'css/' );
	
	// Js File URI
	if( !defined( 'HOSTZA_DIR_JS_URI' ) )
		define( 'HOSTZA_DIR_JS_URI', HOSTZA_DIR_ASSETS_URI .'js/' );
	
	// Icon Images
	if( !defined('HOSTZA_DIR_ICON_IMG_URI') )
		define( 'HOSTZA_DIR_ICON_IMG_URI', HOSTZA_DIR_ASSETS_URI.'img/icon/' );
	
	//DIR inc
	if( !defined( 'HOSTZA_DIR_INC' ) )
		define( 'HOSTZA_DIR_INC', HOSTZA_DIR_URI.'inc/' );

	// Base Directory
	if( !defined( 'HOSTZA_DIR_PATH' ) )
		define( 'HOSTZA_DIR_PATH', get_parent_theme_file_path().'/' );
	
	//Inc Folder Directory
	if( !defined( 'HOSTZA_DIR_PATH_INC' ) )
		define( 'HOSTZA_DIR_PATH_INC', HOSTZA_DIR_PATH.'inc/' );
	
	//Colorlib framework Folder Directory
	if( !defined( 'HOSTZA_DIR_PATH_LIB' ) )
		define( 'HOSTZA_DIR_PATH_LIB', HOSTZA_DIR_PATH_INC.'libraries/' );
	
	//Classes Folder Directory
	if( !defined( 'HOSTZA_DIR_PATH_CLASSES' ) )
		define( 'HOSTZA_DIR_PATH_CLASSES', HOSTZA_DIR_PATH_INC.'classes/' );	

		
	/**
	 * Include File
	 *
	 */
	
	// Breadcrumbs file include
	require_once( HOSTZA_DIR_PATH_INC . 'hostza-breadcrumbs.php' );
	// Sidebar register file include
	require_once( HOSTZA_DIR_PATH_INC . 'widgets/hostza-widgets-reg.php' );
	// Post widget file include
	// require_once( HOSTZA_DIR_PATH_INC . 'widgets/hostza-recent-post-thumb.php' );
	// News letter widget file include
	// require_once( HOSTZA_DIR_PATH_INC . 'widgets/hostza-newsletter-widget.php' );
	//Social Links
	// require_once( HOSTZA_DIR_PATH_INC . 'widgets/hostza-social-links.php' );
	// Instagram Widget
	// require_once( HOSTZA_DIR_PATH_INC . 'widgets/hostza-instagram.php' );
	// Nav walker file include
	require_once( HOSTZA_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	// Theme function file include
	require_once( HOSTZA_DIR_PATH_INC . 'hostza-functions.php' );

	// Theme Demo file include
	// require_once( HOSTZA_DIR_PATH_INC . 'demo/demo-import.php' );

	// Post Like
	require_once( HOSTZA_DIR_PATH_INC . 'post-like.php' );
	// Theme support function file include
	require_once( HOSTZA_DIR_PATH_INC . 'support-functions.php' );
	// Html helper file include
	require_once( HOSTZA_DIR_PATH_INC . 'wp-html-helper.php' );
	// Pagination file include
	require_once( HOSTZA_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	// Elementor Widgets
	// require_once( HOSTZA_DIR_PATH_ELEMENTOR_WIDGETS . 'elementor-widget.php' );
	//
	require_once( HOSTZA_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	
	require_once( HOSTZA_DIR_PATH_CLASSES . 'Class-Config.php' );
	// Customizer
	require_once( HOSTZA_DIR_PATH_INC . 'customizer/customizer.php' );
	// Class autoloader
	require_once( HOSTZA_DIR_PATH_INC . 'class-epsilon-dashboard-autoloader.php' );
	// Class hostza dashboard
	require_once( HOSTZA_DIR_PATH_INC . 'class-epsilon-init-dashboard.php' );
	// Common css
	require_once( HOSTZA_DIR_PATH_INC . 'hostza-commoncss.php' );
	

	// Admin Enqueue Script
	function hostza_admin_script(){
		wp_enqueue_style( 'hostza-admin', get_template_directory_uri().'/assets/css/hostza_admin.css', false, '1.0.0' );
		wp_enqueue_script( 'hostza_admin', get_template_directory_uri().'/assets/js/hostza_admin.js', false, '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'hostza_admin_script' );

	 
	// WooCommerce style desable
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );


	/**
	 * Instantiate Hostza object
	 *
	 * Inside this object:
	 * Enqueue scripts, Google font, Theme support features, Hostza Dashboard .
	 *
	 */
	
	$Hostza = new Hostza();
	
