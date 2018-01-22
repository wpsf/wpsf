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
 * Date: 04-01-2018
 * Time: 05:10 PM
 */
class WPSFramework_Option_accordion extends WPSFramework_Options {
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output(){
        echo $this->element_before();
        $fields = array_values($this->field['fields']);
        $acc_title = (isset($this->field['accordion_title'])) ? $this->field['accordion_title'] : __("Accordion",'wpsf-framework');
        $unique_id = $this->unique . '[' . $this->field['id'] . ']';

        echo '<div class="wpsf-groups wpsf-accordion">';

        echo '<h4 class="wpsf-group-title">'.$acc_title.'</h4>';

        echo '<div class="wpsf-group-content">';
        foreach( $fields as $field ) {
            $field_id = ( isset ($field['id']) ) ? $field['id'] : '';
            $field_default = ( isset ($field['default']) ) ? $field['default'] : $this->value;
            $field_value = ( isset ($this->value [$field_id]) ) ? $this->value [$field_id] : $field_default;

            echo wpsf_add_element($field, $field_value, $unique_id);
        }
        echo '</div>';
        echo '</div>';


        echo $this->element_after();
    }

    public function __output() {
        echo $this->element_before();
        $icons = array( 'down' => 'fa fa-angle-down', 'up'   => 'fa fa-angle-up', );
        $is_open = ( empty($this->value) ) ? FALSE : TRUE;
        $is_open = ( isset($this->field['force_open']) && $this->field['force_open'] === TRUE ) ? TRUE : $is_open;
        $show_icon = ( $is_open === TRUE ) ? 'up' : 'down';
        $is_hidden = ( $is_open === TRUE ) ? '' : 'display:none;';
        $icons = ( isset($this->field['icons']) ) ? wp_parse_args($this->field['icons'], $icons) : $icons;
        $title = isset($this->field['content']) ? $this->field['content'] : $this->field['name'];
        $title .= '<span class="accordion"><i class="' . $icons[$show_icon] . '" data-up="' . $icons['up'] . '" data-down="' . $icons['down'] . '"></i> </span>';

        $sub_heading = array(
            'type' => 'subheading',
            'id' => $this->field ['id'] . '_heading',
            'content' => $title,
            'class' => 'wpsf-accordion-heading',
        );

        $unique_id = $this->unique . '[' . $this->field['id'] . ']';

        echo wpsf_add_element($sub_heading, '', $this->unique);
        echo '<div class="wpsf-cover" style="' . $is_hidden . '">';
        foreach( $this->field['fields'] as $field ) {
            $field_id = ( isset ($field['id']) ) ? $field['id'] : '';
            $field_default = ( isset ($field['default']) ) ? $field['default'] : $this->value;
            $field_value = ( isset ($this->value [$field_id]) ) ? $this->value [$field_id] : $field_default;

            echo wpsf_add_element($field, $field_value, $unique_id);
        }
        echo '</div>';
    }
}