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
 * A fallback for get term meta
 * get_term_meta added since WP 4.4
 *
 * @since 1.0.2
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_term_meta') ) {
    function wpsf_get_term_meta($term_id, $key = '', $single = FALSE) {
        if( function_exists("get_term_meta") ) {
            return get_term_meta($term_id, $key, $single);
        }
        $terms = get_option('wpsf_term_' . $key);
        return ( ! empty ($terms [$term_id]) ) ? $terms [$term_id] : FALSE;
    }
}

/**
 *
 * A fallback for add term meta
 * add_term_meta added since WP 4.4
 *
 * @since 1.0.2
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_add_term_meta') ) {
    function wpsf_add_term_meta($term_id, $meta_key = '', $meta_value, $unique = FALSE) {
        if( function_exists("add_term_meta") ) {
            return add_term_meta($term_id, $meta_key, $meta_value, $unique);
        }
        return update_term_meta($term_id, $meta_key, $meta_value, $unique);
    }
}

/**
 *
 * A fallback for update term meta
 * update_term_meta added since WP 4.4
 *
 * @since 1.0.2
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_update_term_meta') ) {
    function wpsf_update_term_meta($term_id, $meta_key, $meta_value, $prev_value = '') {
        if( function_exists("update_term_meta") ) {
            return update_term_meta($term_id, $meta_key, $meta_value, $prev_value);
        }

        if( ! empty ($term_id) || ! empty ($meta_key) || ! empty ($meta_value) ) {
            $terms = get_option('wpsf_term_' . $meta_key);
            $terms [$term_id] = $meta_value;
            update_option('wpsf_term_' . $meta_key, $terms);
        }
    }
}

/**
 *
 * A fallback for delete term meta
 * delete_term_meta added since WP 4.4
 *
 * @since 1.0.2
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_delete_term_meta') ) {
    function wpsf_delete_term_meta($term_id, $meta_key, $meta_value = '', $delete_all = FALSE) {
        if( function_exists("delete_term_meta") ) {
            return delete_term_meta($term_id, $meta_key, $meta_value, $delete_all);
        }
        if( ! empty ($term_id) || ! empty ($meta_key) ) {
            $terms = get_option('wpsf_term_' . $meta_key);
            unset ($terms [$term_id]);
            update_option('wpsf_term_' . $meta_key, $terms);
        }
    }
}
