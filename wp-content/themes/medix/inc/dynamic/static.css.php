<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_StaticCss
{

    public $scss;
    
    function __construct()
    {
        if(!class_exists('scssc'))
            return;

        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
             
        /* generate css over time */
		add_action('wp', array($this, 'generate_over_time'));
        
        /* save option generate css */
       	add_action("redux/options/opt_theme_options/saved", array($this,'generate_file'));
    }
	
    public function generate_over_time(){
    	
    	global $opt_theme_options;

    	if (!empty($opt_theme_options) && $opt_theme_options['dev_mode']){
    	    $this->generate_file();
    	}
    }
    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $opt_theme_options, $wp_filesystem;
        
        if (empty($wp_filesystem) || !isset($opt_theme_options))
            return;
            
        $options_scss = get_template_directory() . '/assets/scss/options.scss';
        $options_render_scss  = get_template_directory() . '/assets/scss/options.render.scss';

        /* delete files options.scss */
        $wp_filesystem->delete($options_scss);
        $wp_filesystem->delete($options_render_scss);

        /* write options to scss file */
        $wp_filesystem->put_contents($options_scss, $this->css_render(), FS_CHMOD_FILE); // Save it
        $wp_filesystem->put_contents($options_render_scss, $this->css_option_render(), FS_CHMOD_FILE); // Save it
        

        /* minimize CSS styles */
        if (!$opt_theme_options['dev_mode'])
            $this->scss->setFormatter('scss_formatter_compressed');

        /* compile scss to css */
        $css = $this->scss_render();
         
        $file = "static.css";

        $file = get_template_directory() . '/assets/css/' . $file;
        
        /* delete files static.css */
        $wp_filesystem->delete($file);

        /* write static.css file */
        $wp_filesystem->put_contents($file, $css, FS_CHMOD_FILE); // Save it
         
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }
    
    public function primary_HexToRGB($hex,$opacity = 1) {
        $hex = str_replace("#",null, $hex);
        $color = array();
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
            $color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
            $color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            $color['a'] = $opacity;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
            $color['a'] = $opacity;
        }
        $color = "rgba(".implode(', ', $color).")";
        return $color;
    }
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options;
        
        ob_start();
        
        /* second_color */
        
        if(!empty($opt_theme_options['font_body']['color']))
            echo '$body_color:'.esc_attr($opt_theme_options['font_body']['color']).';';
        
        if(!empty($opt_theme_options['primary_color']))
            echo '$primary_color:'.esc_attr($opt_theme_options['primary_color']).';';
            echo '$primary_color_hex:'.$this->primary_HexToRGB($opt_theme_options['primary_color'],0.6).';';
                
        if(!empty($opt_theme_options['second_color'])){
            echo '$second_color:'.esc_attr($opt_theme_options['second_color']).';';
            echo '$second_color_hex:'.$this->primary_HexToRGB($opt_theme_options['second_color'],0.6).';';
        }
          
        if(!empty($opt_theme_options['link_color']['regular']))
            echo '$link_color_regular:'.esc_attr($opt_theme_options['link_color']['regular']).';';
            
        if(!empty($opt_theme_options['link_color']['hover']))
            echo '$link_color_hover:'.esc_attr($opt_theme_options['link_color']['hover']).';';
           
        echo '$third_color: #102035;';
        echo '$third_color_hover: rgba(16, 32, 53, 0.6);';
        echo '$grey_link_color_regular: #737880;';
        echo '$grey_link_color_hover: #102035;';
        echo '$dark_link_color_regular: #102035;';
        echo '$dark_link_color_hover: rgba(16, 32, 53, 0.6);';
        echo '$grey_color: #323232;';
        echo '$border_color: #dadada;';
        if(isset($opt_theme_options['is_dark']) && $opt_theme_options['is_dark']=='1' ){
            echo '$third_color: #ffffff;';
            echo '$third_color_hover: rgba(255, 255, 255, 0.6);';
            echo '$grey_link_color_regular: #8a9099;';
            echo '$grey_link_color_hover: '.$opt_theme_options['primary_color'].';';
            echo '$dark_link_color_regular: #ffffff;';
            echo '$dark_link_color_hover: rgba(255, 255, 255, 0.6);';
            echo '$grey_color: #ffffff;';
            echo '$border_color: rgba(255, 255,255, 0.1);';
        }
         
          
        if(!empty($opt_theme_options['logo_max_height']['height']) && trim($opt_theme_options['logo_max_height']['height']) != 'px')
            echo '$logo_max_height:'.esc_attr($opt_theme_options['logo_max_height']['height']).';';
        else
            echo '$logo_max_height:100%;'; 
         
        if(!empty($opt_theme_options['sticky_logo_max_height']['height']) && trim($opt_theme_options['sticky_logo_max_height']['height']) != 'px')
            echo '$sticky_logo_max_height:'.esc_attr($opt_theme_options['sticky_logo_max_height']['height']).';';
        else
            echo '$sticky_logo_max_height:100%;';   
       
            
        if(!empty($opt_theme_options['ft_logo_max_height']['height']) && trim($opt_theme_options['ft_logo_max_height']['height']) != 'px')
            echo '$ft_logo_max_height:'.esc_attr($opt_theme_options['ft_logo_max_height']['height']).';';  
        else
            echo '$ft_logo_max_height:100%;';  
                
        if(!empty($opt_theme_options['fb_logo_max_height']['height']) && trim($opt_theme_options['fb_logo_max_height']['height']) != 'px')
            echo '$fb_logo_max_height:'.esc_attr($opt_theme_options['fb_logo_max_height']['height']).';';  
        else
            echo '$fb_logo_max_height:100%;';  
              
                
        return ob_get_clean();
    }
    public function css_option_render(){
        global $opt_theme_options;
        if((isset($_GET['normal']) && trim($_GET['normal']) == '1' )) 
            $opt_theme_options['fb_layout1_normal_font'] = 1;
            ob_start();
             
            if(!empty($opt_theme_options['show_arrow_down_icon_right']) && $opt_theme_options['show_arrow_down_icon_right'] == '1'){
                echo '#cshero-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children > a:after, 
                #cshero-header-navigation .main-navigation .menu-main-menu > li.page_item_has_children > a:after{
                    display:inline-block;
                }';
            }
            if( !empty($opt_theme_options['header_layout_bg_gradient']) && $opt_theme_options['header_layout_bg_gradient'] ){ 
                if(empty($opt_theme_options['header_bg_gradient_color']['from']))
                    $startcolor = !empty($opt_theme_options['primary_color']) ? $opt_theme_options['primary_color'] : '#01b2b7';
                else
                    $startcolor = $opt_theme_options['header_bg_gradient_color']['from'];
                if(empty($opt_theme_options['header_bg_gradient_color']['to']))
                    $endcolor = !empty($opt_theme_options['second_color']) ? $opt_theme_options['second_color'] : '#cb5151'; 
                else
                    $endcolor = $opt_theme_options['header_bg_gradient_color']['to'];
                echo '.header-layout4 .main-header-wrap,.header-layout5 .main-header-wrap{';
                echo 'background: '.$startcolor.';'; 
                echo 'background: -webkit-linear-gradient(left, '.$startcolor.' , '.$endcolor.');';  
                echo 'background: -o-linear-gradient(right, '.$startcolor.', '.$endcolor.');'; 
                echo 'background: -moz-linear-gradient(right, '.$startcolor.', '.$endcolor.');';  
                echo 'background: linear-gradient(to right, '.$startcolor.' , '.$endcolor.');'; 
                echo '}';
            }
            if(!empty($opt_theme_options['fb_layout1_normal_font']) && $opt_theme_options['fb_layout1_normal_font'] ){
                echo '.footer-bottom.layout-1{font-size: 16px; text-transform: inherit; font-weight: 300;}';
            }
            if( !empty($opt_theme_options['fb_layout4_bg_gradient']) && $opt_theme_options['fb_layout4_bg_gradient'] ){ 
                 
                    if(empty($opt_theme_options['fb_bg_gradient_color']['from']))
                        $startcolor = !empty($opt_theme_options['primary_color']) ? $opt_theme_options['primary_color'] : '#01b2b7';
                    else
                        $startcolor = $opt_theme_options['fb_bg_gradient_color']['from'];
                    if(empty($opt_theme_options['fb_bg_gradient_color']['to']))
                        $endcolor = !empty($opt_theme_options['second_color']) ? $opt_theme_options['second_color'] : '#cb5151'; 
                    else
                        $endcolor = $opt_theme_options['fb_bg_gradient_color']['to'];
                    echo '.footer-bottom.layout-4{';
                    echo 'background: '.$startcolor.';'; 
                    echo 'background: -webkit-linear-gradient(left, '.$startcolor.' , '.$endcolor.');';  
                    echo 'background: -o-linear-gradient(right, '.$startcolor.', '.$endcolor.');'; 
                    echo 'background: -moz-linear-gradient(right, '.$startcolor.', '.$endcolor.');';  
                    echo 'background: linear-gradient(to right, '.$startcolor.' , '.$endcolor.');'; 
                    echo '}';
                 
            }
             
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();