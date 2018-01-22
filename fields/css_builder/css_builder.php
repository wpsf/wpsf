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
 * Date: 12-01-2018
 * Time: 07:48 AM
 */

class WPSFramework_Option_css_builder extends WPSFramework_Options {
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    private function carr($new_arr,$type=''){
        return array_merge(array(
            'type' => 'text',
            'pseudo' => false,
            'attributes' => array(
                'style' => 'width:40px',
            )
        ),$new_arr);
    }

    private function field_val($type = ''){
        return (isset($this->value[$type])) ? $this->value[$type] : null;
    }

    private function _css_fields($type){
        $id = $this->unique.'['.$this->field['id'].']';
        echo wpsf_add_element(
            $this->carr(array('wrap_class' => 'wpsf-'.$type.' wpsf-'.$type.'-top','id' => $type.'-top')),
            $this->field_val($type.'-top'),$id
        );
        echo wpsf_add_element(
            $this->carr(array('wrap_class' => 'wpsf-'.$type.' wpsf-'.$type.'-right','id' => $type.'-right')),
            $this->field_val($type.'-right'),$id
        );
        echo wpsf_add_element(
            $this->carr(array('wrap_class' => 'wpsf-'.$type.' wpsf-'.$type.'-bottom','id' => $type.'-bottom')),
            $this->field_val($type.'-bottom'),$id
        );
        echo wpsf_add_element(
            $this->carr(array('wrap_class' => 'wpsf-'.$type.' wpsf-'.$type.'-left','id' => $type.'-left')),
            $this->field_val($type.'-left'),$id
        );
    }

    public function output(){
        echo $this->element_before();

        $is_select2 = (isset($this->field['select2']) && $this->field['select2'] === true) ? 'select2' : '';
        $is_chosen = (isset($this->field['chosen']) && $this->field['chosen'] === true) ? 'chosen' : '';
        echo '<div class="wpsf-css-builder-container">';

        echo wpsf_add_element(array(
            'pseudo' => false,
            'id' => $this->field['id'].'_content',
            'type' => 'content',
            'content' => 'Note, that if you enter a value without a unit, the default unit <em>px</em> will automatically appended. If an invalid value is entered, it is replaced by the default value <em>0px</em>. Accepted units are: <em>px</em>, <em>%</em> and <em>em</em></p><p>Activate the lock <span class="dashicons dashicons-lock acf-css-checkall" style="margin:0"></span> to link all values.',
        ));


        echo '<div class="wpsf-css-builder-margin">';
            echo '<div><span class="dashicons wpsf-css-info dashicons-info"></span></div>';
                echo '<div class="wpsf-css-margin-caption">'.__("Margin",'wpsf-framework').'<span class="dashicons dashicons-lock wpsf-css-checkall wpsf-margin-checkall" ></span></div>';
                $this->_css_fields('margin');

                echo '<div class="wpsf-css-builder-border">';
                    echo '<div class="wpsf-css-border-caption">'.__("Border",'wpsf-framework').'<span class="dashicons dashicons-lock wpsf-css-checkall wpsf-border-checkall" ></span></div>';
                    $this->_css_fields('border');
                    echo '<div class="wpsf-css-builder-padding">';
                        echo '<div class="wpsf-css-padding-caption">'.__("Padding",'wpsf-framework').'<span class="dashicons dashicons-lock wpsf-css-checkall wpsf-padding-checkall" ></span></div>';
                        $this->_css_fields('padding');
                        echo '<div class="wpsf-css-builder-layout-center">';
                            echo '<p>Lorem ipsum dolor sit amet, </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';


            echo '<div class="wpsf-css-builder-extra-options">';
            $id = $this->unique.'['.$this->field['id'].']';
            echo wpsf_add_element(array( 'type' => 'color_picker', 'id' => 'background-color', 'title' => __("Background Color",'wpsf-framework')),$this->field_val('background-color'),$id);
            echo wpsf_add_element(array( 'type' => 'color_picker', 'id' => 'border-color', 'title' => __("Border Color",'wpsf-framework')),$this->field_val('border-color'),$id);
            echo wpsf_add_element(array( 'type' => 'color_picker', 'id' => 'color', 'title' => __("Text Color",'wpsf-framework')),$this->field_val('color'),$id);
            echo wpsf_add_element(array(
                'type' => 'select',
                'id' => 'border-style',
                'title' => __("Border Style",'wpsf-framework'),
                'class' => $is_select2.' '.$is_chosen,
                'options' => array(
                    '' => __("None",'wpsf-framework'),
                    'solid' => __("Solid",'wpsf-framework'),
                    'dashed' => __("Dashed",'wpsf-framework'),
                    'dotted' => __("Dotted",'wpsf-framework'),
                    'double' => __("Double",'wpsf-framework'),
                    'groove' => __("Groove",'wpsf-framework'),
                    'ridge' => __("Ridge",'wpsf-framework'),
                    'inset' => __("Inset",'wpsf-framework'),
                    'outset' => __("Outset",'wpsf-framework'),

                ),
            ),$this->field_val('border-style'),$id);

            echo '<div class="wpsf-css-builder-border-radius">';
            echo '<div class="wpsf-css-border-radius-caption">'.__("Border Radius",'wpsf-framework').'<span class="dashicons dashicons-lock wpsf-css-checkall wpsf-border-radius-checkall" ></span></div>';

            echo wpsf_add_element($this->carr(array(
                'title' => __('Top Left','wpsf-framework'),
                'wrap_class' => 'wpsf-border-radius wpsf-border-radius-top-left',
                'id' => 'border-radius-top-left')),$this->field_val('border-radius-top-left'),$id
            );

            echo wpsf_add_element($this->carr(array(
                'title' => __('Top Right','wpsf-framework'),
                'wrap_class' => 'wpsf-border-radius wpsf-border-radius-top-right',
                'id' => 'border-radius-top-right')),$this->field_val('border-radius-top-right'),$id
            );
            echo wpsf_add_element($this->carr(array(
                'title' => __('Bottom Left','wpsf-framework'),
                'wrap_class' => 'wpsf-border-radius wpsf-border-radius-bottom-left',
                'id' => 'border-radius-bottom-left')),$this->field_val('border-radius-bottom-left'),$id
            );
            echo wpsf_add_element($this->carr(array(
                'title' => __('Bottom Right','wpsf-framework'),
                'wrap_class' => 'wpsf-border-radius wpsf-border-radius-bottom-right',
                'id' => 'border-radius-bottom-right')),$this->field_val('border-radius-bottom-right'),$id
            );

            echo '</div>';
            echo '</div>';
        echo '</div>';
        echo $this->element_after();
    }

}

