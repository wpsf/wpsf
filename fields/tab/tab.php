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

    private function tab_style() {
        # 'default', 'box' or 'left'. Optional
        $class = 'wpsf-user-tabs';
        $class = ( isset($this->field['tab_style']) ) ? $class . ' wpsf-user-tabs-' . $this->field['tab_style'] : $class;
        return ( isset($this->field['tab_wrapper']) ) ? $class . ' wpsf-user-tabs-no-wrapper' : $class;
    }

    private function _unique(){
        if(!empty($this->field['un_array'])){
            return $this->unique;
        }

        return (isset($this->field['id'])) ?  $this->unique.'['.$this->field['id'].']' : $this->unique;
    }

    public function render_tabs() {
        if( ! is_array($this->field['sections']) ) {
            return;
        }

        $sections = $this->field['sections'];

        $navs = '<ul class="wpsf-user-tabs-nav">';
        $contents = '<div class="wpsf-user-tabs-panels">';

        foreach( $sections as $section ) {
            $defaults = array(
                'name'   => '',
                'title'  => '',
                'icon'   => '',
                'fields' => '',
            );
            $icon = '';
            $section = wp_parse_args($section, $defaults);

            if( ! empty($section['icon']) ) {
                if( filter_var($section['icon'], FILTER_VALIDATE_URL) ) {
                    $section['icon'] = '<img src="' . $section['icon'] . '"/>';
                } else {
                    $section['icon'] = '<i class="' . $section['icon'] . '"></i>';
                }
            }

            $section['name'] = ( empty($section['name']) ) ? wpsf_sanitize_title($section['title']) : $section['name'];
            $nav_class = 'wpsf-user-tabs-' . $section['name'];

            $navs .= sprintf('<li class="%s" data-panel="%s"><a href="#">%s%s</a></li>', $nav_class, $section['name'], $section['icon'], $section['title']);
            $contents .= '<div class="wpsf-user-tabs-panel wpsf-user-tabs-panel-'.$section['name'].'">';
            foreach($section['fields'] as $field){

                $Uid = $this->_unique();
                $Uid = (empty($field['un_array'])) ? $Uid.'['.$section['name'].']' : $Uid;

                $contents .= wpsf_add_element($field, $this->value, $Uid);
            }
            $contents .= '</div>';

        }

        $navs .= '</ul>';
        $contents .= '</div>';

        return $navs.$contents;
    }
}