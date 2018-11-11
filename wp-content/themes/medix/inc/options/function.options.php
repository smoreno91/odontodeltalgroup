<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'opt_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

/**
 * General Options.
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'medix'),
    'icon' => 'el-icon-adjust-alt',
    'fields' => array(
        array(
            'title'             => esc_html__('Body Background', 'medix'),
            'subtitle'          => esc_html__('Body background.', 'medix'),
            'id'                => 'general_background',
            'type'              => 'background',
            'preview'           => false,
            'output'            => array( 'body' ),
            
        ),
          
        array(
            'title'     => esc_html__('Page loading', 'medix'),
            'subtitle'  => esc_html__('Enable page loading', 'medix'),
            'id'        => 'page_loading',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'subtitle'          => esc_html__('Enable back to top button.', 'medix'),
            'id'                => 'general_back_to_top',
            'type'              => 'switch',
            'title'             => esc_html__('Back To Top', 'medix'),
            'default'           => true,
        )
    )
));

/**
 * Header Options
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'medix'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'subtitle'          => esc_html__('Header side', 'medix'),
            'id'                => 'header_side',
            'type'              => 'switch',
            'title'             => esc_html__('Header side', 'medix'),
            'default'           => false,
        ),
        array(
            'id'                => 'header_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for header', 'medix'),
            'default'           => 'layout1',
            'type'              => 'image_select',
            'options'           => array(
                                        'layout1' => get_template_directory_uri().'/assets/images/header/layout-1.png',
                                        'layout2' => get_template_directory_uri().'/assets/images/header/layout-2.png',
                                        'layout3' => get_template_directory_uri().'/assets/images/header/layout-3.png',
                                        'layout4' => get_template_directory_uri().'/assets/images/header/layout-4.png',
                                        'layout5' => get_template_directory_uri().'/assets/images/header/layout-5.png',
                                    ),
            'required'  => array( 'header_side', '=', 0),                    
        ),
        array(
            'subtitle'          => esc_html__('Header full width', 'medix'),
            'id'                => 'header_full_width',
            'type'              => 'switch',
            'title'             => esc_html__('Full Width', 'medix'),
            'default'           => true,
            'required'  => array( 'header_side', '=', 0),   
        ), 
        array(
            'id'                => 'header_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background Color', 'medix' ),
            'subtitle'          => esc_html__( 'Header background color', 'medix' ),
            'output'   => array(
                'background-color' => '#cshero-header'
            ),
            'required'  => array( 'header_side', '=', 0),   
        ),
        array(
            'title'             => esc_html__('Background Image', 'medix'),
            'subtitle'          => esc_html__('Header background image.', 'medix'),
            'id'                => 'header_background_image',
            'type'              => 'background',
            'preview'           => true,
            'background-color'  => false,
            'output'            => array( '#cshero-header' ),
            'required'  => array( 'header_side', '=', 0),   
        ),
       
        array(
            'title'             => esc_html__('Header padding', 'medix'),
            'subtitle'          => esc_html__('Padding top and bottom', 'medix'),
            'id'                => 'header_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'output'            => array( '.cshero-main-header:not(.header-fixed) .main-navigation ul.nav-menu > li > a' ),
            'required'  => array( 'header_side', '=', 0),   
        ),
         
        array(
            'title'    => esc_html__( 'Open hours title', 'medix' ),
            'id'       => 'open_hours_title',
            'type' => 'text',
            'default'  => 'Open Hours', 
            'required'  => array( 'header_layout', '=', array('layout2','layout5')),
        ),
        array(
            'title'    => esc_html__( 'Open hours text', 'medix' ),
            'id'       => 'open_hours_text',
            'type' => 'text',
            'default'  => 'Mon-Fri: 9-17; Sat: 9-20; Sun: Off', 
            'required'  => array( 'header_layout', '=', array('layout2','layout5')),
        ), 
        array(
            'title'    => esc_html__( 'Phone', 'medix' ),
            'id'       => 'phone',
            'type' => 'text',
            'default'  => '8 (800) 923 4567', 
            'required'  => array( 'header_layout', '=', array('layout2','layout5')),
        ),
        array(
            'title'    => esc_html__( 'Address', 'medix' ),
            'id'       => 'address',
            'type' => 'text',
            'default'  => 'Baker st. 56, San Diego, California', 
            'required'  => array( 'header_layout', '=', array('layout2','layout5')),
        ),
        array(
            'subtitle'          => esc_html__('Show social', 'medix'),
            'id'                => 'hide_social',
            'type'              => 'switch',
            'title'             => esc_html__('Hide social', 'medix'),
            'default'           => false,
            'required'  => array( 'header_layout', '=', 'layout1'),
        ),
        array(
            'id'      => 'individual_social_on_header',
            'type'    => 'sorter',
            'title'   => 'Social on header',
            'options' => array(
                'enabled'  => array(
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'google' => esc_html__('Google', 'medix'),
                ),
                'disabled' => array(
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'  => array( 'hide_social', '=', 0),
        ),
        array(
            'title'     => esc_html__('Gradient Background', 'medix'),
            'subtitle'  => esc_html__('Gradient Background', 'medix'),
            'id'        => 'header_layout_bg_gradient',
            'type'      => 'switch',
            'default'   => true,
            'required'  => array( 'header_layout', '=', array('layout4','layout5')),
        ),
        array(
            'id'       => 'header_bg_gradient_color',
            'type'     => 'color_gradient',
            'title'    => esc_html__('Gradient background color option', 'medix'),
            'validate' => 'color',
            'default'  => array(
                'from' => '',
                'to'   => '', 
            ),
            'required'          => array('header_layout_bg_gradient','=',1)
        ),
        array(
            'subtitle'          => esc_html__('Slide or Push effect (default is slide)', 'medix'),
            'id'                => 'slider_push',
            'type'              => 'switch',
            'title'             => esc_html__('Slide or Push effect', 'medix'),
            'default'           => true,
            'required'  => array( 'header_side', '=', 1),   
        ),
        array(
            'subtitle'          => esc_html__('Show on right', 'medix'),
            'id'                => 'header_side_on_right',
            'type'              => 'switch',
            'title'             => esc_html__('Show on right', 'medix'),
            'default'           => false,
            'required'  => array( 'header_side', '=', 1),   
        ), 
        array(
            'title'             => esc_html__('Is dark', 'medix'),
            'id'                => 'header_side_is_dark',
            'type'              => 'switch',
            'subtitle'          => esc_html__('Is dark', 'medix'),
            'default'           => false,
            'required'  => array( 'header_side', '=', 1),   
        ),
        array(
            'id'      => 'individual_social_on_header_side',
            'type'    => 'sorter',
            'title'   => 'Social on header side',
            'options' => array(
                'enabled'  => array(
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'google' => esc_html__('Google', 'medix'),
                ),
                'disabled' => array(
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'  => array( 'header_side', '=', 1),   
        ),
        
    )
));
/* Header top */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-minus',
    'title' => esc_html__('Header top', 'medix'),
    'subsection' => true,
    'fields' => array(
        array(
            'title'     => esc_html__('Disable', 'medix'),
            'subtitle'          => esc_html__( 'Do not apply to header side', 'medix' ),
            'id'        => 'disable_header_top',
            'type'      => 'switch',
            'default'   => true
        ),
        array(
            'id'                => 'header_top_background',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background Color', 'medix' ),
            'subtitle'          => esc_html__( 'Header top background color', 'medix' ),
            'output'   => array(
                'background-color' => '.header-top'
            ),
            'required'  => array( 'disable_header_top', '=', 0),
        ),
        array(
            'id'                => 'header_top_text_color',
            'type'              => 'color',
            'title'             => esc_html__( 'Text color', 'medix' ),
            'output'            => '.header-top,.header-top .widget,.header-top p,.header-top .widget_text ul li',
            'required'  => array( 'disable_header_top', '=', 0),
        ),
        array(
            'id'                => 'header_top_link_color',
            'type'              => 'link_color',
            'title'             => esc_html__( 'Links Color', 'medix' ),
            'subtitle'          => esc_html__( 'Select links color in header top', 'medix' ),
            'regular'           => true,
            'hover'             => true,
            'active'            => false,
            'visited'           => false,
            'output'            => array( '.header-top a, .header-top ul li a'),
            'required'  => array( 'disable_header_top', '=', 0),
        ),
        array(
            'title'    => esc_html__( 'Register form Terms of use link', 'medix' ),
            'subtitle' => esc_html__( 'Enter the terms of use link', 'medix' ),
            'id'       => 'terms_of_use_link',
            'type' => 'text',
            'default'  => '#', 
            'required'  => array( 'disable_header_top', '=', 0),
        ),
        
         array(
            'id'      => 'individual_social_on_header_top',
            'type'    => 'sorter',
            'title'   => 'Header top socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'google' => esc_html__('Google', 'medix'),
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                ),
                'disabled' => array(
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'), 
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'  => array( 'disable_header_top', '=', 0), 
        ),
 
    )
));
 
/* Header logo */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-minus',
    'title' => esc_html__('Logo', 'medix'),
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Select Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
            'id'                => 'main_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
        ),
        array(
            'title'             => esc_html__('Transparent Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for transparent logo.', 'medix'),
            'id'                => 'tran_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/tran-logo.png'
            ),
        ),
        array(
            'title'             => esc_html__('Dark Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for dark logo.', 'medix'),
            'id'                => 'dark_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/dark-logo.png'
            ),
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'medix'),
            'id'                => 'logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Max Height', 'medix'),
        ),
         
        
    )
));
/* Main menu */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-minus',
    'title' => esc_html__('Main menu', 'medix'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle'          => esc_html__('Enable mega menu.', 'medix'),
            'id'                => 'mega_menu',
            'type'              => 'switch',
            'title'             => esc_html__('Mega Menu', 'medix'),
            'default'           => true,
        ),
         
        array(
            'id'                => 'main_menu_level1_link_color',
            'type'              => 'link_color',
            'title'             => esc_html__( 'Link color', 'medix' ),
            'regular'           => true,
            'hover'             => true,
            'active'            => false,
            'visited'           => false,
            'output'            => array( 
                '#cshero-header-navigation .main-navigation .menu-main-menu > li > a'
            ),
        ),
        
        array(
            'id'                => 'main_menu_level1_current_color',
            'type'              => 'link_color',
            'title'             => esc_html__( 'Current color', 'medix' ),
            'regular'           => true,
            'hover'             => false,
            'active'            => false,
            'visited'           => false,
            'output'            => array(  
                '#cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,  
                #cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a',
            ),
        ),
        array(
            'title'             => esc_html__('Menu item space', 'medix'),
            'subtitle'          => esc_html__('Number of px between menu item', 'medix'),
            'id'                => 'menu_item_space',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => false,
            'right'             => true,
            'bottom'            => false,
            'left'              => true,
            'output'            => array( '#cshero-header-navigation .main-navigation .menu-main-menu > li > a' )
        ),
        array(
            'subtitle'          => esc_html__('Show arrow down icon right', 'medix'),
            'id'                => 'show_arrow_down_icon_right',
            'type'              => 'switch',
            'title'             => esc_html__('Show arrow down icon right', 'medix'),
            'default'           => false,
        ),
        array(
            'title'             => esc_html__('Typography', 'medix'),
            'id'                => 'main_menu_level1_typography',
            'type'              => 'typography',
            'google'            => true,
            'text-align'        => false,
            'color'             => false,
            'line-height'       => true,
            'font-size'         => true,
            'output'            => array( 
                '#cshero-header-navigation .main-navigation ul.nav-menu > li > a' 
            ),
        ),
         
    )
));
/* Menu Sticky */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-minus',
    'title' => esc_html__('Menu Sticky', 'medix'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle'          => esc_html__('enable sticky mode for menu.', 'medix'),
            'id'                => 'menu_sticky',
            'type'              => 'switch',
            'title'             => esc_html__('Sticky Header', 'medix'),
            'default'           => false,
        ),
        array(
            'title'             => esc_html__('Select Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
            'id'                => 'sticky_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
            'required'          => array( 'menu_sticky', '=', 1 )
        ),
        array(
            'title'             => esc_html__('Dark Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for dark logo.', 'medix'),
            'id'                => 'sticky_dark_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/dark-logo.png'
            ),
            'required'          => array( 'menu_sticky', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Set max height for sticky logo.', 'medix'),
            'id'                => 'sticky_logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Sticky Logo Max Height', 'medix'),
            'required'          => array( 'menu_sticky', '=', 1 )
        ),
        array(
            'title'             => esc_html__('Sticky header padding', 'medix'),
            'subtitle'          => esc_html__('Padding top and bottom', 'medix'),
            'id'                => 'sticky_header_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'output'            => array( '.cshero-main-header.affix .main-navigation ul.nav-menu > li > a' ),
            'required'          => array( 'menu_sticky', '=', 1 )
        ),  
    )
));
 
/**
 * Page Title
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title & BC', 'medix'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id'                => 'page_title_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for page title', 'medix'),
            'default'           => '1',
            'type'              => 'image_select',
            'options'           => array(
                                    '1' => get_template_directory_uri().'/assets/images/pagetitle/style1.png',
                                    '2' => get_template_directory_uri().'/assets/images/pagetitle/style2.png',
                                    '3' => get_template_directory_uri().'/assets/images/pagetitle/style3.png',
                                    '4' => get_template_directory_uri().'/assets/images/pagetitle/style4.png',
                                    '5' => get_template_directory_uri().'/assets/images/pagetitle/style5.png',
                                    '6' => get_template_directory_uri().'/assets/images/pagetitle/style6.png',
                                )
        ),
        array(
            'title'             => esc_html__('Is background overlay?', 'medix'),
            'id'                => 'page_title_is_overlay',
            'type'              => 'switch',
            'default'           => true,
        ),
        array(
            'id'                => 'page_title_background_overlay',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background overlay', 'medix' ),
            'output'   => array(
                'background' => '.page-title.layout-1 .bg-overlay,.page-title.layout-2 .bg-overlay,.page-title.layout-3 .bg-overlay,.page-title.layout-4 .bg-overlay,.page-title.layout-5 .bg-overlay,.page-title.layout-6 .bg-overlay',
            ),
            'required'          => array( 'page_title_is_overlay', '=', 1 )
        ),
        
        array(
            'title'             => esc_html__('Background', 'medix'),
            'subtitle'          => esc_html__('Page title background.', 'medix'),
            'id'                => 'page_title_background',
            'type'              => 'background',
            'output'            => array( '.page-title.layout-1,.page-title.layout-2,.page-title.layout-3,.page-title.layout-4,.page-title.layout-5,.page-title.layout-6' )
        ),
        array(
            'title'             => esc_html__('Page title Typography', 'medix'),
            'subtitle'          => esc_html__('Page title typography.', 'medix'),
            'id'                => 'page_title_typography',
            'type'              => 'typography',
            'text-align'        => false,
            'font-size'         => false,
            'line-height'       => false,
            'google'            => true,
            'output'            => array( '.page-title .page-title-text h2' )
        ),
         
        array(
            'title'             => esc_html__('Padding', 'medix'),
            'subtitle'          => esc_html__('Page title padding (top/bottom).', 'medix'),
            'id'                => 'page_title_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'output'            => array( '.page-title','.page-title.layout-1','.page-title.layout-2','.page-title.layout-3','.page-title.layout-4' )
        ),
        
    )
));

/* Breadcrumb */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-random',
    'title' => esc_html__('Breadcrumb', 'medix'),
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Breadcrumb Typography', 'medix'),
            'subtitle'          => esc_html__('Breadcrumb typography.', 'medix'),
            'id'                => 'breadcrumb_typography',
            'type'              => 'typography',
            'text-align'        => false,
            'font-size'         => false,
            'line-height'       => false,
            'google'            => true,
            'output'            => array( '.breadcrumb-text,.breadcrumb-text a,.breadcrumb-text span,.page-title.layout-5 .brc-wrap,.page-title.layout-6 .brc-wrap' )
        ),
        array(
            'id'                => 'breadcrumb_link_color',
            'type'              => 'link_color',
            'title'             => esc_html__( 'Link Color', 'medix' ),
            'active'            => false,
            'subtitle'          => esc_html__( 'Select link color in breadcrumb', 'medix' ),
            'output'            => array( '.breadcrumb-text a, .breadcrumb-text a span, .page-title.layout-5 .brc-wrap a, .page-title.layout-5 .brc-wrap a span, .page-title.layout-6 .brc-wrap a, .page-title.layout-6 .brc-wrap a span' ),
        ),
    )
));

/**
 * Content
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'medix'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
        array(
            'title'     => esc_html__('Padding', 'medix'),
            'subtitle'  => esc_html__('Choose padding for content tag', 'medix'),
            'id'        => 'content_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'right' => false,
            'left' => false,
            'units'     => array('px'),     
            'output'    => array('.site-content')
        ),
    )
));
/* page */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page', 'medix'),
    'icon' => 'el-icon-list',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle'          => esc_html__('Show editor', 'medix'),
            'id'                => 'page_show_frontend_editor',
            'type'              => 'switch',
            'title'             => esc_html__('Frontend editor', 'medix'),
            'default'           => false,
        ),
    )
));
/* archive */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Archive', 'medix'),
    'icon' => 'el-icon-list',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'archive_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for archive, search, index...', 'medix'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'medix'),
            'id'                => 'archive_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'medix'),
            'default'           => true,
        ),  
        array(
            'subtitle'          => esc_html__('Show author.', 'medix'),
            'id'                => 'archive_author',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'medix'),
            'default'           => true,
        ), 
        array(
            'subtitle'          => esc_html__('Show categories.', 'medix'),
            'id'                => 'archive_categories',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'medix'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'medix'),
            'id'                => 'archive_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'medix'),
            'default'           => false,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'medix'),
            'id'                => 'archive_comment',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'medix'),
            'default'           => false,
        ),
        array(
            'subtitle'          => esc_html__('Excerpt length enter by ( number of word )', 'medix'),
            'id'                => 'excerpt_length',
            'type'              => 'text',
            'default'           => 20,
            'title'             => esc_html__('Excerpt length', 'medix'),
        ),
    )
));

/* Single */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single', 'medix'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'single_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for single...', 'medix'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'medix'),
            'id'                => 'single_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'medix'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show author.', 'medix'),
            'id'                => 'single_author',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'medix'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show categories.', 'medix'),
            'id'                => 'single_categories',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'medix'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'medix'),
            'id'                => 'single_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'medix'),
            'default'           => false,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'medix'),
            'id'                => 'single_comment',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'medix'),
            'default'           => false,
        ),
        
        array(
            'title' => esc_html__('ENTRY FOOTER', 'medix'),
            'id'   => 'entry-footer-panel',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'medix'),
            'id'                => 'single_footer_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'medix'),
            'default'           => false,
        ),
        array(
            'subtitle'          => esc_html__('Show social sharing', 'medix'),
            'id'                => 'single_footer_social',
            'type'              => 'switch',
            'title'             => esc_html__('Social sharing', 'medix'),
            'default'           => false,
        ),
        array(
            'title' => esc_html__('COMMENT FORM', 'medix'),
            'id'   => 'comment-form-panel',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle'          => esc_html__('Show comment form', 'medix'),
            'id'                => 'single_comment_form',
            'type'              => 'switch',
            'title'             => esc_html__('Comment form', 'medix'),
            'default'           => true,
        ),
        array(
            'title' => esc_html__('POST NAVIGATION', 'medix'),
            'id'   => 'post-nav-panel',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle'          => esc_html__('Show post navigation', 'medix'),
            'id'                => 'single_post_nav',
            'type'              => 'switch',
            'title'             => esc_html__('Post navigation', 'medix'),
            'default'           => true,
        ),
    )
));

/**
 * events
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single events', 'medix'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
         array(
            'id'                => 'event_single_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for single...', 'medix'),
            'default'           => 'full',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
    )
));

/**
 * gallery archive
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Gallery Archive', 'medix'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'gallery_archive_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for gallery archive post type', 'medix'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle' => esc_html__('Select gallery column', 'medix'),
            'id' => 'gallry_columns',
            'type' => 'select',
            'title' => esc_html__('Gallery Columns', 'medix'),
            'options'=>array(
                'col-xs-12 col-sm-12 col-md-12'=> esc_html__('1 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-6'=> esc_html__('2 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-4'=> esc_html__('3 Columns','medix'),
            ),
            'default' => 'col-xs-12 col-sm-12 col-md-12',
            'required'          => array( 'gallery_archive_layout', '=', array('left','right') )
        ),
        array(
            'subtitle' => esc_html__('Select gallery column', 'medix'),
            'id' => 'gallry_columns_full',
            'type' => 'select',
            'title' => esc_html__('Gallery Columns', 'medix'),
            'options'=>array(
                'col-xs-12 col-sm-12 col-md-12'=> esc_html__('1 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-6'=> esc_html__('2 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-4'=> esc_html__('3 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-3'=> esc_html__('4 Columns','medix'),
            ),
            'default' => 'col-xs-12 col-sm-12 col-md-12',
            'required'          => array( 'gallery_archive_layout', '=', 'full' )
        ),
        array(
            'subtitle' => esc_html__('Enter the number of word for display short desciption', 'medix'),
            'id' => 'gallery_word_number',
            'type' => 'text',
            'title' => esc_html__('Number description word display', 'medix'),
            'default' => '23',
        ),
         
    )
));

/**
 * gallery single
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Gallery Single', 'medix'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Select gallery single layout', 'medix'),
            'id' => 'gallery_single_layout',
            'type' => 'select',
            'title' => esc_html__('Gallery Single layout', 'medix'),
            'options'=>array(
                'layout1'=> esc_html__('Layout 1','medix'),
                'layout2'=> esc_html__('Layout 2','medix'),
                'layout3'=> esc_html__('Layout 3','medix'),
            ),
            'default' => 'layout1',
        ),
    )
));
 
/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'medix'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'title'     => esc_html__('Is dark', 'medix'),
            'subtitle'  => esc_html__('Dark layout style', 'medix'),
            'id'        => 'is_dark',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'subtitle' => esc_html__('Set primary color.', 'medix'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'medix'),
            'default' => '#01b2b7',
        ),
        array(
            'subtitle' => esc_html__('Set secondary color.', 'medix'),
            'id' => 'second_color',
            'type' => 'color',
            'title' => esc_html__('Secondary Color', 'medix'),
            'default' => '#cb5151',
        ),
        array(
            'id'       => 'link_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Primary Links Color', 'medix' ),
            'subtitle' => esc_html__( 'Select Primary Links Color Option', 'medix' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'default'           => array(
                'regular'           => '#01b2b7',
                'hover'             => 'rgba(1, 178, 183, 0.6)',
            ),
        ),
          
    )
));
 

/**
 * Typography
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'medix'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body,body.ds'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h2'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h3'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'), 
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h4'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h5'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('h6'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
        )
    )
));
 
/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'google-font-selector-1');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'medix'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'medix'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  =>  $custom_font_1,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'medix'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'medix'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'medix'),
            'validate' => 'no_html',
            'default' => '',
        )
        
    )
));

/**
 * Footer
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'medix'),
    'icon' => 'el el-website',
    'fields' => array()
));

/* footer top. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'medix'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'title'     => esc_html__('Disable', 'medix'),
            'subtitle'  => esc_html__('Disable footer top', 'medix'),
            'id'        => 'disable_footer_top',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'id'                => 'footer_top_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for footer top', 'medix'),
            'default'           => 'layout-1',
            'type'              => 'image_select',
            'options'           => array(
                                        'layout-1' => get_template_directory_uri().'/assets/images/footer-top/layout1.png',
                                        'layout-2' => get_template_directory_uri().'/assets/images/footer-top/layout2.png',
                                        'layout-3' => get_template_directory_uri().'/assets/images/footer-top/layout3.png',
                                    ),
            'required'          => array('disable_footer_top','=',0)
        ),
        array(
            'id'       => 'footer-top-column-layout1',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'medix' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'medix' ),
            'default'    => 3,
            'options'  => array(
                1 => esc_html__('1', 'medix' ),
                2 => esc_html__('2', 'medix' ),
                3 => esc_html__('3', 'medix' ),
            ),
            'required'  => array('footer_top_layout','=','layout-1')
        ),
        array(
            'id'       => 'footer-top-column-layout2',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'medix' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'medix' ),
            'default'    => 3,
            'options'  => array(
                1 => esc_html__('1', 'medix' ),
                2 => esc_html__('2', 'medix' ),
                3 => esc_html__('3', 'medix' ),
            ),
            'required'  => array('footer_top_layout','=','layout-2')
        ),
        array(
            'id'       => 'footer-top-column-layout3',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'medix' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'medix' ),
            'default'    => 4,
            'options'  => array(
                1 => esc_html__('1', 'medix' ),
                2 => esc_html__('2', 'medix' ),
                3 => esc_html__('3', 'medix' ),
                4 => esc_html__('4', 'medix' ),
            ),
            'required'  => array('footer_top_layout','=','layout-3')
        ),
        array(
            'title'             => esc_html__('Select Footer top Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
            'id'                => 'footer_top_logo',
            'type'              => 'media',
            'url'               => true,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/footer-logo.png'
            ),
            'required'          => array('footer_top_layout','=','layout-1')
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'medix'),
            'id'                => 'ft_logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Max Height', 'medix'),
            'required'          => array('footer_top_layout','=','layout-1')
        ),
        array(
            'title'             => esc_html__('Footer top logo url', 'medix'),
            'subtitle'          => esc_html__('Enter the other url, if empty then use site home url', 'medix'),
            'id'                => 'footer_top_logo_url',
            'type'              => 'text',
            'required'          => array('footer_top_layout','=','layout-1')
        ), 
        array(
            'id'                => 'footer_top_background_color',
            'type'              => 'color_rgba',
            'title'             => esc_html__( 'Background color overlay', 'medix' ),
            'output'   => array(
                'background-color' => 'footer .footer-top .bg-overlay,.footer-top.layout-2 .bg-overlay'
            ),
            'required'  => array('disable_footer_top','=',0)
        ),
        
        array(
            'title'             => esc_html__('Background', 'medix'),
            'subtitle'          => esc_html__('Footer top background', 'medix'),
            'id'                => 'footer_top_background',
            'type'              => 'background',
            'output'            => array( 'footer .footer-top,.footer-top.layout-1,.footer-top.layout-2,.footer-top.layout-3' ),
            'required'  => array('disable_footer_top','=',0)
        ),
         
        array(
            'title'             => esc_html__('Padding', 'medix'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'medix'),
            'id'                => 'footer_top_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
            'output'            => array( 'footer .footer-top,.footer-top.layout-1,.footer-top.layout-2,.footer-top.layout-3' ),
            'required'  => array('disable_footer_top','=',0)
        ),
         
        array(
            'subtitle' => esc_html__('Title color.', 'medix'),
            'id' => 'footer_top_title_color',
            'type' => 'color',
            'title' => esc_html__('Title Color', 'medix'),
            'output'    => array('.footer-top .wg-title,.footer-top.layout-1 .wg-title,.footer-top.layout-2 .wg-title,.footer-top.layout-3 .wg-title'),
            'required'          => array('disable_footer_top','=',0)
        ),
        array(
            'subtitle' => esc_html__('Text color.', 'medix'),
            'id' => 'footer_top_text_color',
            'type' => 'color',
            'title' => esc_html__('Text Color', 'medix'),
            'output'    => array('.footer-top,.footer-top p,.footer-top .widget_text,.footer-top.layout-1,.footer-top.layout-2,.footer-top.layout-3'),
            'required'          => array('disable_footer_top','=',0)
        ),
        array(
            'subtitle' => esc_html__('Border color, Form control color', 'medix'),
            'id' => 'control-form-color',
            'type' => 'color',
            'title' => esc_html__('Border color, Form control color', 'medix'),
            'output'    => array(
                'color' => '.footer-top.layout-1 textarea, .footer-top.layout-1 input[type="text"], .footer-top.layout-1 input[type="email"],.footer-top.layout-2 textarea, .footer-top.layout-2 input[type="text"], .footer-top.layout-2 input[type="email"],.footer-top.layout-3 textarea, .footer-top.layout-3 input[type="text"], .footer-top.layout-3 input[type="email"]',
                'border-color' => '.footer-top.layout-1 textarea, .footer-top.layout-1 input[type="text"], .footer-top.layout-1 input[type="email"],.footer-top.layout-2 textarea, .footer-top.layout-2 input[type="text"], .footer-top.layout-2 input[type="email"],.footer-top.layout-3 textarea, .footer-top.layout-3 input[type="text"], .footer-top.layout-3 input[type="email"],.footer-top.layout-3 ul li,.footer-top.layout-3 ul li:last-child',
            ),
            'required'          => array('disable_footer_top','=',0)
        ), 
        array(
            'id'       => 'footer_top_link_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Links Color', 'medix' ),
            'subtitle' => esc_html__( 'Select Links Color Option', 'medix' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'output'   => array( '.footer-top a:not(.color-bg-icon),.footer-top ul li a,.footer-top a.author,.footer-top.layout-2 a,.footer-top.layout-3 a,.footer-top.layout-3 .cms-recent-post .widget-recent-item a' ),
            'required'          => array('disable_footer_top','=',0)
        ),
        array(
            'id'      => 'individual_social_on_footer_top_layout1',
            'type'    => 'sorter',
            'title'   => 'Footer socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'google' => esc_html__('Google', 'medix'),
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                ),
                'disabled' => array(
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'),
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'          => array('footer_top_layout','=','layout-1')
        ),
        array(
            'id'      => 'individual_social_on_footer_top_layout3',
            'type'    => 'sorter',
            'title'   => 'Footer socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'),
                    
                ),
                'disabled' => array(
                    'google' => esc_html__('Google', 'medix'),
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'          => array('footer_top_layout','=','layout-3')
        ),
    )
));

/* footer bottom. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Bottom', 'medix'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'footer_bottom_layout',
            'title'             => esc_html__('Layouts', 'medix'),
            'subtitle'          => esc_html__('select a layout for footer bottom', 'medix'),
            'default'           => 'layout-1',
            'type'              => 'image_select',
            'options'           => array(
                                        'layout-1' => get_template_directory_uri().'/assets/images/footer-bottom/layout1.png',
                                        'layout-2' => get_template_directory_uri().'/assets/images/footer-bottom/layout2.png',
                                        'layout-3' => get_template_directory_uri().'/assets/images/footer-bottom/layout3.png',
                                        'layout-4' => get_template_directory_uri().'/assets/images/footer-bottom/layout4.png',
                                    )
        ),
        array(
            'title'     => esc_html__('Normal font', 'medix'),
            'id'        => 'fb_layout1_normal_font',
            'type'      => 'switch',
            'default'   => false,
            'required'          => array('footer_bottom_layout','=','layout-1')
        ),
        array(
            'title'             => esc_html__('Select Footer Bottom Logo', 'medix'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
            'id'                => 'footer_bottom_logo',
            'type'              => 'media',
            'url'               => true,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/footer-bottom-logo.png'
            ),
            'required'          => array('footer_bottom_layout','=',array('layout-2','layout-3','layout-4'))
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'medix'),
            'id'                => 'fb_logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Max Height', 'medix'),
            'required'          => array('footer_bottom_layout','=',array('layout-2','layout-3','layout-4'))
        ),
        array(
            'title'             => esc_html__('Footer bottom logo url', 'medix'),
            'subtitle'          => esc_html__('Enter the other url, if empty then use site home url', 'medix'),
            'id'                => 'footer_bottom_logo_url',
            'type'              => 'text',
            'required'          => array('footer_bottom_layout','=',array('layout-2','layout-3','layout-4'))
        ),
        
        array(
            'id'       => 'footer-bottom-copyright-text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Footer bottom copyright text', 'medix' ),
            'subtitle' => esc_html__( 'Input the html content', 'medix' ),
            'validate' => 'html_custom',
            'default'  => wp_kses('&copy; copyright 2017 all rights reserved',true),
            'allowed_html'=> array(
                'a' => array(
                    'class' => array(),  
                    'href' => array(),
                    'title' => array()
                ),
                'span' => array(
                    'class' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            ),
            
        ),
        array(
            'title'             => esc_html__('Background', 'medix'),
            'subtitle'          => esc_html__('Footer bottom background.', 'medix'),
            'id'                => 'footer_bottom_background',
            'type'              => 'background',
            'output'            => array( '.footer-bottom,.footer-bottom.layout-1,.footer-bottom.layout-2,.footer-bottom.layout-3' ),
            'required'          => array('footer_bottom_layout','=',array('layout-1','layout-2','layout-3'))
        ),
        array(
            'title'     => esc_html__('Gradient Background', 'medix'),
            'subtitle'  => esc_html__('Gradient Background', 'medix'),
            'id'        => 'fb_layout4_bg_gradient',
            'type'      => 'switch',
            'default'   => true,
            'required'          => array('footer_bottom_layout','=','layout-4')
        ),
        array(
            'id'       => 'fb_bg_gradient_color',
            'type'     => 'color_gradient',
            'title'    => esc_html__('Gradient background color option', 'medix'),
            'validate' => 'color',
            'default'  => array(
                'from' => '',
                'to'   => '', 
            ),
            'required'          => array('fb_layout4_bg_gradient','=',1)
        ),
        array(
            'title'             => esc_html__('Background', 'medix'),
            'subtitle'          => esc_html__('Footer bottom background.', 'medix'),
            'id'                => 'footer_bottom_layout_4_background',
            'type'              => 'background',
            'output'            => array( '.footer-bottom.layout-4' ),
            'required'          => array('fb_layout4_bg_gradient','=',0)
        ),
        array(
            'id'       => 'footer_bottom_link_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Links Color', 'medix' ),
            'subtitle' => esc_html__( 'Select Links Color Option', 'medix' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'output'   => array( '.footer-bottom a,.footer-bottom ul li a,.footer-bottom.layout-1 a,.footer-bottom.layout-2 a,.footer-bottom.layout-3 a,.footer-bottom.layout-4 a' ),
        ),
        array(
            'subtitle' => esc_html__('Text color.', 'medix'),
            'id' => 'footer_bottom_text_color',
            'type' => 'color',
            'title' => esc_html__('Text Color', 'medix'),
            'output'    => array('.footer-bottom,.footer-bottom.layout-1,.footer-bottom.layout-2,.footer-bottom.layout-3,.footer-bottom.layout-4,.footer-bottom p,.footer-bottom span')
        ),
        array(
            'title'             => esc_html__('Padding', 'medix'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'medix'),
            'id'                => 'footer_bottom_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
            'output'            => array( '.footer-bottom,.footer-bottom.layout-1,.footer-bottom.layout-2,.footer-bottom.layout-3,.footer-bottom.layout-4' )
        ),
         
        array(
            'id'      => 'individual_social_on_footer_bottom_layout4',
            'type'    => 'sorter',
            'title'   => 'Footer socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'medix'),
                    'twitter'     => esc_html__('Twitter', 'medix'),
                    'google' => esc_html__('Google', 'medix'),
                    'linkedin'     => esc_html__('Linkedin', 'medix'),
                    'pinterest' => esc_html__('Pinterest', 'medix'), 
                ),
                'disabled' => array(
                    'youtube' => esc_html__('Youtube', 'medix'),
                    'rss' => esc_html__('Rss', 'medix'),
                    'instagram' => esc_html__('Instagram', 'medix'),
                    'skype' => esc_html__('Skype', 'medix'),
                    'vimeo' => esc_html__('Vimeo', 'medix'),
                    'yelp' => esc_html__('Yelp', 'medix'),
                    'tumblr' => esc_html__('Tumblr', 'medix'),
                    'behance' => esc_html__('Behance', 'medix'),
                    'dribbble' => esc_html__('Dribbble', 'medix'),
                )
            ),
            'required'          => array('footer_bottom_layout','=','layout-4')
        ),
    )
));


/**
 * Shop option
 * 
 * extra css for customer.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Woocommerces', 'medix'),
    'icon' => 'el el-shopping-cart',
    'fields' => array(
       
        array(
            'id'                => 'woo_loop_layout',
            'title'             => esc_html__('Shop catalog layout', 'medix'),
            'subtitle'          => esc_html__('select a layout for catalog shop page', 'medix'),
            'default'           => 'left',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle' => esc_html__('Select catalog product column', 'medix'),
            'id' => 'shop_columns',
            'type' => 'select',
            'title' => esc_html__('Products Columns', 'medix'),
            'options'=>array(
                'col-xs-12 col-sm-6 col-md-6'=> esc_html__('2 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-4'=> esc_html__('3 Columns','medix'),
            ),
            'default' => 'col-xs-12 col-sm-6 col-md-6',
            'required'          => array( 'woo_loop_layout', '=', array('left','right') )
        ),
        array(
            'subtitle' => esc_html__('Select catalog product column', 'medix'),
            'id' => 'shop_columns_full',
            'type' => 'select',
            'title' => esc_html__('Products Columns', 'medix'),
            'options'=>array(
                'col-xs-12 col-sm-6 col-md-6'=> esc_html__('2 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-4'=> esc_html__('3 Columns','medix'),
                'col-xs-12 col-sm-6 col-md-3'=> esc_html__('4 Columns','medix'),
            ),
            'default' => 'col-xs-12 col-sm-6 col-md-4',
            'required'          => array( 'woo_loop_layout', '=', 'full' )
        ),
        array(
            'subtitle' => esc_html__('Enter the number of products you want to show on catalog layout', 'medix'),
            'id' => 'shop_products',
            'type' => 'text',
            'title' => esc_html__('Number Product Per Page', 'medix'),
            'default' => '12',
        ),
        array(
            'id'                => 'woo_single_layout',
            'title'             => esc_html__('Product single layout', 'medix'),
            'subtitle'          => esc_html__('select a layout for single product page', 'medix'),
            'default'           => 'left',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
          
    )
));
 

/* Social Media */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Social Media', 'medix'),
    'icon' => 'el el-twitter',
    'class' => 'social-media',
    'subsection' => false,
    'fields' => array(
        array(
            'id' => 'twitter',
            'type' => 'text',
            'title' => esc_html__('Twitter Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'facebook',
            'type' => 'text',
            'title' => esc_html__('Facebook Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'google',
            'type' => 'text',
            'title' => esc_html__('Google Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'youtube',
            'type' => 'text',
            'title' => esc_html__('Youtube Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'rss',
            'type' => 'text',
            'title' => esc_html__('Rss Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'instagram',
            'type' => 'text',
            'title' => esc_html__('Instagram Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'skype',
            'type' => 'text',
            'title' => esc_html__('Skype Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'linkedin',
            'type' => 'text',
            'title' => esc_html__('Linkedin', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'pinterest',
            'type' => 'text',
            'title' => esc_html__('Pinterest Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'vimeo',
            'type' => 'text',
            'title' => esc_html__('Vimeo Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'yelp',
            'type' => 'text',
            'title' => esc_html__('Yelp Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'tumblr',
            'type' => 'text',
            'title' => esc_html__('Tumblr Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'behance',
            'type' => 'text',
            'title' => esc_html__('Behance Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        array(
            'id' => 'dribbble',
            'type' => 'text',
            'title' => esc_html__('Dribbble Url', 'medix'),
            'subtitle' => '',
            'default' => '#'
        ),
        
    )
));
/* 404 */
Redux::setSection($opt_name, array(
    'title' => esc_html('404'),
    'icon' => 'el-icon-adjust',
    'class' => 'error-404',
    'subsection' => false,
    'fields' => array(
        array(
            'title'             => esc_html__('404 Background', 'medix'),
            'id'                => '404_background',
            'type'              => 'background',
            'preview'           => false,
            'default'  => array(
                'background-color' => '#f3f4f5',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
                'background-position' => 'center center',
                'background-image' => get_template_directory_uri().'/assets/images/not-found.jpg',
            ),
            'output'            => array( '.error404 .site-content' ),
        ),
    )
));
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'medix'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'medix'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'medix'),
            'default' => false
        )
    )
));