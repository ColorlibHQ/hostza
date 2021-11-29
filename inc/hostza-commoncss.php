<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
} 
/**
 * @Packge     : HOSTZA
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
 
// enqueue css
function hostza_common_custom_css(){
    
    wp_enqueue_style( 'hostza-common', get_template_directory_uri().'/assets/css/dynamic.css' );
		$header_bg         		  = esc_url( get_header_image() );
		$header_bg_img 			  = !empty( $header_bg ) ? 'background-image: url('.esc_url( $header_bg ).')' : '';

		$themeColor     		  = hostza_opt( 'hostza_theme_color' );
		$boxShadowColor    		  = hostza_opt( 'hostza_theme_box_shadow_color' );

		$buttonBorderColor     	  = hostza_opt( 'hostza_button_border_color' );
		$hoverColor     	  	  = hostza_opt( 'hostza_hover_color');

		$headerTop_bg     		  = hostza_opt( 'hostza_top_header_bg_color' );
		$headerTop_col     		  = hostza_opt( 'hostza_top_header_color' );

		$headerBg          		  = hostza_opt( 'hostza_header_bg_color');
		$menuColor          	  = hostza_opt( 'hostza_header_menu_color' );
		$menuBorderColor          = hostza_opt( 'hostza_header_menu_border_color' );
		$menuHoverColor           = hostza_opt( 'hostza_header_menu_hover_color' );
		$otherPageMenuHoverColor  = hostza_opt( 'hostza_ohter_page_header_menu_hover_color' );
		$dropMenuColor            = hostza_opt( 'hostza_header_drop_menu_color' );
		$dropMenuHovColor         = hostza_opt( 'hostza_header_drop_menu_hover_color' );
		$headerBtnColor           = hostza_opt( 'hostza_header_right_btn_color' );


		$footerwbgColor     	  = hostza_opt('hostza_footer_bg_color');
		$footerCopyBgColor     	  = hostza_opt('hostza_footer_copy_bg_color');
		$footerwTextColor   	  = hostza_opt('hostza_footer_widget_text_color');
		$widgettitlecolor  		  = hostza_opt('hostza_footer_widget_title_color');
		$footerwanchorcolor 	  = hostza_opt('hostza_footer_widget_anchor_color');
		$footerwanchorhovcolor    = hostza_opt('hostza_footer_widget_anchor_hover_color');
		
		$fofbg					  = hostza_opt('hostza_fof_bg_color');
		$foftonecolor			  = hostza_opt('hostza_fof_textone_color');
		$fofttwocolor			  = hostza_opt('hostza_fof_texttwo_color');


		$customcss ="
			.hero-banner{
				{$header_bg_img}
			}

			.header-area .main-header-area.sticky {
				background-color: {$headerBg};
			}
			
			.priceing_part .single_pricing_item .single_pricing_text:after, .artist_part .single_blog_item .social_icon a:hover, .btn_4
			{
				border-color: {$themeColor};
			}

			.cta_part .cta_part_iner .cta_part_text p, .about_part .about_text h5, .our_latest_work .single_work_demo h5, .blog_part .single-home-blog .card h5:hover, .blog_part .single-home-blog .card ul li i, .priceing_part .single_pricing_item .single_pricing_text h6, .blog_part .single_service_part .single_service_text p a:hover, .blog_part .single_service_part .single_service_text h4 a:hover
			{
				color: {$themeColor}
			}			
			.our_latest_work .single_work_demo .btn_3:hover, .team_member_section .single_team_member .single_team_text h3 a:hover, .team_member_section .single_team_member .team_member_social_icon a:hover, .blog_part .single-home-blog .card .card-body a:hover, .pre_icon a:hover, .next_icon a:hover, .review_part .section_tittle p, .banner-breadcrumb > ol > li.breadcrumb-item > a.bread-link:hover, .review_part .section_tittle p, .banner-breadcrumb .breadcrumb-item a:hover, .blog_details a:hover, .blog_area a h2:hover, .btn_4:hover{
				color: {$themeColor}!important;
			}

			.btn_3:hover, .review_part .intro_video_bg .video-play-button, .review_part .owl-prev span:after, .review_part .owl-next span:after, .review_part .intro_video_bg .video-play-button:after, .review_part .intro_video_bg .video-play-button:before, .review_part .intro_video_bg .video-play-button:hover:after, .blog_item_img .blog_item_date, .button, .single_sidebar_widget .tagcloud a:hover, .blog_right_sidebar .single_sidebar_widget.widget_hostza_newsletter .btn, .pre_icon :after, .next_icon :after, .review_part .owl-dots button.owl-dot.active, .artist_part .single_blog_item .social_icon a:hover, .regervation_part .regerv_btn_iner
			{
				background: {$themeColor};
			}

			.btn_3:hover{
				box-shadow: 0px 15px 20px 0px {$boxShadowColor};
			}

			.service_part .single_service_part:hover .single_service_part_iner span
			{
				background: {$themeColor}!important;
			}

			.btn_2:hover,
			.copyright_part .footer-social a:hover
			{
				background: {$hoverColor}!important;
			}

			.blog_part .single-home-blog .card h5:hover
			{
				color: {$hoverColor};
			}

			.about_part .about_img h2:after, .copyright_part .footer-social a
			{
				border-color: {$themeColor}
			}


			.sub_header{
				background: {$headerTop_bg}
			}
			.sub_header .sub_header_social_icon a,
			.sub_header .sub_header_social_icon .register_icon
			{
				color: {$headerTop_col}
			}

			.header-area .main-header-area .main-menu ul li a, .header-area .log_chat_area .login, .header-area .log_chat_area .login i
			{
			color: {$menuColor};
			}

			.header-area .main-header-area .main-menu ul li a::before
			{
			background: {$menuBorderColor};
			}

			@media (min-width: 1024px){
				.main_menu .main-menu-item ul li a
				{
				color: {$menuColor}!important;
				}
			}
			.header-area .main-header-area .main-menu ul li a:hover, .header-area .log_chat_area .login:hover, .header-area .log_chat_area .login:hover i
			{
			   color: {$menuHoverColor};
			}
			.main_menu .main-menu-item ul li a:hover, .single_page_menu.menu_fixed .main-menu-item ul li .nav-link:hover
			{
			   color: {$menuHoverColor}!important;
			}
			.single_page_menu .main-menu-item ul li .nav-link:hover
			{
			   color: {$otherPageMenuHoverColor}!important;
			}

			.header-area .main-header-area .main-menu ul li .submenu li a {
				color: {$dropMenuColor};
			}
			.header-area .main-header-area .main-menu ul li .submenu li a:hover {
				color: {$dropMenuHovColor};
			}
			.home_menu .main-menu-item ul.dropdown-menu li .dropdown-item.nav-link, .single_page_menu .main-menu-item ul.dropdown-menu li .dropdown-item.nav-link {
				color: {$dropMenuColor}!important;
			}

			.home_menu .main-menu-item ul.dropdown-menu li .dropdown-item.nav-link:hover, .single_page_menu .main-menu-item ul.dropdown-menu li .dropdown-item.nav-link:hover {
				color: {$dropMenuHovColor}!important;
			}

			.header-area .log_chat_area .live_chat_btn a {
				background: {$headerBtnColor};
			}

			.header-area .log_chat_area .live_chat_btn a:hover {
				background: transparent;
				border-color: {$headerBtnColor};
				color: {$headerBtnColor} !important;
			}

			footer.footer {
				background-color: {$footerwbgColor};
			}

			.footer-area .single-footer-widget p, .footer-area .widget_hostza_newsletter .input-group input, .footer-area .copyright_part_text p, .footer-area .footer_2 .social_icon a, .copyright_part p, .footer .footer_top .footer_widget .newsletter_text, .footer .copy-right_text .copy_right
			{
				color: {$footerwTextColor}
			}
			.footer-area .widget_hostza_newsletter .input-group, .footer-area .copyright_part_text {
				border-color: {$footerwTextColor}
			}
			.footer-area .single-footer-widget h4, .footer-area .single-footer-widget h5, .footer .footer_top .footer_widget .footer_title
			{
				color: {$widgettitlecolor}
			}

			.copyright_part a, .footer-area .footer_2 .contact_info span, .footer .footer_top .footer_widget ul li a, .footer .footer_top .footer_widget .social_icon a, .footer .footer_top .footer_widget p.footer_text.doanar a, .footer .copy-right_text .copy_right a
			{
			   color: {$footerwanchorcolor};
			}
			.footer-area .btn{
				background: {$footerwanchorcolor};
			}
			.copyright_part a:hover, .footer-area .footer_2 .social_icon a:hover
			{
			   color: {$footerwanchorhovcolor}!important;
			}
			.footer .footer_top .footer_widget ul li a:hover, .footer .footer_top .footer_widget .social_icon a:hover, .footer .footer_top .footer_widget p.footer_text.doanar a:hover
			{
			   color: {$footerwanchorhovcolor};
			}
			.footer .footer_top .footer_widget p.footer_text.doanar a:hover
			{
			   border-color: unset !important;
			}
			.copyright_part
			{
			   background-color: {$footerCopyBgColor};
			}

			#f0f {
				background-color: {$fofbg};
			}
			.f0f-content .h1 {
			color: {$foftonecolor};
			}
			.f0f-content p {
			color: {$fofttwocolor};
			}

        ";
       
    wp_add_inline_style( 'hostza-common', $customcss );
    
}
add_action( 'wp_enqueue_scripts', 'hostza_common_custom_css', 50 );