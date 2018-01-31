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
 * Field: Select
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_select extends WPSFramework_Options {
    /**
     * WPSFramework_Option_select constructor.
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
            $class = $this->element_class();
            $options = ( is_array($options) ) ? $options : array_filter($this->element_data($options));
            if( isset($this->field['multiple']) ) {
                if( ! isset($this->field['attributes']) ) {
                    $this->field['attributes'] = array();
                }
                $this->field['attributes']['multiple'] = 'multiple';
            }
            $extra_name = ( isset ($this->field ['attributes'] ['multiple']) ) ? '[]' : '';
            $chosen_rtl = ( is_rtl() && strpos($class, 'chosen') ) ? 'chosen-rtl' : '';

            echo '<select name="' . $this->element_name($extra_name) . '"' . $this->element_class($chosen_rtl) . $this->element_attributes() . '>';

            echo ( isset ($this->field ['default_option']) ) ? '<option value="">' . $this->field ['default_option'] . '</option>' : '';

            if( ! empty ($options) ) {
                foreach( $options as $key => $value ) {

                    if( is_array($value) ) {
                        echo '<optgroup label="' . $key . '">';
                        foreach( $value as $v => $k ) {
                            echo '<option value="' . $v . '" ' . $this->checked($this->element_value(), $v, 'selected') . '>' . $k . '</option>';
                        }
                        echo '</optgroup>';
                    } else {
                        echo '<option value="' . $key . '" ' . $this->checked($this->element_value(), $key, 'selected') . '>' . $value . '</option>';
                    }
                }
            }

            echo '</select>';
        }

        echo $this->element_after();
    }
}
