<?php

/**
 * Theme Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
ob_start();
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1170;
	
/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */

function medix_setup() {

	// load language.
	load_theme_textdomain( 'medix' , get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support('woocommerce');
    
    add_theme_support( 'wc-product-gallery-lightbox' );
	
	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote','status','link') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'medix' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array('default-color' => 'e6e6e6',) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	  
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
    
    update_option( 'thumbnail_size_w', 440); 	
    update_option( 'thumbnail_size_h', 440 ); 
    update_option( 'thumbnail_crop', 1);
    update_option( 'medium_size_w', 570);		
    update_option( 'medium_size_h', 337);	
    update_option( 'medium_crop', 1);	
	update_option( 'large_size_w', 1170);  		
    update_option( 'large_size_h', 780);
    update_option( 'large_crop', 1);
     
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'medix_setup' );


/* make shop image size*/
add_action('init', 'medix_change_default_woo_thumb_size');
function medix_change_default_woo_thumb_size(){
 register_activation_hook('woocommerce/woocommerce.php', 'medix_woocommerce_image_dimensions');
}
function medix_woocommerce_image_dimensions() {
    global $pagenow;
    $catalog = array(
        'width'     => '525',   // px
        'height'    => '600',   // px
        'crop'      => 1        // true
    );
    $single = array(
        'width'     => '600',   // px 
        'height'    => '600',   // px
        'crop'      => 1        // true
    );
    $thumbnail = array(
        'width'     => '400',   // px
        'height'    => '400',   // px
        'crop'      => 1        // true
    );
  
    update_option( 'shop_catalog_image_size', $catalog );       
    update_option( 'shop_single_image_size', $single );         
    update_option( 'shop_thumbnail_image_size', $thumbnail );   
}
 
/**
 * support shortcodes
 * @return array
 */
function medix_shortcodes(){
	return array(
		'cms_fancybox_single',
		'cms_counter_single',
		'cms_progressbar',
	);
}

/**
 * Add new elements for VC
 * 
 * @author FOX
 */
add_action('vc_before_init', 'medix_vc_before');

function medix_vc_before(){
    
    require( get_template_directory() . '/vc_params/vc_custom.php' );
    if(!class_exists('CmsShortCode'))
        return ;
    
    require( get_template_directory() . '/inc/elements/cms_testimonial_carousel.php' );
    require( get_template_directory() . '/inc/elements/cms_testimonial_single.php' );
    require( get_template_directory() . '/inc/elements/testimonial_carousel.php' );
    require( get_template_directory() . '/inc/elements/cms_individual_socials.php' );
    require( get_template_directory() . '/inc/elements/cms_button.php' );
    require( get_template_directory() . '/inc/elements/cms_teaser.php' );
    require( get_template_directory() . '/inc/elements/cms_pie_chars.php' );
    require( get_template_directory() . '/inc/elements/cms_pricing.php' );
    require( get_template_directory() . '/inc/elements/cms_message_box.php' );
    require( get_template_directory() . '/inc/elements/cms_team.php' );
    require( get_template_directory() . '/inc/elements/cms_accordion.php' );
    require( get_template_directory() . '/inc/elements/cms_title_header.php' );
    require( get_template_directory() . '/inc/elements/cms_grid_services.php' );
    require( get_template_directory() . '/inc/elements/cms_events.php' );
    require( get_template_directory() . '/inc/elements/cms_countdown.php' );
    require( get_template_directory() . '/inc/elements/cms_contact_block.php' );
    require( get_template_directory() . '/inc/elements/cms_opening_hours.php' );
    require( get_template_directory() . '/inc/elements/cms_department.php' );
    require( get_template_directory() . '/inc/elements/cms_department2.php' );
    require( get_template_directory() . '/inc/elements/cms_gallery_carousel.php' );
    require( get_template_directory() . '/inc/elements/cms_youtube.php' );
    require( get_template_directory() . '/inc/elements/cms_client_carousel.php' );
    require( get_template_directory() . '/inc/elements/flex-booking.php' );
    require( get_template_directory() . '/inc/elements/cms_carousel.php' );
    require( get_template_directory() . '/inc/elements/cms_grid.php' );
    require( get_template_directory() . '/inc/elements/zo_masonry.php' );
    require( get_template_directory() . '/inc/elements/cms_googlemap.php' );
    require( get_template_directory() . '/inc/elements/cms_socials.php' );
 
    require( get_template_directory() . '/inc/elements/cms_schedule_calendar.php' );
    add_filter('cms-shorcode-list', 'medix_shortcodes');
     
}

/**
 * Custom params & remove VC Elements.
 * 
 * @author FOX
 */
add_action('vc_after_init', 'medix_vc_after');

function medix_vc_after() {

    require( get_template_directory() . '/vc_params/vc_column_text.php' ); 
    require( get_template_directory() . '/vc_params/vc_custom_heading.php' ); 
    require( get_template_directory() . '/vc_params/vc_column.php' );
    require( get_template_directory() . '/vc_params/vc_row.php' );    

    vc_add_shortcode_param( 'cms_time', 'medix_time_settings_field', get_template_directory_uri() . '/assets/js/jquery.datetimepicker.js' );
}
function medix_time_settings_field($settings, $value) {
    return '<div class="date-field cms_datetime_block" data-type="datetime" data-format="m/d/Y H:i">'
        	.'<input type="text" name="'.esc_attr( $settings['param_name']).'" class="wpb_vc_param_value wpb-textinput" value="'.esc_attr( $value ).'"/>'
        .'</div>';
}

/* Add widgets */
require( get_template_directory() . '/inc/widgets/recent_post_v2.php' );
require( get_template_directory() . '/inc/widgets/sidebar_recent_posts.php' );
require( get_template_directory() . '/inc/widgets/medix_widget_post.php' );
require( get_template_directory() . '/inc/widgets/medix_widget_recent_comment.php' );
require( get_template_directory() . '/inc/widgets/widget_text.php' );
require( get_template_directory() . '/inc/widgets/news_tabs.php' );
require( get_template_directory() . '/inc/widgets/social_media.php' );
require( get_template_directory() . '/inc/widgets/list_services.php' );
require( get_template_directory() . '/inc/widgets/gallery_post.php' );

/* Custom News Twitter template */
add_filter('znews_twitter/widget/template', 'medix_news_twitter');
function medix_news_twitter(){
	return get_template_directory() . '/inc/widgets/feed.php';
}
/**
 * add google font
 */
 
function medix_roboto() {
    $fonts_url = '';
    $roboto = _x( 'on', 'Roboto font: on or off', 'medix' );
    if ( 'off' !== $roboto ) {
        $query_args = array(
        'family' =>  'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i', 
        'subset' => urlencode( 'latin,latin-ext' )
        );
    }  
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    return esc_url_raw( $fonts_url );
}
function medix_rochester() {
    $fonts_url = '';
    $rochester = _x( 'on', 'Rochester font: on or off', 'medix' );
    if ( 'off' !== $rochester ) {
        $query_args = array(
        'family' =>  'Rochester', 
        'subset' => urlencode( 'latin,latin-ext' )
        );
    }  
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function medix_front_end_scripts() {
    
	global $wp_styles, $opt_theme_options, $opt_meta_options;
 
    /* Add Google font */
     
    wp_enqueue_style( 'medix-roboto-font', medix_roboto(), array(), null );
    wp_enqueue_style( 'medix-rochester-font', medix_rochester(), array(), null );
     
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2');
	
    /* Register isotope */
    wp_enqueue_script('bootstrap-select',get_template_directory_uri().'/assets/js/bootstrap-select.js',array('bootstrap'),'1.0');
     
    /* Adds JavaScript Bootstrap. */
	wp_enqueue_script('wow-effect', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.0.1', true);
    
    /* Adds magnific popup. */
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', true);
    
    /* Register isotope */
    wp_enqueue_script('isotope',get_template_directory_uri().'/assets/js/isotope.js',array('jquery'),'1.5.25',true);
    
	/* Add main.js */
	wp_enqueue_script('medix-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
	
	/* Add menu.js */
	wp_enqueue_script('medix-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);
    
	/* Comment */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/** ----------------------------------------------------------------------------------- */
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    
    wp_enqueue_style('bootstrap-select-css', get_template_directory_uri() . '/assets/css/bootstrap-select.css');
	 
    /* Loads Animation. */
	wp_enqueue_style('animation', get_template_directory_uri() . '/assets/css/animations.css');
    
    /* Load magnific popup css*/
    wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.1');
    
	/* Loads font awesome. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
    
    /* Loads Stroke gap font */
	wp_enqueue_style('font-stroke-7-icon', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css');
     
    /* Loads Stroke gap font */
	wp_enqueue_style('socicon', get_template_directory_uri() . '/assets/css/socicon.css');	
    
    /* Loads Stroke gap font */
	wp_enqueue_style('rt-icon', get_template_directory_uri() . '/assets/css/rt-icon.css');	
      
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'medix-style', get_stylesheet_uri());

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'medix-ie', get_template_directory_uri() . '/assets/css/ie.css');
	
	/* ie */
	$wp_styles->add_data( 'medix-ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('medix-static', get_template_directory_uri() . '/assets/css/static.css');
      
}

add_action( 'wp_enqueue_scripts', 'medix_front_end_scripts' );

/**
 * load admin scripts.
 * 
 * @author FOX
 */
function medix_admin_scripts(){

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
    wp_enqueue_style('font-glyphicons', get_template_directory_uri() . '/assets/css/glyphicons.css', array(), '3.0.0'); 
    wp_enqueue_style('font-rt-icon2', get_template_directory_uri() . '/assets/css/rt-icon.css', array(), '1.0.0'); 
    wp_enqueue_style('medix-admin-css', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0');
    
	$screen = get_current_screen();

	/* load js for edit post. */
	if($screen->post_type == 'post'){
		/* post format select. */
		wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
	}
    wp_register_style('jquery-datetimepicker', get_template_directory_uri().'/assets/css/jquery.datetimepicker.css');
    wp_enqueue_style('jquery-datetimepicker');
    wp_enqueue_script('medix-time', get_template_directory_uri() . '/assets/js/datetime-element.js');
}

add_action( 'admin_enqueue_scripts', 'medix_admin_scripts' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function medix_widgets_init() {

	global $opt_theme_options;

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'medix' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    register_sidebar( array(
		'name' => esc_html__( 'Second Sidebar', 'medix' ),
		'id' => 'sidebar-second',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    
    register_sidebar( array(
		'name' => esc_html__( 'Newsletter sidebar', 'medix' ),
		'id' => 'newsletter',
		'description' => esc_html__( 'Appears on page builder', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s newsletter-sdb">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    
    register_sidebar( array(
		'name' => esc_html__( 'Header top left Side', 'medix' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'Appears on the top left of header', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    register_sidebar( array(
		'name' => esc_html__( 'Header top right Side', 'medix' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'Appears on the top right of header', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    register_sidebar( array(
		'name' => esc_html__( 'Services Sidebar', 'medix' ),
		'id' => 'sidebar-services',
		'description' => esc_html__( 'Appears on services single sidebar', 'medix' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Sidebar', 'medix'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Appears in WooCommerce Archive page', 'medix'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title"><span>',
            'after_title'   => '</span></h4>',
        ));
    } 
    /* footer top sidebar */
    if(!empty($opt_theme_options['footer-top-column-layout1'])) {
		for($i = 1 ; $i <= $opt_theme_options['footer-top-column-layout1'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top Layout 1 - col %s', 'medix'), $i),
				'id' => 'sidebar-footer-top-layout1-col' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}
    if(!empty($opt_theme_options['footer-top-column-layout2'])) {
		for($i = 1 ; $i <= $opt_theme_options['footer-top-column-layout2'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top Layout 2 - col %s', 'medix'), $i),
				'id' => 'sidebar-footer-top-layout2-col' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}
    if(!empty($opt_theme_options['footer-top-column-layout3'])) {
		for($i = 1 ; $i <= $opt_theme_options['footer-top-column-layout3'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top Layout 3 - col %s', 'medix'), $i),
				'id' => 'sidebar-footer-top-layout3-col' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}
     
    /* footer bottom sidebar*/ 
    register_sidebar(array(
		'name' => esc_html__('Footer Bottom Sidebar', 'medix'),
		'id' => 'sidebar-footer-bottom-sidebar',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	));

    register_sidebar(array(
		'name' => esc_html__('Footer Bottom layout 3 right', 'medix'),
		'id' => 'sidebar-footer-bottom-layout-3-right',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	));

    register_sidebar(array(
		'name' => esc_html__('Footer Bottom layout 4 right', 'medix'),
		'id' => 'sidebar-footer-bottom-layout-4-right',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'medix'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	));
        
    
}

add_action( 'widgets_init', 'medix_widgets_init' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function medix_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'medix' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'medix' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'medix' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function medix_paging_nav() {
    // Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix text-center">
			<div class="pagination loop-pagination">
				<?php echo wp_kses_post($links); ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function medix_post_nav() {
    global $post,$opt_theme_options;
     
    if(!isset($opt_theme_options['single_post_nav']) ||  ( isset($opt_theme_options['single_post_nav']) && !$opt_theme_options['single_post_nav']))
        return;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="row nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): 
            $thumbnail_bg = get_the_post_thumbnail_url($prev_post->ID, 'thumbnail');
            $style='';
            if ( $thumbnail_bg ) {
                $style = 'style="background-image:url('.$thumbnail_bg.'); background-size: cover;"';
            }
            ?>
            <div class="col-sm-6">
                <div class="post-nav-wrap text-center" <?php echo $style;?>>
                <a class="post-prev left" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_html__('Previous','medix'); ?></a>
                <h3><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_title($prev_post->ID);?></a></h3>
                </div>  
            </div>
			<?php endif; ?>
            
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { 
    			$thumbnail_bg = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
                $style='';
                if ( $thumbnail_bg ) {
                    $style = 'style="background-image:url('.$thumbnail_bg.'); background-size: cover;"';
                }
                 ?>
                <div class="col-sm-6">
                    <div class="post-nav-wrap text-center" <?php echo $style;?>>
    			     <a class="post-next right" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo esc_html__('Next','medix'); ?></a>
                     <h3><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title($next_post->ID);?></a></h3>
                    </div>  
                </div>  
			<?php } ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
 
function medix_post_gallery_nav() {
    global $post;
     
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
     
	<div class="items-nav display_table_md with_shadow greylinks">
		<div class="nav-links clearfix">
            <?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): 
            $thumbnail_bg = get_the_post_thumbnail_url($prev_post->ID, 'thumbnail');
            ?>
             
            <div class="media display_table_cell_md prev-item">
    			<div class="media-left media-middle">
    				<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
    					<i class="fa fa-angle-left position-absolute"></i>
    					<img src="<?php echo esc_url($thumbnail_bg);?>" alt=""/>
    				</a>
    			</div>
    			<div class="media-body media-middle">
    				<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_html__('Previous Item','medix'); ?></a>
    				<h4 class="entry-title">
    					<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_title($prev_post->ID);?></a>
    				</h4>
    			</div>
    		</div>
			<?php endif; ?>
			 
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { 
    			$thumbnail_bg = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
            ?>
                <div class="media display_table_cell_md next-item text-right">
        			<div class="media-body media-middle">
        				<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_html__('Next Item','medix'); ?></a>
        				<h4 class="entry-title">
        					<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title($next_post->ID);?></a> 
        				</h4>
        			</div>
        			<div class="media-right media-middle">
        				<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next">
        					<img src="<?php echo esc_url($thumbnail_bg);?>" alt=""/>
                            <i class="fa fa-angle-right position-absolute"></i>
        				</a>
        			</div>
        		</div>
			<?php } ?>

		</div> 
	</div>
     
	<?php
}

/* Add Custom Comment */
function medix_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
    <?php endif; ?>
    <div class="comment-author-image vcard">
    	<?php echo get_avatar( $comment, 75 ); ?>
    </div>
    
    <div class="comment-main">
    
        <div class="comment-meta commentmetadata">
            <?php
    		echo '<h4 class="comment-author">'. get_comment_author_link() .'</h4>';
             
            echo '<span class="comment-date">';
                $comment_date = get_comment_date('d M, Y',get_comment_ID()); 
        	    echo esc_html__('Posted','medix').' '.esc_attr($comment_date);  
        	echo '</span>';
            ?>
            <div class="comment-reply">
    		  <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    		</div>	
    	</div>
        
    	<div class="comment-content">
            <?php comment_text(); ?>
    	</div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
        	<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'medix'); ?></em>
        <?php endif; ?>
    </div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

if ( ! function_exists( 'medix_user_social_filter' ) ) :
/**
 * New contact methods for author - Social profiles
 */
function medix_user_social_filter( $methods, $user )
{
    $roles = array();

    if ( is_object( $user ) && property_exists( $user, 'roles' ) )
    {
        $roles = (array) $user->roles;
    }

    if ( in_array( 'medix_role_employer', $roles ) || in_array( 'medix_role_candidate', $roles ) || in_array( 'subscriber', $roles ) )
    {
        return $methods;
    }

    $methods['user_facebook'] = esc_html( 'Facebook' );
    $methods['user_twitter'] = esc_html( 'Twitter' );
    $methods['user_linkedin'] = esc_html( 'Linkedin' );
    $methods['user_pinterest'] = esc_html( 'Pinterest' );
    $methods['user_instagram'] = esc_html( 'Instagram' );
    $methods['user_google'] = esc_html( 'Google' );
    $methods['user_dribbble'] = esc_html( 'Dribbble' );
    $methods['user_flickr'] = esc_html( 'Flickr' );
    $methods['user_behance'] = esc_html( 'Behance' );
    $methods['user_tumblr'] = esc_html( 'Tumblr' );
    $methods['user_youtube'] = esc_html( 'Youtube' );
    $methods['user_vimeo'] = esc_html( 'Vimeo' );
    $methods['user_soundcloud'] = esc_html( 'Soundcloud' );
    $methods['user_reddit'] = esc_html( 'Reddit' );
    $methods['user_yahoo'] = esc_html( 'Yahoo' );
    $methods['user_github'] = esc_html( 'Github' );
    $methods['user_rss'] = esc_html( 'Rss' );
      
    return $methods;
}
endif;
add_filter( 'user_contactmethods', 'medix_user_social_filter', 10, 2 );

/**
 * Display user profile
 */
function medix_post_user_profile(){
     
    $desc = get_the_author_meta('description');
    if(!empty($desc)){
        $user_socials = array();
        $facebook_link = get_user_meta( get_the_author_meta('ID'), 'user_facebook', true );
        $twitter_link = get_user_meta( get_the_author_meta('ID'), 'user_twitter', true );
        $linkedin_link = get_user_meta( get_the_author_meta('ID'), 'user_linkedin', true );
        $pinterest_link = get_user_meta( get_the_author_meta('ID'), 'user_pinterest', true );
        $instagram_link = get_user_meta( get_the_author_meta('ID'), 'user_instagram', true );
        $google_link = get_user_meta( get_the_author_meta('ID'), 'user_google', true );
        $dribble_link = get_user_meta( get_the_author_meta('ID'), 'user_dribbble', true );
        $flickr_link = get_user_meta( get_the_author_meta('ID'), 'user_flickr', true );
        $behance_link = get_user_meta( get_the_author_meta('ID'), 'user_behance', true );
        $tumblr_link = get_user_meta( get_the_author_meta('ID'), 'user_tumblr', true );
        $youtube_link = get_user_meta( get_the_author_meta('ID'), 'user_youtube', true );
        $vimeo_link = get_user_meta( get_the_author_meta('ID'), 'user_vimeo', true );
        $soundcloud_link = get_user_meta( get_the_author_meta('ID'), 'user_soundcloud', true );
        $reddit_link = get_user_meta( get_the_author_meta('ID'), 'user_reddit', true );
        $yahoo_link = get_user_meta( get_the_author_meta('ID'), 'user_yahoo', true );
        $github_link = get_user_meta( get_the_author_meta('ID'), 'user_github', true );
        $rss_link = get_user_meta( get_the_author_meta('ID'), 'user_rss', true );
         
        if(!empty($facebook_link))      $user_socials['soc-facebook']    = $facebook_link;
        if(!empty($twitter_link))       $user_socials['soc-twitter']     = $twitter_link;
        if(!empty($linkedin_link))      $user_socials['soc-linkedin']    = $linkedin_link;
        if(!empty($pinterest_link))     $user_socials['soc-pinterest']   = $pinterest_link;
        if(!empty($instagram_link))     $user_socials['soc-instagram']   = $instagram_link;
        if(!empty($google_link))        $user_socials['soc-google']      = $google_link;
        if(!empty($dribble_link))       $user_socials['soc-dribbble']     = $dribble_link;
        if(!empty($flickr_link))        $user_socials['soc-flickr']      = $flickr_link;
        if(!empty($behance_link))       $user_socials['soc-behance']     = $behance_link;
        if(!empty($tumblr_link))        $user_socials['soc-tumblr']      = $tumblr_link;
        if(!empty($youtube_link))       $user_socials['soc-youtube']     = $youtube_link;
        if(!empty($vimeo_link))         $user_socials['soc-vimeo']       = $vimeo_link;
        if(!empty($soundcloud_link))    $user_socials['soc-soundcloud']  = $soundcloud_link;
        if(!empty($reddit_link))        $user_socials['soc-reddit']      = $reddit_link;
        if(!empty($yahoo_link))         $user_socials['soc-yahoo']       = $yahoo_link;
        if(!empty($github_link))        $user_socials['soc-github']      = $github_link;
        if(!empty($rss_link))           $user_socials['soc-rss']         = $rss_link;
         
    ?>
    <div class="author-meta">
		<div class="row display_table_md">
			<div class="col-avatar col-md-4 display_table_cell_md">
				<div class="item-media">
                    <?php echo get_avatar(get_the_author_meta('ID'), 250); ?>
				</div>
			</div>
			<div class="col-md-8 display_table_cell_md">
				<div class="item-content">
					<h4><?php echo get_the_author(); ?></h4>
					<p class="desc"><?php echo get_the_author_meta('description'); ?></p>
                    <?php if(!empty($user_socials)){
					echo '<div class="author-social social-icons">';
                        foreach($user_socials as $key => $u_social){
						  echo '<a href="'.esc_url($u_social).'" class="social-icon color-bg-icon rounded-icon '.esc_attr($key).'"></a>';
                        }
					echo '</div>';
                    }
                    ?>
				</div>
			</div>

		</div>
	</div>
    <?php
    }
}

// function display number view of posts.
function medix_get_post_viewed($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}

// function to count views.
add_action( 'wp_head', 'medix_set_post_view' );
function medix_set_post_view(){
	if( is_single() ){ 
		$postID = get_the_ID();
		$count_key = 'post_views_count';
		$count = intval(get_post_meta($postID, $count_key, true));
		if(!$count){
			$count = 1;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, $count);
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}

/**
 * Move comment form field to bottom
 */
function medix_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'medix_comment_field_to_bottom' ); 

/**
 * limit words
 */

function medix_limit_words($string) {
    global $opt_theme_options;
    if(isset($opt_theme_options['excerpt_length']) && !empty($opt_theme_options['excerpt_length']) && (int) $opt_theme_options['excerpt_length'] > 0){
        $word_limit =  $opt_theme_options['excerpt_length'];
        if(is_sticky()) $word_limit = 22;
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return implode(' ', $words);
    }else{
        return $string;
    }
}

function medix_grid_limit_words($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit) {
        array_pop($words);
    }
    return implode(' ', $words);
}

/* Remove [...] after excerpt text */
function medix_new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'medix_new_excerpt_more');

/* Custom excerpt length */
function medix_custom_excerpt_length( $length ) { 
	return 50;
}

add_filter( 'excerpt_length', 'medix_custom_excerpt_length', 999 );

require_once( get_template_directory() . '/inc/libs/class-events.php' );
/* core functions. */
require_once( get_template_directory() . '/inc/functions.php' );

/**
 * theme actions.
 */

/* add footer back to top. */
add_action('wp_footer', 'medix_footer_back_to_top');
$output = ob_get_clean();