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
 * ------------------------------------------------------------------------------------------------
 *
 * WordPress-Settings-Framework Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Plugin Name: WordPress-Settings-Framework Framework
 * Plugin URI: http://wpsf.com/
 * Author: WordPress-Settings-Framework
 * Author URI: http://varunsridharan.in/
 * Version: 1.0.2
 * Description: A Lightweight and easy-to-use WordPress Options Framework
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpsf-framework
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Copyright 2015 WordPress-Settings-Framework <info@wpsf.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * ------------------------------------------------------------------------------------------------
 */

require_once plugin_dir_path(__FILE__) . '/wpsf-framework.php';

add_action("wpsf_framework_loaded", 'wpsf_framework_demo',1);

add_action('wpsf_widgets', 'wpsf_sample_widget');


function wpsf_sample_widget() {
    require_once __DIR__.'/config/widget.php';
    register_widget('wpsf_sample_1');
}


function wpsf_framework_demo() {
    require_once( __DIR__ . '/config/wc-metabox.php' );
    require_once __DIR__ . '/config/settings.php';
    require_once __DIR__ . '/config/wp-customizer.php';
    require_once __DIR__ . '/config/metabox.php';
    require_once __DIR__.'/config/quick-edit.php';
    require_once __DIR__.'/config/taxonomy.php';
    require_once __DIR__.'/config/shortcode.php';
    require_once __DIR__.'/config/user-profile.php';
}

/*
add_action( 'shutdown', function(){
    $data = array();
    foreach( $GLOBALS['wp_actions'] as $action => $count ){
        $data[] = $action.' - ('.$count.')';
    }
    echo json_encode($data);

});*/