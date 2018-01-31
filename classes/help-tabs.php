<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 30-01-2018
 * Time: 10:10 AM
 */

class WPSFramework_Help_Tabs extends WPSFramework_Abstract {
    private static $_instance = NULL;

    private $help_tabs = array();
    private $help_tabs_pages = array();

    /**
     * WPSFramework_Help_Tabs constructor.
     * @param array $help_tabs
     */
    public function __construct($help_tabs = array()) {
        $this->help_tabs = $help_tabs;
        $this->help_tabs_pages = array_keys($help_tabs);
        $this->init_pages();
    }

    public function init_pages() {
        if( ! empty($this->help_tabs_pages) ) {
            foreach( $this->help_tabs_pages as $page_id ) {
                $this->addAction('load-' . $page_id, 'callback_help_tabs');
            }
        }
    }

    /**
     * @return null|\WPSFramework_Help_Tabs
     */
    public static function instance() {
        if( self::$_instance === NULL ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function callback_help_tabs() {
        $screen = get_current_screen();
        $sid = $screen->id;
        if( isset($this->help_tabs[$screen->id]) && is_array($this->help_tabs[$screen->id]) ) {
            $help_tabs = array();
            $help_sidebar = array();

            if( isset($this->help_tabs[$sid]['help_tabs']) && isset($this->help_tabs[$sid]['help_sidebar']) ) {
                $help_tabs = ( is_array($this->help_tabs[$sid]['help_tabs']) ) ? $this->help_tabs[$sid]['help_tabs'] : array();
                $help_sidebar = ( ! empty($this->help_tabs[$sid]['help_sidebar']) ) ? $this->help_tabs[$sid]['help_sidebar'] : array();
            } else if( isset($this->help_tabs[$sid]['help_tabs']) && ! isset($this->help_tabs[$sid]['help_sidebar']) ) {
                $help_tabs = ( is_array($this->help_tabs[$sid]['help_tabs']) ) ? $this->help_tabs[$sid]['help_tabs'] : array();
            } else if( isset($this->help_tabs[$sid]) && ! isset($this->help_tabs[$sid]['help_sidebar']) ) {
                $help_tabs = ( is_array($this->help_tabs[$sid]) ) ? $this->help_tabs[$sid] : array();
            }

            foreach( $help_tabs as $tab ) {
                $tab = $this->handle_data($tab);
                $screen->add_help_tab($tab);
            }

            if( ! empty($help_sidebar) ) {
                $screen->set_help_sidebar($help_sidebar);
            }
        }
    }

    /**
     * @param $help_sidebar
     * @return mixed
     */
    public function handle_data($help_sidebar) {
        if( isset($help_sidebar['content']) || isset($help_sidebar['callback']) ) {
            return $help_sidebar;
        }

        $fields = $help_sidebar['fields'];
        $fields = $this->map_field_ids(array( 'fields' => $fields ));
        $fields = isset($fields['fields']) ? $fields['fields'] : array();
        $output = '<div class="wpsf-framework wpsf-help-tabs">';
        foreach( $fields as $field ) {
            if( ! isset($field['id']) ) {
                $field['id'] = 'wpsf-help-tab-' . microtime(TRUE);
            }
            $output .= wpsf_add_element($field, '', 'wpsf_help_tab');
        }
        $output .= '</div>';
        $help_sidebar['content'] = $output;

        unset($help_sidebar['fields']);
        return $help_sidebar;
    }

    /**
     * @param array $array
     * @return array
     */
    protected function map_field_ids($array = array()) {
        $s = empty($array) ? $this->options : $array;

        if( isset($s['sections']) ) {
            foreach( $s['sections'] as $b => $a ) {
                if( isset($a['fields']) ) {
                    $s['sections'][$b] = $this->map_field_ids($a);
                }
            }
        } else if( isset($s['fields']) ) {
            foreach( $s['fields'] as $f => $e ) {

                if( ! isset($e['id']) ) {
                    $field_id = 'wpsf-helptab-' . $e['type'] . '-' . microtime(TRUE) . mt_rand(1, 100000);
                    $s['fields'][$f]['id'] = $field_id;
                }

                if( isset($e['fields']) || isset($e['sections']) ) {
                    $s['fields'][$f] = $this->map_field_ids($s['fields'][$f]);
                }
            }
        } else {
            foreach( $s as $i => $v ) {
                if( isset($v['fields']) || isset($v['sections']) ) {
                    $s[$i] = $this->map_field_ids($v);
                }
            }
        }
        return $s;
    }
}