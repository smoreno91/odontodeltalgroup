<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

add_action('admin_init', 'medix_meta_boxs');

MetaFramework::init();

function medix_meta_boxs()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id' => '_page_main_options',
        'label' => esc_html__('Page Setting', 'medix'),
        'post_type' => 'page',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => false,
        'sections' => array(
            array(
                'title' => esc_html__('Header', 'medix'),
                'id' => 'tab-page-header',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id' => 'header_layout',
                        'title' => esc_html__('Layouts', 'medix'),
                        'subtitle' => esc_html__('select a layout for header', 'medix'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri() . '/assets/images/header/h-page-default.png',
                            'layout1' => get_template_directory_uri().'/assets/images/header/layout-1.png',
                            'layout2' => get_template_directory_uri().'/assets/images/header/layout-2.png',
                            'layout3' => get_template_directory_uri().'/assets/images/header/layout-3.png',
                            'layout4' => get_template_directory_uri().'/assets/images/header/layout-4.png',
                            'layout5' => get_template_directory_uri().'/assets/images/header/layout-5.png',
                        ),
                    ),
                    array(
                        'subtitle' => esc_html__('Header transparent', 'medix'),
                        'id' => 'header_transparent',
                        'type' => 'switch',
                        'title' => esc_html__('Header transparent', 'medix'),
                        'default' => false,
                    ),
                    array(
                        'subtitle' => esc_html__('Show header top', 'medix'),
                        'id' => 'show_header_top',
                        'type' => 'switch',
                        'title' => esc_html__('Show header top', 'medix'),
                        'default' => false,
                    ),    
                     
                    array(
                        'id' => 'header_menu',
                        'type' => 'select',
                        'title' => esc_html__('Select Menu', 'medix'),
                        'subtitle' => esc_html__('custom menu for current page', 'medix'),
                        'options' => medix_get_nav_menu(),
                        'default' => '',
                    ),
                )
            ),
            array(
                'title' => esc_html__('Page Title & BC', 'medix'),
                'id' => 'tab-page-title-bc',
                'icon' => 'el el-map-marker',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Disable Page title for current page.', 'medix'),
                        'id' => 'disable_page_title',
                        'type' => 'switch',
                        'title' => esc_html__('Disable', 'medix'),
                        'default' => false,
                    ),
                    array(
                        'id' => 'page_title_layout',
                        'title' => esc_html__('Layouts', 'medix'),
                        'subtitle' => esc_html__('select a layout for page title', 'medix'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri().'/assets/images/pagetitle/default.png',
                            '1' => get_template_directory_uri().'/assets/images/pagetitle/style1.png',
                            '2' => get_template_directory_uri().'/assets/images/pagetitle/style2.png',
                            '3' => get_template_directory_uri().'/assets/images/pagetitle/style3.png',
                            '4' => get_template_directory_uri().'/assets/images/pagetitle/style4.png',
                            '5' => get_template_directory_uri().'/assets/images/pagetitle/style5.png',
                            '6' => get_template_directory_uri().'/assets/images/pagetitle/style6.png',
                        ),
                        'required' => array( 0 => 'disable_page_title', 1 => '=', 2 => 0 )
                    ),
                    array(
                        'id' => 'page_title_text',
                        'type' => 'text',
                        'title' => esc_html__('Custom Title', 'medix'),
                        'subtitle' => esc_html__('Custom current page title.', 'medix'),
                        'required' => array( 0 => 'disable_page_title', 1 => '=', 2 => 0 )
                    ),
                )
            ),
            array(
                'title' => esc_html__('Content', 'medix'),
                'id' => 'tab-content',
                'icon' => 'el el-pencil',
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
                    ),
                    array(
                        'subtitle' => esc_html__('Gray light background', 'medix'),
                        'id' => 'gray_light_bg',
                        'type' => 'switch',
                        'title' => esc_html__('Gray light background', 'medix'),
                        'default' => false,
                    ),
                )
            ),
            array(
                'title' => esc_html__('Footer top', 'medix'),
                'id' => 'tab-page-footer-top',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Disable footer top for current page.', 'medix'),
                        'id' => 'disable_footer_top',
                        'type' => 'switch',
                        'title' => esc_html__('Disable', 'medix'),
                        'default' => false,
                    ),
                    array(
                        'id' => 'footer_top_layout',
                        'title' => esc_html__('Layouts', 'medix'),
                        'subtitle' => esc_html__('select a layout for footer top', 'medix'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri() . '/assets/images/pagetitle/default.png',
                            'layout-1' => get_template_directory_uri().'/assets/images/footer-top/layout1.png',
                            'layout-2' => get_template_directory_uri().'/assets/images/footer-top/layout2.png',
                            'layout-3' => get_template_directory_uri().'/assets/images/footer-top/layout3.png',
                        ),
                        'required' => array( 0 => 'disable_footer_top', 1 => '=', 2 => 0 )
                    ),
                    array(
                        'title'             => esc_html__('Select Footer top Logo', 'medix'),
                        'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
                        'id'                => 'footer_top_logo',
                        'type'              => 'media',
                        'url'               => true,
                    ),
                )
            ),
            array(
                'title' => esc_html__('Footer bottom', 'medix'),
                'id' => 'tab-page-footer-bottom',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id' => 'footer_bottom_layout',
                        'title' => esc_html__('Layouts', 'medix'),
                        'subtitle' => esc_html__('select a layout for footer bottom', 'medix'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '' => get_template_directory_uri() . '/assets/images/pagetitle/default.png',
                            'layout-1' => get_template_directory_uri().'/assets/images/footer-bottom/layout1.png',
                            'layout-2' => get_template_directory_uri().'/assets/images/footer-bottom/layout2.png',
                            'layout-3' => get_template_directory_uri().'/assets/images/footer-bottom/layout3.png',
                            'layout-4' => get_template_directory_uri().'/assets/images/footer-bottom/layout4.png',
                        ),
                    ),
                    array(
                        'subtitle' => esc_html__('Select Style', 'medix'),
                        'id' => 'footer_bottom_style',
                        'type' => 'select',
                        'title' => esc_html__('Footer bottom style', 'medix'),
                        'options'=>array(
                            ''=> esc_html__('Default','medix'),
                            'ls'=> esc_html__('Light','medix'),
                            'cs'=> esc_html__('Dark','medix'),
                        ),
                        'default' => '',
                        'required'          => array('footer_bottom_layout','=',array('layout-1'))
                    ),
                     
                )
            ), 
            array(
                'title' => esc_html__('Custom', 'medix'),
                'id' => 'tab-page-custom',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'title'             => esc_html__('Select Logo', 'medix'),
                        'subtitle'          => esc_html__('Select an image file for your logo.', 'medix'),
                        'id'                => 'main_logo',
                        'type'              => 'media',
                        'url'               => false,
                    ),
                    array(
                        'title'             => esc_html__('Select sticky Logo', 'medix'),
                        'subtitle'          => esc_html__('Select an image file for your sticky logo.', 'medix'),
                        'id'                => 'sticky_logo',
                        'type'              => 'media',
                        'url'               => false,
                    ),
                    array(
                        'subtitle' => esc_html__('Set primary color.', 'medix'),
                        'id' => 'primary_color',
                        'type' => 'color',
                        'title' => esc_html__('Primary Color', 'medix'),
                    ),
                    array(
                        'subtitle' => esc_html__('Set secondary color.', 'medix'),
                        'id' => 'second_color',
                        'type' => 'color',
                        'title' => esc_html__('Secondary Color', 'medix'),
                    ), 
                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Links Color', 'medix' ),
                        'subtitle' => esc_html__( 'Select Links Color Option', 'medix' ),
                        'regular'   => true,
                        'hover'     => true,
                        'active'    => false,
                        'visited'   => false,
                    ),
                    
                )
            ),
            
        )
    ));

    /** post options */
    MetaFramework::setMetabox(array(
        'id' => '_page_post_format_options',
        'label' => esc_html__('Post Format', 'medix'),
        'post_type' => 'post',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'id' => 'opt-video-type',
                        'type' => 'select',
                        'title' => esc_html__('Select Video Type', 'medix'),
                        'subtitle' => esc_html__('Local video, Youtube, Vimeo', 'medix'),
                        'options' => array(
                            'local' => esc_html__('Upload', 'medix'),
                            'youtube' => esc_html__('Youtube', 'medix'),
                            'vimeo' => esc_html__('Vimeo', 'medix'),
                        )
                    ),
                    array(
                        'id' => 'otp-video-local',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Local Video', 'medix'),
                        'subtitle' => esc_html__('Upload video media using the WordPress native uploader', 'medix'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'opt-video-youtube',
                        'type' => 'text',
                        'title' => esc_html__('Youtube', 'medix'),
                        'subtitle' => esc_html__('Load video from Youtube.', 'medix'),
                        'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'medix'),
                        'required' => array('opt-video-type', '=', 'youtube')
                    ),
                    array(
                        'id' => 'opt-video-vimeo',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'medix'),
                        'subtitle' => esc_html__('Load video from Vimeo.', 'medix'),
                        'placeholder' => esc_html__('https://vimeo.com/155673893', 'medix'),
                        'required' => array('opt-video-type', '=', 'vimeo')
                    ),
                    array(
                        'id' => 'otp-video-thumb',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Video Thumb', 'medix'),
                        'subtitle' => esc_html__('Upload thumb media using the WordPress native uploader', 'medix'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'otp-audio',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Audio Media', 'medix'),
                        'subtitle' => esc_html__('Upload audio media using the WordPress native uploader', 'medix'),
                    ),
                    array(
                        'id' => 'opt-gallery',
                        'type' => 'gallery',
                        'title' => esc_html__('Add/Edit Gallery', 'medix'),
                        'subtitle' => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'medix'),
                    ),
                    array(
                        'id' => 'opt-quote-title',
                        'type' => 'text',
                        'title' => esc_html__('Quote Title', 'medix'),
                        'subtitle' => esc_html__('Quote title or quote name...', 'medix'),
                    ),
                    array(
                        'id' => 'opt-quote-sub-title',
                        'type' => 'text',
                        'title' => esc_html__('Quote Sub Title', 'medix'),
                        'subtitle' => esc_html__('Quote sub title or quote position...', 'medix'),
                    ),
                    array(
                        'id' => 'opt-quote-content',
                        'type' => 'textarea',
                        'title' => esc_html__('Quote Content', 'medix'),
                    ),
                    array(
                        'id' => 'opt-status',
                        'type' => 'media',
                        'title' => esc_html__('Add/Edit Status image', 'medix'),
                        'subtitle' => esc_html__('uploading new images using the WordPress native uploader', 'medix'),
                    ),
                )
            ),
        )
    ));
    /** Services options */
    MetaFramework::setMetabox(array(
        'id' => '_page_services_format_options',
        'label' => esc_html__('Services Option', 'medix'),
        'post_type' => 'services',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'title'             => esc_html__('Select an image icon', 'medix'),
                        'subtitle'          => esc_html__('Select an image icon file for this service.', 'medix'),
                        'id'                => 'icon_image',
                        'type'              => 'media',
                        'url'               => false,
                    ),
                )
            ),
             
        )
    ));
    /** Team options */
    MetaFramework::setMetabox(array(
        'id' => '_page_team_format_options',
        'label' => esc_html__('Team Option', 'medix'),
        'post_type' => 'team',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'id' => 'opt_team_position',
                        'type' => 'text',
                        'title' => esc_html__('Position', 'medix'),
                        'subtitle' => esc_html__('Enter the position for this team', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_link_1',
                        'type' => 'text',
                        'title' => esc_html__('Social link 1', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 1', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_icon_class_1',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 1', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 1 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_link_2',
                        'type' => 'text',
                        'title' => esc_html__('Social link 2', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 2', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_icon_class_2',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 2', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 2 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_link_3',
                        'type' => 'text',
                        'title' => esc_html__('Social link 3', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 3', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_icon_class_3',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 3', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 3 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_link_4',
                        'type' => 'text',
                        'title' => esc_html__('Social link 4', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 4', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_icon_class_4',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 4', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 4 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_link_5',
                        'type' => 'text',
                        'title' => esc_html__('Social link 5', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 5', 'medix'),
                    ),
                    array(
                        'id' => 'opt_team_social_icon_class_5',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 5', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 5 (facebook,twitter,google...)', 'medix'),
                    ),
                )
            ),
             
        )
    ));
    MetaFramework::setMetabox(array(
        'id' => '_page_gallery_format_options',
        'label' => esc_html__('Gallery Option', 'medix'),
        'post_type' => 'gallery',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Select gallery single layout', 'medix'),
                        'id' => 'opt_gallery_single_layout',
                        'type' => 'select',
                        'title' => esc_html__('Gallery Single layout', 'medix'),
                        'options'=>array(
                            'layout1'=> esc_html__('Layout 1','medix'),
                            'layout2'=> esc_html__('Layout 2','medix'),
                            'layout3'=> esc_html__('Layout 3','medix'),
                        ),
                    ),
                    array(
                        'title' => esc_html__('CLIENT', 'medix'),
                        'id'   => 'gallery_panel_client',
                        'type' => 'info',
                        'style' => 'success',
                    ),
                    array(
                        'title'             => esc_html__('Select avatar', 'medix'),
                        'id'                => 'opt_gallery_client_avatar',
                        'type'              => 'media',
                        'url'               => false,
                    ),
                    array(
                        'id' => 'opt_gallery_client_name',
                        'type' => 'text',
                        'title' => esc_html__('Client name', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_client_position',
                        'type' => 'text',
                        'title' => esc_html__('Client Position', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_client_desc',
                        'type' => 'textarea',
                        'title' => esc_html__('Client Description', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_link_1',
                        'type' => 'text',
                        'title' => esc_html__('Social link 1', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 1', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_icon_class_1',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 1', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 1 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_link_2',
                        'type' => 'text',
                        'title' => esc_html__('Social link 2', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 2', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_icon_class_2',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 2', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 2 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_link_3',
                        'type' => 'text',
                        'title' => esc_html__('Social link 3', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 3', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_icon_class_3',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 3', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 3 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_link_4',
                        'type' => 'text',
                        'title' => esc_html__('Social link 4', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 4', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_icon_class_4',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 4', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 4 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_link_5',
                        'type' => 'text',
                        'title' => esc_html__('Social link 5', 'medix'),
                        'subtitle' => esc_html__('Enter the social link 5', 'medix'),
                    ),
                    array(
                        'id' => 'opt_gallery_social_icon_class_5',
                        'type' => 'text',
                        'title' => esc_html__('Social icon class 5', 'medix'),
                        'subtitle' => esc_html__('Enter the social icon class 5 (facebook,twitter,google...)', 'medix'),
                    ),
                    array(
                        'title' => esc_html__('Services', 'medix'),
                        'id'   => 'gallery_panel_services',
                        'type' => 'info',
                        'style' => 'success',
                    ),
                    array(
                        'id'               => 'opt_gallery_service_content',
                        'type'             => 'editor',
                        'title'            => esc_html__('Service contentt', 'medix'), 
                        'subtitle'         => esc_html__('Subtitle text would go here.', 'medix'),
                        'args'   => array(
                            'teeny'            => true,
                            'textarea_rows'    => 5
                        )
                    )
                )
            ),
             
        )
    ));
}