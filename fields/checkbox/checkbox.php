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
 * Field: Checkbox
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_checkbox extends WPSFramework_Options {
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
                    if( is_array($value) ) {
                        $values = $this->element_value();
                        $gid = wpsf_sanitize_title($key);
                        $values = isset($values[$gid]) ? $values[$gid] : $values;
                        echo '<li><h3>' . $key . '</h3><ul>';
                        foreach( $value as $i => $v ) {
                            echo '<li><label> 
                                <input type="checkbox" name="'.$this->element_name('['.$gid.'][]') . '" value="'.$i.'"'. $this->element_attributes($i) .
                                $this->checked($values, $i) . '/> ' . $v . '</label></li>';
                        }
                        echo '</ul></li>';
                    } else {
                        echo '<li><label><input type="checkbox" name="' . $this->element_name('[]') . '" value="' . $key . '"' . $this->element_attributes($key) . $this->checked($this->element_value(), $key) . '/> ' . $value . '</label></li>';
                    }
                }
                echo '</ul>';
            }
        } else {
            $label = ( isset ($this->field ['label']) ) ? $this->field ['label'] : '';
            echo '<label><input type="checkbox" name="' . $this->element_name() . '" value="1"' . $this->element_class() . $this->element_attributes() . checked($this->element_value(), 1, FALSE) . '/> ' . $label . '</label>';
        }

        echo $this->element_after();
    }
}
