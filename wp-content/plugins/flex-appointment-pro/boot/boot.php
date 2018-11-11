<?php
/*----------------------------|
 *   BOOTSTRAPING PLUGIN      |
 * ---------------------------|
 * @version 1.0.0
 * @author Flex Team
 */

if (!class_exists('fs_boot')) {
    require_once 'helpers' . DIRECTORY_SEPARATOR . 'validate.php';
    if (!isset($dev_mode)) {
        $dev_mode = false;
    }
    add_action('admin_enqueue_scripts', 'enqueueBootScripts');
    function enqueueBootScripts()
    {
        global $dev_mode;
        wp_register_script('plugin-config.js', plugin_dir_url(__FILE__) . "/assets/js/plugin-config.js", array(), '1.0.0', true);
        wp_localize_script('plugin-config.js', 'plugin_config', array(
            'dev_mode' => $dev_mode,
        ));
        wp_enqueue_script('plugin-config.js');
    }

    class fs_boot
    {
        public $plugin_dir;
        public $plugin_url;
        public $boot_dir;
        public $boot_url;
        public $parent_dir;
        public $theme_dir;

        public $metabox_option;

        /**
         * @param $pluginname
         */

        public function init($pluginname)
        {
            $this->boot_dir = plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR;
            // $this->plugin_dir = dirname(dirname(plugin_dir_path(__FILE__))) . DIRECTORY_SEPARATOR . $pluginname;
            $this->boot_url = plugin_dir_url(__FILE__);
            $this->plugin_url = plugins_url() . "/$pluginname/";
            // $this->plugin_dir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $pluginname . DIRECTORY_SEPARATOR;
            $this->plugin_dir = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . $pluginname . DIRECTORY_SEPARATOR;

            $this->plugin_folder_dir = dirname(dirname(dirname(__FILE__)));

            $this->parent_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
            $this->theme_dir = get_template_directory() . DIRECTORY_SEPARATOR;
        }

        /**
         * @param $foldername
         */
        public function requireFolder($foldername)
        {
            $foldername = $this->switch_alias_dir($foldername);
            $dir = $this->plugin_dir . DIRECTORY_SEPARATOR . $foldername;
            if (!is_dir($dir)) {
                return;
            }
            $files = array_diff(scandir($dir), array('..', '.'));
            foreach ($files as $file) {
                $patch = $dir . DIRECTORY_SEPARATOR . $file;
                if (file_exists($patch) && strpos($file, ".php") !== false) {
                    include_once $patch;
                    //var_dump($patch);
                    $classname = substr($file, 0, -4);
                    if (class_exists($classname)) {
                        ${$classname} = new $classname();
                    }
                }
            }
        }

        /**
         * GENERATING TEMPLATE FROM PLUGIN TO THE STRING RESULT
         * ------------------------------------------------
         * @param $alias_path
         * @param null $form_data
         * @param null $place
         * @return string
         * @internal param $template
         * @internal param null $data
         */
        public function admin_template__($alias_path, $form_data = null, $place = null)
        {
            if ($place == null) {
                $place = 'templates' . DIRECTORY_SEPARATOR;
            } else {
                $place = DIRECTORY_SEPARATOR . $this->switch_alias_dir($place);
            }
            $path = $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);
            $plugin_path = $this->plugin_dir . $path;
            $parent_path = $this->parent_dir . $path;
            // Checking for variable assign
            if (!empty($form_data) && is_array($form_data)) {
                foreach ($form_data as $variable_name => $variable_value) {
                    ${$variable_name} = $variable_value;
                }
            }
            $plugin_path_name = $plugin_path . '.temp.php';
            $parent_path_name = $parent_path . '.temp.php';
            if (strpos($path, 'boot') !== false && file_exists($parent_path_name)) {
                ob_start();
                include $parent_path_name;
                return ob_get_clean();
            } elseif (file_exists($plugin_path_name)) {
                ob_start();
                include $plugin_path_name;
                return ob_get_clean();
            } else {
                echo 'The path <b>' . $plugin_path_name . '</b> && <b>' . $parent_path_name . '</b> doesnt exists';
            }
            return '';
        }

        /**
         * @param $option
         * @param $content
         *
         * @return string
         */
        public function generateField($option, $content)
        {
            $data = get_option($option);
            if (isset($content['option']) && !in_array($content['option'], $data)) {
                $data[] = $content['option'];
                update_option($option, $data);
            }

            $field = array_merge(array(
                'type'        => 'Form.Input',
                'class'       => '',
                'id'          => '',
                'type'        => '',
                'content'     => '',
                'title'       => '',
                'name'        => '',
                'label'       => '',
                'placeholder' => '',
                'required'    => '',
                'value'       => '',
                'options'     => array(),
            ), $content['field']);
            return $this->get_template_file__($field['type'], $field, 'boot.templates');
        }

        /**
         * @param $tabs
         * @return string
         */
        public function settingTab($tabs)
        {
            foreach ($tabs as $k => $array) {
                if ($array['intelement'] == 'Field') {
                    foreach ($array['element'] as $key) {
                        $label = $key['label'];
                        $content = $this->generateField('test', $key);
                        $tabs[$k]['content'] .= $this->get_template_file__('UI.Field', array('label' => $label, 'content' => $content), 'boot.templates');
                    }
                } else if ($array['intelement'] == 'Collapse') {
                    $field = '';
                    foreach ($array['element'] as $key) {
                        $field .= $this->generateField('test', $key);
                    }
                    $tabs[$k]['content'] .= $this->get_template_file__('UI.Collapse', array('content' => $field), 'boot.templates');
                    $tabs[$k]['content'] .= $this->generateField('test', array('field' => array('type' => 'UI.Button', 'id' => 'add-field', 'content' => 'Add field')));
                }
            }
            return $this->getTemplateFields('UI', 'Tab', $tabs);
        }

        public function getTemplateFields($folder, $file, $settings = null)
        {
            ob_start();
            include plugin_dir_path(__FILE__) . 'templates' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $file . '.temp.php';
            $temp = ob_get_clean();
            return $temp;
        }

        public function generateMetaBoxs($options)
        {
            $this->embed_flat_UI(array(
                'jquery',
                'roboto',
                'material_icon',
                'bootstrap',
                'datetimepicker',
                'bootstrap_select',
                'tags_input',
                'jquery_spinner',
                'multi_select'
            ), true);

            $options = array_merge(
                array('post_slug' => '',
                      'id'        => 'new_meta_box',
                      'title'     => 'Meta Box',
                      'context'   => 'normal',
                      'priority'  => 'high',
                      'tabs'      => array()
                ),
                $options
            );

            $this->metabox_option = $options;
            add_action('add_meta_boxes', array($this, 'createMetaBoxs'));

            if (!empty($options['post_slug']))
                add_action('save_post_' . $options['post_slug'], array($this, 'saveMetaBoxs'), 10, 3);
            else
                add_action('save_post', array($this, 'saveMetaBoxs'), 10, 3);
        }

        public function createMetaBoxs()
        {
            $options = $this->metabox_option;
            $options = apply_filters($options['post_slug'] . '/' . $options['id'], $options);
            update_option($options['post_slug'] . '/' . $options['id'], $options);
            add_meta_box($options['id'], $options['title'], array(
                $this,
                'showMetaBoxs'
            ), $options['post_slug'], $options['context'], $options['priority']);
        }

        public function showMetaBoxs($post)
        {
            $options = $this->metabox_option;
            $tabs = apply_filters($options['post_slug'] . '/' . $options['id'] . '/tabs', $options['tabs']);
            update_option($options['post_slug'] . '/' . $options['id'] . '/tabs', $tabs);
            foreach ($tabs as $id => $tab) {
                $tabs[$id]['content'] = '';
                $fields = apply_filters($options['post_slug'] . '/' . $options['id'] . '/tabs/' . $id . '/fields', $tab['fields']);
                update_option($options['post_slug'] . '/' . $options['id'] . '/tabs/' . $id . '/fields', $fields);
                foreach ($fields as $field) {
                    if (isset($field['row']) && $field['row'] === true)
                        $tabs[$id]['content'] .= $this->generate_row_metabox($post, $field);
                    else
                        $tabs[$id]['content'] .= $this->generate_field($field);
                }
            }
            echo $this->get_template_file__('UI.MetaTab', array('tabs' => $tabs), 'boot.templates');
        }


        public function generate_tabs($options)
        {
            $this->embed_flat_UI(array(
                'jquery',
                'roboto',
                'material_icon',
                'bootstrap',
                'datetimepicker',
                'bootstrap_select',
                'tags_input',
                'jquery_spinner',
                'multi_select',
                'fields_function',
                'nouislider',
                'range_slider'
            ), true);

            $options = array_merge(array(
                'slug' => 'example',
                'tabs' => array()
            ), $options);

            global $post;

            $tabs = apply_filters($options['slug'] . '/tabs', $options['tabs']);
            if (is_array($tabs)) {
                foreach ($tabs as $id => $tab) {
                    $tabs[$id]['content'] = isset($tabs[$id]['content']) ? $tabs[$id]['content'] : '';

                    if (isset($tab['groups'])) {
                        $groups = apply_filters($options['slug'] . '/tabs/' . $id . '/groups', $tab['groups']);

                        foreach ($groups as $slug => $group) {
                            $fields = apply_filters($options['slug'] . '/tabs/' . $id . '/group/' . $slug . '/fields', $group['fields']);
                            $groups[$slug]['body'] = '';
                            if (is_array($fields))
                                foreach ($fields as $field) {
                                    if (isset($field['row']) && $field['row'] === 'metabox')
                                        $groups[$slug]['body'] .= $this->generate_row_metabox($post, $field);
                                    else
                                        $groups[$slug]['body'] .= $this->generate_field($field);
                                }
                        }

                        $tabs[$id]['content'] .= $this->admin_template__('UI.groups', array('tab' => $id, 'groups' => $groups), 'boot.templates');
                    }

                    if (isset($tab['fields'])) {
                        $fields = apply_filters($options['slug'] . '/tabs/' . $id . '/fields', $tab['fields']);
                        if (is_array($fields))
                            foreach ($fields as $field) {
                                if (isset($field['row']) && $field['row'] === 'metabox')
                                    $tabs[$id]['content'] .= $this->generate_row_metabox($post, $field);
                                else
                                    $tabs[$id]['content'] .= $this->generate_field($field);
                            }
                    }
                }
            }

            return $this->get_template_file__('UI.MetaTab', array('tabs' => $tabs), 'boot.templates');
        }

        public function generate_row_metabox($post, $field)
        {
            $value = get_post_meta($post->ID, $field['name'], true);
            if ($value !== false && $value !== '' && $value !== null) {
                if (isset($field['class']) && $field['class'] == 'material-datimepicker' && !empty($value))
                    $field['value'] = date('d/m/Y', intval($value));
                else
                    $field['value'] = $value;
            }
            $field['content'] = $this->generate_field($field);
            return $this->get_template_file__('UI.row_metabox', $field, 'boot.templates');
        }

        public function saveMetaBoxs($post_id)
        {
            $options = $this->metabox_option;
            $tabs = get_option($options['post_slug'] . '/' . $options['id'] . '/tabs');

            if (is_array($tabs))
                foreach ($tabs as $id => $tab) {

                    $fields = get_option($options['post_slug'] . '/' . $options['id'] . '/tabs/' . $id . '/fields');
                    if (isset($fields))
                        foreach ($fields as $field) {
                            if (!empty($_POST)) {
                                if (isset($_POST[$field['name']])) {

                                    if (isset($field['class']) && $field['class'] == 'material-datimepicker') {

                                        $date = explode('/', $_POST[$field['name']]);

                                        if (count($date) == 3 && checkdate($date[1], $date[0], $date[2])) {

                                            $date = mktime(23, 59, 0, $date[1], $date[0], $date[2]);

                                            if (!add_post_meta($post_id, $field['name'], $date, true)) {
                                                update_post_meta($post_id, $field['name'], $date);
                                            }
                                        }
                                    } else {

                                        if (!add_post_meta($post_id, $field['name'], sanitize_text_field($_POST[$field['name']]), true)) {
                                            update_post_meta($post_id, $field['name'], sanitize_text_field($_POST[$field['name']]));
                                        }

                                    }

                                }
                            }
                        }
                }
        }

        /**
         * @param $options
         */
        public function generatePageSettings($options)
        {
            $this->embed_flat_UI(array(
                'jquery',
                'roboto',
                'material_icon',
                'bootstrap',
                'datetimepicker',
                'bootstrap_select',
                'tags_input',
                'fields_function',
                'multi_select'
            ), true);
            $options = array_merge(array(
                'page_slug'    => 'fs_page_settings',
                'title'        => 'Flex Page Settings',
                'description'  => 'Extension Settings',
                'tab_class'    => '', /* tab-col-pink, tab-col-teal, tab-col-purple, tab-col-deep-orange, tab-col-orange, tab-col-blue-grey*/
                'button_class' => 'btn-primary', /* bg-red, btn-default, btn-primary, btn-success, btn-info, btn-warning, btn-danger, bg-red, bg-pink*/
                'tabs'         => array(),
                'text_domain'  => 'default',
                'query_args'   => array(),
            ), array_filter($options));
            $this->handle_save_page_settings($options['page_slug'], $options);
            $this->view_page_settings($options);
        }

        /**
         * Rendering page setting template
         * ------------------------------------------
         * @param $options
         * @filter add tab: fs_filter_tabs/page_slug
         * @filter add field : fs_filter_tabs/page_slug/tab_slug/fields
         * @filter add group : fs_filter_tabs/page_slug/tab_slug/groups
         * @filter add field to group : fs_filter_tabs/page_slug/tab_slug/groups/group_slug/fields
         */
        public function view_page_settings($options)
        {
            // Filter for tabs
            $options['tabs'] = apply_filters('fs_filter_tabs/' . $options['page_slug'], $options['tabs']);
            $slug_active = "";
            // Extract tabs
            foreach ($options['tabs'] as $slug => $tab) {
                $slug_active = (isset($tab['actived']) && $tab['actived'] === true) ? $slug : $slug_active;
                $options['tabs'][$slug]['body'] = isset($options['tabs'][$slug]['body']) ? $options['tabs'][$slug]['body'] : '';

                if (isset($tab['fields'])) {
                    $tab['fields'] = apply_filters('fs_filter_tabs/' . $options['page_slug'] . '/' . $slug . '/fields', $tab['fields']);
                    // Extract fields
                    $options['tabs'][$slug]['body'] .= $this->generate_settings_row($tab['fields'], $options['page_slug']);
                }
                if (isset($tab['groups'])) {
                    $tabs['groups'] = apply_filters('fs_filter_tabs/' . $options['page_slug'] . '/' . $slug . '/groups', $tab['groups']);
                    // Extract group
                    $options['tabs'][$slug]['body'] .= $this->generate_group($tabs['groups'], $options['page_slug'], $slug);
                }
                $options['tabs'][$slug]['actived'] = false;
            }

            $options['tabs'][$slug_active]['actived'] = true;
            $options['body'] = $this->admin_template__('tabs', $options, 'boot.templates.UI');
            $this->admin_template_e('pages.settings', $options, 'boot.templates');
        }

        /**
         * Generate rows that will contains any fields in a tab on page settings
         * ----------------------------------------------------------------------
         * @param $fields
         * @return string
         */
        private function generate_settings_row($fields, $page_slug)
        {
            $body = '<div class="row"><div class="col-lg-10 col-lg-offset-1">';
            $options = get_option($page_slug, false);

            foreach ($fields as $field) {
                if (isset($field['name']) && isset($options[$field['name'] . '_checkbox'])) {
                    $field['value'] = (isset($options[$field['name'] . '_checkbox'])) ? $options[$field['name'] . '_checkbox'] : ((isset($field['default'])) ? $field['default'] : '');
                } elseif (isset($field['name']) && strpos($field['name'], '[]') !== false) {
                    $name_option = str_replace('[]', '', $field['name']);
                    $field['value'] = (isset($options[$name_option])) ? $options[$name_option] : ((isset($field['default'])) ? $field['default'] : '');
                } elseif (isset($field['name'])) {
                    $field['value'] = (isset($options[$field['name']])) ? $options[$field['name']] : ((isset($field['default'])) ? $field['default'] : '');
                }

                $body .= $this->generate_field($field);
            }
            $body .= '</div></div>';
            return $body;
        }

        /**
         * For generating group
         * -----------------------------------------------------------
         * @filter fs_filter_tabs / Page Slug / Tab Slug /groups / Group Slug / fields
         *
         * @param array $groups
         * @param $page
         * @param $tab
         * @return string
         */
        public function generate_group($groups = array(), $page, $tab)
        {
            foreach ($groups as $slug => $group) {
                $groups[$slug] = array_merge(array(
                    'class_color' => 'panel-primary',
                    'actived'     => false,
                    'icon'        => ''
                ), $group);
                $group['fields'] = apply_filters('fs_filter_tabs/' . $page . '/' . $tab . '/groups/' . $slug . '/fields', $group['fields']);
                $groups[$slug]['body'] = $this->generate_settings_row($group['fields'], $page);
            }
            return $this->admin_template__('UI.groups', array('tab' => $tab, 'groups' => $groups), 'boot.templates');
        }

        public function handle_save_page_settings($page_slug, $options = array())
        {
            if (has_action("before_save_setting_$page_slug"))
                do_action("before_save_setting_$page_slug", $page_slug, $_POST);

            if (isset($_POST[$page_slug])) {
                $settings = array();
                foreach ($_POST as $field_name => $value) {
                    if (is_string($value))
                        $settings[$field_name] = addslashes($value);
                    else
                        $settings[$field_name] = $value;
                }
                update_option($page_slug, $settings);
                $_POST['notice'] = $this->string_to_url(esc_html__('Updated Successfully!', $options['textdomain']), esc_html__('All the options was updated completed.', $options['textdomain']), 'success');

                if (has_action("after_save_setting_$page_slug"))
                    do_action("after_save_setting_$page_slug", $page_slug, $_POST);
            }
        }

        /**
         * Rendering elements
         * @param null $data_form
         * @internal param $path
         * @internal param $form_data
         */
        public function admin_template_e($alias_path, $data_form = null, $place = null)
        {
            echo $this->admin_template__($alias_path, $data_form, $place);
        }

        /**
         * Embed flat UI TEMPLATE
         * @option array mix|jquery, roboto, material_icon, bootstrap_notify, bootstrap,
         * @author JAX
         * @version 1.0.2
         */
        public function embed_flat_UI($options = array(), $essential = true)
        {
            if (in_array('jquery', $options)) {
                wp_enqueue_script('jquery');
//	            wp_enqueue_script("jquery.min.js", $this->boot_url . "assets/plugins/jquery/jquery.min.js", array(), '', true);
            }
            if ($essential === true) {
                wp_enqueue_script('custom.js', $this->boot_url . 'assets/js/custom.js', array(), '', true);
                wp_enqueue_style("waves.min.css", $this->boot_url . "assets/plugins/node-waves/waves.min.css");
                wp_enqueue_style("animate.min.css", $this->boot_url . "assets/plugins/animate-css/animate.min.css");
                wp_enqueue_script("waves.min.js", $this->boot_url . "assets/plugins/node-waves/waves.min.js", array(), '', true);
            }

            if (in_array('range_slider', $options)) {
                wp_enqueue_style("ion.rangeSlider.css", $this->boot_url . "assets/plugins/ion-rangeslider/css/ion.rangeSlider.css");
                wp_enqueue_style("ion.rangeSlider.skinFlat.css", $this->boot_url . "assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css");
                wp_enqueue_script("ion.rangeSlider.js", $this->boot_url . "assets/plugins/ion-rangeslider/js/ion.rangeSlider.js", array(), '', true);
            }

            if (in_array('roboto', $options)) {
                wp_enqueue_style("Roboto", "https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext");
            }

            if (in_array('bootstrap_notify', $options)) {
                wp_enqueue_script("bootstrap-notify.min.js", $this->boot_url . "assets/plugins/bootstrap-notify/bootstrap-notify.js", array(), '', true);
            }

            if (in_array('material_icon', $options)) {
                wp_enqueue_style("MaterialIcons", "https://fonts.googleapis.com/icon?family=Material+Icons");
            }

            if (in_array('bootstrap', $options)) {
                wp_enqueue_style("bootstrap.min.css", $this->boot_url . "assets/plugins/bootstrap/css/bootstrap.min.css");
                wp_enqueue_script("bootstrap.min.js", $this->boot_url . "assets/plugins/bootstrap/js/bootstrap.min.js", array(), '', true);
            }

            if (in_array('jquery_spinner', $options)) {
                wp_enqueue_style("bootstrap-spinner.min.css", $this->boot_url . "assets/plugins/jquery-spinner/css/bootstrap-spinner.min.css");
                wp_enqueue_script("jquery.spinner.min.js", $this->boot_url . "assets/plugins/jquery-spinner/js/jquery.spinner.min.js", array(), '', true);
            }

            if (in_array('datetimepicker', $options)) {
                wp_enqueue_style("datetimepicker.css", $this->boot_url . "assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css");
                //DatetimePicker Plugin
                wp_enqueue_script("autosize.min.js", $this->boot_url . "assets/plugins/autosize/autosize.min.js", array(), '', true);
                wp_enqueue_script("moment.js", $this->boot_url . "assets/plugins/momentjs/moment.js", array(), '', true);
                wp_enqueue_script("datetimepicker.js", $this->boot_url . "assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js", array(), '', true);
            }
            if (in_array('bootstrap_select', $options)) {
                wp_enqueue_script("bootstrap-select.min.js", $this->boot_url . "assets/plugins/bootstrap-select/js/bootstrap-select.min.js", array(), '', true);
                wp_enqueue_style("bootstrap-select.css", $this->boot_url . "assets/plugins/bootstrap-select/css/bootstrap-select.min.css");
            }
            if (in_array('tags_input', $options)) {
                wp_enqueue_style("bootstrap-tagsinput.css", $this->boot_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
                wp_enqueue_style("bootstrap-tagsinput-typeahead.css", $this->boot_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css");
                wp_enqueue_script("typeahead.bundle.js", 'http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js', array(), '', true);
                wp_enqueue_script("bootstrap-tagsinput.min.js", $this->boot_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js", array(), '', true);
            }

            if (in_array('nouislider', $options)) {
                wp_enqueue_style("nouislider.min.css", $this->boot_url . "assets/plugins/nouislider/nouislider.min.css");
                wp_enqueue_script("nouislider.js", $this->boot_url . 'assets/plugins/nouislider/nouislider.js', array(), '', true);
            }

            if (in_array('data_table', $options)) {
                wp_enqueue_style('dataTables.bootstrap.css', $this->boot_url . 'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css');
                wp_enqueue_script("jquery.dataTables.js", $this->boot_url . "assets/plugins/jquery-datatable/jquery.dataTables.js", array(), '', true);
                wp_enqueue_script("dataTables.bootstrap.js", $this->boot_url . "assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js", array(), '', true);
                wp_enqueue_script("dataTables.buttons.min.js", $this->boot_url . "assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js", array(), '', true);
                wp_enqueue_script("buttons.flash.min.js", $this->boot_url . "assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js", array(), '', true);
                wp_enqueue_script("buttons.html5.min.js", $this->boot_url . "assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js", array(), '', true);
                wp_enqueue_script("buttons.print.min.js", $this->boot_url . "assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js", array(), '', true);
            }
            if (in_array('sweetalert', $options)) {
                wp_enqueue_style('sweetalert.css', $this->boot_url . 'assets/plugins/sweetalert/sweetalert.css');
                wp_enqueue_script("sweetalert.js", $this->boot_url . "assets/plugins/sweetalert/sweetalert.min.js", array(), '', true);
                // wp_enqueue_script("dialogs.js", $this->boot_url . "/assets/js/pages/ui/dialogs.js", array("admin.js"), '', true);
            }

            if (in_array('multi_select', $options)) {
                wp_enqueue_style('multi-select.css', $this->boot_url . 'assets/plugins/multi-select/css/multi-select.css');
                wp_enqueue_script("jquery.multi-select.js", $this->boot_url . "assets/plugins/multi-select/js/jquery.multi-select.js", array(), '', true);
                wp_enqueue_script("multi-select.js", $this->boot_url . "assets/js/multi-select.js", array(), '', true);
            }
            // Custom css
            if ($essential === true) {
                wp_enqueue_style("custom.css", $this->boot_url . "assets/css/custom.css");
                wp_enqueue_style("style.min.css", $this->boot_url . "assets/css/style.min.css");
                //Jquery DataTable Plugin Js
                //wp_enqueue_script( "pdfmake.min.js", $this->boot_url . "/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js", array(), '', true );
                //wp_enqueue_script( "vfs_fonts.js", $this->boot_url . "/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js", array(), '', true );
                // custom js
                wp_enqueue_script("admin.js", $this->boot_url . "assets/js/admin.js", array(), false, true);
                wp_enqueue_script("basic.form.elements.js", $this->boot_url . "assets/js/pages/forms/basic-form-elements.js", array(), '', true);
                // Input mark
                wp_enqueue_script('jquery.inputmask.bundle.js', $this->boot_url . 'assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js', null, '1.0.0', true);
            }
            if (in_array('fields_function', $options))
                wp_enqueue_script("fields.function.js", $this->boot_url . "assets/js/fields.function.js", array(), false, true);

        }

        /**
         * @param $field
         * @return string
         * @internal param $settings
         */
        public function generate_field($field)
        {
            // Prevent the lack of attributes
            $field = array_merge(array(
                'type'           => 'text',
                'layout'         => '',
                'select_type'    => '',
                'name'           => '',
                'wrapper_class'  => '',
                'class'          => '',
                'id'             => '',
                'attrs'          => array(),
                'tags'           => array(),
                'place_holder'   => '',
                'default'        => '',
                'options'        => '',
                'value'          => '',
                'label'          => '',
                'default_option' => array(),
            ), $field);
            $field['layout'] = (!empty($field['layout'])) ? '.layouts.' . $field['layout'] . '.' : '';
            if ($field['type'] == 'custom') {
                return $this->get_action_result($field['action']);
            } else {
                return $this->admin_template__('fields.' . $field['layout'] . $field['type'], $field, 'boot.templates');
            }
        }

        public function get_action_result($action_name)
        {
            ob_start();
            do_action($action_name);
            return ob_get_clean();
        }

        public function get_template_file_path($alias_path, $form_data = null, $place = null, $theme_place = null, $plugin_folder = null)
        {
            if ($place == null) {
                $place = 'templates';
            } else {
                $place = $this->switch_alias_dir($place);
            }

            $theme_dir = trailingslashit(get_template_directory() . DIRECTORY_SEPARATOR . $this->switch_alias_dir($theme_place));

            $plugin_template_path = $this->plugin_dir . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);

            $boot_path = $this->parent_dir . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);
            // var_dump(strpos($place,'boot'));
            $theme_template_path = $theme_dir . $this->switch_alias_dir($alias_path);

            $plugin_folder = rtrim($this->plugin_dir, '\\\/') . DIRECTORY_SEPARATOR . $plugin_folder;

            $plugin_folder_patch = $plugin_folder . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);

            // Checking for variable assign
            if (!empty($form_data) && is_array($form_data)) {
                foreach ($form_data as $variable_name => $variable_value) {
                    ${$variable_name} = $variable_value;
                }
            }

            $plugin_full_path_name = $plugin_template_path . '.temp.php';
            $theme_full_path_name = $theme_template_path . '.temp.php';
            $boot_path_name = $boot_path . '.temp.php';

            if (strpos($place, 'boot') === 0 && file_exists($boot_path_name)) {
                return $boot_path_name;
            } elseif (file_exists($theme_full_path_name)) {
                return $theme_full_path_name;
            } elseif (file_exists($plugin_full_path_name)) {
                return $plugin_full_path_name;
            } elseif (file_exists($plugin_folder_patch)) {
                return $plugin_folder_patch;
            }
            return '';
        }

        /**
         * Render template file in template folder
         * ------------------------------------------
         * @param $alias_path
         * @param $form_data
         * @param $place : 1. Boot place, 2. Main template place
         * @return string
         * @internal param $path
         */
        public function get_template_file__($alias_path, $form_data = null, $place = null, $theme_place = null, $plugin_folder = null)
        {
            if ($place == null) {
                $place = 'templates';
            } else {
                $place = $this->switch_alias_dir($place);
            }

            $theme_dir = trailingslashit(get_template_directory() . DIRECTORY_SEPARATOR . $this->switch_alias_dir($theme_place));

            $plugin_template_path = $this->plugin_dir . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);

            $boot_path = $this->parent_dir . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);
            // var_dump(strpos($place,'boot'));
            $theme_template_path = $theme_dir . $this->switch_alias_dir($alias_path);

            $plugin_folder = rtrim($this->plugin_dir, '\\\/') . DIRECTORY_SEPARATOR . $plugin_folder;

            $plugin_folder_patch = $plugin_folder . DIRECTORY_SEPARATOR . $place . DIRECTORY_SEPARATOR . $this->switch_alias_dir($alias_path);

            // Checking for variable assign
            if (!empty($form_data) && is_array($form_data)) {
                foreach ($form_data as $variable_name => $variable_value) {
                    ${$variable_name} = $variable_value;
                }
            }

            $plugin_full_path_name = $plugin_template_path . '.temp.php';
            $theme_full_path_name = $theme_template_path . '.temp.php';
            $boot_path_name = $boot_path . '.temp.php';

            if (strpos($place, 'boot') === 0 && file_exists($boot_path_name)) {
                ob_start();
                include $boot_path_name;
                return ob_get_clean();
            } elseif (file_exists($theme_full_path_name)) {
                ob_start();
                include $theme_full_path_name;
                return ob_get_clean();
            } elseif (file_exists($plugin_full_path_name)) {
                ob_start();
                include $plugin_full_path_name;
                return ob_get_clean();
            } elseif (file_exists($plugin_folder_patch)) {
                ob_start();
                include $plugin_folder_patch;
                return ob_get_clean();
            }
            var_dump($plugin_folder_patch);
            return '';
        }

        public function get_list_layout($filter_name)
        {
            $return = array();
            if (has_filter($filter_name)) {
                $layout = apply_filters($filter_name, null);
                foreach ($layout as $key => $value) {
                    $layout[$key] = $value['name'];
                }
                $return = $layout;
            }
            return $return;
        }

        public function get_layout_directory($layout, $filter_name)
        {
            if (has_filter($filter_name)) {
                $filter = apply_filters($filter_name, null);
                // Begin to make love weed dir

                $filter[$layout] = array_merge(array(
                    'name'    => 'I need a name please!',
                    'dir'     => '',
                    'place'   => 'plugin',
                    'details' => array(),
                    'assets'  => array('styles' => array(), 'scripts' => array(array('src' => '', 'data' => array()))),
                    'data'    => array()
                ), array_filter($filter[$layout]));

                $filter[$layout]['dir'] = $this->switch_alias_dir($filter[$layout]['dir']);

                if (isset($filter[$layout]['assets']['styles']) && !empty($filter[$layout]['assets']['styles'])) {
                    foreach ($filter[$layout]['assets']['styles'] as $style_url) {
                        $style_hierechy = explode('/', $style_url);
                        $alias_name = $style_hierechy[count($style_hierechy) - 1];
                        wp_enqueue_style($alias_name, $style_url, array(), '');
                    }
                }

                if (isset($filter[$layout]['assets']['scripts']) && !empty($filter[$layout]['assets']['scripts'])) {
                    foreach ($filter[$layout]['assets']['scripts'] as $script) {

                        if (is_array($script) && (!isset($script['data']) || !isset($script['src']))) continue;
                        $script_src = (is_array($script)) ? $script['src'] : $script;
                        $script_hierechy = explode('/', $script_src);
                        $alias_name = $script_hierechy[count($script_hierechy) - 1];

                        if (is_array($script)) {
                            wp_register_script($alias_name, $script_src, array(), '', true);
                            wp_localize_script($alias_name, 'data', $script['data']);
                            wp_enqueue_script($alias_name);
                        } else {
                            wp_enqueue_script($alias_name, $script_src, array(), '', true);
                        }
                    }
                }

                if ($filter[$layout]['place'] == 'plugin') {
                    $dir = $this->plugin_folder_dir . DIRECTORY_SEPARATOR . trim($filter[$layout]['dir'], '\/\\') . '.temp.php';
                } elseif ($filter[$layout]['place'] == 'theme') {
                    $dir = $this->theme_folder_dir . DIRECTORY_SEPARATOR . trim($filter[$layout]['dir'], '\/\\') . '.temp.php';
                }
                if (file_exists($dir)) {
                    return $dir;
                }
                return "Template not found!";
            }
        }

        /**
         * GETTING THE BEST FUCKING LAYOUTS TEMPLATES FROM EVERYWHERE EVENIF IT LOCATED IN ALIEN'S PLANET
         * ----------------------------------------------
         * @param $template_name
         * @param $filter_name
         * @param array $query_args
         * @return string
         */
        public function get_layout_template__($template_name, $filter_name, $query_args = array())
        {
            // Declare Variable
            if (!empty($query_args)) {
                foreach ($query_args as $variable_name => $value) {
                    ${$variable_name} = $value;
                }
            }

            // The array that will contains templates's layout
            // The structure will be like this Shit. If it's not fine, just fuck this bitch
            $template_array = array();
            /* $template_array = array(
                 'template_name' => array(
                     'name'   => 'A Fucking awesome name',
                     'dir'    => 'A fucking directory' // Will be fucking alias for shortly,
                     'place'  => 'plugin|template' // Currently support
                     'details' => array('Some illegal dirty details'),
                     // Blow Job for this bitch
                     'assets' => array(
                         'styles'  => array(),
                         'scripts' => array(string | array('src' => '', 'data' => array()))
                     ),
                     // Always be good when have some addition data right?
                     'data' => array('variable_name' => value)
                 )
             ); */

            // Let's put some dicks for this bitch
            if (has_filter($filter_name)) $template_array = apply_filters($filter_name, $template_array);
//            return $template_array;
            if (isset($template_array[$template_name]) && isset($template_array[$template_name]['dir'])) {
                $chosen_template = $template_array[$template_name];
                // Filter elements
                $chosen_template = array_merge(array(
                    'name'    => 'I need a name please!',
                    'dir'     => '',
                    'place'   => 'plugin',
                    'details' => array(),
                    'assets'  => array('styles' => array(), 'scripts' => array(array('src' => '', 'data' => array()))),
                    'data'    => array()
                ), array_filter($chosen_template));

                // Extract if it has addition data
                if (!empty($chosen_template['data'])) {
                    foreach ($chosen_template['data'] as $variable_name => $value) {
                        ${$variable_name} = $value;
                    }
                }

                // Begin to make love weed dir
                $chosen_template['dir'] = $this->switch_alias_dir($chosen_template['dir']);

                if ($chosen_template['place'] == 'plugin') {
                    $chosen_template['dir'] = $this->plugin_folder_dir . DIRECTORY_SEPARATOR . trim($chosen_template['dir'], '\/\\') . '.temp.php';
                } elseif ($chosen_template['place'] == 'theme') {
                    $chosen_template['dir'] = $this->theme_folder_dir . DIRECTORY_SEPARATOR . trim($chosen_template['dir'], '\/\\') . '.temp.php';
                }

                // Let's enqueue some style and scripts

                if (isset($chosen_template['assets']['styles']) && !empty($chosen_template['assets']['styles'])) {
                    foreach ($chosen_template['assets']['styles'] as $style_url) {
                        $style_hierechy = explode('/', $style_url);
                        $alias_name = $style_hierechy[count($style_hierechy) - 1];
                        wp_enqueue_style($alias_name, $style_url, array(), '');
                    }
                }

                if (isset($chosen_template['assets']['scripts']) && !empty($chosen_template['assets']['scripts'])) {
                    foreach ($chosen_template['assets']['scripts'] as $script) {

                        if (is_array($script) && (!isset($script['data']) || !isset($script['src']))) continue;
                        $script_src = (is_array($script)) ? $script['src'] : $script;
                        $script_hierechy = explode('/', $script_src);
                        $alias_name = $script_hierechy[count($script_hierechy) - 1];

                        if (is_array($script)) {
                            wp_register_script($alias_name, $script_src, array(), '', true);
                            wp_localize_script($alias_name, 'data', $script['data']);
                            wp_enqueue_script($alias_name);
                        } else {
                            wp_enqueue_script($alias_name, $script_src, array(), '', true);
                        }
                    }
                }

                if (file_exists($chosen_template['dir'])) {
                    ob_start();
                    include $chosen_template['dir'];
                    return ob_get_clean();
                }
            }
            return 'Cannot find directory template of: ' . $template_name;
        }


        /**
         * Detect the alert parameter from URL and return the alert equipvalent with notice type
         * -------------------------------------------------------------------------------------
         * @return string
         */
        public function autoCheckNotice()
        {
            if (isset($_GET['notice'])) {
                $notice = json_decode(base64_decode($_GET['notice']), true);
                $type = (!isset($notice['type'])) ? 'error' : $notice['type'];
                switch ($type) {
                    case 'error':
                        return $this->admin_template__('alert', array('class' => 'alert-danger', 'title' => $notice['title'], 'body' => $notice['body']), 'boot.templates.elements');
                        break;
                    case 'success':
                        return $this->admin_template__('alert', array('class' => 'alert-success', 'title' => $notice['title'], 'body' => $notice['body']), 'boot.templates.elements');
                        break;
                    case 'warning':
                        return $this->admin_template__('alert', array('class' => 'alert-warning', 'title' => $notice['title'], 'body' => $notice['body']), 'boot.templates.elements');
                        break;
                    case 'infor':
                        return $this->admin_template__('alert', array('class' => 'alert-info', 'title' => $notice['title'], 'body' => $notice['body']), 'boot.templates.elements');
                        break;
                    default:
                        break;
                }
            } elseif (isset($_POST['notice'])) {
                $notice = json_decode(base64_decode($_POST['notice']), true);
                $type = (!isset($notice['type'])) ? 'error' : $notice['type'];
                switch ($type) {
                    case 'error':
                        return $this->admin_template__('alert', array('class' => 'alert-danger', 'title' => sanitize_text_field($notice['title']), 'body' => sanitize_text_field($notice['body'])), 'boot.templates.elements');
                        break;
                    case 'success':
                        return $this->admin_template__('alert', array('class' => 'alert-success', 'title' => sanitize_text_field($notice['title']), 'body' => sanitize_text_field($notice['body'])), 'boot.templates.elements');
                        break;
                    case 'warning':
                        return $this->admin_template__('alert', array('class' => 'alert-warning', 'title' => sanitize_text_field($notice['title']), 'body' => sanitize_text_field($notice['body'])), 'boot.templates.elements');
                        break;
                    case 'infor':
                        return $this->admin_template__('alert', array('class' => 'alert-info', 'title' => sanitize_text_field($notice['title']), 'body' => sanitize_text_field($notice['body'])), 'boot.templates.elements');
                        break;
                    default:
                        break;
                }
            }
        }

        public function uploadFile($file)
        {
            if (!function_exists('wp_handle_upload')) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
            }
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload($file, $upload_overrides);
            if ($movefile && !isset($movefile['error'])) {
                return $movefile;
            } else {
                return false;
            }
        }

        public function downloadImage($url)
        {
            if (!function_exists('wp_handle_upload')) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
            }
            $temp_file = download_url($url);
            if (!is_wp_error($temp_file)) {
                // Array based on $_FILE as seen in PHP file uploads
                $file = array(
                    'name'     => basename($url), // ex: wp-header-logo.png
                    'type'     => 'image/',
                    'tmp_name' => $temp_file,
                    'error'    => 0,
                    'size'     => filesize($temp_file),
                );
                $overrides = array(
                    'test_form' => false,
                    'test_size' => true,
                );
                // Move the temporary file into the uploads directory
                $results = wp_handle_sideload($file, $overrides);
                if (!empty($results['error'])) {
                    return false;
                } else {
                    $filename = $results['file']; // Full path to the file
                    $local_url = $results['url']; // URL to the file in the uploads dir
                    $type = $results['type']; // MIME type of the file
                    return $results;
                }
            }
        }

        public function string_to_url($title, $body, $type = null)
        {
            return base64_encode(json_encode(array('title' => $title, 'body' => $body, 'type' => $type)));
        }

        /**
         * Switch a directory to a clean format
         * ------------------------------------------
         * @param $path
         * @return mixed
         */
        public function switch_alias_dir($path)
        {
            if (strpos($path, '.') !== false) {
                return str_replace('.', DIRECTORY_SEPARATOR, $path);
            }
            return $path;
        }

        public function validate_($type, $string = "")
        {
            switch ($type) {
                case 'email':
                    return fs_validateEmail($string);
                    break;
                case 'phone':
                    return fs_validatePhone($string);
                    break;
                case 'slug':
                    return fs_validateSlug($string);
                    break;
                case 'name':
                    return fs_validateName($string);
                    break;
                default:
                    return false;
                    break;
            }
            return false;
        }
    }
}