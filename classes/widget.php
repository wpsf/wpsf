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
 * Date: 25-01-2018
 * Time: 02:56 PM
 */
class WPSFramework_widget_helper extends WPSFramework_Abstract{
    public function error_ids($array,$p){
        $this->options = array('fields' => $array);
        return $this->map_error_id($this->options,$p);
    }
}

class WPSFramework_Widget extends WP_Widget {

    private $wpsf_instance = null;
    private $errors = null;

    public function __construct($id_base, $name, array $widget_options = array(), array $control_options = array()) {
        parent::__construct($id_base, $name, $widget_options, $control_options);
    }

    public function wpsf(){
        if(is_null($this->wpsf_instance)){
            $this->wpsf_instance = new WPSFramework_widget_helper();
        }

        return $this->wpsf_instance;
    }

    public function get_form_fields(){
        $fields = $this->form_fields();
        $fields = $this->wpsf()->error_ids($fields,$this->id_base.'_'.$this->number);
        $fields = $fields['fields'];
        return $fields;
    }

    public function form($instance) {
        global $wpsf_errors,$wpsf_error;
        $wpsf_errors = $this->errors;
        $wpsf_error = $this->errors;
        $fields = $this->get_form_fields();
        $uid = $this->get_field_name('uid');
        $uid = str_replace('[uid]','',$uid);

        echo '<div class="wpsf-framework-widgets wpsf-widgets">';
        foreach( $fields as $field ) {
            $value = null;
            if( isset($field['id']) ) {
                $field['name'] = $this->get_field_name($field['id']);
                $value = ( isset($instance[$field['id']]) ) ? $instance[$field['id']] : NULL;
            }
            echo wpsf_add_element($field, $value, $uid);
        }
        echo '</div>';
    }

    public function update($new_instance, $old_instance) {
        $field = new WPSFramework_Fields_Save_Sanitize();
        $fields = array('fields' => $this->get_form_fields());
        $final  = $field->general_save_handler($new_instance,$old_instance,$fields);
        $this->errors  = $field->get_errors();
        return $final;
    }
}