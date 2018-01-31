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
 * Date: 26-01-2018
 * Time: 08:49 AM
 */
class WPSFramework_Option_spacing extends WPSFramework_Options {
    /**
     * WPSFramework_Option_spacing constructor.
     * @param array  $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field = array(), $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        $this->unique .= '[' . $this->field['id'] . ']';
        $select_class = isset($this->field['select2']) ? ' select2 ' : '';
        $select_class .= isset($this->field['chosen']) ? ' chosen ' : '';

        $show_top = ( isset($this->field['top']) && $this->field['top'] === FALSE ) ? FALSE : TRUE;
        $show_bottom = ( isset($this->field['bottom']) && $this->field['bottom'] === FALSE ) ? FALSE : TRUE;
        $show_left = ( isset($this->field['left']) && $this->field['left'] === FALSE ) ? FALSE : TRUE;
        $show_right = ( isset($this->field['right']) && $this->field['right'] === FALSE ) ? FALSE : TRUE;
        $show_units = ( isset($this->field['units']) && $this->field['units'] === FALSE ) ? FALSE : TRUE;


        if( $show_top ) {
            echo wpsf_add_element(array(
                'id'         => $this->field['id'] . '-top',
                'type'       => 'text',
                'wrap_class' => 'small-input wpsf-spacing wpsf-spacing-top',
                'pseudo'     => TRUE,
                'attributes' => array( 'title' => ( isset($this->field['title']) ) ? $this->field['title'] . ' Top' : '', ),
            ), $this->get_value('top'), $this->unique);
        }

        if( $show_bottom ) {
            echo wpsf_add_element(array(
                'id'         => $this->field['id'] . '-bottom',
                'type'       => 'text',
                'wrap_class' => 'small-input wpsf-spacing wpsf-spacing-bottom',
                'pseudo'     => TRUE,
                'attributes' => array( 'title' => ( isset($this->field['title']) ) ? $this->field['title'] . ' Bottom' : '', ),
            ), $this->get_value('bottom'), $this->unique);
        }

        if( $show_left ) {
            echo wpsf_add_element(array(
                'id'         => $this->field['id'] . '-left',
                'type'       => 'text',
                'wrap_class' => 'small-input wpsf-spacing wpsf-spacing-left',
                'pseudo'     => TRUE,
                'attributes' => array( 'title' => ( isset($this->field['title']) ) ? $this->field['title'] . ' Left' : '', ),
            ), $this->get_value('left'), $this->unique);
        }

        if( $show_right ) {
            echo wpsf_add_element(array(
                'id'         => $this->field['id'] . '-right',
                'type'       => 'text',
                'wrap_class' => 'small-input wpsf-spacing wpsf-spacing-right',
                'pseudo'     => TRUE,
                'attributes' => array( 'title' => ( isset($this->field['title']) ) ? $this->field['title'] . ' Right' : '', ),
            ), $this->get_value('right'), $this->unique);
        }

        if( $show_units ) {
            echo wpsf_add_element(array(
                'pseudo'     => TRUE,
                'id'         => $this->field['id'] . '-units',
                'type'       => 'select',
                'class'      => $select_class,
                'wrap_class' => 'small-input wpsf-spacing-units',
                'attributes' => array( 'title' => ( isset($this->field['title']) ) ? '' : '', ),
                'options'    => array(
                    'px'  => __('px'),
                    '%'   => '%',
                    'em'  => __("em"),
                    'rem' => __('rem'),
                ),
            ), $this->get_value('units'), $this->unique);
        }
        echo $this->element_after();
    }

    /**
     * @param string $key
     * @return bool
     */
    private function get_value($key = '') {
        $fid = $this->field['id'];

        if( isset($this->value[$fid . '-' . $key]) ) {
            return $this->value[$fid . '-' . $key];
        }
        return FALSE;
    }
}