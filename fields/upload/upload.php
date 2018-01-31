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
 * Field: Upload
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_upload extends WPSFramework_Options {
    /**
     * WPSFramework_Option_upload constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        if( isset ($this->field ['settings']) ) {
            extract($this->field ['settings']);
        }

        $upload_type = ( isset ($upload_type) ) ? $upload_type : 'image';
        $button_title = ( isset ($button_title) ) ? $button_title : esc_html__('Upload', 'wpsf-framework');
        $frame_title = ( isset ($frame_title) ) ? $frame_title : esc_html__('Upload', 'wpsf-framework');
        $insert_title = ( isset ($insert_title) ) ? $insert_title : esc_html__('Use Image', 'wpsf-framework');

        echo '<input type="text" name="' . $this->element_name() . '" value="' . $this->element_value() . '"' . $this->element_class() . $this->element_attributes() . '/>';
        echo '<a href="#" class="button wpsf-add" data-frame-title="' . $frame_title . '" data-upload-type="' . $upload_type . '" data-insert-title="' . $insert_title . '">' . $button_title . '</a>';

        echo $this->element_after();
    }
}
