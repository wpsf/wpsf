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

/**
 * Created by PhpStorm.
 * User: varun
 * Date: 16-01-2018
 * Time: 03:20 PM
 */

/**
 *
 * Field: Typography Advanced
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_typography_advanced extends WPSFramework_Options {

    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {

        echo $this->element_before();

        $defaults_value = array(
            'family'  => 'Arial',
            'variant' => 'regular',
            'font'    => 'websafe',
            'size'    => '14',
            'height'  => '',
            'color'   => '',
        );


        $value = wp_parse_args($this->element_value(), $defaults_value);
        $family_value = $value['family'];
        $variant_value = $value['variant'];

        $google_json = wpsf_get_google_fonts();
        $chosen_rtl = ( is_rtl() && ! empty($is_chosen) ) ? 'chosen-rtl ' : '';


        //Container
        echo '<div class="wpsf_font_field" data-id="' . $this->field['id'] . '">';

        echo wpsf_add_element(array(
            'pseudo'  => TRUE,
            'type'    => 'typography',
            'id'      => $this->field['id'].'_typography',
            'variant' => isset($this->field['variant']) ? $this->field['variant'] : TRUE,
            'chosen'  => isset($this->field['chosen']) ? $this->field['chosen'] : NULL,
            'select2' => isset($this->field['select2']) ? $this->field['select2'] : NULL,
        ), $this->value, $this->unique);

        echo wpsf_add_element(array(
            'pseudo'     => TRUE,
            'type'       => 'number',
            'id'      => $this->field['id'].'_size',
            'name'       => $this->element_name('[size]'),
            'value'      => $value['size'],
            'default'    => ( isset($this->field['default']['size']) ) ? $this->field['default']['size'] : '',
            'wrap_class' => 'small-input wpsf-font-size',
            'attributes' => array('data-font-size' => '')
        ), $value['size'], $this->unique);


        echo wpsf_add_element(array(
            'pseudo'     => TRUE,
            'type'       => 'number',
            'id'      => $this->field['id'].'_height',
            'name'       => $this->element_name('[height]'),
            'value'      => $value['height'],
            'default'    => ( isset($this->field['default']['height']) ) ? $this->field['default']['height'] : '',
            'wrap_class' => 'small-input wpsf-font-height',
            'attributes' => array('data-font-line-height' => '')
        ), $value['height'], $this->unique);


        echo wpsf_add_element(array(
            'pseudo'     => TRUE,
            'id'         => $this->field['id'] . '_color',
            'type'       => 'color_picker',
            'id'      => $this->field['id'].'_color',
            'name'       => $this->element_name('[color]'),
            'attributes' => array(
                'data-atts' => 'bgcolor',
            ),
            'value'      => $value['color'],
            'default'    => ( isset($this->field['default']['color']) ) ? $this->field['default']['color'] : '',
            'rgba'       => ( isset($this->field['rgba']) && $this->field['rgba'] === FALSE ) ? FALSE : '',
        ), $value['color'], $this->unique);


        echo '<div class="wpsf-divider"></div>';
        /**
         * Font Preview
         */
        if( isset($this->field['preview']) && $this->field['preview'] == TRUE ) {
            if( isset($this->field['preview_text']) ) {
                $preview_text = $this->field['preview_text'];
            } else {
                $preview_text = 'Lorem ipsum dolor sit amet, pro ad sanctus admodum, vim at insolens appellantur. Eum veri adipiscing an, probo nonumy an vis.';
            }
            echo '<div id="preview-' . $this->field['id'] . '" style="font-family:;" class="wpsf-font-preview">' . $preview_text . '</div>';
        }

        echo '<input type="text" name="' . $this->element_name('[font]') . '" class="wpsf-typo-font hidden" data-atts="font" value="' . $value['font'] . '" />';

        //end container
        echo '</div>';

        echo $this->element_after();

    }

}