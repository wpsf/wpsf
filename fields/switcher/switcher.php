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
 * Field: Switcher
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_switcher extends WPSFramework_Options {
    /**
     * WPSFramework_Option_switcher constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();
        $on_text = ( isset($this->field['on_label']) && ! empty($this->field['on_label']) ) ? $this->field['on_label'] : __("On", 'wpsf-framework');
        $off_text = ( isset($this->field['off_label']) && ! empty($this->field['off_label']) ) ? $this->field['off_label'] : __("Off", 'wpsf-framework');
        $label = ( isset ($this->field ['label']) ) ? '<div class="wpsf-text-desc">' . $this->field ['label'] . '</div>' : '';
        echo '<label><input type="checkbox" name="' . $this->element_name() . '" value="1"' . $this->element_class() . $this->element_attributes() . checked($this->element_value(), 1, FALSE) . '/>
		<em data-on="' . esc_html($on_text) . '" data-off="' . esc_html($off_text) . '"></em><span></span></label>' . $label;
        echo $this->element_after();
    }
}
