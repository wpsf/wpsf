<?php
/*-------------------------------------------------------------------------------------------------
 - This file is part of the WPSF package.                                                         -
 - This package is Open Source Software. For the full copyright and license                       -
 - information, please view the LICENSE file which was distributed with this                      -
 - source code.                                                                                   -
 -                                                                                                -
 - @package    WPSF                                                                               -
 - @author     Varun Sridharan <varunsridharan23@gmail.com>                                       -
 -------------------------------------------------------------------------------------------------*/

if( ! defined("ABSPATH") ) {
    exit;
}

if( ! class_exists("WPSFramework_WC_Metabox") ) {
    class WPSFramework_WC_Metabox extends WPSFramework_Abstract {
        private static $_instance = NULL;

        public $options = NULL;

        public $default_wc_tabs = NULL;

        public $fields = array();

        public $group_fields = array();

        public $groups_to_add = array();

        public $variation_errors = array();

        public $variation_fields = array(
            'pricing'    => array(),
            'options'    => array(),
            'inventory'  => array(),
            'dimensions' => array(),
            'tax'        => array(),
            'download'   => array(),
            'default'    => array(),
        );

        public static function instance() {
            if( self::$_instance === NULL ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct($options = array()) {
            $this->default_wc_tabs = apply_filters('wpsf_wc_default_tabs', array(
                'general'        => 'general_product_data',
                'inventory'      => 'inventory_product_data',
                'shipping'       => 'shipping_product_data',
                'linked_product' => 'linked_product_data',
                'attribute'      => 'product_attributes',
                'variations'     => 'variable_product_options',
                'advanced'       => 'advanced_product_data',
            ));

            $this->init($options);
        }

        public function init($options) {
            if( ! empty($options) ) {
                $this->options = apply_filters('wpsf_wc_metabox_options', $options);
                $this->addAction('load-post.php', 'handle_options');
                $this->addAction('load-post-new.php', 'handle_options');
                $this->addAction('wp_ajax_woocommerce_load_variations', 'handle_options', 1);
                $this->addAction('woocommerce_product_data_tabs', 'add_wc_tabs');
                $this->addAction("woocommerce_product_data_panels", 'add_wc_fields', 99);
                $this->addAction("admin_enqueue_scripts", 'load_style_script');
                $this->addAction('woocommerce_admin_process_product_object', 'save_product_data');
                $this->addAction('woocommerce_product_options_advanced', 'advanced_page');
                $this->addAction('woocommerce_product_options_general_product_data', 'general_page');
                $this->addAction('woocommerce_product_options_inventory_product_data', 'stock_page');
                $this->addAction('woocommerce_product_options_related', 'linked_page');
                $this->addAction('woocommerce_product_options_shipping', 'shipping_page');
                $this->addAction('woocommerce_save_product_variation', 'save_variation_fields', 10, 2);

                $this->addAction('woocommerce_variation_options', 'wc_variation_options', 10, 3);
                $this->addAction('woocommerce_variation_options_pricing', 'wc_variation_pricing', 10, 3);
                $this->addAction('woocommerce_variation_options_inventory', 'wc_variation_inventory', 10, 3);
                $this->addAction('woocommerce_variation_options_dimensions', 'wc_variation_dimensions', 10, 3);
                $this->addAction('woocommerce_variation_options_tax', 'wc_variation_tax', 10, 3);
                $this->addAction('woocommerce_variation_options_download', 'wc_variation_download', 10, 3);
                $this->addAction('woocommerce_product_after_variable_attributes', 'wc_variation_variable_attributes', 10, 3);
            }
        }

        public function wc_variation_options($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('options', $loop, $variation);
        }

        public function wc_variation_pricing($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('pricing', $loop, $variation);
        }

        public function wc_variation_inventory($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('inventory', $loop, $variation);
        }

        public function wc_variation_dimensions($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('dimensions', $loop, $variation);
        }

        public function wc_variation_tax($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('tax', $loop, $variation);
        }

        public function wc_variation_download($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('download', $loop, $variation);
        }

        public function wc_variation_variable_attributes($loop, $variation_data, $variation) {
            echo $this->render_variation_fields('default', $loop, $variation);
        }

        public function advanced_page() {
            echo $this->_render_group_page('advanced');
        }

        public function general_page() {
            echo $this->_render_group_page('general');
        }

        public function stock_page() {
            echo $this->_render_group_page('inventory');
        }

        public function linked_page() {
            echo $this->_render_group_page('linked_product');
        }

        public function shipping_page() {
            echo $this->_render_group_page('shipping');
        }

        public function render_variation_fields($type, $loop, $variation) {
            if( empty($this->fields) ) {
                $this->handle_options();
            }
            $fieldss = isset($this->variation_fields[$type]) ? $this->variation_fields[$type] : $this->fields;
            $variation_id = is_object($variation) ? $variation->ID : absint($variation);
            $final = '';

            $output = '';
            foreach( $fieldss as $meta_id => $sections ) {
                foreach( $sections as $fields ) {
                    global $wpsf_errors;
                    $errors = get_transient('_wpsf_variation_' . $variation_id . '_' . $loop);
                    $options = get_post_meta($variation_id, $meta_id, TRUE);
                    $options = ( ! is_array($options) ) ? array() : $options;

                    if( isset($errors['errors']) ) {
                        $this->variation_errors = array_merge($this->variation_errors, $errors['errors']);
                        set_transient('_wpsf_variation_' . $variation_id . '_' . $loop, array(), 10);
                    }

                    $wpsf_errors = $this->variation_errors;

                    foreach( $fields['fields'] as $field ) {

                        if( isset($field['is_variation']) ) {
                            $field['is_variation'] = ( $field['is_variation'] === TRUE ) ? 'default' : $field['is_variation'];
                            if( $field['is_variation'] == $type ) {
                                $defaults = array(
                                    'show'       => '',
                                    'hide'       => '',
                                    'wrap_class' => '',
                                );

                                $field = wp_parse_args($field, $defaults);
                                $field['error_id'] = '_' . $loop . $field['error_id'];
                                $value = isset($options[$field['id']]) ? $options[$field['id']] : '';
                                $WrapClass = $this->show_hide_class($field['show'], $field['hide']);
                                $field['wrap_class'] = $this->_merge_wrap_class($field['wrap_class'], $WrapClass);
                                $output .= wpsf_add_element($field, $value, $meta_id . '[' . $loop . ']');

                            }
                        }
                    }

                    $defaults = array(
                        'show' => '',
                        'hide' => '',
                    );
                    $fields = wp_parse_args($fields, $defaults);
                    $WrapClass = $this->show_hide_class($fields['show'], $fields['hide']);
                    $final .= '<div class="wpsf-wc-metabox-fields ' . $WrapClass . '">' . $output . '</div>';
                }
            }

            return $final;
        }

        public function save_variation_fields($variation_id, $loop) {
            if( empty($this->fields) ) {
                $this->handle_options();
            }
            $validator = new WPSFramework_Fields_Save_Sanitize;
            foreach( $this->fields as $meta_id => $fields ) {
                $posted_values = wpsf_get_var($meta_id);

                foreach( $fields as $field ) {
                    if( isset($field['is_variation']) != FALSE ) {
                        $field['error_id'] = '_' . $loop . $field['error_id'];
                        $val = isset($posted_values[$loop][$field['id']]) ? $posted_values[$loop][$field['id']] : "";
                        $val = $validator->_sanitize_field($field, $val, $fields);
                        $val = $validator->_validate_field($field, $val, $fields);

                        if( isset($posted_values[$loop][$field['id']]) ) {
                            $posted_values[$loop][$field['id']] = $val;
                        }
                    }
                }
                update_post_meta($variation_id, $meta_id, $posted_values[$loop]);
                set_transient('_wpsf_variation_' . $variation_id . '_' . $loop, array( 'errors' => $validator->get_errors() ), 50);
            }
        }

        private function render_fields($option, $db_key = '') {
            global $post, $wpsf_errors;
            $html = '';
            $values = get_post_meta($post->ID, $db_key, TRUE);
            $transient = get_transient('wpsf-wc-mt' . $db_key);
            $wpsf_errors = isset($transient['errors']) ? $transient['errors'] : array();

            if( ! is_array($values) ) {
                $values = array();
            }
            if( isset($option['fields']) ) {
                foreach( $option['fields'] as $field ) {
                    if( isset($field['is_variation']) && ( isset($field['only_variation']) && $field['only_variation'] === TRUE ) ) {
                        continue;
                    }
                    $defaults = array(
                        'show'       => '',
                        'hide'       => '',
                        'wrap_class' => '',
                    );
                    $field = wp_parse_args($field, $defaults);
                    $field_id = isset($field['id']) ? $field['id'] : "";
                    $value = isset($values[$field_id]) ? $values[$field_id] : '';
                    $WrapClass = $this->show_hide_class($field['show'], $field['hide']);
                    $field['wrap_class'] = $this->_merge_wrap_class($field['wrap_class'], $WrapClass);
                    $html .= wpsf_add_element($field, $value, $db_key);
                }
            }
            return $html;
        }

        private function _render_group_page($key = '') {
            if( ! isset($this->group_fields[$key]) ) {
                return;
            }

            foreach( $this->group_fields[$key] as $group_field ) {
                $wc_class = ( isset($group_field['wc_style']) && $group_field['wc_style'] === TRUE ) ? ' wpsf-wc-style wpsf-wc-metabox-fields ' : ' wpsf-wc-metabox-fields ';
                echo '<div class="' . $wc_class . '">';
                echo $this->render_fields($group_field, $group_field['id']);
                echo '</div>';
            }
        }

        private function _handle_fields($section, $db_id, $section_variation) {
            $place = 'default';
            $add_vars = FALSE;
            foreach( $section['fields'] as $field_id => $field ) {
                if( $section_variation !== FALSE ) {
                    $place = ( $section_variation === TRUE ) ? 'default' : $section_variation;
                    $section['fields'][$field_id]['is_variation'] = $place;
                    $add_vars = TRUE;
                } else if( isset($field['only_variation']) ) {
                    $place = ( $field['is_variation'] === TRUE ) ? 'default' : $field['is_variation'];
                    $add_vars = TRUE;
                } else {
                    $this->fields[$db_id][] = $field;
                    if( isset($field['is_variation']) ) {
                        $place = ( $field['is_variation'] === TRUE ) ? 'default' : $field['is_variation'];
                        $add_vars = TRUE;
                    }
                }
            }

            if( $add_vars === TRUE ) {
                $this->variation_fields[$place][$db_id][] = $section;
            }
        }

        private function _get_page_id($section) {
            $sec_id = ( isset($section['id']) ) ? $section['id'] : NULL;
            $sec_id = ( $sec_id === NULL && isset($section['name']) ) ? wpsf_sanitize_title($section['name']) : $sec_id;
            $sec_id = ( $sec_id === NULL && isset($section['group']) ) ? wpsf_sanitize_title($section['group']) : $sec_id;
            return $sec_id;
        }

        public function handle_options() {
            foreach( $this->options as $page_id => $page ) {
                $db_id = $page['id'];

                if( isset($page['sections']) ) {
                    foreach( $page['sections'] as $section_id => $section ) {
                        $sec_id = $this->_get_page_id($section);
                        $section = $this->map_error_id($section, $sec_id);
                        $this->options[$page_id]['sections'][$section_id] = $section;
                    }
                } else {
                    $sec_id = $this->_get_page_id($page);
                    $page = $this->map_error_id($page, $sec_id);
                    $this->options[$page_id] = $page;
                }
            }

            foreach( $this->options as $page_id => $page ) {
                $db_id = $page['id'];
                if( ! isset($this->fields[$db_id]) ) {
                    $this->fields[$db_id] = array();
                }

                if( isset($page['sections']) ) {
                    foreach( $page['sections'] as $section_id => $section ) {
                        $parent_variation = ( isset($section['is_variation']) ) ? $section['is_variation'] : FALSE;
                        $only_variation = ( isset($section['only_variation']) ) ? $section['only_variation'] : FALSE;

                        if( $only_variation == FALSE ) {
                            if( isset($section['group']) ) {
                                if( ! isset($this->group_fields[$section['group']]) ) {
                                    $this->group_fields[$section['group']] = array();
                                }
                                $this->group_fields[$section['group']][] = array_merge(array( 'id' => $db_id ), $section);
                            } else {
                                $this->groups_to_add[] = array_merge(array( 'id' => $db_id ), $section);
                            }
                        }
                        $this->_handle_fields($section, $db_id, $parent_variation);
                    }
                } else {
                    $parent_variation = ( isset($page['is_variation']) ) ? $page['is_variation'] : FALSE;
                    $only_variation = ( isset($page['only_variation']) ) ? $page['only_variation'] : FALSE;
                    if( $only_variation == FALSE ) {
                        $this->groups_to_add[] = $page;
                    }
                    $this->_handle_fields($page, $db_id, $parent_variation);
                }
            }

        }

        public function save_product_data() {
            global $post;

            if( wp_verify_nonce(wpsf_get_var('wpsf-framework-wc-metabox-nonce'), 'wpsf-framework-wc-metabox') ) {
                $validator = new WPSFramework_Fields_Save_Sanitize;
                foreach( $this->fields as $db_id => $fields ) {
                    $transient = array();
                    $request = wpsf_get_var($db_id);
                    $ex_value = $this->_post_data('get', $db_id);
                    $request = $validator->loop_fields(array( 'fields' => $fields ), $request, $ex_value, TRUE);
                    $request = apply_filters('wpsf_wc_metabox_save', $request, $db_id, $post);

                    if( empty($request) ) {
                        delete_post_meta($post->ID, $db_id);
                    } else {
                        update_post_meta($post->ID, $db_id, $request);
                    }
                    $transient['errors'] = $validator->get_errors();
                    set_transient('wpsf-wc-mt' . $db_id, $transient, 30);
                }
            }
        }

        public function load_style_script() {
            global $typenow;
            if( $typenow === 'product' ) {
                wpsf_load_fields_styles();
            }
        }

        public function add_wc_tabs($tabs = array()) {
            foreach( $this->groups_to_add as $group ) {
                $defaults = array(
                    'class'    => array(),
                    'priority' => 9999,
                    'title'    => '',
                    'name'     => '',
                    'show'     => '',
                    'hide'     => '',
                );

                $group = wp_parse_args($group, $defaults);
                $default_class = array( 'wpsf-wc-tab' );
                $default_class = is_array($group['class']) ? array_merge($group['class'], $default_class) : array_merge(array( $group['class'] ), $default_class);
                $default_class = array_merge($default_class, $this->show_hide_class($group['show'], $group['hide']));
                $tabs[$group['name']] = array(
                    'label'    => $group['title'],
                    'target'   => apply_filters('wpsf_sanitize_title', 'wpsf_' . $group['name'] . '_wctab'),
                    'class'    => $default_class,
                    'priority' => $group['priority'],
                );
            }
            return $tabs;
        }

        private function __sh_class($data, $key) {
            $return = array();
            if( ! empty($data) ) {
                foreach( explode('|', $data) as $c ) {
                    $return[] = $key . $c;
                }
            }
            return $return;
        }

        private function show_hide_class($show = '', $hide = '', $_r = 'array') {
            $return = array();
            $return = array_merge($return, $this->__sh_class($show, 'show_if_'));
            $return = array_merge($return, $this->__sh_class($hide, 'hide_if_'));
            if( $_r == 'array' ) {
                return $return;
            }
            return implode(' ', $return);
        }

        private function _merge_wrap_class($old_classes = '', $new_class = array()) {
            if( empty($old_class) ) {
                return implode(' ', $new_class);
            }

            $ex_class = explode(' ', $old_classes);
            foreach( $new_class as $c ) {
                if( ! in_array($c, $ex_class) ) {
                    $ex_class[] = $c;
                }
            }
            return implode(' ', $ex_class);
        }

        private function _post_data($type = 'get', $key = '', $update_value = '', $post_id = '') {
            if( empty($post_id) ) {
                global $post;
                $post_id = isset($post->ID) ? $post->ID : FALSE;
            }

            if( $type == 'get' ) {
                return get_post_meta($post_id, apply_filters('wpsf_sanitize_title', $key), TRUE);
            }

            return update_post_meta($post_id, apply_filters('wpsf_sanatize_title', $key), $update_value);
        }

        public function add_wc_fields() {
            wp_nonce_field('wpsf-framework-wc-metabox', 'wpsf-framework-wc-metabox-nonce');

            foreach( $this->groups_to_add as $group ) {
                $default = array(
                    'fields' => '',
                    'name'   => '',
                    'title'  => '',
                );
                $group = wp_parse_args($group, $default);
                $id = apply_filters('wpsf_sanitize_title', 'wpsf_' . $group['name'] . '_wctab');
                $wc_class = ( isset($group['wc_style']) && $group['wc_style'] === TRUE ) ? ' wpsf-wc-style ' : '';
                echo '<div id="' . $id . '" class="panel woocommerce_options_panel hidden  wpsf-wc-metabox-fields' . $wc_class . '">';
                echo $this->render_fields($group, $group['id']);
                echo '</div>';
            }
        }
    }
}