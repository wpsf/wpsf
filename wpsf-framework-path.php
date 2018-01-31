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
 * Framework constants
 * @since 1.0.0
 * @version 1.0.0
 *
 */
defined('WPSF_VERSION') or define('WPSF_VERSION', '0.7Beta');
defined('WPSF_OPTION') or define('WPSF_OPTION', '_wpsf_options');
defined('WPSF_CUSTOMIZE') or define('WPSF_CUSTOMIZE', '_wpsf_customize_options');

/**
 *
 * Framework path finder
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_path_locate') ) {
    /**
     * @return mixed|void
     */
    function wpsf_get_path_locate() {
        $dirname = wp_normalize_path(dirname(__FILE__));
        $plugin_dir = wp_normalize_path(WP_PLUGIN_DIR);
        $located_plugin = ( preg_match('#' . preg_replace('/[^A-Za-z]/', '', $plugin_dir) . '#', preg_replace('/[^A-Za-z]/', '', $dirname)) ) ? TRUE : FALSE;
        $directory = ( $located_plugin ) ? $plugin_dir : get_template_directory();
        $directory_uri = ( $located_plugin ) ? WP_PLUGIN_URL : get_template_directory_uri();
        $basename = str_replace(wp_normalize_path($directory), '', $dirname);
        $dir = $directory . $basename;
        $uri = $directory_uri . $basename;

        return apply_filters('wpsf_get_path_locate', array(
            'basename' => wp_normalize_path($basename),
            'dir'      => wp_normalize_path($dir),
            'uri'      => $uri,
        ));
    }
}

/**
 *
 * Framework set paths
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
$get_path = wpsf_get_path_locate();
defined('WPSF_BASENAME') or define('WPSF_BASENAME', $get_path ['basename']);
defined('WPSF_DIR') or define('WPSF_DIR', $get_path ['dir']);
defined('WPSF_URI') or define('WPSF_URI', $get_path ['uri']);

/**
 * Framework locate template and override files
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_locate_template') ) {
    /**
     * @param $template_name
     * @return string
     */
    function wpsf_locate_template($template_name) {
        $located = '';
        $override = apply_filters('wpsf_framework_override', 'wpsf-framework-override');
        $dir_plugin = wp_normalize_path(WP_PLUGIN_DIR);
        $dir_theme = get_template_directory();
        $dir_child = get_stylesheet_directory();
        $dir_override = '/' . $override . '/' . $template_name;
        $dir_template = WPSF_BASENAME . '/' . $template_name;
        $child_force_overide = $dir_child . $dir_override;
        $child_normal_override = $dir_child . $dir_template;
        $theme_force_override = $dir_theme . $dir_override;
        $theme_normal_override = $dir_theme . $dir_template;
        $plugin_force_override = $dir_plugin . $dir_override;
        $plugin_normal_override = $dir_plugin . $dir_template;


        if( file_exists($child_force_overide) ) {
            $located = $child_force_overide;
        } else if( file_exists($child_normal_override) ) {
            $located = $child_normal_override;
        } else if( file_exists($theme_force_override) ) {
            $located = $theme_force_override;
        } else if( file_exists($theme_normal_override) ) {
            $located = $theme_normal_override;
        } else if( file_exists($plugin_force_override) ) {
            $located = $plugin_force_override;
        } else if( file_exists($plugin_normal_override) ) {
            $located = $plugin_normal_override;
        }

        $located = apply_filters('wpsf_locate_template', $located, $template_name);

        if( ! empty ($located) ) {
            load_template($located, TRUE);
        }

        return $located;
    }
}


/**
 * Multi language option
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_multilang_option') ) {
    /**
     * @param string $option_name
     * @param string $default
     * @return mixed|string
     */
    function wpsf_get_multilang_option($option_name = '', $default = '') {
        $value = wpsf_get_option($option_name, $default);
        $languages = wpsf_language_defaults();
        $default = $languages ['default'];
        $current = $languages ['current'];

        if( is_array($value) && is_array($languages) && isset ($value [$current]) ) {
            return $value [$current];
        } else if( $default != $current ) {
            return '';
        }

        return $value;
    }
}

/**
 * Multi language value
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_multilang_value') ) {
    /**
     * @param string $value
     * @param string $default
     * @return mixed|string
     */
    function wpsf_get_multilang_value($value = '', $default = '') {
        $languages = wpsf_language_defaults();
        $default = $languages ['default'];
        $current = $languages ['current'];

        if( is_array($value) && is_array($languages) && isset ($value [$current]) ) {
            return $value [$current];
        } else if( $default != $current ) {
            return '';
        }

        return $value;
    }
}

/**
 * Get customize option
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_customize_option') ) {
    /**
     * @param string $option_name
     * @param string $default
     * @return null|string
     */
    function wpsf_get_customize_option($option_name = '', $default = '') {
        $options = apply_filters('wpsf_get_customize_option', get_option(WPSF_CUSTOMIZE), $option_name, $default);

        if( ! empty ($option_name) && ! empty ($options [$option_name]) ) {
            return $options [$option_name];
        } else {
            return ( ! empty ($default) ) ? $default : NULL;
        }
    }
}

/**
 * Set customize option
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_set_customize_option') ) {
    /**
     * @param string $option_name
     * @param string $new_value
     */
    function wpsf_set_customize_option($option_name = '', $new_value = '') {
        $options = apply_filters('wpsf_set_customize_option', get_option(WPSF_CUSTOMIZE), $option_name, $new_value);

        if( ! empty ($option_name) ) {
            $options [$option_name] = $new_value;
            update_option(WPSF_CUSTOMIZE, $options);
        }
    }
}

/**
 * Get all customize option
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_get_all_customize_option') ) {
    /**
     * @return mixed|void
     */
    function wpsf_get_all_customize_option() {
        return get_option(WPSF_CUSTOMIZE);
    }
}

/**
 * WPML plugin is activated
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_is_wpml_activated') ) {
    /**
     * @return bool
     */
    function wpsf_is_wpml_activated() {
        if( class_exists('SitePress') ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * qTranslate plugin is activated
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_is_qtranslate_activated') ) {
    /**
     * @return bool
     */
    function wpsf_is_qtranslate_activated() {
        if( function_exists('qtrans_getSortedLanguages') ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * Polylang plugin is activated
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_is_polylang_activated') ) {
    /**
     * @return bool
     */
    function wpsf_is_polylang_activated() {
        if( class_exists('Polylang') ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * Get language defaults
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('wpsf_language_defaults') ) {
    /**
     * @return bool|mixed|void
     */
    function wpsf_language_defaults() {
        $multilang = array();
        if( wpsf_is_wpml_activated() || wpsf_is_qtranslate_activated() || wpsf_is_polylang_activated() ) {
            if( wpsf_is_wpml_activated() ) {
                global $sitepress;
                $multilang ['default'] = $sitepress->get_default_language();
                $multilang ['current'] = $sitepress->get_current_language();
                $multilang ['languages'] = $sitepress->get_active_languages();
            } else if( wpsf_is_polylang_activated() ) {
                global $polylang;
                $current = pll_current_language();
                $default = pll_default_language();
                $current = ( empty ($current) ) ? $default : $current;
                $poly_langs = $polylang->model->get_languages_list();
                $languages = array();
                foreach( $poly_langs as $p_lang ) {
                    $languages [$p_lang->slug] = $p_lang->slug;
                }
                $multilang ['default'] = $default;
                $multilang ['current'] = $current;
                $multilang ['languages'] = $languages;
            } else if( wpsf_is_qtranslate_activated() ) {
                global $q_config;
                $multilang ['default'] = $q_config ['default_language'];
                $multilang ['current'] = $q_config ['language'];
                $multilang ['languages'] = array_flip(qtrans_getSortedLanguages());
            }
        }
        $multilang = apply_filters('wpsf_language_defaults', $multilang);
        return ( ! empty ($multilang) ) ? $multilang : FALSE;
    }
}

/**
 * Framework load text domain
 * @since 1.0.0
 * @version 1.0.0
 */
load_textdomain('wpsf-framework', WPSF_DIR . '/languages/' . get_locale() . '.mo');