<?php 
/**
 * @Packge     : Hostza
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

/*=========================================================
	Theme option callback
=========================================================*/
function hostza_opt( $id = null, $default = '' ) {
	
	$opt = get_theme_mod( $id, $default );
	
	$data = '';
	
	if( $opt ) {
		$data = $opt;
	}
	
	return $data;
}


/*=========================================================
	Body support function
=========================================================*/
if ( ! function_exists( 'wp_body_open' ) ) {
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support WordPress versions prior to 5.2.0.
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action( 'wp_body_open' );
    }
}


/*=========================================================
	Custom meta id callback
=========================================================*/
function hostza_meta( $id = '' ){
    
    $value = get_post_meta( get_the_ID(), '_hostza_'.$id, true );
    
    return $value;
}


/*=========================================================
	Blog Date Permalink
=========================================================*/
function hostza_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}



/*========================================================
	Blog Excerpt Length
========================================================*/
if ( ! function_exists( 'hostza_excerpt_length' ) ) {
	function hostza_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
        
        
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;

	}
}


/*==========================================================
	Comment number and Link
==========================================================*/
if ( ! function_exists( 'hostza_posted_comments' ) ) {
    function hostza_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','hostza');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','hostza');
            } else {
                $comments = esc_html__( '1 Comment','hostza' );
            }
            $comments = '<i class="ti-comments"></i>'. $comments;
        } else {
            $comments = esc_html__( 'Comments are closed', 'hostza' );
        }
        
        return $comments;
    }
}


/*===================================================
	Post embedded media
===================================================*/
function hostza_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
}


/*===================================================
	WP post link pages
====================================================*/
function hostza_link_pages(){
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'hostza' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'hostza' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


/*====================================================
	Theme logo
====================================================*/
function hostza_theme_logo( $class = '' ) {

    $siteUrl   = home_url('/');
    $siteTitle = get_bloginfo( 'name' );
    // site logo
		
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$imageUrl = wp_get_attachment_image_src( $custom_logo_id , 'hostza_logo_126x35' );
	
	if( !empty( $imageUrl[0] ) ){
		$siteLogo = '<a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( $imageUrl[0] ).'" alt="hostza logo"></a>';
	}else{
		$siteLogo = '<a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'"><img src="'. HOSTZA_DIR_ASSETS_URI .'img/logo.png" alt="'.esc_attr( $siteTitle ).'"></a>';
	}
	
	return wp_kses_post( $siteLogo );
	
}


/*================================================
    Page Title Bar
================================================*/
function hostza_page_titlebar() {
	if ( ! is_page_template( 'template-builder.php' ) ) {
		?>
        <section class="hero-banner">
            <div class="container">
				<h2>
				<?php
				if ( is_category() ) {
					single_cat_title( __('Category: ', 'hostza') );

				} elseif ( is_tag() ) {
					single_tag_title( 'Tag Archive for - ' );

				} elseif ( is_archive() ) {
					echo get_the_archive_title();

				} elseif ( is_page() ) {
					echo get_the_title();

				} elseif ( is_search() ) {
					echo esc_html__( 'Search for: ', 'hostza' ) . get_search_query();

				} elseif ( ! ( is_404() ) && ( is_single() ) || ( is_page() ) ) {
					echo  get_the_title();

				} elseif ( is_home() ) {
					echo esc_html__( 'Blog', 'hostza' );

				} elseif ( is_404() ) {
					echo esc_html__( '404 error', 'hostza' );

				}
				?>
				</h2>
            </div>
        </section>
		<?php
	}
}



/*================================================
	Blog pull right class callback
=================================================*/
function hostza_pull_right( $id = '', $condation ){
    
    if( $id == $condation ){
        return ' '.'order-last';
    }else{
        return;
    }
    
}



/*======================================================
	Inline Background
======================================================*/
function hostza_inline_bg_img( $bgUrl ){
    $bg = '';

    if( $bgUrl ){
        $bg = 'style="background-image:url('.esc_url( $bgUrl ).')"'; 
    }

    return $bg;
}


/*======================================================
	Blog Category
======================================================*/
function hostza_featured_post_cat(){

	$categories = get_the_category(); 
	
	if( is_array( $categories ) && count( $categories ) > 0 ){
		$getCat = [];
		foreach ( $categories as $value ) {

			if( $value->slug != 'featured' ){
				$getCat[] = '<a href="'.esc_url( get_category_link( $value->term_id ) ).'">'.esc_html( $value->name ).'</a>';
			}   
		}

		return implode( ', ', $getCat );
	}
         
}


/*=======================================================
	Customize Sidebar Option Value Return
========================================================*/
function hostza_sidebar_opt(){

    $sidebarOpt = hostza_opt( 'hostza_blog_layout' );
    $sidebar = '1';
    // Blog Sidebar layout  opt
    if( is_array( $sidebarOpt ) ){
        $sidebarOpt =  $sidebarOpt;
    }else{
        $sidebarOpt =  json_decode( $sidebarOpt, true );
    }
    
    
    if( !empty( $sidebarOpt['columnsCount'] ) ){
        $sidebar = $sidebarOpt['columnsCount'];
    }


    return $sidebar;
}


/**================================================
	Themify Icon
 =================================================*/
function hostza_themify_icon(){
    return[
        'flaticon-servers'    => __('Server Icon', 'hostza'),
        'flaticon-hosting'    => __('Hosting Icon', 'hostza'),
        'flaticon-wordpress'  => __('Wordpress Icon', 'hostza'),
        'flaticon-servers-1'  => __('Server 1 Icon', 'hostza'),
        'flaticon-browser'	  => __('Browser Icon', 'hostza'),
        'flaticon-security'	  => __('Security Icon', 'hostza'),
        'flaticon-like'	  	  => __('Like Icon', 'hostza'),
        'flaticon-lock'	  	  => __('Lock Icon', 'hostza'),
    ];
}


/*===========================================================
	Set contact form 7 default form template
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

/*===========================================================
	Set contact form 7 default form template
============================================================*/
function hostza_contact7_form_content( $template, $prop ) {
    
    if ( 'form' == $prop ) {

        $template =
            '<div class="row"><div class="col-12"><div class="form-group">[textarea* your-message id:message class:form-control class:w-100 rows:9 cols:30 placeholder "Message"]</div></div><div class="col-sm-6"><div class="form-group">[text* your-name id:name class:form-control placeholder "Enter your  name"]</div></div><div class="col-sm-6"><div class="form-group">[email* your-email id:email class:form-control placeholder "Enter your email"]</div></div><div class="col-12"><div class="form-group">[text your-subject id:subject class:form-control placeholder "Subject"]</div></div></div><div class="form-group mt-3">[submit class:button class:button-contactForm "Send Message"]</div>';

        return $template;

    } else {
    return $template;
    } 
}
add_filter( 'wpcf7_default_template', 'hostza_contact7_form_content', 10, 2 );



/*============================================================
	Pagination
=============================================================*/
function hostza_blog_pagination(){
	echo '<nav class="blog-pagination justify-content-center d-flex">';
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => __( '<span class="ti-angle-left"></span>', 'hostza' ),
                'next_text' => __( '<span class="ti-angle-right"></span>', 'hostza' ),
                'screen_reader_text' => ' '
            )
        );
	echo '</nav>';
}


/*=============================================================
	Portfolio Single Post Navigation
=============================================================*/
if( ! function_exists('hostza_portfolio_single_post_navigation') ) {
	function hostza_portfolio_single_post_navigation() {
		$slim_left_icon = HOSTZA_DIR_ICON_IMG_URI . 'slim-left.svg';
		$slim_right_icon = HOSTZA_DIR_ICON_IMG_URI . 'slim-right.svg';
		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ) {
			
			if( get_next_post_link() ){
				$nextPost = get_next_post();
				?>
				<div class="pre_icon float-left">
					<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>"><img src="<?php echo esc_url( $slim_left_icon )?>" alt="slim left icon"> <?php echo esc_html__( 'previous', 'hostza' ); ?></a> 
				</div>
				<?php
			}
			
			if( get_previous_post_link() ){
				$prevPost = get_previous_post();
				?>
				<div class="next_icon float-right">
					<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>"> <?php echo esc_html__( 'next', 'hostza' ); ?> <img src="<?php echo esc_url( $slim_right_icon )?>" alt="slim right icon"> </a> 
				</div>
				<?php
			}
		}

	}
}


/*=============================================================
	Blog Single Post Navigation
=============================================================*/
if( ! function_exists('hostza_blog_single_post_navigation') ) {
	function hostza_blog_single_post_navigation() {

		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ):
			?>
			<div class="navigation-area">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
						<?php
						if( get_next_post_link() ){
							$nextPost = get_next_post();

							if( has_post_thumbnail() ){
								?>
								<div class="thumb">
									<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
										<?php echo get_the_post_thumbnail( absint( $nextPost->ID ), 'hostza_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
									</a>
								</div>
								<?php
							} ?>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<span class="ti-arrow-left text-white"></span>
								</a>
							</div>
							<div class="detials">
								<p><?php echo esc_html__( 'Prev Post', 'hostza' ); ?></p>
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $nextPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<?php
						} ?>
					</div>
					<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
						<?php
						if( get_previous_post_link() ){
							$prevPost = get_previous_post();
							?>
							<div class="detials">
								<p><?php echo esc_html__( 'Next Post', 'hostza' ); ?></p>
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $prevPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<span class="ti-arrow-right text-white"></span>
								</a>
							</div>
							<div class="thumb">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<?php echo get_the_post_thumbnail( absint( $prevPost->ID ), 'hostza_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
								</a>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
		<?php
		endif;

	}
}


/*=======================================================
	Author Bio
=======================================================*/
function hostza_author_bio(){
	$avatar = get_avatar( absint( get_the_author_meta( 'ID' ) ), 90 );
	?>
	<div class="blog-author">
		<div class="media align-items-center">
			<?php
			if( $avatar  ) {
				echo wp_kses_post( $avatar );
			}
			?>
			<div class="media-body">
				<a href="<?php echo esc_url( get_author_posts_url( absint( get_the_author_meta( 'ID' ) ) ) ); ?>"><h4><?php echo esc_html( get_the_author() ); ?></h4></a>
				<p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
			</div>
		</div>
	</div>
	<?php
}


/*===================================================
 Hostza Comment Template Callback
 ====================================================*/
function hostza_comment_callback( $comment, $args, $depth ) {

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo esc_attr( $tag ); ?> <?php comment_class( ( empty( $args['has_children'] ) ? '' : 'parent').' comment-list' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-list">
	<?php endif; ?>
		<div class="single-comment">
			<div class="user d-flex">
				<div class="thumb">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<div class="desc">
					<div class="comment">
						<?php comment_text(); ?>
					</div>

					<div class="d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<h5 class="comment_author"><?php printf( __( '<span class="comment-author-name">%s</span> ', 'hostza' ), get_comment_author_link() ); ?></h5>
							<p class="date"><?php printf( __('%1$s at %2$s', 'hostza'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)', 'hostza' ), '  ', '' ); ?> </p>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'hostza' ); ?></em>
								<br>
							<?php endif; ?>
						</div>

						<div class="reply-btn">
							<?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => 'Reply' ) ) ); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php
}
// add class comment reply link
add_filter('comment_reply_link', 'hostza_replace_reply_link_class');
function hostza_replace_reply_link_class( $class ) {
	$class = str_replace("class='comment-reply-link", "class='btn-reply comment-reply-link text-uppercase", $class);
	return $class;
}



/*=========================================================
    Latest Blog Post For Elementor Section
===========================================================*/
function hostza_latest_blog( $pNumber = 3, $excerpt_limit = 5, $post_order = 'DESC' ){
	
	$lBlog = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => $pNumber,
		'order'			 => $post_order
    ) );

    if( $lBlog->have_posts() ){
        while( $lBlog->have_posts() ){
			$lBlog->the_post();
			?>
			<div class="col-xl-4 col-md-6 col-lg-4">
				<div class="single_news">
					<div class="thumb">
						<a href="<?php the_permalink(); ?>">
							<?php
								if( has_post_thumbnail() ){
									the_post_thumbnail( 'hostza_home_blog_thumb_362x240', ['alt' => get_the_title() ] );
								}
							?>
						</a>
					</div>
					<div class="news_content">
						<div class="news_meta">
							<?php the_time('j M, Y') ?> in <?php echo hostza_featured_post_cat(); ?> 
						</div>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="news_info"><?php echo hostza_excerpt_length( $excerpt_limit ) ?></p>
					</div>
				</div>
			</div>
        <?php
        }

    }

}



/*=========================================================
    Share Button Code
===========================================================*/
function hostza_social_sharing_buttons( $ulClass = '', $tagLine = '' ) {

	// Get page URL
	$URL = get_permalink();
	$Sitetitle = get_bloginfo('name');

	// Get page title
	$Title = str_replace( ' ', '%20', get_the_title());

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
	$facebookURL= 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
	$linkedin   = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
	$pinterest  = 'http://pinterest.com/pin/create/button/?url='.esc_url( $URL ).'&description='.esc_html( $Title );;

	// Add sharing button at the end of page/page content
	$content = '';
	$content  .= '<ul class="'.esc_attr( $ulClass ).'">';
	$content .= $tagLine;
	$content .= '<li><a href="' . esc_url( $facebookURL ) . '" target="_blank"><i class="ti-facebook"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $twitterURL ) . '" target="_blank"><i class="ti-twitter-alt"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="ti-pinterest"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="ti-linkedin"></i></a></li>';
	$content .= '</ul>';

	return $content;

}



/*================================================
	Projects Return data 
================================================ */
function return_tab_data( $getTags, $menu_tabs ) {
	$y = [];
	foreach ( $getTags as $val ) {

		$t = [];

		foreach( $menu_tabs as $data ) {
			if( $data['label'] == $val ) {
				$t[] = $data;
			}
		}

		$y[$val] = $t;

	}

	return $y;
}

/*==========================================================
 *  Flaticon Icon List
=========================================================*/
function hostza_flaticon_list(){
    return(
        array(
            'flaticon-growth'     => 'Flaticon Growth',
            'flaticon-wallet'     => 'Flaticon Wallet',
        )
    );
}


// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );
