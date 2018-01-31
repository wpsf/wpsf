<?php if( ! defined('ABSPATH') ) {
    die;
} // Cannot access pages directly.

/**
 *
 * Field: Group
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Option_group extends WPSFramework_Options {

    /**
     * WPSFramework_Option_group constructor.
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
        $last_id = ( is_array($this->value) ) ? max(array_keys($this->value)) : 0;
        $acc_title = ( isset($this->field['accordion_title']) ) ? $this->field['accordion_title'] : esc_html__('Adding', 'wpsf-framework');
        $field_title = ( isset($fields[0]['title']) ) ? $fields[0]['title'] : $fields[1]['title'];
        $field_id = ( isset($fields[0]['id']) ) ? $fields[0]['id'] : $fields[1]['id'];
        $el_class = ( isset($this->field['title']) ) ? sanitize_title($field_title) : 'no-title';
        $search_id = wpsf_array_search($fields, 'id', $acc_title);

        if( ! empty($search_id) ) {
            $acc_title = ( isset($search_id[0]['title']) ) ? $search_id[0]['title'] : $acc_title;
            $field_id = ( isset($search_id[0]['id']) ) ? $search_id[0]['id'] : $field_id;
        }

        echo '<div class="wpsf-group wpsf-group-' . $el_class . '-adding hidden">';

        echo '<h4 class="wpsf-group-title">' . $acc_title . '</h4>';
        echo '<div class="wpsf-group-content">';
        foreach( $fields as $field ) {
            $field['sub'] = TRUE;
            $unique = $this->unique . '[_nonce][' . $this->field['id'] . '][' . $last_id . ']';
            $field_default = ( isset($field['default']) ) ? $field['default'] : '';
            echo wpsf_add_element($field, $field_default, $unique);
        }
        echo '<div class="wpsf-element wpsf-text-right wpsf-remove"><a href="#" class="button wpsf-warning-primary wpsf-remove-group">' . esc_html__('Remove', 'wpsf-framework') . '</a></div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="wpsf-groups wpsf-accordion">';

        if( ! empty($this->value) ) {
            foreach( $this->value as $key => $value ) {
                if( isset($this->multilang) && $this->multilang !== FALSE ) {
                    $title = $this->_get_title($this->value[$key], TRUE);
                    if( is_array($title) ) {
                        $lang = wpsf_language_defaults();
                        $title = isset($title[$lang['current']]) ? $title[$lang['current']] : $title;
                        $title = is_array($title) ? $title[0] : $title;
                    }
                } else {
                    $title = $this->_get_title($this->value[$key]);
                }


                $field_title = ( ! empty($search_id) ) ? $acc_title : $field_title;

                echo '<div class="wpsf-group wpsf-group-' . $el_class . '-' . ( $key + 1 ) . '">';
                echo '<h4 class="wpsf-group-title">' . $field_title . ': ' . $title . '</h4>';
                echo '<div class="wpsf-group-content">';

                foreach( $fields as $field ) {
                    $field['sub'] = TRUE;
                    $unique = $this->unique . '[' . $this->field['id'] . '][' . $key . ']';
                    $value = ( isset($field['id']) && isset($this->value[$key][$field['id']]) ) ? $this->value[$key][$field['id']] : '';
                    echo wpsf_add_element($field, $value, $unique);
                }

                echo '<div class="wpsf-element wpsf-text-right wpsf-remove"><a href="#" class="button wpsf-warning-primary wpsf-remove-group">' . esc_html__('Remove', 'wpsf-framework') . '</a></div>';
                echo '</div>';
                echo '</div>';

            }

        }

        echo '</div>';
        echo '<a href="#" class="button button-primary wpsf-add-group" data-group-id="' . $this->unique . '">' . $this->field['button_title'] . '</a>';
        echo $this->element_after();
    }

    /**
     * @param string $array
     * @param bool   $is_array
     * @return array|bool|mixed|string
     */
    public function _get_title($array = '', $is_array = FALSE) {
        if( ! is_array($array) && ! empty($array) ) {
            return $array;
        }

        if( is_array($array) ) {
            if( $is_array === TRUE ) {
                return $array;
            }

            $e = current($array);
            if( ! is_array($e) && ! empty($e) ) {
                return $e;
            }

            return $this->_get_title(next($array));
        }

        return FALSE;

    }
}