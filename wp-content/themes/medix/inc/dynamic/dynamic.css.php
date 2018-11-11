<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {

        wp_enqueue_style('custom-dynamic',get_template_directory_uri() . '/assets/css/custom-dynamic.css');

        $_dynamic_css = $this->css_render();

        wp_add_inline_style('custom-dynamic', $_dynamic_css);
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options,$opt_meta_options;

        ob_start();

        /* custom css. */
        if (class_exists('EF3_Framework')){
            if(!empty($opt_theme_options['show_arrow_down_icon_right']) && $opt_theme_options['show_arrow_down_icon_right'] == '1'){
                echo '#cshero-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children > a:after, 
                #cshero-header-navigation .main-navigation .menu-main-menu > li.page_item_has_children > a:after{
                    display:inline-block;
                }';
            }
            if(isset($opt_meta_options['content_padding']['padding-top']) && $opt_meta_options['content_padding']['padding-top'] != '' ){
                echo 'body .site-content{padding-top:'.$opt_meta_options['content_padding']['padding-top'].';}';
                if( (int)$opt_meta_options['content_padding']['padding-top'] > 85){
                    echo '@media screen and (max-width: 1199px){
                        body .site-content{
                            padding-top: 85px;
                        }
                    }';
                }
            }
            if(isset($opt_meta_options['content_padding']['padding-bottom']) && $opt_meta_options['content_padding']['padding-bottom'] != ''){
                echo 'body .site-content{padding-bottom:'.$opt_meta_options['content_padding']['padding-bottom'].';}';
                if( (int)$opt_meta_options['content_padding']['padding-bottom'] > 50){
                    echo '@media screen and (max-width: 1199px){
                        body .site-content{
                            padding-bottom: 50px;
                        }
                    }';
                }
            }
            if( isset($opt_meta_options['gray_light_bg']) && $opt_meta_options['gray_light_bg'] == '1')
                echo 'body .site-content{background-color: #f3f4f5;}';
             
            if(!empty($opt_meta_options['primary_color'])){
                echo '.primary-color{color:'.$opt_meta_options['primary_color'].';}';
                echo 'body .primary-bg{background:'.$opt_meta_options['primary_color'].';}';
                echo '.theme_button{color:'.$opt_meta_options['primary_color'].';}';
                echo '.cms-accordion .panel-heading .panel-title > a.collapsed > i{color:'.$opt_meta_options['primary_color'].';}';
                echo '.testimonial-carousel-two .testimonials-owl-content blockquote:before, .testimonial-carousel-two .testimonials-owl-content blockquote:after{color: '.$opt_meta_options['primary_color'].';}';
                echo '.embed-placeholder.primary-color:before{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.ef3-back-to-top{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.cms-teaser.layout7.primary_bg{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.bgprimary .btn-loadmore{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .primary_bg{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .blockquote-item blockquote.second_bg:before{color:'.$opt_meta_options['primary_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .blockquote-item blockquote.dark_bg:before{color:'.$opt_meta_options['primary_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .blockquote-item blockquote.primary_bg:after{border-top-color:'.$opt_meta_options['primary_color'].';}';
                echo '.appointment-form-wrap{background-color: '.$opt_meta_options['primary_color'].';}';
                echo '.appointment-form-wrap .corner-icon{background-color: '.$opt_meta_options['primary_color'].';}';
                 
            }
            if(!empty($opt_meta_options['second_color'])){
                echo '.second-color{color: '.$opt_meta_options['second_color'].';}';
                echo 'body .second-bg{background:'.$opt_meta_options['second_color'].';}';
                echo '@media screen and (min-width: 1200px){';
                    echo '.header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a, 
                        .header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a {
                            color: '.$opt_meta_options['second_color'].';
                        }';
                    echo '.header-navigation .main-navigation .menu-main-menu > li > a:focus,  
                        .header-navigation .main-navigation .menu-main-menu > li > a:hover {
                            color: '.$opt_meta_options['second_color'].';
                        }';
                echo '}';
                echo '.cms-accordion .panel-heading .panel-title > a{background-color:'.$opt_meta_options['second_color'].'}';
                echo '.cms-accordion .panel-heading .panel-title > a.collapsed:hover, .cms-accordion .panel-heading .panel-title > a:hover{background-color:'.$opt_meta_options['second_color'].'}';
                echo '.owl-carousel .owl-nav .owl-prev, .owl-carousel .owl-nav .owl-next{color: '.$opt_meta_options['second_color'].';}';
                echo '.cms-gallery-carousel .filters a.selected{color: '.$opt_meta_options['second_color'].';}';
                echo '.links-wrap a{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.embed-placeholder.second-color:before{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.testimonial-carousel-two.second .testimonials-owl-content blockquote:before, .testimonial-carousel-two.second .testimonials-owl-content blockquote:after{color: '.$opt_meta_options['second_color'].';}';
                echo '.btn-loadmore{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.footer-top.layout-1 input[type="submit"]{background: '.$opt_meta_options['second_color'].';}';
                echo 'body .btn-secondary,body .btn-secondary:hover, body .btn-secondary:active, body .btn-secondary:focus{background: '.$opt_meta_options['second_color'].';}';
                echo '.cms-teaser.layout7.second_bg{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .second_bg{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.cms-testimonial-wrap.layout3 .blockquote-item blockquote.second_bg:after{border-top-color:'.$opt_meta_options['second_color'].';}';
                echo '.highlight2{color: '.$opt_meta_options['second_color'].';}';
                echo '.bgsecond .btn-loadmore{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.footer-bottom.layout-1{background-color: '.$opt_meta_options['second_color'].';}';
                echo '.fancy-style3 .cms-teaser .teaser_icon{background-color: '.$opt_meta_options['second_color'].';}';
            }
            if(!empty($opt_meta_options['link_color']['regular'])){
                echo 'a{ color: '.$opt_meta_options['link_color']['regular'].';}';
                echo '.medix-blog-loop .entry-title a{ color: '.$opt_meta_options['link_color']['regular'].';}';
                echo '.footer-bottom.layout-1.cs a{ color: '.$opt_meta_options['link_color']['regular'].';}';
                echo '.blog-grid3 .entry-title a{ color: '.$opt_meta_options['link_color']['regular'].';}';
            }
            if(!empty($opt_meta_options['link_color']['hover'])){
                echo 'a:hover { color: '.$opt_meta_options['link_color']['hover'].';}';
                echo '.medix-blog-loop .entry-title a:hover{ color: '.$opt_meta_options['link_color']['hover'].';}';
                echo '.footer-bottom.layout-1.cs a:hover{ color: '.$opt_meta_options['link_color']['hover'].';}';
                echo '.blog-grid3 .entry-title a:hover{ color: '.$opt_meta_options['link_color']['hover'].';}';
            }
              
        }
        ?>
        <?php
        
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();