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
 * Shortcodes Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class WPSFramework_Shortcode_Manager extends WPSFramework_Abstract {

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
     * shortcode options
     *
     * @access public
     * @var array
     *
     */
    public $options = array();
    /**
     *
     * shortcodes options
     *
     * @access public
     * @var array
     *
     */
    public $shortcodes = array();
    /**
     *
     * exclude_post_types
     *
     * @access public
     * @var array
     *
     */
    public $exclude_post_types = array();

    // run shortcode construct

    public function __construct($options) {

        $this->settings = array();
        $this->options = apply_filters('wpsf_shortcode_options', $options);
        $this->exclude_post_types = apply_filters('wpsf_shortcode_exclude', $this->exclude_post_types);

        if( ! empty ($this->options) ) {
            if( isset($this->options['settings']) ) {
                $this->settings = $options['settings'];
                unset($this->options['settings']);
            }

            $defaults = array(
                'button_title' => __("Add Shortcode"),
                'button_class' => 'button button-primary',
                'auto_select'  => 'yes',
            );

            $this->settings = wp_parse_args($this->settings, $defaults);


            $this->shortcodes = $this->get_shortcodes();
            $this->addAction("admin_enqueue_scripts", 'load_style_script');
            $this->addAction('media_buttons', 'media_shortcode_button', 99);
            $this->addAction('admin_footer', 'shortcode_dialog', 99);
            $this->addAction('customize_controls_print_footer_scripts', 'shortcode_dialog', 99);
            $this->addAction('wp_ajax_wpsf-get-shortcode', 'shortcode_generator', 99);
        }
    }

    public function get_shortcodes() {
        $shortcodes = array();

        foreach( $this->options as $group_value ) {
            foreach( $group_value ['shortcodes'] as $shortcode ) {
                $shortcodes [$shortcode ['name']] = $shortcode;
            }
        }

        return $shortcodes;
    }

    // add shortcode button

    public function load_style_script() {
        wpsf_load_fields_styles();
    }

    // shortcode dialog

    public function media_shortcode_button($editor_id) {
        global $post;

        $post_type = ( isset ($post->post_type) ) ? $post->post_type : '';

        if( ! in_array($post_type, $this->exclude_post_types) ) {
            echo '<a href="#" class="' . esc_attr($this->settings['button_class']) . ' wpsf-shortcode" data-auto-select="' . esc_attr($this->settings['auto_select']) . '" data-editor-id="' . $editor_id . '">' . esc_html($this->settings['button_title']) . '</a>';
        }
    }

    // shortcode generator function for dialog

    public function shortcode_dialog() {

        ?>
        <div id="wpsf-shortcode-dialog" class="wpsf-dialog hidden"
             title="<?php esc_html_e('Add Shortcode', 'wpsf-framework'); ?>">
            <div class="wpsf-dialog-header">
                <select
                        class="<?php echo ( is_rtl() ) ? 'chosen-rtl ' : ''; ?>wpsf-dialog-select"
                        data-placeholder="<?php esc_html_e('Select a shortcode', 'wpsf-framework'); ?>">
                    <option value=""></option>
                    <?php
                    foreach( $this->options as $group ) {
                        echo '<optgroup label="' . $group ['title'] . '">';
                        foreach( $group ['shortcodes'] as $shortcode ) {
                            $view = ( isset ($shortcode ['view']) ) ? $shortcode ['view'] : 'normal';
                            echo '<option value="' . $shortcode ['name'] . '" data-view="' . $view . '">' . $shortcode ['title'] . '</option>';
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select>
            </div>
            <div class="wpsf-dialog-load"></div>
            <div class="wpsf-insert-button hidden">
                <a href="#"
                   class="button button-primary wpsf-dialog-insert"><?php esc_html_e('Insert Shortcode', 'wpsf-framework'); ?></a>
            </div>
        </div>
        <?php
    }

    // getting shortcodes from config array

    public function shortcode_generator() {
        $request = wpsf_get_var('shortcode');

        if( empty ($request) ) {
            die ();
        }

        $shortcode = $this->shortcodes [$request];

        if( isset ($shortcode ['fields']) ) {

            foreach( $shortcode ['fields'] as $key => $field ) {

                if( isset ($field ['id']) ) {
                    $field ['attributes'] = ( isset ($field ['attributes']) ) ? wp_parse_args(array(
                        'data-atts' => $field ['id'],
                    ), $field ['attributes']) : array(
                        'data-atts' => $field ['id'],
                    );
                }

                $field_default = ( isset ($field ['default']) ) ? $field ['default'] : '';

                if( in_array($field ['type'], array(
                        'image_select',
                        'checkbox',
                    )) && isset ($field ['options']) ) {
                    $field ['attributes'] ['data-check'] = TRUE;
                }

                echo wpsf_add_element($field, $field_default, 'shortcode');
            }
        }

        if( isset ($shortcode ['clone_fields']) ) {

            $clone_id = isset ($shortcode ['clone_id']) ? $shortcode ['clone_id'] : $shortcode ['name'];

            echo '<div class="wpsf-shortcode-clone" data-clone-id="' . $clone_id . '">';
            echo '<a href="#" class="wpsf-remove-clone"><i class="fa fa-trash"></i></a>';

            foreach( $shortcode ['clone_fields'] as $key => $field ) {

                $field ['sub'] = TRUE;
                $field ['attributes'] = ( isset ($field ['attributes']) ) ? wp_parse_args(array(
                    'data-clone-atts' => $field ['id'],
                ), $field ['attributes']) : array(
                    'data-clone-atts' => $field ['id'],
                );
                $field_default = ( isset ($field ['default']) ) ? $field ['default'] : '';

                if( in_array($field ['type'], array(
                        'image_select',
                        'checkbox',
                    )) && isset ($field ['options']) ) {
                    $field ['attributes'] ['data-check'] = TRUE;
                }

                echo wpsf_add_element($field, $field_default, 'shortcode');
            }

            echo '</div>';

            echo '<div class="wpsf-clone-button"><a id="shortcode-clone-button" class="button" href="#"><i class="fa fa-plus-circle"></i> ' . $shortcode ['clone_title'] . '</a></div>';
        }

        die ();
    }
}
