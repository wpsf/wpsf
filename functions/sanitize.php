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
 * Text sanitize
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_text') ) {
    /**
     * @param $value
     * @param $field
     * @return string
     */
    function wpsf_sanitize_text($value, $field) {
        return wp_filter_nohtml_kses($value);
    }

    add_filter('wpsf_sanitize_text', 'wpsf_sanitize_text', 10, 2);
}

/**
 *
 * Textarea sanitize
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_textarea') ) {
    /**
     * @param $value
     * @return string
     */
    function wpsf_sanitize_textarea($value) {
        global $allowedposttags;
        return wp_kses($value, $allowedposttags);
    }

    add_filter('wpsf_sanitize_textarea', 'wpsf_sanitize_textarea');
}

/**
 *
 * Checkbox sanitize
 * Do not touch, or think twice.
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_checkbox') ) {
    /**
     * @param $value
     * @return bool
     */
    function wpsf_sanitize_checkbox($value) {
        if( ! empty ($value) && $value == 1 ) {
            $value = TRUE;
        }

        if( empty ($value) ) {
            $value = FALSE;
        }

        return $value;
    }

    add_filter('wpsf_sanitize_checkbox', 'wpsf_sanitize_checkbox');
    add_filter('wpsf_sanitize_switcher', 'wpsf_sanitize_checkbox');
}

/**
 *
 * Image select sanitize
 * Do not touch, or think twice.
 *
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_image_select') ) {
    /**
     * @param $value
     * @return array|mixed|string
     */
    function wpsf_sanitize_image_select($value) {
        if( isset ($value) && is_array($value) ) {
            if( count($value) ) {
                $value = $value;
            } else {
                $value = $value [0];
            }
        } else if( empty ($value) ) {
            $value = '';
        }

        return $value;
    }

    add_filter('wpsf_sanitize_image_select', 'wpsf_sanitize_image_select');
}

/**
 *
 * Group sanitize
 * Do not touch, or think twice.
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_group') ) {
    /**
     * @param $value
     * @return string
     */
    function wpsf_sanitize_group($value) {
        return ( empty ($value) ) ? '' : $value;
    }

    add_filter('wpsf_sanitize_group', 'wpsf_sanitize_group');
}

/**
 *
 * Title sanitize
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_title') ) {
    /**
     * @param $value
     * @return string
     */
    function wpsf_sanitize_title($value) {
        return sanitize_title($value);
    }

    add_filter('wpsf_sanitize_title', 'wpsf_sanitize_title');
}

/**
 *
 * Text clean
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_sanitize_clean') ) {
    /**
     * @param $value
     * @return mixed
     */
    function wpsf_sanitize_clean($value) {
        return $value;
    }

    add_filter('wpsf_sanitize_clean', 'wpsf_sanitize_clean', 10, 2);
}
