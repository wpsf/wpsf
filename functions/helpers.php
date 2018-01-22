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

if(!function_exists('wpsf_add_element')){
    function wpsf_add_element($field = array(),$value = '',$unique=''){
        static $total_columns = 0;
        $output = '';
        $class = 'WPSFramework_Option_' . $field ['type'];
        wpsf_autoloader($class, TRUE);

        if(class_exists($class)){
            ob_start();
            $element = new $class($field,$value,$unique);
            $element->final_output();
            $output .= ob_get_clean();
        }else {
            $output .= '<p>' . esc_html__('This field class is not available!', 'wpsf-framework') . '</p>';
        }
        return $output;
    }
}

/**
 *
 * Add framework element
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_add_element') ) {
    function _wpsf_add_element($field = array(), $value = '', $unique = '') {
        static $total_columns = 0;
        $output = '';
        $depend = '';
        $sub = ( isset ($field ['sub']) ) ? 'sub-' : '';
        $unique = ( isset ($unique) ) ? $unique : '';
        $languages = wpsf_language_defaults();
        $class = 'WPSFramework_Option_' . $field ['type'];
        $wrap_class = ( isset ($field ['wrap_class']) ) ? ' ' . $field ['wrap_class'] : '';
        $el_class = ( isset ($field ['title']) ) ? sanitize_title($field ['title']) : 'no-title';
        $hidden = ( isset ($field ['show_only_language']) && ( $field ['show_only_language'] != $languages ['current'] ) ) ? ' hidden' : '';
        $is_pseudo = ( isset ($field ['pseudo']) ) ? ' wpsf-pseudo-field' : '';
        $_row_after = '';
        if( isset ($field ['dependency']) ) {
            $hidden = ' hidden';
            $depend .= ' data-' . $sub . 'controller="' . $field ['dependency'] [0] . '"';
            $depend .= ' data-' . $sub . 'condition="' . $field ['dependency'] [1] . '"';
            $depend .= ' data-' . $sub . 'value="' . $field ['dependency'] [2] . '"';
        }

        if( isset($field['columns']) ) {
            $wrap_class .= ' wpsf-column wpsf-column-' . $field['columns'];

            if( 0 == $total_columns ) {
                $wrap_class .= ' wpsf-column-first';
                $output .= '<div class="wpsf-row">';
            }

            $total_columns += $field['columns'];

            if( 12 == $total_columns ) {
                $wrap_class .= ' wpsf-column-last';
                $_row_after = '</div>';
                $total_columns = 0;
            }
        }

        $output .= '<div class="wpsf-element wpsf-element-' . $el_class . ' wpsf-field-' . $field['type'] . $is_pseudo . $wrap_class . $hidden . '"' . $depend . '>';

        if( isset ($field ['title']) ) {
            $field_desc = ( isset ($field ['desc']) ) ? '<p class="wpsf-text-desc">' . $field ['desc'] . '</p>' : '';
            $output .= '<div class="wpsf-title"><h4>' . $field ['title'] . '</h4>' . $field_desc . '</div>';
        }

        $output .= ( isset ($field ['title']) ) ? '<div class="wpsf-fieldset">' : '';

        $value = ( ! isset ($value) && isset ($field ['default']) ) ? $field ['default'] : $value;
        $value = ( isset ($field ['value']) ) ? $field ['value'] : $value;


        wpsf_autoloader($class, TRUE);

        if( class_exists($class) ) {
            ob_start();
            $element = new $class ($field, $value, $unique);
            $element->output();
            $e_out = ob_get_clean();
            if( $field['type'] === 'hidden' ) {
                return $e_out;
            }
            $output .= $e_out;
        } else {
            $output .= '<p>' . esc_html__('This field class is not available!', 'wpsf-framework') . '</p>';
        }

        $output .= ( isset ($field ['title']) ) ? '</div>' : '';
        $output .= '<div class="clear"></div>';
        $output .= '</div>';


        $output .= $_row_after;
        return $output;
    }
}

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_encode_string') ) {
    function wpsf_encode_string($string) {
        return serialize($string);
    }
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_decode_string') ) {
    function wpsf_decode_string($string) {
        return unserialize($string);
    }
}

/**
 *
 * Get google font from json file
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_google_fonts') ) {
    function wpsf_get_google_fonts() {
        global $wpsf_google_fonts;

        if( ! empty ($wpsf_google_fonts) ) {

            return $wpsf_google_fonts;
        } else {

            ob_start();
            wpsf_locate_template('fields/typography/google-fonts.json');
            $json = ob_get_clean();

            $wpsf_google_fonts = json_decode($json);

            return $wpsf_google_fonts;
        }
    }
}

/**
 *
 * Get icon fonts from json file
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_icon_fonts') ) {
    function wpsf_get_icon_fonts($file) {
        ob_start();
        wpsf_locate_template($file);
        $json = ob_get_clean();

        return json_decode($json);
    }
}

/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_array_search') ) {
    function wpsf_array_search($array, $key, $value) {
        $results = array();

        if( is_array($array) ) {
            if( isset ($array [$key]) && $array [$key] == $value ) {
                $results [] = $array;
            }

            foreach( $array as $sub_array ) {
                $results = array_merge($results, wpsf_array_search($sub_array, $key, $value));
            }
        }

        return $results;
    }
}

/**
 *
 * Getting POST Var
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_var') ) {
    function wpsf_get_var($var, $default = '') {
        if( isset ($_POST [$var]) ) {
            return $_POST [$var];
        }

        if( isset ($_GET [$var]) ) {
            return $_GET [$var];
        }

        return $default;
    }
}

/**
 *
 * Getting POST Vars
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_vars') ) {
    function wpsf_get_vars($var, $depth, $default = '') {
        if( isset ($_POST [$var] [$depth]) ) {
            return $_POST [$var] [$depth];
        }

        if( isset ($_GET [$var] [$depth]) ) {
            return $_GET [$var] [$depth];
        }

        return $default;
    }
}

/**
 *
 * Load options fields
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_load_option_fields') ) {
    function wpsf_load_option_fields() {
        $located_fields = array();

        foreach( glob(WPSF_DIR . '/fields/*/*.php') as $wpsf_field ) {
            $located_fields [] = basename($wpsf_field);
            wpsf_locate_template(str_replace(WPSF_DIR, '', $wpsf_field));
        }

        $override_name = apply_filters('wpsf_framework_override', 'wpsf-framework-override');
        $override_dir = get_template_directory() . '/' . $override_name . '/fields';

        if( is_dir($override_dir) ) {

            foreach( glob($override_dir . '/*/*.php') as $override_field ) {

                if( ! in_array(basename($override_field), $located_fields) ) {

                    wpsf_locate_template(str_replace($override_dir, '/fields', $override_field));
                }
            }
        }

        do_action('wpsf_load_option_fields');
    }
}
