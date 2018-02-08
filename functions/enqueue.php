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
}

if( ! function_exists("wpsf_load_fields_styles") ) {
    function wpsf_load_fields_styles() {
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('wpsf-plugins');
        wp_enqueue_script('wpsf-fields');
        wp_enqueue_script('wpsf-framework');

        wp_enqueue_style('editor-buttons');
        wp_enqueue_script('wplink');
        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_style('jquery-datepicker');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('animate-css');
        wp_enqueue_style('wpsf-plugins');
        wp_enqueue_style('wpsf-framework');

        if( is_rtl() ) {
            wp_enqueue_style('wpsf-framework-rtl');
        }
    }
}

if( ! function_exists('wpsf_admin_enqueue_scripts') ) {
    function wpsf_admin_enqueue_scripts() {
        $css_files = array(
            'wpsf-plugins'       => array( '/assets/css/wpsf-plugins.min.css', array(), '1.0.0', 'all' ),
            'wpsf-framework'     => array( '/assets/css/wpsf-framework.min.css', array(), '1.0.0', 'all', ),
            'font-awesome'       => array( '/assets/css/font-awesome.min.css', array(), '4.7.0', 'all', ),
            'wpsf-framework-rtl' => array( '/assets/css/wpsf-framework-rtl.min.css', array(), '1.0.0', 'all', ),
            'animate-css'        => array( '/assets/vendors/animatecss/animate.min.css', array(), '3.5.2', 'all', ),
        );

        $js_files = array(
            'wpsf-plugins'    => array( '/assets/js/wpsf-plugins.min.js', array(), '1.0.0', FALSE, ),
            'wpsf-framework'  => array( '/assets/js/wpsf-framework.min.js', array( 'wpsf-plugins' ), '1.0.0', FALSE, ),
            'wpsf-quick-edit' => array( '/assets/js/wpsf-quick-edit.min.js', NULL, '1.0', '', FALSE, ),
        );

        foreach( $css_files as $id => $file ) {
            wp_register_style($id, WPSF_URI . $file[0], $file[1], $file[2], $file[3]);
        }

        foreach( $js_files as $id => $file ) {
            wp_register_script($id, WPSF_URI . $file[0], $file[1], $file[2], TRUE);
        }

        if( has_action('wpsf_widgets') ) {
            add_action('admin_print_styles-widgets.php', 'wpsf_load_fields_styles');
        }
    }

    add_action('admin_enqueue_scripts', 'wpsf_admin_enqueue_scripts', 1);
}