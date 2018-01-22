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
 * Field: Image Select
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_image_select extends WPSFramework_Options {
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        $input_type = ( ! empty ($this->field ['radio']) ) ? 'radio' : 'checkbox';
        $input_attr = ( ! empty ($this->field ['multi_select']) ) ? '[]' : '';

        echo $this->element_before();
        echo ( empty ($input_attr) ) ? '<div class="wpsf-field-image-select">' : '';

        if( isset ($this->field ['options']) ) {
            $options = $this->field ['options'];
            foreach( $options as $key => $value ) {
                echo '<label><input type="' . $input_type . '" name="' . $this->element_name($input_attr) . '" value="' . $key . '"' . $this->element_class() . $this->element_attributes($key) . $this->checked($this->element_value(), $key) . '/><img src="' . $value . '" alt="' . $key . '" /></label>';
            }
        }

        echo ( empty ($input_attr) ) ? '</div>' : '';
        echo $this->element_after();
    }
}
