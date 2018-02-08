<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 07-02-2018
 * Time: 11:24 AM
 */

final class WPSFramework_Ajax extends WPSFramework_Abstract {
    private static $_instance = NULL;

    public function __construct() {
        add_action('wp_ajax_wpsf-ajax', array( &$this, 'handle_ajax' ));
        add_action('wp_ajax_nopriv_wpsf-ajax', array( &$this, 'handle_ajax' ));
    }

    public static function instance() {
        if( self::$_instance == NULL ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function handle_ajax() {
        if( isset($_REQUEST['wpsf-action']) ) {
            $action = $_REQUEST['wpsf-action'];
            $action = str_replace('-', '_', strtolower($action));
            if( method_exists($this, $action) ) {
                $this->$action();
            } else if( has_action('wpsf_ajax_' . $action) ) {
                do_action('wpsf_ajax_' . $action);
            }
        }

        wp_die();
    }

    public function query_select_data() {
        $options = array();
        $query_args = ( isset ($_REQUEST['query_args']) ) ? $_REQUEST['query_args'] : array();

        $data = WPSFramework_Query::query($_REQUEST['options'], $query_args, $_REQUEST['s']);
        echo wp_json_encode($data);
        wp_die();
    }

    public function wpsf_get_icons() {
        do_action('wpsf_add_icons_before');
        $jsons = apply_filters('wpsf_add_icons_json', glob(WPSF_DIR . '/fields/icon/*.json'));

        if( ! empty ($jsons) ) {
            foreach( $jsons as $path ) {
                $object = wpsf_get_icon_fonts('fields/icon/' . basename($path));
                if( is_object($object) ) {
                    echo ( count($jsons) >= 2 ) ? '<h4 class="wpsf-icon-title">' . $object->name . '</h4>' : '';
                    foreach( $object->icons as $icon ) {
                        echo '<a class="wpsf-icon-tooltip" data-wpsf-icon="' . $icon . '" data-title="' . $icon . '"><span class="wpsf-icon wpsf-selector"><i class="' . $icon . '"></i></span></a>';
                    }
                } else {
                    echo '<h4 class="wpsf-icon-title">' . esc_html__('Error! Can not load json file.', 'wpsf-framework') . '</h4>';
                }
            }
        }

        do_action('wpsf_add_icons');
        do_action('wpsf_add_icons_after');
    }

}

return WPSFramework_Ajax::instance();