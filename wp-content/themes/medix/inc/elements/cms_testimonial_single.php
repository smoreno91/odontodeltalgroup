<?php
vc_map(array(
    'name' => 'CMS Testimonial Single',
    'base' => 'cms_testimonial_single',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    'description' => esc_html__('Add clients testimonial', 'medix'),
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
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ),
          
    )
));
 
class WPBakeryShortCode_cms_testimonial_single extends CmsShortCode
{
     protected function content($atts, $content = null){
        return parent::content($atts, $content);
    } 
}
?>