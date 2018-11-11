* Boot update 
#! Version 1.0.0
- Add fields.function.js, for init all fields related ( added to `embed_flat_UI` method )
- Update tags-input fields
* Updated by Quan
    - Update multi select
    - Added generateMetaBoxs
    - Added jQuery.Spinner
    - Added input_spinner template
    - Added gmaps
    - Added ion-rangeslider
        - usage:
        - html:
        `<input type="text" id="map_zoom" value="" class="hidden"/>`
        - Js: 
        `$('#map_zoom').ionRangeSlider({
                           grid: true,
                           from: $this.map.getZoom(),
                           min: 0,
                           max: 22,
                           step: 1,
                           onFinish: function (data) {
                               $this.map.setZoom(data.from);
                               $this.parent.update_data('zoom', data.from);
                           }
                       });`
        
        
    - Added generate_tabs($options)
        - option example
        ```
        $options = array(
                        'slug' => 'test',
                        'tabs' => array(
                            'general' => array(
                                'active' => true,
                                'icon'   => 'settings',
                                'fields' => array(
                                    array(
                                        'label'        => esc_html__('Coupon Subtitle', 'flexcoupons'),
                                        'name'         => 'coupon_subtitle',
                                        'id'           => 'coupon_subtitle',
                                        'row'          => 'metabox',
                                        'value'        => '',
                                        'place_holder' => esc_html__('Coupon Subtitle', 'flexCoupons')
                                    )
                                )
        
                            ),
                            'marker' => array(
                                'active' => false,
                                'icon'   => 'location_on',
                                'fields' => array(
                                    array(
                                        'label'        => esc_html__('Coupon Subtitle', 'flexcoupons'),
                                        'name'         => 'coupon_subtitle',
                                        'id'           => 'coupon_subtitle',
                                        'row'          => 'metabox',
                                        'value'        => '',
                                        'place_holder' => esc_html__('Coupon Subtitle', 'flexCoupons')
                                    )
                                )
                            ),
                            'draw' => array(
                                'active' => false,
                                'icon'   => 'brush',
                                'fields' => array(
                                    array(
                                        'label'        => esc_html__('Coupon Subtitle', 'flexcoupons'),
                                        'name'         => 'coupon_subtitle',
                                        'id'           => 'coupon_subtitle',
                                        'row'          => 'metabox',
                                        'value'        => '',
                                        'place_holder' => esc_html__('Coupon Subtitle', 'flexCoupons')
                                    )
                                )
                            ),
                            'style' => array(
                                'active' => false,
                                'icon'   => 'color_lens',
                                'fields' => array(
                                    array(
                                        'label'        => esc_html__('Coupon Subtitle', 'flexcoupons'),
                                        'name'         => 'coupon_subtitle',
                                        'id'           => 'coupon_subtitle',
                                        'row'          => 'metabox',
                                        'value'        => '',
                                        'place_holder' => esc_html__('Coupon Subtitle', 'flexCoupons')
                                    )
                                )
                            )
                        )
                    );
                    
                    
* Boot updated
	- fix function admin_template__ and get_template_file__
	- add group to page setting
	
* Updated by Nic
    - do_action('before_save_setting',$page_slug,$_POST);
    - do_action('after_save_setting',$page_slug,$_POST);
    
    Purpose: Customize save setting page