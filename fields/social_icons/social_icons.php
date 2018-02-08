<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 01-02-2018
 * Time: 07:00 AM
 */

class WPSFramework_Option_Social_icons extends WPSFramework_Options {
    public function __construct(array $field = array(), $value = '', $unique = '') {
        parent::__construct($field, $value, $unique);
    }

    public function output() {
        echo $this->element_before();

        $unique = $this->unique . '[' . $this->field['id'] . ']';
        $icons = ( isset($this->field['options']) && ! empty($this->field['options']) ) ? $this->field['options'] : $this->social_icons();
        $type = ( isset($this->field['icon_type']) && ! empty($this->field['icon_type']) ) ? $this->field['icon_type'] : 'checkbox';
        $extra_fields = ( isset($this->field['extra_fields']) && is_array($this->field['extra_fields']) ) ? $this->field['extra_fields'] : array();
        $extra_icons = ( isset($this->field['extra_icons']) && is_array($this->field['extra_icons']) ) ? $this->field['extra_icons'] : array();
        $icons = array_merge($icons, $extra_icons);
        $disabled = ( isset($this->field['disabled']) ) ? $this->field['disabled'] : '';
        $icons = $this->disabled_icons($disabled, $icons);
        $icons = $this->handle_icons($icons);

        echo wpsf_add_element(array(
            'type'     => $type,
            'icon_box' => TRUE,
            'id'       => 'active_icons',
            'class'    => 'horizontal',
            'options'  => $icons,
            'pseudo'   => TRUE,
        ), $this->_value('active_icons'), $unique);

        echo '<div class="wpsf-social-icons-fields">';
        $_unique = $unique . '[enabled]';
        $field_set = ( isset($this->value['enabled']) ) ? $this->value['enabled'] : array();

        foreach( $icons as $icon => $data ) {

            $base_field = array(
                'type'       => 'text',
                'title'      => $data['label'],
                'attributes' => array(
                    'placeholder' => 'http://example.com/your-profile',
                ),
                'id'         => 'url',
            );

            echo wpsf_add_element(array(
                'id'         => $icon,
                'type'       => 'fieldset',
                'pseudo'     => TRUE,
                'wrap_class' => 'horizontal',
                'dependency' => array( 'active_icons_' . $icon, '==', 'true' ),
                'fields'     => array_merge(array( $base_field ), $extra_fields),
            ), $this->_value($icon, $field_set), $_unique);
        }

        echo '</div>';
        echo $this->element_after();
    }

    public function social_icons() {
        return apply_filters('wpsf_social_icons', array(
            'Behance'   => 'fa fa-behance',
            'Delicious' => 'fa fa-delicious',
            'Dropbox'   => 'fa fa-dropbox',
            'Facebook'  => 'fa fa-facebook',
            'Github'    => 'fa fa-github',
            'Google+'   => 'fa fa-google-plus',
            'LinkedIn'  => 'fa fa-linkedin',
            'Paypal'    => 'fa fa-paypal',
            'Pinterest' => 'fa fa-pinterest',
            'YouTube'   => 'fa fa-youtube',
            'Skype'     => 'fa fa-skype',
            'Flickr'    => 'fa fa-flickr',
            'Instagram' => 'fa fa-instagram',
            'Twitter'   => 'fa fa-twitter',
        ));
    }

    public function disabled_icons($disabled, $icons) {
        if( ! empty($disabled) ) {
            $disabled = explode('|', $disabled);
            foreach( $disabled as $i ) {
                if( isset($icons[$i]) ) {
                    unset($icons[$i]);
                }
            }
        }
        return $icons;
    }

    public function handle_icons($icons) {
        foreach( $icons as $icon_key => $icon ) {
            if( ! is_array($icon) ) {
                $icons[$icon_key] = array(
                    'label' => $icon_key,
                    'icon'  => $icon,
                    'title' => $icon_key,
                );
            }
        }
        return $icons;
    }

    protected function _value($key, $array = array()) {
        if( empty($array) ) {
            $array = $this->value;
        }

        if( ! empty($array) ) {
            if( isset($array[$key]) ) {
                return $array[$key];
            }
        }
        return FALSE;
    }
}