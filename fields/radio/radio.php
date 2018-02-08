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
 * Field: Radio
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_radio extends WPSFramework_Options {
    /**
     * WPSFramework_Option_radio constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        if( isset ($this->field ['options']) ) {

            $options = $this->field ['options'];
            $options = ( is_array($options) ) ? $options : array_filter($this->element_data($options));
            if( ! empty ($options) ) {

                echo '<ul' . $this->element_class() . '>';
                foreach( $options as $key => $value ) {
                    if( is_array($value) && ! isset($value['label']) ) {
                        $values = $this->element_value();
                        $gid = wpsf_sanitize_title($key);
                        $values = isset($values[$gid]) ? $values[$gid] : $values;

                        echo '<li><h3>' . $key . '</h3> <ul>';
                        $rid = '[' . wpsf_sanitize_title($key) . ']';
                        foreach( $value as $k => $v ) {
                            $data = $this->element_handle_option($v, $k);
                            $k = $data['id'];
                            $v = $data['value'];
                            $attr = $data['attributes'];
                            echo '<li>' . $this->_element($rid, $k, $v, $values, $attr,$data) . '</li>';
                        }
                        echo '</ul></li>';
                    } else {
                        $data = $this->element_handle_option($value, $key);
                        echo '<li>' . $this->_element('', $data['id'], $data['value'], $this->element_value(), $data['attributes'],$data) . '</li>';
                    }
                }
                echo '</ul>';
            }
        } else {
            $label = ( isset ($this->field ['label']) ) ? $this->field ['label'] : '';
            echo '<label><input type="radio" name="' . $this->element_name() . '" value="1"' . $this->element_class() . $this->element_attributes() . checked($this->element_value(), 1, FALSE) . '/> ' . $label . '</label>';
        }

        echo $this->element_after();
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $title
     * @param array  $chboxval
     * @param string $attributes
     * @return string
     */
    public function _element($name = '', $value = '', $title = '', $chboxval = array(), $attributes = '',$data = array()) {
        if( isset($this->field['icon_box']) && $this->field['icon_box'] === TRUE ) {
            $attr = $this->element_attributes($value, $attributes);
            $is_checked = $this->checked($chboxval, $value);
            $checkbox = '<input type="radio" name="' . $this->element_name($name) . '" value="' . $value . '" ' . $attr . ' ' . $is_checked . '/>';
            $icon = '<span class="wpsf-icon-preview wpsf-help" data-title="' . $title . '"><i class="' . $data['icon'] . '"></i></span>';
            return ' <label class="with-icon-preview">' . $checkbox . ' ' . $icon . '</label > ';
        }

        return '<label> <input type="radio" name="' . $this->element_name($name) . '" 
        value="' . $value . '"' . $this->element_attributes($value, $attributes) . $this->checked($chboxval, $value) . '/> ' . $title . ' </label>';

    }
}
