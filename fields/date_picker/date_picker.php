<?php

/*
 -------------------------------------------------------------------------------------------------
 - This file is part of the WPSF package.                                                         -
 - This package is Open Source Software. For the full copyright and license                       -
 - information, please view the LICENSE file which was distributed with this                      -
 - source code.                                                                                   -
 -                                                                                                -
 - @package    WPSF                                                                               -
 - @author     Varun Sridharan <varunsridharan23@gmail.com>                                       -
 -------------------------------------------------------------------------------------------------
 *
 * Created by PhpStorm.
 * User: varun
 * Date: 12-01-2018
 * Time: 07:48 AM
 */

class WPSFramework_Option_date_picker extends WPSFramework_Options {
    /**
     * WPSFramework_Option_date_picker constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();
        $this->simple_datepicker('simple', $this->settings(), '');
        echo $this->element_after();
    }

    public function simple_datepicker($type = 'simple', $extrAttrs = array(), $title = '') {
        $elem_args = array_filter(array(
            'id'         => $this->field['id'],
            'type'       => 'text',
            'class'      => 'wpsf-datepicker ',
            'wrap_class' => 'horizontal ',
            'title'      => $title,
            'pseudo'     => TRUE,
            'attributes' => array_merge(array( 'data-datepicker-type'  => $type,
                                               'data-datepicker-theme' => $this->get_theme(),
            ), $extrAttrs),
        ));
        echo wpsf_add_element($elem_args, $this->element_value(), $this->unique);
    }

    public function get_theme() {
        return ( isset($this->field['theme']) ) ? 'flatpickr-' . $this->field['theme'] : '';
    }

    protected function settings() {
        $return = array();

        $randID = sanitize_key($this->field['id']) . intval(microtime(TRUE));
        $randID = str_replace(array( '-', '_' ), '', $randID);
        if( ! empty($this->field['settings']) ) {
            wp_localize_script('wpsf-framework', $randID, $this->field['settings']);
        }

        return array( 'data-datepicker-id' => $randID, 'data-second-id' => $randID . 'Second' );
    }

    protected function _is_set($key, $default = FALSE) {
        if( isset($this->field['settings'][$key]) ) {
            return $this->field['settings'][$key];
        }
        return $default;
    }
}

