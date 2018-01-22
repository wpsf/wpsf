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
 * Field: Gallery
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_Gallery extends WPSFramework_Options {
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);

    }

    public function output() {
        echo $this->element_before();

        $value = $this->element_value();
        $add = ( ! empty ($this->field ['add_title']) ) ? $this->field ['add_title'] : esc_html__('Add Gallery', 'wpsf-framework');
        $edit = ( ! empty ($this->field ['edit_title']) ) ? $this->field ['edit_title'] : esc_html__('Edit Gallery', 'wpsf-framework');
        $clear = ( ! empty ($this->field ['clear_title']) ) ? $this->field ['clear_title'] : esc_html__('Clear', 'wpsf-framework');
        $hidden = ( empty ($value) ) ? ' hidden' : '';

        echo '<ul>';

        if( ! empty ($value) ) {

            $values = explode(',', $value);

            foreach( $values as $id ) {
                $attachment = wp_get_attachment_image_src($id, 'thumbnail');
                echo '<li><img src="' . $attachment [0] . '" alt="" /></li>';
            }
        }

        echo '</ul>';
        echo '<a href="#" class="button button-primary wpsf-add">' . $add . '</a>';
        echo '<a href="#" class="button wpsf-edit' . $hidden . '">' . $edit . '</a>';
        echo '<a href="#" class="button wpsf-warning-primary wpsf-remove' . $hidden . '">' . $clear . '</a>';
        echo '<input type="text" name="' . $this->element_name() . '" value="' . $value . '"' . $this->element_class() . $this->element_attributes() . '/>';

        echo $this->element_after();
    }
}