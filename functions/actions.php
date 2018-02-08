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
