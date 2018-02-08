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

if( ! defined('ABSPATH') ) {
    die ();
} // Cannot access pages directly.

/**
 *
 * Options Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
abstract class WPSFramework_Options extends WPSFramework_Abstract {
    public static $total_cols = 0;

    /**
     * WPSFramework_Options constructor.
     * @param array  $field
     * @param string $value
     * @param string $unique
     */
    public function __construct($field = array(), $value = '', $unique = '') {
        $this->field = $field;
        $this->value = $value;
        $this->org_value = $value;
        $this->unique = $unique;
        $this->multilang = $this->element_multilang();
        $this->row_after = NULL;
    }

    /**
     * @return bool|mixed
     */
    public function element_multilang() {
        return ( isset ($this->field ['multilang']) ) ? wpsf_language_defaults() : FALSE;
    }

    public function final_output() {
        if( $this->element_type() === 'hidden' ) {
            echo $this->output();
        } else {
            echo $this->element_wrapper();
            echo $this->output();
            echo $this->element_wrapper(FALSE);
        }
    }

    /**
     * @return mixed
     */
    public function element_type() {
        $type = ( isset ($this->field ['attributes'] ['type']) ) ? $this->field ['attributes'] ['type'] : $this->field ['type'];
        return $type;
    }

    /**
     * @param bool $is_start
     */
    public function element_wrapper($is_start = TRUE) {
        if( $is_start === TRUE ) {
            $depend = '';
            $this->row_after = '';

            $sub = ( isset ($this->field['sub']) ) ? 'sub-' : '';
            $languages = wpsf_language_defaults();
            $wrap_class = 'wpsf-element wpsf-element-' . $this->element_type() . ' wpsf-field-' . $this->element_type() . ' ';
            $wrap_class .= ( isset($this->field['wrap_class']) ) ? ' ' . $this->field['wrap_class'] : '';
            $wrap_class .= ( isset($this->field['title']) ) ? ' wpsf-element-' . sanitize_title($this->field ['title']) : ' no-title ';
            $wrap_class .= ( isset ($this->field ['pseudo']) ) ? ' wpsf-pseudo-field' : '';
            $is_hidden = ( isset ($this->field ['show_only_language']) && ( $this->field ['show_only_language'] != $languages ['current'] ) ) ? ' hidden ' : '';

            if( isset ($this->field['dependency']) ) {
                $is_hidden = ' hidden';
                $depend .= ' data-' . $sub . 'controller="' . $this->field ['dependency'] [0] . '"';
                $depend .= ' data-' . $sub . 'condition="' . $this->field ['dependency'] [1] . '"';
                $depend .= ' data-' . $sub . 'value="' . $this->field ['dependency'] [2] . '"';
            }

            if( isset($this->field['columns']) ) {
                $wrap_class .= ' wpsf-column wpsf-column-' . $this->field['columns'] . ' ';

                if( 0 == self::$total_cols ) {
                    $wrap_class .= ' wpsf-column-first ';
                    echo '<div class="wpsf-element wpsf-row">';
                }

                self::$total_cols += $this->field['columns'];

                if( 12 == self::$total_cols ) {
                    $wrap_class .= ' wpsf-column-last ';
                    $this->row_after = '</div>';
                    self::$total_cols = 0;
                }
            }

            echo '<div class="' . $wrap_class . '" ' . $depend . ' >';
            $this->element_title();
            echo $this->element_title_before();
        } else {
            echo $this->element_title_after();
            echo '<div class="clear"></div>';
            echo '</div>';
            echo $this->row_after;
        }
    }

    public function element_title() {
        if( isset ($this->field ['title']) ) {
            $field_desc = ( isset ($this->field ['desc']) ) ? '<p class="wpsf-text-desc">' . $this->field ['desc'] . '</p>' : '';
            echo '<div class="wpsf-title"><h4>' . $this->field ['title'] . '</h4>' . $this->element_desc() . ' ' . $this->element_help() . '</div>';
        }
    }

    /**
     * @return string
     */
    public function element_desc() {
        return ( isset($this->field['desc']) ) ? '<p class="wpsf-text-desc">' . $this->field['desc'] . '</p>' : '';
    }

    /**
     * @return string
     */
    public function element_help() {
        $defaults = array(
            'icon'     => 'fa fa-question-circle',
            'content'  => '',
            'position' => 'bottom',
        );
        $help = array();
        if( isset($this->field['help']) ) {
            if( ! is_array($this->field['help']) ) {
                $this->field['help'] = array( 'content' => $this->field['help'] );
            }
            $help = wp_parse_args($this->field['help'], $defaults);
        }

        return ( ! empty($help['content']) ) ? '<span class="wpsf-help" data-placement="' . $help['position'] . '" data-title="' . $help['content'] . '"><span class="' . $help['icon'] . '"></span></span>' : '';
    }

    /**
     * @return string
     */
    public function element_title_before() {
        return ( isset ($this->field ['title']) ) ? '<div class="wpsf-fieldset">' : '';
    }

    /**
     * @return string
     */
    public function element_title_after() {
        return ( isset ($this->field ['title']) ) ? '</div>' : '';
    }

    /**
     * @param string $el_class
     * @return string
     */
    public function element_class($el_class = '') {
        $field_class = ( isset ($this->field ['class']) ) ? ' ' . $this->field ['class'] : '';
        return ( $field_class || $el_class ) ? ' class="' . $el_class . $field_class . '"' : '';
    }

    /**
     * @param array $el_attributes
     * @param array $extra_more
     * @return string
     */
    public function element_attributes($el_attributes = array(), $extra_more = array()) {
        $attributes = ( isset ($this->field ['attributes']) ) ? $this->field ['attributes'] : array();
        $element_id = ( isset ($this->field ['id']) ) ? $this->field ['id'] : '';

        if( $el_attributes !== FALSE ) {
            $sub_elemenet = ( isset ($this->field ['sub']) ) ? 'sub-' : '';
            $el_attributes = ( is_string($el_attributes) || is_numeric($el_attributes) ) ? array(
                'data-' . $sub_elemenet . 'depend-id' => $element_id . '_' . $el_attributes,
            ) : $el_attributes;
            $el_attributes = ( empty ($el_attributes) && isset ($element_id) ) ? array(
                'data-' . $sub_elemenet . 'depend-id' => $element_id,
            ) : $el_attributes;
        }

        if( in_array($this->field['type'], array(
                'text',
                'textarea',
            )) && ( isset($this->field['limit']) && $this->field['limit'] > 0 ) ) {
            $el_attributes['data-limit-element'] = TRUE;
        }

        if( ! empty($extra_more) ) {
            $el_attributes = wp_parse_args($el_attributes, $extra_more);
        }

        $attributes = wp_parse_args($attributes, $el_attributes);

        $atts = '';

        if( ! empty ($attributes) ) {
            foreach( $attributes as $key => $value ) {
                if( $value === 'only-key' ) {
                    $atts .= ' ' . $key;
                } else {
                    $atts .= ' ' . $key . '="' . $value . '"';
                }
            }
        }

        return $atts;
    }

    /**
     * @return mixed|string
     */
    public function element_before() {
        return ( isset ($this->field ['before']) ) ? $this->field ['before'] : '';
    }

    /**
     * @return string
     */
    public function element_after() {
        $out = $this->element_text_limit();
        $out .= $this->element_desc_after();
        $out .= ( isset ($this->field ['after']) ) ? $this->field ['after'] : '';
        $out .= $this->element_after_multilang();
        $out .= $this->element_get_error();
        //$out .= $this->element_help();
        $out .= $this->element_debug();
        return $out;
    }

    /**
     * @return string
     */
    public function element_text_limit() {
        $return = '';
        if( in_array($this->field['type'], array(
                'text',
                'textarea',
            )) && ( isset($this->field['limit']) && $this->field['limit'] > 0 ) ) {

            if( $this->field['limit'] > 0 ) {
                $type = isset($this->field['limit_type']) ? $this->field['limit_type'] : 'character';
                $text = 'word' === $type ? __('Word Count', 'text-limiter') : __('Character Count', 'text-limiter');
                return '<div class="text-limiter" data-limit-type="' . esc_attr($type) . '"> <span>' . esc_html($text) . ': <span class="counter">0</span>/<span class="maximum">' . esc_html($this->field['limit']) . '</span></span></div>';
            }
        }
        return $return;
    }

    /**
     * @return string
     */
    public function element_desc_after() {
        return ( isset ($this->field ['desc_field']) ) ? '<p class="wpsf-text-desc">' . $this->field ['desc_field'] . '</p>' : '';
    }

    /**
     * @return string
     */
    public function element_after_multilang() {
        $out = '';

        if( is_array($this->multilang) ) {

            $out .= '<fieldset class="hidden">';

            foreach( $this->multilang ['languages'] as $key => $val ) {

                // ignore current language for hidden element
                if( $key != $this->multilang ['current'] ) {

                    // set default value
                    if( isset ($this->org_value [$key]) ) {
                        $value = $this->org_value [$key];
                    } else if( ! isset ($this->org_value [$key]) && ( $key == $this->multilang ['default'] ) ) {
                        $value = $this->org_value;
                    } else {
                        $value = '';
                    }

                    $cache_field = $this->field;

                    unset ($cache_field ['multilang']);
                    $cache_field ['name'] = $this->element_name('[' . $key . ']', TRUE);

                    $class = 'WPSFramework_Option_' . $this->field ['type'];
                    $element = new $class ($cache_field, $value, $this->unique);

                    ob_start();
                    $element->output();
                    $out .= ob_get_clean();
                }
            }

            $out .= '<input type="hidden" name="' . $this->element_name('[multilang]', TRUE) . '" value="true" />';
            $out .= '</fieldset>';
            $out .= '<p class="wpsf-text-desc">' . sprintf(esc_html__('You are editing language: ( %s )', 'wpsf-framework'), '<strong>' . $this->multilang ['current'] . '</strong>') . '</p>';
        }

        return $out;
    }

    /**
     * @param string $extra_name
     * @param bool   $multilang
     * @return string
     */
    public function element_name($extra_name = '', $multilang = FALSE) {
        $element_id = ( isset ($this->field ['id']) ) ? $this->field ['id'] : '';
        $extra_multilang = ( ! $multilang && is_array($this->multilang) ) ? '[' . $this->multilang ['current'] . ']' : '';
        return ( isset ($this->field ['name']) ) ? $this->field ['name'] . $extra_name : $this->unique . '[' . $element_id . ']' . $extra_multilang . $extra_name;
    }

    /**
     * @return string
     */
    public function element_get_error() {
        global $wpsf_errors;

        $out = '';

        if( ! empty ($wpsf_errors) ) {
            foreach( $wpsf_errors as $key => $value ) {
                $fid = isset($this->field['error_id']) ? $this->field['error_id'] : $this->field['id'];
                if( isset ($this->field ['id']) && $value ['code'] == $fid ) {
                    $out .= '<p class="wpsf-text-warning">' . $value ['message'] . '</p>';
                }
            }
        }

        return $out;
    }

    /**
     * @return string
     */
    public function element_debug() {
        $out = '';

        if( ( isset ($this->field ['debug']) && $this->field ['debug'] === TRUE ) || ( defined('WPSF_OPTIONS_DEBUG') && WPSF_OPTIONS_DEBUG ) ) {

            $value = $this->element_value();

            $out .= "<pre>";
            $out .= "<strong>" . esc_html__('CONFIG', 'wpsf-framework') . ":</strong>";
            $out .= "\n";
            ob_start();
            var_export($this->field);
            $out .= htmlspecialchars(ob_get_clean());
            $out .= "\n\n";
            $out .= "<strong>" . esc_html__('USAGE', 'wpsf-framework') . ":</strong>";
            $out .= "\n";
            $out .= ( isset ($this->field ['id']) ) ? "wpsf_get_option( '" . $this->field ['id'] . "' );" : '';

            if( ! empty ($value) ) {
                $out .= "\n\n";
                $out .= "<strong>" . esc_html__('VALUE', 'wpsf-framework') . ":</strong>";
                $out .= "\n";
                ob_start();
                var_export($value);
                $out .= htmlspecialchars(ob_get_clean());
            }

            $out .= "</pre>";
        }

        if( ( isset ($this->field ['debug_light']) && $this->field ['debug_light'] === TRUE ) || ( defined('WPSF_OPTIONS_DEBUG_LIGHT') && WPSF_OPTIONS_DEBUG_LIGHT ) ) {

            $out .= "<pre>";
            $out .= "<strong>" . esc_html__('USAGE', 'wpsf-framework') . ":</strong>";
            $out .= "\n";
            $out .= ( isset ($this->field ['id']) ) ? "wpsf_get_option( '" . $this->field ['id'] . "' );" : '';
            $out .= "\n";
            $out .= "<strong>" . esc_html__('ID', 'wpsf-framework') . ":</strong>";
            $out .= "\n";
            $out .= ( isset ($this->field ['id']) ) ? $this->field ['id'] : '';
            $out .= "</pre>";
        }

        return $out;
    }

    /**
     * @param string $value
     * @return array|mixed|string
     */
    public function element_value($value = '') {
        $value = $this->value;

        if( is_array($this->multilang) && is_array($value) ) {

            $current = $this->multilang ['current'];

            if( isset ($value [$current]) ) {
                $value = $value [$current];
            } else if( $this->multilang ['current'] == $this->multilang ['default'] ) {
                $value = $this->value;
            } else {
                $value = '';
            }
        } else if( ! is_array($this->multilang) && isset ($this->value ['multilang']) && is_array($this->value) ) {

            $value = array_values($this->value);
            $value = $value [0];
        } else if( is_array($this->multilang) && ! is_array($value) && ( $this->multilang ['current'] != $this->multilang ['default'] ) ) {

            $value = '';
        }

        return $value;
    }

    /**
     * @param       $field_id
     * @param array $default
     * @return array|string
     */
    public function _unarray_values($field_id, $default = array()) {
        if( in_array($this->field['type'], array( 'tab', 'group', 'fieldset', 'accordion' )) ) {
            if( isset($this->field['un_array']) === FALSE || $this->field['un_array'] === FALSE ) {
                if( isset($this->value[$field_id]) ) {
                    return $this->value[$field_id];
                } else {
                    return $default;
                }
            }
        }
        return ( empty($this->value) ) ? $default : $this->value;
    }

    /**
     * @param string $type
     * @return array
     */
    public function element_data($type = '') {
        $is_ajax = ( isset($this->field['settings']) && isset($this->field['settings']['is_ajax']) && $this->field['settings']['is_ajax'] === TRUE );
        $query_args = ( isset ($this->field ['query_args']) ) ? $this->field ['query_args'] : array();

        if( $is_ajax ) {
            $query_args['post__in'] = ( ! is_array($this->value) ) ? explode(",", $this->value) : $this->value;
        }

        $data = WPSFramework_Query::query($type, $query_args, '');
        return $data;
    }

    /**
     * @param string $helper
     * @param string $current
     * @param string $type
     * @param bool   $echo
     * @return string
     */
    public function checked($helper = '', $current = '', $type = 'checked', $echo = FALSE) {
        if( is_array($helper) && in_array($current, $helper) ) {
            $result = ' ' . $type . '="' . $type . '"';
        } else if( $helper == $current ) {
            $result = ' ' . $type . '="' . $type . '"';
        } else {
            $result = '';
        }

        if( $echo ) {
            echo $result;
        }

        return $result;
    }

    /**
     * @param $option
     * @param $key
     * @return array
     */
    public function element_handle_option($option, $key) {
        if( ! is_array($option) ) {
            $option = array(
                'label' => $option,
                'key'   => $key,
            );
        }

        $defaults = array(
            'label'      => '',
            'key'        => '',
            'attributes' => array(),
            'disabled'   => '',
            'icon'       => '',
        );

        $option = wp_parse_args($option, $defaults);

        if( $option['disabled'] === TRUE ) {
            $option['attributes']['disabled'] = 'disabled';
        }

        if( $option['key'] === '' ) {
            $option['key'] = $key;
        }

        return array(
            'id'         => $option['key'],
            'value'      => $option['label'],
            'attributes' => $option['attributes'],
            'icon'       => $option['icon'],
        );
    }
}