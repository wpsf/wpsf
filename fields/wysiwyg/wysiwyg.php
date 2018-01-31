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
 * Field: Wysiwyg
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_Wysiwyg extends WPSFramework_Options {
    /**
     * WPSFramework_Option_Wysiwyg constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        $defaults = array(
            'textarea_rows' => 10,
            'textarea_name' => $this->element_name(),
        );

        $settings = ( ! empty ($this->field ['settings']) ) ? $this->field ['settings'] : array();
        $settings = wp_parse_args($settings, $defaults);

        $field_id = ( ! empty ($this->field ['id']) ) ? $this->field ['id'] : '';
        $field_value = $this->element_value();

        wp_editor($field_value, $field_id, $settings);

        echo $this->element_after();
    }
}
