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
 * Field: Typography
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_typography extends WPSFramework_Options {
    /**
     * WPSFramework_Option_typography constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        $defaults_value = array(
            'family'  => 'Arial',
            'variant' => 'regular',
            'font'    => 'websafe',
        );

        $default_variants = apply_filters('wpsf_websafe_fonts_variants', array(
            'regular',
            'italic',
            '700',
            '700italic',
            'inherit',
        ));

        $websafe_fonts = apply_filters('wpsf_websafe_fonts', array(
            'Arial',
            'Arial Black',
            'Comic Sans MS',
            'Impact',
            'Lucida Sans Unicode',
            'Tahoma',
            'Trebuchet MS',
            'Verdana',
            'Courier New',
            'Lucida Console',
            'Georgia, serif',
            'Palatino Linotype',
            'Times New Roman',
        ));

        $value = wp_parse_args($this->element_value(), $defaults_value);
        $family_value = $value ['family'];
        $variant_value = $value ['variant'];
        $is_variant = ( isset ($this->field ['variant']) && $this->field ['variant'] === FALSE ) ? FALSE : TRUE;
        $is_chosen = ( isset ($this->field ['chosen']) && $this->field ['chosen'] !== FALSE ) ? ' chosen ' : ' ';
        $is_select2 = ( isset ($this->field ['select2']) && $this->field ['select2'] !== FALSE ) ? ' select2 ' : ' ';
        $google_json = wpsf_get_google_fonts();
        $chosen_rtl = ( is_rtl() && ! empty ($is_chosen) ) ? 'chosen-rtl ' : '';

        if( is_object($google_json) ) {

            $googlefonts = array();

            foreach( $google_json->items as $key => $font ) {
                $googlefonts [$font->family] = $font->variants;
            }

            $is_google = ( array_key_exists($family_value, $googlefonts) ) ? TRUE : FALSE;

            echo '<label class="wpsf-typography-family">';
            echo '<select name="' . $this->element_name('[family]') . '" class="' . $is_select2 . $is_chosen . $chosen_rtl . 'wpsf-typo-family" data-atts="family"' . $this->element_attributes() . '>';

            do_action('wpsf_typography_family', $family_value, $this);

            echo '<optgroup label="' . esc_html__('Web Safe Fonts', 'wpsf-framework') . '">';
            foreach( $websafe_fonts as $websafe_value ) {
                echo '<option value="' . $websafe_value . '" data-variants="' . implode('|', $default_variants) . '" data-type="websafe"' . selected($websafe_value, $family_value, TRUE) . '>' . $websafe_value . '</option>';
            }
            echo '</optgroup>';

            echo '<optgroup label="' . esc_html__('Google Fonts', 'wpsf-framework') . '">';
            foreach( $googlefonts as $google_key => $google_value ) {

                echo '<option value="' . $google_key . '" data-variants="' . implode('|', $google_value) . '" data-type="google"' . selected($google_key, $family_value, TRUE) . '>' . $google_key . '</option>';
            }
            echo '</optgroup>';

            echo '</select>';
            echo '</label>';

            if( ! empty ($is_variant) ) {

                $variants = ( $is_google ) ? $googlefonts [$family_value] : $default_variants;
                $variants = ( $value ['font'] === 'google' || $value ['font'] === 'websafe' ) ? $variants : array(
                    'regular',
                );

                echo '<label class="wpsf-typography-variant">';
                echo '<select name="' . $this->element_name('[variant]') . '" class="' . $is_select2 . $is_chosen . $chosen_rtl . 'wpsf-typo-variant" data-atts="variant">';
                foreach( $variants as $variant ) {
                    echo '<option value="' . $variant . '"' . $this->checked($variant_value, $variant, 'selected') . '>' . $variant . '</option>';
                }
                echo '</select>';
                echo '</label>';
            }

            echo '<input type="text" name="' . $this->element_name('[font]') . '" class="wpsf-typo-font hidden" data-atts="font" value="' . $value ['font'] . '" />';
        } else {
            echo esc_html__('Error! Can not load json file.', 'wpsf-framework');
        }

        echo $this->element_after();
    }
}
