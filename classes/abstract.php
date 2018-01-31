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

    /**
     * @return bool
     */
    public function is_not_ajax() {
        if( isset ($_POST) && isset ($_POST['action']) && $_POST['action'] == 'heartbeat' ) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * @param     $hook
     * @param     $function_to_add
     * @param int $priority
     * @param int $accepted_args
     */
    public function addAction($hook, $function_to_add, $priority = 30, $accepted_args = 1) {
        add_action($hook, array( &$this, $function_to_add, ), $priority, $accepted_args);
    }

    /**
     * @param     $tag
     * @param     $function_to_add
     * @param int $priority
     * @param int $accepted_args
     */
    public function addFilter($tag, $function_to_add, $priority = 30, $accepted_args = 1) {
        add_action($tag, array( &$this, $function_to_add, ), $priority, $accepted_args);
    }

    /**
     * @param       $template_name
     * @param array $args
     */
    public function load_template($template_name, $args = array()) {
        wpsf_template($this->override_location, $template_name, $args);
    }

    /**
     * @param $field
     * @param $values
     * @return array|bool
     */
    public function get_field_values($field, $values) {
        $value = ( isset($field['id']) && isset($values[$field['id']]) ) ? $values[$field['id']] : FALSE;
        $value = ( empty($value) && isset($field['default']) ) ? $field['default'] : $value;

        if( in_array($field['type'], array(
                'fieldset',
                'accordion',
            )) && ( isset($field['un_array']) && $field['un_array'] === TRUE ) ) {
            $value = array();
            foreach( $field['fields'] as $_field ) {
                $value[$_field['id']] = $this->get_field_values($_field, $values);
            }
        } else if( $field['type'] == 'tab' ) {
            $value = array();
            $_tab_values = array();
            $_tab_vals = ( isset($field['id']) && isset($values[$field['id']]) ) ? $values[$field['id']] : '';
            if( ( isset($field['un_array']) && $field['un_array'] === TRUE ) ) {
                $_tab_vals = $values;
            }

            foreach( $field['sections'] as $section ) {
                $_section_vals = ( isset($section['name']) && isset($_tab_vals[$section['name']]) ) ? $_tab_vals[$section['name']] : $_tab_vals;

                $_section_values = array();
                foreach( $section['fields'] as $_field ) {
                    $_section_values[$_field['id']] = $this->get_field_values($_field, $_section_vals);
                }

                if( isset($section['un_array']) && $section['un_array'] === TRUE ) {
                    $_tab_values = array_merge($_section_values, $_tab_values);
                } else {
                    $_tab_values[$section['name']] = $_section_values;
                }
            }

            $value = $_tab_values;
        }

        return $value;
    }

    /**
     * @param array  $array
     * @param string $parent_id
     * @return array
     */
    protected function map_error_id($array = array(), $parent_id = '') {
        $s = empty($array) ? $this->options : $array;

        if( isset($s['sections']) ) {
            $fname = '';
            if( isset($s['type']) && $s['type'] === 'tab' ) {
                $fname = $parent_id . '_' . $s['id'] . '_';
            }
            foreach( $s['sections'] as $b => $a ) {
                if( isset($a['fields']) ) {
                    $fname .= ( isset($a['name']) ) ? $a['name'] : '';
                    $s['sections'][$b] = $this->map_error_id($a, $fname);
                }
            }
        } else if( isset($s['fields']) ) {
            foreach( $s['fields'] as $f => $e ) {
                $field_id = isset($e['id']) ? $e['id'] : '';
                $pid = $parent_id . '_' . $field_id;
                $s['fields'][$f]['error_id'] = $pid;

                if( isset($e['fields']) || isset($e['sections']) ) {
                    $s['fields'][$f] = $this->map_error_id($s['fields'][$f], $pid);
                }

            }
        } else {
            foreach( $s as $i => $v ) {
                if( isset($v['fields']) || isset($v['sections']) ) {
                    $s[$i] = $this->map_error_id($v, $parent_id);
                }
            }
        }
        return $s;
    }

    /**
     * @param string $status
     * @return string
     */
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

    /**
     * @param array $data
     * @return bool|mixed|string
     */
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
