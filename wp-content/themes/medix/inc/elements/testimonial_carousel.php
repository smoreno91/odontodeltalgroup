<?php
vc_map(array(
    'name' => 'Testimonial Carousel',
    'base' => 'testimonial_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    'description' => esc_html__('Add clients testimonial', 'medix'),
    'params' => array(
        array(
            'type' => 'img',
            'heading' => esc_html__('Layout Mode','medix'),
            'param_name' => 'layout_mode',
            'value' =>  array(
                '' => get_template_directory_uri().'/vc_params/layouts/cms_testimonial3.png',
            ),
            'std' => '',
        ), 
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Color Mode', 'medix' ),
            'param_name'    => 'color_mode',
            'value'         => array(
                esc_html__('Primary','medix')     => '',
                esc_html__('Secondary','medix')     => 'second',
            ),
            'std'           => ''
        ),
        array(
            'type'          => 'param_group',
            'heading'       => esc_html__( 'Add your testimonial', 'medix' ),
            'param_name'    => 'values',
            'value'         => urlencode( json_encode( array(
                array(
                    'author_name' => esc_html__( 'John Smith', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__( 'Author Image', 'medix' ),
                    'param_name'    => 'author_avatar',
                    'value'         => ''
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Author name', 'medix' ),
                    'param_name'    => 'author_name',
                    'admin_label'   => true,
                    'value'         => esc_html__('John Smith','medix')
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Author Position', 'medix' ),
                    'param_name'    => 'author_position',
                    'value'         => esc_html__('Project Manager','medix')
                ),
                array(
                    'type'          => 'textarea',
                    'heading'       => esc_html__( 'Testimonial text', 'medix' ),
                    'description'   => esc_html__('Press double ENTER to get line-break','medix'),
                    'param_name'    => 'text',
                    'value'         => esc_html__('Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna','medix')
                ),
            ),
            'group' => esc_html__('Testimonial Item','medix')
        ),
         
    )
));

 
class WPBakeryShortCode_testimonial_carousel extends CmsShortCode
{
    protected function content($atts, $content = null){
          
        wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.2.1','all');
        wp_enqueue_script('imagesloaded', get_template_directory_uri().'/assets/js/jquery.imagesloaded.js', array('jquery') ,'1.0',true);
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.2.1',true);
        wp_enqueue_script('owl-carousel-cms2',get_template_directory_uri().'/assets/js/owl.carousel.two.js',array('jquery'),'1.0.0',true);
        
        return parent::content($atts, $content);
    }
}
?>