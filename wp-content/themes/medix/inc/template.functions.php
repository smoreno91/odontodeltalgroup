<?php

/**
 * get theme option
 */
function medix_get_theme_option(){
     global $opt_theme_options, $opt_meta_options;

     if(is_page() && isset($opt_meta_options['show_header_top']) && $opt_meta_options['show_header_top'] == '1')
        $opt_theme_options['disable_header_top'] = 0;
     if($opt_theme_options['disable_header_top'] == '1' && ( $opt_theme_options['header_side'] == '1' || (isset($_GET['header_side']) && $_GET['header_side'] == 1)))
        $opt_theme_options['disable_header_top'] = 0;
     if(is_page() && isset($opt_meta_options['disable_footer_top']) && $opt_meta_options['disable_footer_top']=='1')
        $opt_theme_options['disable_footer_top'] = 1;

     if(is_page() && !empty($opt_meta_options['footer_top_layout']))
        $opt_theme_options['footer_top_layout'] = $opt_meta_options['footer_top_layout'];

     if(is_page() && !empty($opt_meta_options['footer_bottom_layout']))
        $opt_theme_options['footer_bottom_layout'] = $opt_meta_options['footer_bottom_layout'];

     return $opt_theme_options;
}

/**
 * get meta option
 */
function medix_get_meta_option(){
     global $opt_meta_options;
     return $opt_meta_options;
}
/**
 * get page loading
 */
function medix_page_loading(){
    global $opt_theme_options;

    if(!isset($opt_theme_options) || (isset($opt_theme_options['page_loading']) && !$opt_theme_options['page_loading']))
        return;
    echo '<div class="preloader">';
		echo '<div class="preloader_image"></div>';
	echo '</div>';

}
/**
 * get header layout.
 */
function medix_header(){
    global $opt_theme_options, $opt_meta_options;

    if(!class_exists('EF3_Framework') || ( class_exists('EF3_Framework') && empty($opt_theme_options['header_layout']))){
        get_template_part('inc/header/header', 'layout1');
        return;
    }

    if(is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    if( (isset($opt_theme_options['header_side']) && $opt_theme_options['header_side']) || (isset($_GET['header_side']) && $_GET['header_side'] == 1))
        get_template_part('inc/header/header', 'side');
    else
        get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

/**
 * get header layout class
 */
function medix_header_layout_class($class = ''){
    global $opt_theme_options,$opt_meta_options;

    if(empty($opt_theme_options)){
        echo esc_attr($class);
        return;
    }

    if(is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    if(!empty($opt_theme_options['header_layout']))
        $class = 'header-'.$opt_theme_options['header_layout'];

    if(is_page() && !empty($opt_meta_options['header_transparent']))
        $class .= ' header-transparent';

    echo esc_attr($class);
}

/**
 * get theme logo.
 */
function medix_header_logo(){
    global $opt_theme_options, $opt_meta_options;

    if(is_page() && !empty($opt_meta_options['main_logo']['url'])){
        $opt_theme_options['main_logo']['url'] = $opt_meta_options['main_logo']['url'];
        $opt_theme_options['tran_logo']['url'] = $opt_meta_options['main_logo']['url'];
        $opt_theme_options['dark_logo']['url'] = $opt_meta_options['main_logo']['url'];
    }
    $has_sticky_logo =  !empty($opt_theme_options['sticky_logo']['url']) ? 'has-sticky-logo' : '';
    echo '<div class="main_logo '.esc_attr($has_sticky_logo).'">';

    if(!empty($opt_theme_options['main_logo']['url'])) {
        echo '<a class="main-logo" href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['main_logo']['url']) . '"></a>';
        if(!empty($opt_theme_options['tran_logo']['url']))
            echo '<a class="tran-logo" href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['tran_logo']['url']) . '"></a>';
        if(!empty($opt_theme_options['dark_logo']['url']))
            echo '<a class="dark-logo" href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['dark_logo']['url']) . '"></a>';
    }else {
        echo '<h3 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . get_bloginfo( "name" ) . '</a></h3>';
        echo '<p class="site-description">' . get_bloginfo( "description" ) . '</p>';
    }

    echo '</div>';

    medix_header_sticky_logo();
}

/**
 * get theme logo.
 */
function medix_header_sticky_logo(){
    global $opt_theme_options, $opt_meta_options;

    /* sticky off. */
    if(!isset($opt_theme_options['menu_sticky']) || !$opt_theme_options['menu_sticky'])
        return;

    /* default logo. */
    if(empty($opt_theme_options['sticky_logo']['url']))
        return;
    if(is_page() && !empty($opt_meta_options['sticky_logo']['url'])){
        $opt_theme_options['sticky_logo']['url'] = $opt_meta_options['sticky_logo']['url'];
        $opt_theme_options['sticky_dark_logo']['url'] = $opt_meta_options['sticky_logo']['url'];
    }

    echo '<div class="sticky_logo">';

    if(!empty($opt_theme_options['sticky_logo']['url'])) {
        if(!empty($opt_theme_options['sticky_dark_logo']['url']))
            echo '<a class="sticky_logo_ds" href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['sticky_dark_logo']['url']) . '"></a>';
        echo '<a class="sticky_logo_ls" href="' . esc_url(home_url('/')) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['sticky_logo']['url']) . '"></a>';
    }else {
        echo '<h3 class="site-title"><a href="' . esc_url( home_url( '/' )) . '" rel="home">' . get_bloginfo( "name" ) . '</a></h3>';
        echo '<p class="site-description">' . get_bloginfo( "description" ) . '</p>';
    }

    echo '</div>';
}

/**
 * get header class.
 */
function medix_header_class($class = ''){
    global $opt_theme_options;

    if(empty($opt_theme_options)){
        echo esc_attr($class);
        return;
    }

    if(!empty($opt_theme_options['menu_sticky']) && $opt_theme_options['menu_sticky']=='1')
        $class .= ' sticky-desktop';

    echo esc_attr($class);
}

/**
 * main navigation.
 */
function medix_header_navigation(){

    global $opt_meta_options;

    $attr = array(
        'menu_class' => 'nav-menu menu-main-menu',
        'theme_location' => 'primary'
    );

    if(is_page() && !empty($opt_meta_options['header_menu']))
        $attr['menu'] = $opt_meta_options['header_menu'];

    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    $locations = get_nav_menu_locations();

    if(empty($locations[ 'primary' ]))
        return;

    /* main nav. */
    wp_nav_menu( $attr );
}

/**
 * Change search form
 **/
function medix_my_search_form( $form ) {
    $form = '<form method="get" action="'. esc_url( home_url( '/'  ) ).'" class="searchform search-form">
            <div class="form-group">
				<input type="text" value="' . get_search_query() . '" name="s" class="form-control" placeholder="'.esc_html__("Search keyword",'medix').'" id="modal-search-input">
			</div>
			<button type="submit" class="theme_button"><i class="fa fa-search"></i></button>
             ';
         $form .='</form>';
    return $form;
}
add_filter( 'get_search_form', 'medix_my_search_form' );

/**
 * get page title layout
 */
function medix_page_title(){
    global $opt_theme_options, $opt_meta_options;

    if(is_404()) return;
    /* default. */
    $layout = '1';

    /* get theme options */
    if(isset($opt_theme_options['page_title_layout']))
        $layout = $opt_theme_options['page_title_layout'];

    if(isset($opt_theme_options['page_title_layout']))
        $layout = $opt_theme_options['page_title_layout'];

    if(isset($opt_meta_options['disable_page_title']) && $opt_meta_options['disable_page_title']=='1'){
        return;
    }

    /* custom layout from page. */
    if(is_page() && !empty($opt_meta_options['page_title_layout']))
        $layout = $opt_meta_options['page_title_layout'];

    ?>
    <div id="page-title" class="page-title <?php echo 'layout-'.esc_attr($layout);?>">
    <?php if(isset($opt_theme_options['page_title_is_overlay']) && $opt_theme_options['page_title_is_overlay']=='1') echo '<div class="bg-overlay"></div>'; ?>
        <div class="container">
        <div class="row">
        <?php switch ($layout){
            case '1':
                ?>
                <div id="page-title-text" class="page-title-text text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"><h2><?php medix_get_page_title(); ?></h2></div>
                <div id="breadcrumb-text" class="breadcrumb-text text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php medix_get_bread_crumb(); ?></div>
                <?php
                break;
            case '2':
                ?>
                <div id="page-title-text" class="page-title-text col-md-6 text-center text-md-left"><h2><?php medix_get_page_title(); ?></h2></div>
                <div id="breadcrumb-text" class="breadcrumb-text col-md-6 text-center text-md-right"><?php medix_get_bread_crumb(); ?></div>
                <?php
                break;
            case '3':
                ?>
                <div id="page-title-text" class="page-title-text text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"><h2><?php medix_get_page_title(); ?></h2></div>
                <div id="breadcrumb-text" class="breadcrumb-text text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php medix_get_bread_crumb(); ?></div>
                <?php
                break;
            case '4':
                ?>
                <div id="page-title-text" class="page-title-text col-xs-12 col-sm-12">
                    <h2><?php medix_get_page_title(); ?></h2>
                    <div id="breadcrumb-text" class="breadcrumb-text"><?php medix_get_bread_crumb(); ?></div>
                </div>
                <?php
                break;
            case '5':
                ?>
                <div id="page-title-text" class="page-title-text text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"><h2><?php medix_get_page_title(); ?></h2></div>
                <div id="breadcrumb-text" class="breadcrumb-text text-right col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="brc-wrap">
                        <?php medix_get_bread_crumb(); ?>
                    </div>
                </div>
                <?php
                break;
            case '6':
                ?>
                <div id="page-title-text" class="page-title-text text-left col-xs-12 col-sm-12 col-md-12 col-lg-12"><h2><?php medix_get_page_title(); ?></h2></div>
                <div id="breadcrumb-text" class="breadcrumb-text text-right col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="brc-wrap">
                        <?php medix_get_bread_crumb(); ?>
                    </div>
                </div>
                <?php
                break;
        } ?>
        </div>
        </div>
    </div><!-- #page-title -->
    <?php
}

/**
 * page title
 */
function medix_get_page_title(){

    global $opt_meta_options;

    if (!is_archive()){
        /* page. */
        if(is_page()) :
            /* custom title. */
            if(!empty($opt_meta_options['page_title_text'])):
                echo esc_html($opt_meta_options['page_title_text']);
            else :
                the_title();
            endif;
        elseif (is_front_page()):
            esc_html_e('Blog', 'medix');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'medix' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'medix');
        /* other */
        elseif (is_single() && (function_exists('is_woocommerce') && is_woocommerce() && is_product())):
            esc_html_e( 'Single shop', 'medix' );
        elseif ( is_singular( 'gallery' ) ):
            esc_html_e( 'Single gallery', 'medix' );
        elseif ( is_singular( 'team' ) ):
            esc_html_e( 'Single team', 'medix' );
        elseif ( is_singular( 'services' ) ):
            esc_html_e( 'Single service', 'medix' );
        elseif ( is_singular( 'tribe_events' ) ):
            esc_html_e( 'Single event', 'medix' );
        elseif ( is_single() ):
            esc_html_e( 'Single post', 'medix' );
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        elseif ( is_tag() ) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'medix' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'medix' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'medix' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'medix' ), '<span>' . get_the_date() . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'medix');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'medix');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'medix' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'medix' );
        elseif (is_post_type_archive('gallery')):
            esc_html_e( 'Gallery', 'medix' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

/**
 * Breadcrumb NavXT
 *
 * @since 1.0.0
 */
function medix_get_bread_crumb() {

    if(!function_exists('bcn_display')) return;

    bcn_display();
}

/**
 * Display an optional post video.
 */
function medix_post_video() {

    global $opt_meta_options, $wp_embed;

    /* no video. */
    if(empty($opt_meta_options['opt-video-type'])) {
        medix_post_thumbnail();
        return;
    }

    if($opt_meta_options['opt-video-type'] == 'local' && !empty($opt_meta_options['otp-video-local']['id'])){

        $video = wp_get_attachment_metadata($opt_meta_options['otp-video-local']['id']);

        echo do_shortcode('[video width="'.esc_attr($opt_meta_options['otp-video-local']['width']).'" height="'.esc_attr($opt_meta_options['otp-video-local']['height']).'" '.$video['fileformat'].'="'.esc_url($opt_meta_options['otp-video-local']['url']).'" poster="'.esc_url($opt_meta_options['otp-video-thumb']['url']).'"][/video]');

    } elseif($opt_meta_options['opt-video-type'] == 'youtube' && !empty($opt_meta_options['opt-video-youtube'])) {
        echo '<div class="embed-responsive">';
			echo '<a href="'.esc_url($opt_meta_options['opt-video-youtube']).'" class="embed-placeholder">';
				medix_post_thumbnail();
			echo '</a>';
		echo '</div>';
        //echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-youtube']).'[/embed]'));

    } elseif($opt_meta_options['opt-video-type'] == 'vimeo' && !empty($opt_meta_options['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-vimeo']).'[/embed]'));

    }
}

/**
 * Display an optional post audio.
 */
function medix_post_audio() {
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['otp-audio']['id'])) {
        medix_post_thumbnail();
        return;
    }

    $audio = wp_get_attachment_metadata($opt_meta_options['otp-audio']['id']);

    echo do_shortcode('[audio '.$audio['fileformat'].'="'.esc_url($opt_meta_options['otp-audio']['url']).'"][/audio]');
}

/**
 * Display an optional post gallery.
 */
function medix_post_gallery($size='large'){
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['opt-gallery'])) {
        medix_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta_options['opt-gallery']);

    ?>
    <div id="carousel-post-gallery" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $i = 0; ?>
            <?php foreach ($array_id as $image_id): ?>
                <?php
                $attachment_image = wp_get_attachment_image_src($image_id, $size, false);
                if($attachment_image[0] != ''):?>
                    <div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
                        <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                    </div>
                <?php $i++; endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="left carousel-control" href="#carousel-post-gallery" role="button" data-slide="prev">
            <span class="pe-7s-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-post-gallery" role="button" data-slide="next">
            <span class="pe-7s-angle-right"></span>
        </a>
    </div>
    <?php
}

/**
 * Display an optional post quote.
 */
function medix_post_quote() {
    global $opt_meta_options;

    if(empty($opt_meta_options['opt-quote-content'])){
        return;
    }

    $quote_title = !empty($opt_meta_options['opt-quote-title']) ? '<h4>'.esc_html($opt_meta_options['opt-quote-title']).'</h4>' : '' ;
    $quote_sub_title = !empty($opt_meta_options['opt-quote-sub-title']) ? '<p>'.esc_html($opt_meta_options['opt-quote-sub-title']).'</p>' : '' ;

    echo '<blockquote>'.esc_html($opt_meta_options['opt-quote-content']).wp_kses_post($quote_title).wp_kses_post($quote_sub_title).'</blockquote>';

}

/**
 * Display an optional post status.
 */
function medix_post_status() {
    global $opt_meta_options;

    if(empty($opt_meta_options['opt-status'])){
        return;
    }

    echo '<div class="media inline-block">';
		echo '<img src="'.esc_url($opt_meta_options['opt-status']['thumbnail']).'" alt="" class="round">';
	echo '</div>';

}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function medix_post_thumbnail($size='') {

    global $opt_theme_options;
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    $img_size = 'large';
    if($size!='') $img_size = $size;

    echo '<div class="post-thumbnail">';
            the_post_thumbnail($img_size);
    echo '</div>';

}

function medix_post_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'right';

    if(isset($opt_theme_options['single_layout']))
        $_sidebar = $opt_theme_options['single_layout'];

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';
    return 'is-sidebar-' . esc_attr($_sidebar);
}

function medix_post_class(){
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";

    if(isset($opt_theme_options['single_layout']) && $opt_theme_options['single_layout'] == 'full')
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";

    echo esc_attr($_class);
}
function medix_event_sidebar(){
    global $opt_theme_options;
    $_sidebar = 'full';
    if(is_singular()){
        if(isset($opt_theme_options['event_single_layout']))
            $_sidebar = $opt_theme_options['event_single_layout'];
        if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
            $_sidebar = 'left';
        if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
            $_sidebar = 'right';
    }
    return 'is-sidebar-' . esc_attr($_sidebar);
}
function medix_event_class(){
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
    if(is_singular()){
        $_class = "col-xs-12 col-sm-10 col-sm-push-1";
        if(isset($opt_theme_options['event_single_layout']) && $opt_theme_options['event_single_layout'] == 'left')
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
        if(isset($opt_theme_options['event_single_layout']) && $opt_theme_options['event_single_layout'] == 'right')
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
        if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
        if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
            $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    }

    echo esc_attr($_class);
}
/**
 * Display an optional post detail.
 */
function medix_post_detail(){
    global $opt_theme_options;

    ?>
    <ul class="single_detail">

        <?php if(!isset($opt_theme_options['single_date']) || (isset($opt_theme_options['single_date']) && $opt_theme_options['single_date'])): ?>

            <li class="detail-date"><?php echo esc_html__('Posted','medix'); ?> <a href="<?php echo get_day_link(false, false, false); ?>"><?php the_date(); ?></a></li>

        <?php endif; ?>

        <?php if(isset($opt_theme_options['single_author']) && $opt_theme_options['single_author']): ?>

            <li class="detail-author"><?php echo esc_html__('by','medix'); ?> <?php the_author_posts_link(); ?></li>

        <?php endif; ?>

        <?php if(!isset($opt_theme_options['single_comment']) || (isset($opt_theme_options['single_comment']) && $opt_theme_options['single_comment'])): ?>

            <li class="detail-comment"><a href="<?php the_permalink(); ?>"><?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'medix'); ?></a></li>

        <?php endif; ?>

        <?php if(has_tag() && (!isset($opt_theme_options['single_tag']) || (isset($opt_theme_options['single_tag']) && $opt_theme_options['single_tag']))): ?>

            <li class="detail-tags"><?php the_tags('', ', ' ); ?></li>

        <?php endif; ?>

    </ul>
    <?php
}

/**
 * Display an optional event detail.
 */
function medix_event_detail(){

    ?>
    <ul class="single_detail">
        <li class="detail-date"><?php echo esc_html__('Posted','medix'); ?> <a href="<?php echo get_day_link(false, false, false); ?>"><?php the_date(); ?></a></li>
        <li class="detail-author"><?php echo esc_html__('by','medix'); ?> <?php the_author_posts_link(); ?></li>
    </ul>
    <?php
}
/**
 * Display an optional post category.
 */
function medix_post_cats(){
    global $opt_theme_options;
    if(get_post_format()=='quote' || get_post_format()=='link'){
        echo '<div class="categories-links"><a href="'.esc_url( get_permalink() ) .'" title="">'.get_post_format().'</a></div>';
    }else if(has_category() && (!isset($opt_theme_options['single_categories']) || (isset($opt_theme_options['single_categories']) && $opt_theme_options['single_categories']))){
        ?>
        <div class="categories-links"><?php the_terms( get_the_ID(), 'category', '', ' ' ); ?></div>
        <?php
    }
}
/**
 * Display an optional event category.
 */
function medix_event_cats(){
    ?>
        <div class="categories-links"><?php the_terms( get_the_ID(), 'tribe_events_cat', '', ' ' ); ?></div>
    <?php
}

/**
 * Display single entry footer
 */
function medix_entry_footer(){
    global $opt_theme_options;
    if( ( isset($opt_theme_options['single_footer_tag']) && $opt_theme_options['single_footer_tag']) || (isset($opt_theme_options['single_footer_social']) && $opt_theme_options['single_footer_social']) ){
        echo '<footer class="entry-footer">';
            if(has_tag() && (!isset($opt_theme_options['single_footer_tag']) || (isset($opt_theme_options['single_footer_tag']) && $opt_theme_options['single_footer_tag'])))
                the_tags( '<span class="tag-label">'.esc_html__('Tags: ','medix').'</span><span class="tag-links">', ',', '</span>' );
            if(isset($opt_theme_options['single_footer_social']) && $opt_theme_options['single_footer_social'])
                medix_footer_share();
        echo '</footer>';
    }
}
/**
 * Display an optional archive detail.
 */
function medix_archive_detail(){
    global $opt_theme_options;
    $archive_year  = get_the_time('Y');
    $archive_month = get_the_time('m');
    $archive_day   = get_the_time('d');

    ?>
    <ul class="archive_detail">

        <?php if(!isset($opt_theme_options['archive_date']) || (isset($opt_theme_options['archive_date']) && $opt_theme_options['archive_date'])): ?>
            <li class="detail-date"><?php echo esc_html__('Posted','medix'); ?> <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a></li>
        <?php endif; ?>

        <?php if(!isset($opt_theme_options['archive_author']) || (isset($opt_theme_options['archive_author']) && $opt_theme_options['archive_author'])): ?>

            <li class="detail-author"><?php echo esc_html__('by','medix'); ?> <?php the_author_posts_link(); ?></li>

        <?php endif; ?>

        <?php if(!isset($opt_theme_options['archive_comment']) || (isset($opt_theme_options['archive_comment']) && $opt_theme_options['archive_comment'])): ?>

            <li class="detail-comment"><a href="<?php the_permalink(); ?>"><?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'medix'); ?></a></li>

        <?php endif; ?>

        <?php if(has_tag() && (!isset($opt_theme_options['archive_tag']) || (isset($opt_theme_options['archive_tag']) && $opt_theme_options['archive_tag']))): ?>

            <li class="detail-tags"><?php the_tags('', ', ' ); ?></li>

        <?php endif; ?>
    </ul>

    <?php

}
/**
 * Display an optional archive category.
 */
function medix_archive_cats(){
    global $opt_theme_options;
    if(get_post_format()=='quote' || get_post_format()=='link'){
        echo '<div class="categories-links"><a href="'.esc_url( get_permalink() ) .'" title="">'.get_post_format().'</a></div>';
    }else if(has_category() && (!isset($opt_theme_options['archive_categories']) || (isset($opt_theme_options['archive_categories']) && $opt_theme_options['archive_categories']))){
        ?>
        <div class="categories-links"><?php the_terms( get_the_ID(), 'category', '', ' ' ); ?></div>
        <?php
    }
}
function medix_archive_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'right';

    if(isset($opt_theme_options['archive_layout']))
        $_sidebar = $opt_theme_options['archive_layout'];

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';

    return 'is-sidebar-' . esc_attr($_sidebar);
}

function medix_gallery_archive_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'right';

    if(isset($opt_theme_options['gallery_archive_layout']))
        $_sidebar = $opt_theme_options['gallery_archive_layout'];

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';

    return 'is-sidebar-' . esc_attr($_sidebar);
}

function medix_archive_class(){
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";

    if(isset($opt_theme_options['archive_layout']) && $opt_theme_options['archive_layout'] == 'full')
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";


    echo esc_attr($_class);
}

function medix_gallery_archive_class(){
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";

    if(isset($opt_theme_options['gallery_archive_layout']) && $opt_theme_options['gallery_archive_layout'] == 'full')
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_class = "col-xs-12 col-sm-12 col-md-10 col-md-push-1";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";


    echo esc_attr($_class);
}

function medix_get_gallery_cols(){
    global $opt_theme_options;
    $_class = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    $is_sidebar = medix_gallery_archive_sidebar();
    if($is_sidebar == 'is-sidebar-full'){
        if(isset($_GET['cols']) && trim($_GET['cols']) == 1 )
            $_class =  'col-xs-12 col-sm-12 col-md-12';
        elseif(isset($_GET['cols']) && trim($_GET['cols']) == 2 )
            $_class =  'col-xs-12 col-sm-6 col-md-6';
        elseif(isset($_GET['cols']) && trim($_GET['cols']) == 3 )
            $_class =  'col-xs-12 col-sm-6 col-md-4';
        elseif(isset($_GET['cols']) && trim($_GET['cols']) == 4 )
            $_class =  'col-xs-12 col-sm-6 col-md-3';
        else
        $_class =  $opt_theme_options['gallry_columns_full'];
    }else{
        if(isset($_GET['cols']) && trim($_GET['cols']) == 1 )
            $_class =  'col-xs-12 col-sm-12 col-md-12';
        elseif(isset($_GET['cols']) && trim($_GET['cols']) == 2 )
            $_class =  'col-xs-12 col-sm-6 col-md-6';
        elseif(isset($_GET['cols']) && trim($_GET['cols']) == 3 )
            $_class =  'col-xs-12 col-sm-6 col-md-4';
        else
        $_class =  $opt_theme_options['gallry_columns'];
    }
    echo esc_attr($_class);
}

function medix_get_gallery_single_layout(){
    global $opt_theme_options, $opt_meta_options;

    if( !empty($opt_meta_options['opt_gallery_single_layout']))
        $gallery_layout = $opt_meta_options['opt_gallery_single_layout'];
    elseif(!empty($opt_theme_options['gallery_single_layout']))
        $gallery_layout = $opt_theme_options['gallery_single_layout'];
    else
        $gallery_layout = 'layout1';

    return $gallery_layout;
}
/**
 * footer layout
 */
function medix_footer_top(){
    global $opt_theme_options,$opt_meta_options;

    if(!isset($opt_theme_options))
        return;
    if(is_page() && !empty($opt_meta_options['footer_top_layout']))
        $opt_theme_options['footer_top_layout'] = $opt_meta_options['footer_top_layout'];

    if(is_page() && !empty($opt_meta_options['footer_top_logo']['url']))
    $opt_theme_options['footer_top_logo']['url'] = $opt_meta_options['footer_top_logo']['url'];

    $_class = "";
    if(!empty($opt_theme_options['footer_top_layout'])){
        if($opt_theme_options['footer_top_layout'] == 'layout-1'){
            switch ($opt_theme_options['footer-top-column-layout1']){
                case '1':
                    $_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                    break;
                case '2':
                    $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                    break;
                case '3':
                    $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
                    break;
            }
            if ( is_active_sidebar( 'sidebar-footer-top-layout1-col1' ) || !empty($opt_theme_options['footer_top_logo']['url'])){
                echo '<div class="' . esc_html($_class) . ' text-center to_animate wow scaleAppear">';
                    if(!empty($opt_theme_options['footer_top_logo']['url'])) {
                        $footer_top_logo_url = !empty($opt_theme_options['footer_top_logo_url']) ? $opt_theme_options['footer_top_logo_url'] : home_url('/') ;
                        echo '<a class="footer-top-logo" href="' . esc_url($footer_top_logo_url) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($opt_theme_options['footer_top_logo']['url']) . '"></a>';
                    }
                    dynamic_sidebar( 'sidebar-footer-top-layout1-col1' );
                echo "</div>";
            }
            for($i = 2 ; $i <= $opt_theme_options['footer-top-column-layout1'] ; $i++){
                if ( is_active_sidebar( 'sidebar-footer-top-layout1-col' . $i ) ){
                    echo '<div class="' . esc_html($_class) . ' text-center to_animate wow scaleAppear">';
                        dynamic_sidebar( 'sidebar-footer-top-layout1-col' . $i );
                    echo "</div>";
                }
            }
        }
        if($opt_theme_options['footer_top_layout'] == 'layout-2'){
            switch ($opt_theme_options['footer-top-column-layout2']){
                case '1':
                    $_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                    break;
                case '2':
                    $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                    break;
                case '3':
                    $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
                    break;
            }
            for($i = 1 ; $i <= $opt_theme_options['footer-top-column-layout2'] ; $i++){
                if ( is_active_sidebar( 'sidebar-footer-top-layout2-col' . $i ) ){
                    echo '<div class="' . esc_html($_class) . ' to_animate wow fadeIn">';
                        dynamic_sidebar( 'sidebar-footer-top-layout2-col' . $i );
                    echo "</div>";
                }
            }
        }
        if($opt_theme_options['footer_top_layout'] == 'layout-3'){
            switch ($opt_theme_options['footer-top-column-layout3']){
                case '1':
                    $_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                    break;
                case '2':
                    $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                    break;
                case '3':
                    $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
                    break;
                case '4':
                    $_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
                    break;
            }
            for($i = 1 ; $i <= $opt_theme_options['footer-top-column-layout3'] ; $i++){
                if ( is_active_sidebar( 'sidebar-footer-top-layout3-col' . $i ) ){
                    echo '<div class="' . esc_html($_class) . ' to_animate wow fadeInUp">';
                        dynamic_sidebar( 'sidebar-footer-top-layout3-col' . $i );
                    echo "</div>";
                }
            }
        }


    }
}

function medix_footer_bottom(){
    global $opt_theme_options,$opt_meta_options;
    if(is_page() && !empty($opt_meta_options['footer_bottom_layout']))
        $opt_theme_options['footer_bottom_layout'] = $opt_meta_options['footer_bottom_layout'];

    if(empty($opt_theme_options['footer_bottom_layout'])){
        get_template_part('inc/footer-bottom/footer_bottom', 'layout-1');
    }else{
        get_template_part('inc/footer-bottom/footer_bottom', $opt_theme_options['footer_bottom_layout']);
    }
}
function get_footer_bottom_style(){
    global $opt_meta_options;
    if(is_page() && !empty($opt_meta_options['footer_bottom_style']))
        return $opt_meta_options['footer_bottom_style'];
    elseif(isset($_GET['ls']) && trim($_GET['ls']) == '1' )
        return 'ls';
    elseif(isset($_GET['cs']) && trim($_GET['cs']) == '1' )
        return 'cs';
    else
        return '';
}
function medix_footer_back_to_top(){
    global $opt_theme_options;

    $_back_to_top = true;

    if(isset($opt_theme_options['general_back_to_top']))
        $_back_to_top = $opt_theme_options['general_back_to_top'];

    if($_back_to_top)
        echo '<div class="ef3-back-to-top"><i class="fa fa-angle-up"></i></div>';
}

/**
 * Show social list from theme option
 */
function medix_social_from_themeoption($layout = '',$social_type = '',$social_round = '') {
    global $opt_theme_options;
    $lists = '';
    if (!empty($layout ) && $layout == 'header_top') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header_top']['enabled']) ) ? $opt_theme_options['individual_social_on_header_top']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'header') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header']['enabled']) ) ? $opt_theme_options['individual_social_on_header']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_top_layout1') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_top_layout1']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_top_layout1']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_top_layout3') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_top_layout3']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_top_layout3']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_bottom_layout4') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_bottom_layout4']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_bottom_layout4']['enabled'] : '';
    }
    if ( $lists ) {
        echo '<div class="social-icons layout-'.$layout.'">';
        foreach ($lists as $key => $value) {
            if($key != 'placebo'){
              if($key == 'rss'){
                echo '<a class="social-icon '.$social_type.' '.$social_round.' soc-whatsapp" href="'.esc_url($opt_theme_options[$key]).'" target="_blank"></a>';
              }else{
                echo '<a class="social-icon '.$social_type.' '.$social_round.' soc-'.esc_attr($key).'" href="'.esc_url($opt_theme_options[$key]).'" target="_blank"></a>';
              }
            }
        }
        echo '</div>';
    }
}
function medix_social_from_themeoption_layout2($layout = '',$social_type = '',$social_round = '') {
    global $opt_theme_options;
    $lists = '';
    if (!empty($layout ) && $layout == 'header_top') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header_top']['enabled']) ) ? $opt_theme_options['individual_social_on_header_top']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'header') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header']['enabled']) ) ? $opt_theme_options['individual_social_on_header']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_top_layout1') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_top_layout1']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_top_layout1']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_top_layout3') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_top_layout3']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_top_layout3']['enabled'] : '';
    }
    if (!empty($layout ) && $layout == 'footer_bottom_layout4') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer_bottom_layout4']['enabled']) ) ? $opt_theme_options['individual_social_on_footer_bottom_layout4']['enabled'] : '';
    }
    if ( $lists ) {
        echo '<div class="social-icons layout-'.$layout.'">';
        foreach ($lists as $key => $value) {
            if($key != 'placebo'){
                echo '<div class="media">';
                echo '<div class="media-left media-middle">';
                echo '<a href="'.esc_url($opt_theme_options[$key]).'" class="social-icon '.$social_type.' '.$social_round.' soc-'.esc_attr($key).'"></a>';
                echo '</div>';
                echo '<div class="media-body media-middle">'.esc_html($value).'</div>';
                echo '</div>';
            }

        }
        echo '</div>';
    }
}
/**
 * Display social share in single footer.
 */
function medix_footer_share(){
    ?>
        <div class="entry-share clearfix">
            <ul class="social-share">
                <li><a class="twitter" target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'medix');?>:%20<?php echo strip_tags(get_the_title());?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                <li><a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                <li><a class="google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-google-plus"></i></a></li>
                <li><a class="pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink());?>"><i class="fa fa-pinterest"></i></a></li>
            </ul>
        </div>
    <?php
}
/**
 * Display social share in single footer.
 */
function medix_single_event_share(){
    ?>
        <div class="event-entry-share text-center clearfix">
            <a class="social-icon color-bg-icon soc-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"></a>
            <a class="social-icon color-bg-icon soc-twitter" target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'medix');?>:%20<?php echo strip_tags(get_the_title());?>%20-%20<?php the_permalink();?>"></a>
            <a class="social-icon color-bg-icon soc-google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"></a>
            <a class="social-icon color-bg-icon soc-pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink());?>"></a>
        </div>
    <?php
}
/**
 * Display an optional gallery gallery.
 */
function medix_portfolio_gallery(){
    global $opt_meta_options;

    ?>
    <div class="page-wrapper post-media">
        <?php
        if(empty($opt_meta_options['opt_port_gallery'])) {
            red_organicfood_post_thumbnail('large');
        }else{
            $array_id = explode(",", $opt_meta_options['opt_port_gallery']);
            ?>
             <div id="carousel-port-gallery" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i = 0; ?>
                    <?php foreach ($array_id as $image_id): ?>
                        <?php
                        $attachment_image = wp_get_attachment_image_src($image_id, 'large', false);
                        if($attachment_image[0] != ''):?>
                            <div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
                                <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                            </div>
                        <?php $i++; endif; ?>
                    <?php endforeach; ?>
                </div>

                <a class="left carousel-control" href="#carousel-port-gallery" data-slide="prev">
                    <span class="pe-7s-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-port-gallery" data-slide="next">
                    <span class="pe-7s-angle-right"></span>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php
}
/**
 * Display team meta
 */
function medix_team_meta(){
    global $opt_meta_options;

    ?>
    <?php if(!empty($opt_meta_options['opt_team_position'])) {?>
    <p class="position"><?php echo esc_html($opt_meta_options['opt_team_position']); ?></p>
    <?php }?>
    <?php if( !empty($opt_meta_options['opt_team_social_link_1']) || !empty($opt_meta_options['opt_team_social_link_2']) || !empty($opt_meta_options['opt_team_social_link_3']) || !empty($opt_meta_options['opt_team_social_link_4']) || !empty($opt_meta_options['opt_team_social_link_5'])) {?>
    <div class="text-center social-icons">
        <?php if( !empty($opt_meta_options['opt_team_social_link_1']) && !empty($opt_meta_options['opt_team_social_icon_class_1']) ) {?>
            <a class="social-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_1']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_1']);?>" title="" target="_blank" data-toggle="tooltip" data-original-title="<?php echo ucfirst(esc_attr($opt_meta_options['opt_team_social_icon_class_1']));?>"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_2']) && !empty($opt_meta_options['opt_team_social_icon_class_2']) ) {?>
            <a class="social-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_2']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_2']);?>" title="" target="_blank" data-toggle="tooltip" data-original-title="<?php echo ucfirst(esc_attr($opt_meta_options['opt_team_social_icon_class_2']));?>"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_3']) && !empty($opt_meta_options['opt_team_social_icon_class_3']) ) {?>
            <a class="social-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_3']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_3']);?>" title="" target="_blank" data-toggle="tooltip" data-original-title="<?php echo ucfirst(esc_attr($opt_meta_options['opt_team_social_icon_class_3']));?>"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_4']) && !empty($opt_meta_options['opt_team_social_icon_class_4']) ) {?>
            <a class="social-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_4']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_4']);?>" title="" target="_blank" data-toggle="tooltip" data-original-title="<?php echo ucfirst(esc_attr($opt_meta_options['opt_team_social_icon_class_4']));?>"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_5']) && !empty($opt_meta_options['opt_team_social_icon_class_5']) ) {?>
            <a class="social-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_5']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_5']);?>" title="" target="_blank" data-toggle="tooltip" data-original-title="<?php echo ucfirst(esc_attr($opt_meta_options['opt_team_social_icon_class_5']));?>"></a>
        <?php }?>
    </div>
    <?php
    }
}

/**
 * Display team meta
 */
function medix_team_meta_layout1(){
    global $opt_meta_options;

    ?>
    <?php if(!empty($opt_meta_options['opt_team_position'])) {?>
    <p class="position"><?php echo esc_html($opt_meta_options['opt_team_position']); ?></p>
    <?php }?>
    <?php if( !empty($opt_meta_options['opt_team_social_link_1']) || !empty($opt_meta_options['opt_team_social_link_2']) || !empty($opt_meta_options['opt_team_social_link_3']) || !empty($opt_meta_options['opt_team_social_link_4']) || !empty($opt_meta_options['opt_team_social_link_5'])) {?>
    <div class="text-center social-icons">
        <?php if( !empty($opt_meta_options['opt_team_social_link_1']) && !empty($opt_meta_options['opt_team_social_icon_class_1']) ) {?>
            <a class="social-icon color-bg-icon rounded-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_1']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_1']);?>" title="" target="_blank"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_2']) && !empty($opt_meta_options['opt_team_social_icon_class_2']) ) {?>
            <a class="social-icon color-bg-icon rounded-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_2']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_2']);?>" title="" target="_blank"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_3']) && !empty($opt_meta_options['opt_team_social_icon_class_3']) ) {?>
            <a class="social-icon color-bg-icon rounded-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_3']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_3']);?>" title="" target="_blank"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_4']) && !empty($opt_meta_options['opt_team_social_icon_class_4']) ) {?>
            <a class="social-icon color-bg-icon rounded-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_4']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_4']);?>" title="" target="_blank"></a>
        <?php }?>
        <?php if( !empty($opt_meta_options['opt_team_social_link_5']) && !empty($opt_meta_options['opt_team_social_icon_class_5']) ) {?>
            <a class="social-icon color-bg-icon rounded-icon soc-<?php echo esc_attr($opt_meta_options['opt_team_social_icon_class_5']);?>" href="<?php echo esc_url($opt_meta_options['opt_team_social_link_5']);?>" title="" target="_blank"></a>
        <?php }?>
    </div>
    <?php
    }
}

/**
 * Add specific CSS class by filter
 */
add_filter( 'body_class', 'medix_body_extra_class' );
function medix_body_extra_class( $classes ) {
    global $opt_theme_options,$opt_meta_options;

    if(is_page() && isset($opt_meta_options['gray_light_bg']) && $opt_meta_options['gray_light_bg'] == '1'){
        $classes[] = 'gray-light';
    }
    if(isset($opt_theme_options['is_dark']) && $opt_theme_options['is_dark'] == '1'){
        $classes[] = 'ds';
    }else{
        $classes[] = 'ls';
    }
    if ( is_singular( 'gallery' ) ){
        if( !empty($opt_meta_options['opt_gallery_single_layout']))
            $classes[] = $opt_meta_options['opt_gallery_single_layout'];
        elseif(!empty($opt_theme_options['gallery_single_layout']))
            $classes[] = $opt_theme_options['gallery_single_layout'];
        else
            $gallery_layout = 'layout1';
    }

	return $classes;

}

function medix_carousel_nav_style(){
    $medix_carousel_nav_style = array(
        esc_html__('Default','medix') => '',
        esc_html__('Left','medix') => 'nav-left',
        esc_html__('Right','medix') => 'nav-right',
        esc_html__('Vertical','medix') => 'nav-vertical',
        esc_html__('Vertical with Text','medix') => 'nav-vertical-text',
    );
    return $medix_carousel_nav_style;
}

/**
 * Animation lib
 */
function medix_animate_lib() {
    $animate = array(
        esc_html( 'None') => '',
        esc_html( 'slideDown' ) => 'slideDown',
        esc_html( 'scaleAppear' ) => 'scaleAppear',
        esc_html( 'fadeInLeft' ) => 'fadeInLeft',
        esc_html( 'fadeInUp') => 'fadeInUp',
        esc_html( 'fadeInRight' ) => 'fadeInRight',
        esc_html( 'fadeInDown' ) => 'fadeInDown',
        esc_html( 'fadeIn') => 'fadeIn',
        esc_html( 'slideRight' ) => 'slideRight',
        esc_html( 'slideUp' ) => 'slideUp',
        esc_html( 'slideLeft' ) => 'slideLeft',
        esc_html( 'expandUp' ) => 'expandUp',
        esc_html( 'slideExpandUp' ) => 'slideExpandUp',
        esc_html( 'expandOpen' ) => 'expandOpen',
        esc_html( 'bigEntrance' ) => 'bigEntrance',
        esc_html( 'hatch' ) => 'hatch',
        esc_html( 'tossing' ) => 'tossing',
        esc_html( 'pulse' ) => 'pulse',
        esc_html( 'floating' ) => 'floating',
        esc_html( 'bounce' ) => 'bounce',
        esc_html( 'pullUp' ) => 'pullUp',
        esc_html( 'pullDown' ) => 'pullDown',
        esc_html( 'stretchLeft' ) => 'stretchLeft',
        esc_html( 'stretchRight' ) => 'stretchRight',
        esc_html( 'fadeInUpBig' ) => 'fadeInUpBig',
        esc_html( 'fadeInDownBig' ) => 'fadeInDownBig',
        esc_html( 'fadeInLeftBig' ) => 'fadeInLeftBig',
        esc_html( 'fadeInRightBig' ) => 'fadeInRightBig',
        esc_html( 'slideInDown' ) => 'slideInDown',
        esc_html( 'slideInLeft' ) => 'slideInLeft',
        esc_html( 'slideInRight' ) => 'slideInRight',
        esc_html( 'moveFromLeft' ) => 'moveFromLeft',
        esc_html( 'moveFromRight' ) => 'moveFromRight',
        esc_html( 'moveFromBottom' ) => 'moveFromBottom',
    );

    return $animate;
}

/**
 * Change number product to show
 */
add_action('after_setup_theme','medix_update_woo_number_item_in_page');
function medix_update_woo_number_item_in_page(){
    global $opt_theme_options;
    if(class_exists('EF3_Framework')){
        if(class_exists( 'woocommerce' )){
            $number_product = ( !empty($opt_theme_options['shop_products']) ) ? $opt_theme_options['shop_products'] : 9;
            add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$number_product.';' ), 9 );
        }
    }
}

/**
 * Shop sidebar
 */
function medix_shop_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'left';

    if(isset($opt_theme_options['woo_loop_layout']))
        $_sidebar = $opt_theme_options['woo_loop_layout'];

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';
    return 'is-sidebar-' . esc_attr($_sidebar);
}

/**
 * Shop product sidebar
 */
function medix_shop_single_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'left';

    if(isset($opt_theme_options['woo_single_layout']))
        $_sidebar = $opt_theme_options['woo_single_layout'];

    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';
    return 'is-sidebar-' . esc_attr($_sidebar);
}

function medix_get_catalog_cols(){
    global $opt_theme_options;
    if(!isset($opt_theme_options['woo_loop_layout']))
        return 'col-xs-12 col-sm-6 col-md-4';

    $is_sidebar = medix_shop_sidebar();
    if($is_sidebar == 'is-sidebar-full'){
        if(isset($_GET['cols']) && trim($_GET['cols']) == 2 )
            return 'col-xs-12 col-sm-6 col-md-6';
        if(isset($_GET['cols']) && trim($_GET['cols']) == 3 )
            return 'col-xs-12 col-sm-6 col-md-4';
        if(isset($_GET['cols']) && trim($_GET['cols']) == 4 )
            return 'col-xs-12 col-sm-6 col-md-3';
        return $opt_theme_options['shop_columns_full'];
    }else{
        if(isset($_GET['cols']) && trim($_GET['cols']) == 2 )
            return 'col-xs-12 col-sm-6 col-md-6';
        if(isset($_GET['cols']) && trim($_GET['cols']) == 3 )
            return 'col-xs-12 col-sm-6 col-md-4';
        return $opt_theme_options['shop_columns'];
    }
}
