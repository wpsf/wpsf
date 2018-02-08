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

if( ! function_exists('wpsf_add_element') ) {
    /**
     * @param array  $field
     * @param string $value
     * @param string $unique
     * @return string
     */
    function wpsf_add_element($field = array(), $value = '', $unique = '') {
        static $total_columns = 0;
        $output = '';
        $class = 'WPSFramework_Option_' . $field ['type'];
        wpsf_autoloader($class, TRUE);

        if( class_exists($class) ) {
            ob_start();
            $element = new $class($field, $value, $unique);
            $element->final_output();
            $output .= ob_get_clean();
        } else {
            $output .= '<p>' . esc_html__('This field class is not available!', 'wpsf-framework') . '</p>';
        }
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
    /**
     * @param $string
     * @return string
     */
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
    /**
     * @param $string
     * @return mixed
     */
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
    /**
     * @return array|mixed|object
     */
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
    /**
     * @param $file
     * @return array|mixed|object
     */
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
    /**
     * @param $array
     * @param $key
     * @param $value
     * @return array
     */
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
    /**
     * @param        $var
     * @param string $default
     * @return string
     */
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
    /**
     * @param        $var
     * @param        $depth
     * @param string $default
     * @return string
     */
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

if( ! function_exists("wpsf_js_vars") ) {
    /**
     * @param      $object_name
     * @param      $l10n
     * @param bool $with_script_tag
     * @return string
     */
    function wpsf_js_vars($object_name = '', $l10n, $with_script_tag = TRUE) {
        foreach( (array) $l10n as $key => $value ) {
            if( ! is_scalar($value) )
                continue;
            $l10n[$key] = html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8');
        }

        if( ! empty($object_name) ) {
            $script = "var $object_name = " . wp_json_encode($l10n) . ';';
        } else {
            $script = wp_json_encode($l10n);
        }

        if( ! empty($after) )
            $script .= "\n$after;";
        if( $with_script_tag ) {
            return '<script type="text/javascript">' . $script . '</script>';
        }
        return $script;
    }
}