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

if( ! defined("ABSPATH") ) {
    exit;
}

if( ! class_exists("WPSFramework") ) {
    /**
     * Class WPSFramework
     */
    class WPSFramework {

        /**
         * @return array
         */
        private function _defaults() {
            return array(
                'settings'   => FALSE,
                'customizer' => FALSE,
                'metabox'    => FALSE,
                'shortcode'  => FALSE,
                'taxonomy'   => FALSE,
            );
        }

        /**
         * WPSFramework constructor.
         * @param array $options
         */
        public function __construct($options = array()) {
            $this->init($options);
        }

        /**
         * @param array $options
         */
        public function init($options = array()) {
            $final = wp_parse_args($options, $this->_defaults());

            if( $final['settings'] !== FALSE && ( is_admin() || is_ajax() ) ) {
                $this->init_settings($final['settings']);
            }

            if( $final['metabox'] !== FALSE && is_admin() ) {
                $this->init_metabox($final['metabox']);
            }

            if( $final['customizer'] !== FALSE ) {
                $this->init_customizer($final['customizer']);
            }

            if( $final['taxonomy'] !== FALSE && ( is_admin() || is_ajax() ) ) {
                $this->init_taxonomy($final['taxonomy']);
            }

            if( $final['shortcode'] !== FALSE ) {
                $this->init_shortcode($final['shortcode']);
            }
        }

        /**
         * @param $options
         */
        public function init_taxonomy($options) {
            $this->taxonomy = new WPSFramework_Taxonomy($options);
        }

        /**
         * @param $options
         */
        public function init_customizer($options) {
            $this->customizer = new WPSFramework_Customize($options);
        }

        /**
         * @param $options
         */
        public function init_metabox($options) {
            $this->metabox = new WPSFramework_Metabox($options);
        }

        /**
         * @param $options
         */
        public function init_settings($options) {
            $this->settings = new WPSFramework_Settings($options['config'], $options['options']);
        }

        /**
         * @param $options
         */
        public function init_shortcode($options) {
            $this->shortcodes = new WPSFramework_Shortcode_Manager($options);
        }
    }
}