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

        $is_ajax = ( isset($this->field['settings']) && isset($this->field['settings']['is_ajax']) && $this->field['settings']['is_ajax'] === TRUE );

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
            $exAttr = ( $is_ajax ) ? array( 'data-has-settings' => 'yes' ) : array();

            echo '<select name="' . $this->element_name($extra_name) . '"' . $this->element_class($chosen_rtl) . $this->element_attributes($exAttr) . '>';

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

        if( $is_ajax ) {
            echo '<div class="wpsf-element-settings hidden" style="display:none;">' . wpsf_js_vars('', $this->render_settings(), FALSE) . '</div>';
        }

        echo $this->element_after();
    }

    public function render_settings() {
        $_settings = array();
        $_settings['action'] = 'wpsf-ajax';
        $_settings['wpsf-action'] = 'query_select_data';
        $_settings['options'] = $this->field['options'];
        $_settings['query_args'] = ( isset ($this->field ['query_args']) ) ? $this->field ['query_args'] : array();
        return array_filter($_settings);
    }
}
