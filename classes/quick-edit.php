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

/**
 * Created by PhpStorm.
 * User: varun
 * Date: 31-12-2017
 * Time: 02:44 PM
 */

if( ! defined('ABSPATH') ) {
    die ();
}

class WPSFramework_Quick_Edit extends WPSFramework_Abstract {

    public $options = array();
    public $post_types = array();
    public $formatted = array();
    public $only_IDS = array();
    private $added_ids = array();
    private $is_nonce_rendered = FALSE;

    public function __construct($options = array()) {
        $this->options = apply_filters('wpsf_quick_edit_options', $options);
        $this->hook_post_types();
        $this->addAction("admin_enqueue_scripts", 'load_style_script');
    }

    public function hook_post_types() {
        $this->post_types = wp_list_pluck($this->options, 'post_type', 'post_type');
        foreach( $this->options as $option ) {
            $this->only_IDS[] = $option['id'];
            if( ! isset($this->formatted[$option['post_type']]) ) {
                $this->formatted[$option['post_type']] = array();
            }

            if( ! isset($this->formatted[$option['post_type']][$option['column']]) ) {
                $this->formatted[$option['post_type']][$option['column']] = array();
            }

            $this->formatted[$option['post_type']][$option['column']][] = $option;
        }
        foreach( $this->post_types as $post_type ) {
            $this->addAction('manage_' . $post_type . '_posts_custom_column', 'render_hidden_data', 99, 100);
        }
        $this->addAction('quick_edit_custom_box', 'render_quick_edit', 10, 99);
        $this->addAction('save_post', 'save_quick_edit', 10, 2);
        $this->only_IDS = array_filter(array_unique($this->only_IDS));
    }

    public function load_style_script() {
        global $pagenow, $typenow;

        if( ( $pagenow === 'edit.php' ) && isset($this->post_types[$typenow]) ) {
            wpsf_load_fields_styles();
            wp_enqueue_script('wpsf-quick-edit');
        }
    }

    public function render_hidden_data($column, $post_id) {

        if( isset($this->added_ids[$post_id]) || empty($this->only_IDS) ) {
            return;
        }
        echo '<div id="wpsf_quick_edit_' . $post_id . '" class="hidden">';
        foreach( $this->only_IDS as $id ) {
            echo '<div id="' . $id . '"> ' . json_encode(get_post_meta($post_id, $id, TRUE)) . '</div>';
        }
        echo '</div>';
        $this->added_ids[$post_id] = $post_id;
    }

    public function render_quick_edit($column, $post_type) {
        if( ! isset($this->formatted[$post_type][$column]) ) {
            return;
        }

        if( $this->is_nonce_rendered === FALSE ) {
            wp_nonce_field('wpsf-quick-edit', 'wpsf-quick-edit-nonce');
            $this->is_nonce_rendered = TRUE;
        }

        $options = $this->formatted[$post_type][$column];
        echo '<fieldset class="inline-edit-col-left"> <div class="wpsf_quick_edit_fields inline-edit-col"> ';
        foreach( $options as $option ) {
            echo $this->render_fields($option, $option['id']);
        }
        echo '</div></fieldset>';
    }

    private function render_fields($option, $db_key = '') {
        if( ! isset($option['fields']) ) {
            return TRUE;
        }
        $html = '';
        foreach( $option['fields'] as $field ) {
            $html .= wpsf_add_element($field, '', $db_key);
        }
        return $html;
    }

    public function save_quick_edit($post_id, $post) {
        if( wp_verify_nonce(wpsf_get_var('wpsf-quick-edit-nonce'), 'wpsf-quick-edit') ) {
            $post_type = wpsf_get_var('post_type');
            $errors = array();
            $validator = new WPSFramework_Fields_Save_Sanitize;
            if( isset($this->post_types[$post_type]) && isset($this->formatted[$post_type]) ) {
                foreach( $this->formatted[$post_type] as $data ) {
                    foreach( $data as $section ) {
                        $transient = array();
                        $request_key = $section['id'];
                        $submitted_val = wpsf_get_var($request_key, array());
                        $db_value = get_post_meta($post_id, $request_key, TRUE);

                        if( ! is_array($db_value) ) {
                            $db_value = array();
                        }

                        $request = array_merge($db_value, $submitted_val);

                        if( isset($request['_nonce']) ) {
                            unset($request['_nonce']);
                        }

                        $request = $validator->loop_fields(array( 'fields' => $section['fields'] ), $request, $db_value, TRUE);
                        $request = apply_filters('wpsf_save_post', $request, $request_key, $post);

                        if( empty ($request) ) {
                            delete_post_meta($post_id, $request_key);
                        } else {
                            update_post_meta($post_id, $request_key, $request);
                        }

                    }
                }
            }
        }
    }
}