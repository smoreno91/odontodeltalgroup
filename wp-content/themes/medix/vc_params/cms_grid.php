<?php
 
$params = array( 
    array(
        'type' => 'checkbox',
        'heading' => esc_html__("Show pagination", 'medix'),
        'param_name' => 'show_patination',
        'value' => array(
            'Yes' => true
        ),
        'std' => false,
        'dependency' => array(
            'element' => 'layout',
            'value' => array(
                'basic',
            ),
        ),
        //'template' => array('cms_grid.php','cms_grid--blog2.php','cms_grid--blog3.php','cms_grid--blog-department.php','cms_grid--gallery.php'),
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__("Show Read more", 'medix'),
        'param_name' => 'show_read_more',
        'value' => array(
            'Yes' => true
        ),
        'std' => true,
        'template' => array('cms_grid.php','cms_grid--blog2.php','cms_grid--blog3.php','cms_grid--blog-department.php','cms_grid--gallery.php'),
    ),
    array(
        'type' => 'dropdown',
    	'heading' => esc_html__( 'Read more background color', 'medix' ),
    	'value' => array(
    		esc_html__( 'Primary background', 'medix' ) => 'bgprimary',
    		esc_html__( 'Secondary background', 'medix' ) => 'bgsecond',
    	),
        "std"       => 'bgprimary',
    	'param_name' => 'btn_bg_color',
    	'template' => array('cms_grid.php','cms_grid--blog2.php','cms_grid--blog3.php','cms_grid--blog-department.php','cms_grid--gallery.php'),   
    ),
    array(
        'type' => 'dropdown',
    	'heading' => esc_html__( 'Layout', 'medix' ),
    	'value' => array(
    		esc_html__( 'Default', 'medix' ) => 'default',
    		esc_html__( 'Layout1', 'medix' ) => 'layout1',
            esc_html__( 'Layout2', 'medix' ) => 'layout2',
    	),
        "std"       => 'default',
    	'param_name' => 'gallery_layout',
    	'template' => array('cms_grid--gallery.php'),   
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__("Show Social Sharing", 'medix'),
        'param_name' => 'show_social_sharing',
        'value' => array(
            'Yes' => true
        ),
        'std' => true,
        'template' => array('cms_grid.php'),
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__("Filter align center", 'medix'),
        'param_name' => 'filter_align_center',
        'value' => array(
            'Yes' => true
        ),
        'std' => false,
        'template' => array('cms_grid--gallery.php'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__("Description limit word", 'medix'),
        'description' => esc_html__( 'Enter the number of work to display', 'medix' ),
        'param_name' => 'word_number',
        'value' =>  '',
        'template' => array('cms_grid.php','cms_grid--blog2.php','cms_grid--blog3.php','cms_grid--blog-department.php','cms_grid--gallery.php'),
    ),
     
     
);
