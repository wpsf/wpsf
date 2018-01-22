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
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_icons') ) {
    function wpsf_get_icons() {
        do_action('wpsf_add_icons_before');

        $jsons = apply_filters('wpsf_add_icons_json', glob(WPSF_DIR . '/fields/icon/*.json'));

        if( ! empty ($jsons) ) {

            foreach( $jsons as $path ) {

                $object = wpsf_get_icon_fonts('fields/icon/' . basename($path));

                if( is_object($object) ) {

                    echo ( count($jsons) >= 2 ) ? '<h4 class="wpsf-icon-title">' . $object->name . '</h4>' : '';

                    foreach( $object->icons as $icon ) {
                        echo '<a class="wpsf-icon-tooltip" data-wpsf-icon="' . $icon . '" data-title="' . $icon . '"><span class="wpsf-icon wpsf-selector"><i class="' . $icon . '"></i></span></a>';
                    }
                } else {
                    echo '<h4 class="wpsf-icon-title">' . esc_html__('Error! Can not load json file.', 'wpsf-framework') . '</h4>';
                }
            }
        }

        do_action('wpsf_add_icons');
        do_action('wpsf_add_icons_after');

        die ();
    }

    add_action('wp_ajax_wpsf-get-icons', 'wpsf_get_icons');
}

/**
 *
 * Export options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_export_options') ) {
    function wpsf_export_options() {
        header('Content-Type: plain/text');
        header('Content-disposition: attachment; filename=backup-options-' . gmdate('d-m-Y') . '.txt');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo wpsf_encode_string(get_option(WPSF_OPTION));

        die ();
    }

    add_action('wp_ajax_wpsf-export-options', 'wpsf_export_options');
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_set_icons') ) {
    function wpsf_set_icons() {
        echo '<div id="wpsf-icon-dialog" class="wpsf-dialog" title="' . esc_html__('Add Icon', 'wpsf-framework') . '">';
        echo '<div class="wpsf-dialog-header wpsf-text-center"><input type="text" placeholder="' . esc_html__('Search a Icon...', 'wpsf-framework') . '" class="wpsf-icon-search" /></div>';
        echo '<div class="wpsf-dialog-load"><div class="wpsf-icon-loading">' . esc_html__('Loading...', 'wpsf-framework') . '</div></div>';
        echo '</div>';
    }

    add_action('admin_footer', 'wpsf_set_icons');
    add_action('customize_controls_print_footer_scripts', 'wpsf_set_icons');
}
