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
 * Field: Image
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_Image extends WPSFramework_Options {
    /**
     * WPSFramework_Option_Image constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        $preview = '';
        $value = $this->element_value();
        $add = ( ! empty ($this->field ['add_title']) ) ? $this->field ['add_title'] : esc_html__('Add Image', 'wpsf-framework');
        $hidden = ( empty ($value) ) ? ' hidden' : '';

        if( ! empty ($value) ) {
            $attachment = wp_get_attachment_image_src($value, 'thumbnail');
            $preview = $attachment [0];
        }

        echo '<div class="wpsf-image-preview' . $hidden . '"><div class="wpsf-preview"><i class="fa fa-times wpsf-remove"></i><img src="' . $preview . '" alt="preview" /></div></div>';
        echo '<a href="#" class="button button-primary wpsf-add">' . $add . '</a>';
        echo '<input type="text" name="' . $this->element_name() . '" value="' . $this->element_value() . '"' . $this->element_class() . $this->element_attributes() . '/>';

        echo $this->element_after();
    }
}
