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
class WPSFramework_Option_date_picker extends WPSFramework_Options {
    public function __construct($field, $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();
        echo '<input ' . $this->element_attributes($this->picker_settings()) . ' class="' . $this->element_class() . '" value="' . $this->element_value() . '" type="text" name="' . $this->element_name() . '" />';
        echo $this->element_after();
    }

    public function picker_settings() {
        $s = ( isset($this->field['settings']) ) ? $this->field['settings'] : FALSE;
        if( $s === FALSE ) {
            return array();
        }
        $array = array();

        if( isset($s['show_other_month']) ) {
            $array['data-show-other-month'] = $s['show_other_month'];
        }

        if( isset($s['select_other_month']) ) {
            $array['data-select-other-month'] = $s['select_other_month'];
        }

        if( isset($s['show_button']) ) {
            $array['data-button-panel'] = $s['show_button'];
        }

        if( isset($s['change_month']) ) {
            $array['data-change-month'] = $s['change_month'];
        }

        if( isset($s['change_year']) ) {
            $array['data-change-year'] = $s['change_year'];
        }

        if( isset($s['months_count']) ) {
            $array['data-months-count'] = $s['months_count'];
        }

        if( isset($s['date_format']) ) {
            $array['data-date-format'] = $s['date_format'];
        }

        if( isset($s['min_date']) ) {
            $array['data-min-date'] = $s['min_date'];
        }

        if( isset($s['max_date']) ) {
            $array['data-max-date'] = $s['max_date'];
        }

        return $array;
    }

}

