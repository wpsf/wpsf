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

if( ! function_exists('wpsf_get_error_message') ) {
    function wpsf_get_error_message($fields, $slug, $default) {
        if( isset($fields['errors'][$slug]) ) {
            return $fields['errors'][$slug];
        }
        return $default;
    }
}


/**
 *
 * Email validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_validate_email') ) {
    function wpsf_validate_email($value, $field) {
        if( ! sanitize_email($value) ) {
            return esc_html__('Please write a valid email address!', 'wpsf-framework');
        }
    }

    add_filter('wpsf_validate_email', 'wpsf_validate_email', 10, 2);
}

/**
 *
 * Numeric validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_validate_numeric') ) {
    function wpsf_validate_numeric($value, $field) {
        if( ! is_numeric($value) ) {
            return esc_html__('Please write a numeric data!', 'wpsf-framework');
        }
    }

    add_filter('wpsf_validate_numeric', 'wpsf_validate_numeric', 10, 2);
}

/**
 *
 * Required validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_validate_required') ) {
    function wpsf_validate_required($value) {
        if( empty ($value) ) {
            return esc_html__('Fatal Error! This field is required!', 'wpsf-framework');
        }
    }

    add_filter('wpsf_validate_required', 'wpsf_validate_required');
}
