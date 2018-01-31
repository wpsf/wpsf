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
 * Date: 18-01-2018
 * Time: 12:03 PM
 */
class WPSFramework_Option_tab extends WPSFramework_Options {

    /**
     * WPSFramework_Option_tab constructor.
     * @param array  $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field = array(), $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();
        echo '<div class="' . $this->tab_style() . '">';
        echo $this->render_tabs();
        echo '</div>';
        echo $this->element_after();
    }

    /**
     * @return string
     */
    private function tab_style() {
        # 'default', 'box' or 'left'. Optional
        $class = 'wpsf-user-tabs';
        $class = ( isset($this->field['tab_style']) ) ? $class . ' wpsf-user-tabs-' . $this->field['tab_style'] : $class;
        return ( isset($this->field['tab_wrapper']) ) ? $class . ' wpsf-user-tabs-no-wrapper ' : $class;
    }

    /**
     * @return null|string
     */
    public function render_tabs() {
        if( ! is_array($this->field['sections']) ) {
            return NULL;
        }

        $sections = $this->field['sections'];

        $navs = '<ul class="wpsf-user-tabs-nav">';
        $contents = '<div class="wpsf-user-tabs-panels">';

        $first_section = current($sections);
        $first_section = isset($first_section['name']) ? $first_section['name'] : FALSE;

        foreach( $sections as $section ) {
            $defaults = array(
                'name'   => '',
                'title'  => '',
                'icon'   => '',
                'fields' => '',
            );
            $icon = '';
            $section = wp_parse_args($section, $defaults);
            $is_active = ( $first_section === $section['name'] ) ? TRUE : FALSE;
            $is_display = ( $is_active === TRUE ) ? 'display:block;' : 'display:none;';

            if( ! empty($section['icon']) ) {
                if( filter_var($section['icon'], FILTER_VALIDATE_URL) ) {
                    $section['icon'] = '<img src="' . $section['icon'] . '"/>';
                } else {
                    $section['icon'] = '<i class="' . $section['icon'] . '"></i>';
                }
            }

            $section['name'] = ( empty($section['name']) ) ? wpsf_sanitize_title($section['title']) : $section['name'];
            $nav_class = 'wpsf-user-tabs-' . $section['name'];
            $nav_class = ( $is_active === TRUE ) ? $nav_class . ' wpsf-user-tabs-active ' : $nav_class;

            $navs .= sprintf('<li class="%s" data-panel="%s"><a href="#" class="wpsf-tab-a">%s%s</a></li>', $nav_class, $section['name'], $section['icon'], $section['title']);
            $contents .= '<div class="wpsf-user-tabs-panel wpsf-user-tabs-panel-' . $section['name'] . '" style="' . $is_display . '">';

            foreach( $section['fields'] as $field ) {
                $field_id = ( isset ($field['id']) ) ? $field['id'] : '';
                $field_default = ( isset ($field['default']) ) ? $field['default'] : $this->value;
                $Uid = $this->_unique();
                $Uid = ( empty($section['un_array']) ) ? $Uid . '[' . $section['name'] . ']' : $Uid;
                $value = $this->field_value($section, $field_id);
                $contents .= wpsf_add_element($field, $value, $Uid);
            }

            $contents .= '</div>';
        }

        $navs .= '</ul>';
        $contents .= '</div>';
        return $navs . $contents;
    }

    /**
     * @return string
     */
    private function _unique() {
        if( ! empty($this->field['un_array']) ) {
            return $this->unique;
        }
        return ( isset($this->field['id']) ) ? $this->unique . '[' . $this->field['id'] . ']' : $this->unique;
    }

    /**
     * @param string $section
     * @param        $field_id
     * @return bool|mixed
     */
    public function field_value($section = '', $field_id) {
        $arr = $this->value;

        if( empty($section['un_array']) ) {
            $arr = isset($arr[$section['name']]) ? $arr[$section['name']] : array();
        }

        return isset($arr[$field_id]) ? $arr[$field_id] : FALSE;
    }
}