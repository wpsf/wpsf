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
/**
 * ------------------------------------------------------------------------------------------------
 * WordPress-Settings-Framework Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Copyright 2015 WordPress-Settings-Framework <info@wpsf.com>
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * ------------------------------------------------------------------------------------------------
 */

require_once plugin_dir_path(__FILE__) . '/wpsf-framework-path.php';

if( ! function_exists("wpsf_template") ) {
    /**
     * @param       $override_location
     * @param       $template_name
     * @param array $args
     * @return bool
     */
    function wpsf_template($override_location, $template_name, $args = array()) {
        if( file_exists($override_location . '/' . $template_name) ) {
            $path = $override_location . '/' . $template_name;
        } else if( file_exists(WPSF_DIR . '/templates/' . $template_name) ) {
            $path = WPSF_DIR . '/templates/' . $template_name;
        } else {
            return FALSE;
        }

        extract($args);
        include( $path );
        return TRUE;
    }
}

if( ! function_exists("wpsf_autoloader") ) {
    /**
     * @param      $class
     * @param bool $check
     * @return bool
     */
    function wpsf_autoloader($class, $check = FALSE) {
        if( $class === TRUE && class_exists($class) === TRUE ) {
            return TRUE;
        }

        if( 0 === strpos($class, 'WPSFramework_Option_') ) {
            $path = strtolower(substr($class, 20));
            wpsf_locate_template('fields/' . $path . '/' . $path . '.php');
        } else if( 0 === strpos($class, 'WPSFramework_') ) {
            $path = strtolower(substr(str_replace('_', '-', $class), 13));
            include( 'classes/' . $path . '.php' );
        }
        return TRUE;
    }
}

if( ! function_exists('wpsf_framework_init') && ! class_exists('WPSFramework') ) {
    function wpsf_framework_init() {

        defined('WPSF_ACTIVE_LIGHT_THEME') or define('WPSF_ACTIVE_LIGHT_THEME', FALSE);
        // helpers
        require_once( WPSF_DIR . '/functions/fallback.php' );
        require_once( WPSF_DIR . '/functions/helpers.php' );
        require_once( WPSF_DIR . '/functions/actions.php' );
        require_once( WPSF_DIR . '/functions/enqueue.php' );
        require_once( WPSF_DIR . '/functions/sanitize.php' );
        require_once( WPSF_DIR . '/functions/validate.php' );

        // classes
        require_once( WPSF_DIR . '/classes/abstract.php' );
        require_once( WPSF_DIR . '/classes/options.php' );
        require_once( WPSF_DIR . '/classes/framework.php' );

        wpsf_load_options();
        add_action('widgets_init', 'wpsf_framework_widgets', 1);
        spl_autoload_register('wpsf_autoloader');
        do_action("wpsf_framework_loaded");
    }

    add_action('plugins_loaded', 'wpsf_framework_init', 1);
    add_filter('widgets_init', 'wpsf_framework_widgets', 10);
}

if( ! function_exists('wpsf_framework_widgets') ) {
    function wpsf_framework_widgets() {
        wpsf_locate_template('classes/widget.php');
        do_action('wpsf_widgets');
    }
}

if( ! function_exists('wpsf_register_settings') ) {
    /**
     * @param string $slug
     */
    function wpsf_register_settings($slug = '') {
        $ex_data = get_option('_wpsf_registered_settings', TRUE);
        if( ! is_array($ex_data) ) {
            $ex_data = array();
        }

        if( ! in_array($slug, $ex_data) ) {
            $ex_data[] = $slug;
        }

        update_option('_wpsf_registered_settings', $ex_data);
    }
}

if( ! function_exists("wpsf_load_options") ) {
    function wpsf_load_options() {

        $ex_data = get_option('_wpsf_registered_settings', TRUE);
        if( ! is_array($ex_data) ) {
            $ex_data = array();
        }

        if( ! empty($ex_data) ) {
            foreach( $ex_data as $slug ) {
                $mslug = ltrim($slug, "_");
                $mslug = rtrim($mslug, "_");
                $data = get_option($slug, TRUE);
                $data = ( ! is_array($data) ) ? array() : $data;
                $GLOBALS[$mslug] = $data;
            }
        }
    }
}