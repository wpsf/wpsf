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
    /**
     * WPSFramework_Option_accordion constructor.
     * @param        $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();
        $fields = array_values($this->field['fields']);
        $acc_title = ( isset($this->field['accordion_title']) ) ? $this->field['accordion_title'] : __("Accordion", 'wpsf-framework');
        $unique_id = ( ! empty($this->field['un_array']) ) ? $this->unique : $this->unique . '[' . $this->field['id'] . ']';

        echo '<div class="wpsf-groups wpsf-accordion">';

        echo '<h4 class="wpsf-group-title">' . $acc_title . '</h4>';

        echo '<div class="wpsf-group-content">';
        foreach( $fields as $field ) {
            $field_id = ( isset ($field['id']) ) ? $field['id'] : '';
            $field_default = ( isset ($field['default']) ) ? $field['default'] : FALSE;
            $field_value = $this->_unarray_values($field_id, $field_default);
            echo wpsf_add_element($field, $field_value, $unique_id);
        }
        echo '</div>';
        echo '</div>';


        echo $this->element_after();
    }
}