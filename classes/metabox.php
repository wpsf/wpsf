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
 * Metabox Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Metabox extends WPSFramework_Abstract {

    /**
     *
     * instance
     *
     * @access private
     * @var class
     *
     */
    private static $instance = NULL;
    /**
     *
     * metabox options
     *
     * @access public
     * @var array
     *
     */
    public $options = array();

    /**
     * WPSFramework_Metabox constructor.
     * @param $options
     */
    public function __construct($options) {
        $this->options = apply_filters('wpsf_metabox_options', $options);
        $this->posttypes = array();

        if( ! empty ($this->options) ) {
            $this->addAction('add_meta_boxes', 'add_meta_box');
            $this->addAction('save_post', 'save_post', 10, 2);
        }
    }

    /**
     * @param array $options
     * @return \class|\WPSFramework_Metabox
     */
    public static function instance($options = array()) {
        if( is_null(self::$instance) ) {
            self::$instance = new self ($options);
        }
        return self::$instance;
    }

    /**
     * @param $post_type
     */
    public function add_meta_box($post_type) {
        foreach( $this->options as $value ) {
            add_meta_box($value ['id'], $value ['title'], array(
                &$this,
                'render_meta_box_content',
            ), $value ['post_type'], $value ['context'], $value ['priority'], $value);
            $this->posttypes[$value['post_type']] = $value['post_type'];
        }

        $this->addAction("admin_enqueue_scripts", 'load_style_script');
    }

    public function load_style_script() {
        global $pagenow, $typenow;

        if( ( $pagenow === 'post-new.php' || $pagenow === 'post.php' ) && isset($this->posttypes[$typenow]) ) {
            wpsf_load_fields_styles();
        }
    }


    /**
     * @param $post
     * @param $callback
     */
    public function render_meta_box_content($post, $callback) {
        global $post, $wpsf_errors, $typenow;

        wp_nonce_field('wpsf-framework-metabox', 'wpsf-framework-metabox-nonce');

        $unique = $callback ['args'] ['id'];
        $sections = $callback ['args'] ['sections'];
        $meta_value = get_post_meta($post->ID, $unique, TRUE);
        $transient = get_transient('wpsf-mt-' . $this->get_cache_key($callback['args']));
        $wpsf_errors = $transient ['errors'];
        $has_nav = ( count($sections) >= 2 && $callback ['args'] ['context'] != 'side' ) ? TRUE : FALSE;
        $show_all = ( ! $has_nav ) ? ' wpsf-show-all' : '';
        $section_id = ( ! empty ($transient ['ids'] [$unique]) ) ? $transient ['ids'] [$unique] : '';
        $section_id = wpsf_get_var('wpsf-section', $section_id);

        echo '<div class="wpsf-framework wpsf-metabox-framework" data-theme="modern" data-single-page="yes">';

        echo '<input type="hidden" name="wpsf_section_id[' . $unique . ']" class="wpsf-reset" value="' . $section_id . '">';

        echo '<div class="wpsf-body' . $show_all . '">';

        if( $has_nav ) {

            echo '<div class="wpsf-nav">';

            echo '<ul>';
            $num = 0;
            foreach( $sections as $value ) {

                if( ! empty ($value ['typenow']) && $value ['typenow'] !== $typenow ) {
                    continue;
                }

                $tab_icon = ( ! empty ($value ['icon']) ) ? '<i class="wpsf-icon ' . $value ['icon'] . '"></i>' : '';

                if( isset ($value ['fields']) ) {
                    $active_section = ( ( empty ($section_id) && $num === 0 ) || $section_id == $value ['name'] ) ? ' class="wpsf-section-active"' : '';
                    echo '<li><a href="#"' . $active_section . ' data-section="' . $value ['name'] . '">' . $tab_icon . $value ['title'] . '</a></li>';
                } else {
                    echo '<li><div class="wpsf-seperator">' . $tab_icon . $value ['title'] . '</div></li>';
                }

                $num++;
            }
            echo '</ul>';

            echo '</div>';
        }

        echo '<div class="wpsf-content">';

        echo '<div class="wpsf-sections">';
        $num = 0;
        foreach( $sections as $v ) {

            if( ! empty ($v ['typenow']) && $v ['typenow'] !== $typenow ) {
                continue;
            }

            if( isset ($v ['fields']) ) {

                $active_content = ( ( empty ($section_id) && $num === 0 ) || $section_id == $v ['name'] ) ? ' style="display: block;"' : '';

                echo '<div id="wpsf-tab-' . $v ['name'] . '" class="wpsf-section"' . $active_content . '>';
                echo ( isset ($v ['title']) ) ? '<div class="wpsf-section-title"><h3>' . $v ['title'] . '</h3></div>' : '';

                foreach( $v ['fields'] as $field_key => $field ) {
                    $elem_value = $this->get_field_values($field, $meta_value);
                    echo wpsf_add_element($field, $elem_value, $unique);
                }
                echo '</div>';
            }

            $num++;
        }
        echo '</div>';

        echo '<div class="clear"></div>';

        echo '</div>';

        echo ( $has_nav ) ? '<div class="wpsf-nav-background"></div>' : '';

        echo '<div class="clear"></div>';

        echo '</div>';

        echo '</div>';
    }

    /**
     * @param $post_id
     * @param $post
     */
    public function save_post($post_id, $post) {
        if( wp_verify_nonce(wpsf_get_var('wpsf-framework-metabox-nonce'), 'wpsf-framework-metabox') ) {
            $errors = array();
            $post_type = wpsf_get_var('post_type');

            foreach( $this->options as $request_value ) {
                $transient = array();
                $validator = new WPSFramework_Fields_Save_Sanitize;
                if( in_array($post_type, ( array ) $request_value ['post_type']) ) {
                    $request_key = $request_value ['id'];
                    $request = wpsf_get_var($request_key, array());

                    if( isset ($request ['_nonce']) ) {
                        unset ($request ['_nonce']);
                    }

                    foreach( $request_value ['sections'] as $key => $section ) {
                        if( isset ($section ['fields']) ) {
                            $meta_value = get_post_meta($post_id, $request_key, TRUE);
                            $request = $validator->loop_fields(array( 'fields' => $section['fields'] ), $request, $meta_value, TRUE);
                        }
                    }

                    $request = apply_filters('wpsf_save_post', $request, $request_key, $post);

                    if( empty ($request) ) {
                        delete_post_meta($post_id, $request_key);
                    } else {
                        update_post_meta($post_id, $request_key, $request);
                    }

                    $transient ['ids'] [$request_key] = wpsf_get_vars('wpsf_section_id', $request_key);
                    $transient ['errors'] = $validator->get_errors();;
                }

                set_transient('wpsf-mt-' . $this->get_cache_key($request_value), $transient, 10);
            }
        }
    }
}
