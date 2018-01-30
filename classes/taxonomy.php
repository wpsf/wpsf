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

if( ! defined('ABSPATH') ) {
    die ();
} // Cannot access pages directly.

/**
 *
 * Taxonomy Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Taxonomy extends WPSFramework_Abstract {

    /**
     *
     * instance
     *
     * @access private
     * @var class
     *
     */
    private static $instance = NULL;
    /**
     *
     * taxonomy options
     *
     * @access public
     * @var array
     *
     */
    public $options = array();

    public function __construct($options) {
        $this->options = apply_filters('wpsf_taxonomy_options', $options);
        $this->taxes = array();
        if( ! empty ($this->options) ) {
            $this->addAction('admin_init', 'add_taxonomy_fields');
            $this->addAction("admin_enqueue_scripts", 'load_style_script');
        }
    }

    public static function instance($options = array()) {
        if( is_null(self::$instance) ) {
            self::$instance = new self ($options);
        }
        return self::$instance;
    }

    public function load_style_script() {
        global $pagenow, $taxnow;

        if( $pagenow === 'term.php' || $pagenow === 'edit-tags.php' ) {
            if( isset($this->taxes[$taxnow]) ) {
                wpsf_load_fields_styles();
            }
        }
    }

    public function add_taxonomy_fields() {
        foreach( $this->options as $option ) {
            $opt_taxonomy = $option ['taxonomy'];
            $get_taxonomy = wpsf_get_var('taxonomy');
            if( $get_taxonomy == $opt_taxonomy ) {
                $this->addAction($opt_taxonomy . '_add_form_fields', 'render_taxonomy_form_fields');
                $this->addAction($opt_taxonomy . '_edit_form', 'render_taxonomy_form_fields');

                $this->addAction('created_' . $opt_taxonomy, 'save_taxonomy');
                $this->addAction('edited_' . $opt_taxonomy, 'save_taxonomy');
                $this->addAction('delete_' . $opt_taxonomy, 'delete_taxonomy');
                $this->taxes[$opt_taxonomy] = $opt_taxonomy;
            }
        }
    }

    public function render_taxonomy_form_fields($term) {
        global $wpsf_errors;
        $form_edit = ( is_object($term) && isset ($term->taxonomy) ) ? TRUE : FALSE;
        $taxonomy = ( $form_edit ) ? $term->taxonomy : $term;
        $classname = ( $form_edit ) ? 'edit' : 'add';
        wp_nonce_field('wpsf-taxonomy', 'wpsf-taxonomy-nonce');
        echo '<div class="wpsf-framework wpsf-taxonomy wpsf-taxonomy-' . $classname . '-fields">';

        foreach( $this->options as $option ) {
            if( $taxonomy == $option ['taxonomy'] ) {
                $wpsf_errors = get_transient(wpsf_sanitize_title('wpsf-tt-'.$this->get_cache_key($option)));
                $tax_value = ( $form_edit ) ? wpsf_get_term_meta($term->term_id, $option ['id'], TRUE) : '';

                foreach( $option ['fields'] as $field ) {
                    $elem_value = $this->get_field_values($field,$tax_value);
                    echo wpsf_add_element($field, $elem_value, $option ['id']);
                }
            }
        }
        echo '</div>';
    }

    public function save_taxonomy($term_id) {
        if( wp_verify_nonce(wpsf_get_var('wpsf-taxonomy-nonce'), 'wpsf-taxonomy') ) {
            $taxonomy = wpsf_get_var('taxonomy');
            $validator = new WPSFramework_Fields_Save_Sanitize;
            foreach( $this->options as $request_value ) {
                if( $taxonomy == $request_value ['taxonomy'] ) {
                    $request_key = $request_value ['id'];
                    $request = wpsf_get_var($request_key, array());

                    // ignore _nonce
                    if( isset ($request ['_nonce']) ) {
                        unset ($request ['_nonce']);
                    }

                    if( isset ($request_value ['fields']) ) {
                        $meta_value = wpsf_get_term_meta($term_id, $request_key, TRUE);

                        $request = $validator->loop_fields($request_value, $request, $meta_value, TRUE);

                        /*foreach( $request_value ['fields'] as $field ) {

                            if( isset ($field ['type']) && isset ($field ['id']) ) {

                                $field_value = wpsf_get_vars($request_key, $field ['id']);

                                // sanitize options
                                if( isset ($field ['sanitize']) && $field ['sanitize'] !== FALSE ) {
                                    $sanitize_type = $field ['sanitize'];
                                } else if( ! isset ($field ['sanitize']) ) {
                                    $sanitize_type = $field ['type'];
                                }

                                if( has_filter('wpsf_sanitize_' . $sanitize_type) ) {
                                    $request [$field ['id']] = apply_filters('wpsf_sanitize_' . $sanitize_type, $field_value, $field, $request_value ['fields']);
                                }

                                // validate options
                                if( isset ($field ['validate']) && has_filter('wpsf_validate_' . $field ['validate']) ) {

                                    $validate = apply_filters('wpsf_validate_' . $field ['validate'], $field_value, $field, $request_value ['fields']);

                                    if( ! empty ($validate) ) {

                                        $meta_value = wpsf_get_term_meta($term_id, $request_key, TRUE);

                                        $errors [$field ['id']] = array(
                                            'code'    => $field ['id'],
                                            'message' => $validate,
                                            'type'    => 'error',
                                        );
                                        $default_value = isset ($field ['default']) ? $field ['default'] : '';
                                        $request [$field ['id']] = ( isset ($meta_value [$field ['id']]) ) ? $meta_value [$field ['id']] : $default_value;
                                    }
                                }
                            }
                        }*/
                    }

                    $request = apply_filters('wpsf_save_taxonomy', $request, $request_key, $term_id);

                    if( empty ($request) ) {
                        wpsf_delete_term_meta($term_id, $request_key);
                    } else {
                        if( wpsf_get_term_meta($term_id, $request_key, TRUE) ) {
                            wpsf_update_term_meta($term_id, $request_key, $request);
                        } else {
                            wpsf_add_term_meta($term_id, $request_key, $request);
                        }
                    }

                    set_transient(wpsf_sanitize_title('wpsf-tt-'.$this->get_cache_key($request_value)), $validator->get_errors(), 20);
                }

            }
        }
    }

    public function delete_taxonomy($term_id) {
        $taxonomy = wpsf_get_var('taxonomy');
        if( ! empty ($taxonomy) ) {
            foreach( $this->options as $request_value ) {
                if( $taxonomy == $request_value ['taxonomy'] ) {
                    $request_key = $request_value ['id'];
                    wpsf_delete_term_meta($term_id, $request_key);
                }
            }
        }
    }
}
