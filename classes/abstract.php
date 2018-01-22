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
 * Abstract Class
 * A helper class for action and filter hooks
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
abstract class WPSFramework_Abstract {
    public function __construct() {
    }

    public function addAction($hook, $function_to_add, $priority = 30, $accepted_args = 1) {
        add_action($hook, array(
            &$this,
            $function_to_add,
        ), $priority, $accepted_args);
    }

    public function addFilter($tag, $function_to_add, $priority = 30, $accepted_args = 1) {
        add_action($tag, array(
            &$this,
            $function_to_add,
        ), $priority, $accepted_args);
    }

    public function load_template($template_name, $args = array()) {
        wpsf_template($this->override_location, $template_name, $args);
    }

    protected function map_error_id($array = array(), $parent_id = '') {
        $s = empty($array) ? $this->options : $array;

        if( isset($s['sections']) ) {
            foreach( $s['sections'] as $b => $a ) {
                if( isset($a['fields']) ) {

                    $s['sections'][$b] = $this->map_error_id($a, $a['name']);
                }
            }
        } else if( isset($s['fields']) ) {
            foreach( $s['fields'] as $f => $e ) {
                $field_id = isset($e['id']) ? $e['id'] : '';
                $pid = $parent_id . '_' . $field_id;
                $s['fields'][$f]['error_id'] = $pid;

                if( isset($e['fields']) ) {
                    $s['fields'][$f] = $this->map_error_id($e, $pid);
                }
            }
        } else {
            foreach( $s as $i => $v ) {
                if( isset($v['fields']) || isset($v['sections']) ) {
                    $s[$i] = $this->map_error_id($v, '');
                }
            }
        }
        return $s;
    }

    protected function catch_output($status = 'start') {
        $data = '';
        if( $status == 'start' ) {
            ob_start();
        } else {
            $data = ob_get_clean();
            ob_flush();
        }

        return $data;
    }

    protected function get_cache_key($data = array()) {
        if( empty($data) ) {
            $data = $this->settings;
        }

        if( isset($data['uid']) ) {
            return $data['uid'];
        } else if( isset($data['id']) ) {
            return $data['id'];
        } else if( isset($data['title']) ) {
            return sanitize_title($data['title']);
        } else if( isset($data['menu_title']) ) {
            return sanitize_title($data['menu_title']);
        }
        return FALSE;
    }
}
