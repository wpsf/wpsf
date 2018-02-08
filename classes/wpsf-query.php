<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 07-02-2018
 * Time: 11:43 AM
 */

final class WPSFramework_Query {
    private static $_instance = NULL;

    private static $query = NULL;

    private static $query_args = array();

    public static function instance() {
        if( self::$_instance === NULL ) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public static function query($type = '', $args = array(), $search = '') {
        self::$query_args = array();
        self::$query = NULL;

        $option_key = 'ID';
        $option_value = 'name';
        $default_key = 'ID';
        $default_value = 'name';
        if( ! empty($search) ) {
            self::$query_args['s'] = $search;
        }

        if( ! empty($args) ) {
            $option_key = isset($args['option_key']) ? $args['option_key'] : 'ID';
            $option_value = isset($args['option_value']) ? $args['option_value'] : 'name';
            unset($args['option_key']);
            unset($args['option_value']);
            self::$query_args = array_merge($args, self::$query_args);
        }

        $_q_type = 'cpt';

        switch( $type ) {

            case 'pages' :
            case 'page' :
            case 'posts' :
            case 'post' :
                $_q_type = 'cpt';
                $default_key = 'ID';
                $default_value = 'post_title';

                if( in_array($type, array( 'posts', 'post' )) ) {
                    if( ! isset(self::$query_args['post_type']) ) {
                        self::$query_args['post_type'] = $type;
                    }
                } else {
                    self::$query_args['post_type'] = 'page';
                }
            break;

            case 'categories' :
            case 'category' :
            case 'tags':
            case 'tag':
                $_q_type = 'cat';
                $default_key = 'term_id';
                $default_value = 'name';


                if( in_array($type, array( 'tags', 'tag' )) ) {
                    self::$query_args ['taxonomies'] = ( isset(self::$query_args ['taxonomies']) ) ? self::$query_args['taxonomies'] : 'post_tag';
                } else {
                    self::$query_args['taxonomy'] = 'category';
                }

                if( ! empty($search) ) {
                    self::$query_args['search'] = $search;
                    unset(self::$query_args['s']);
                }
            break;

            case 'menus' :
            case 'menu' :
                $default_key = 'term_id';
                $default_value = 'name';
            break;

            case 'post_types' :
            case 'post_type' :
                $options = array();
                $post_types = get_post_types(array(
                    'show_in_nav_menus' => TRUE,
                ));

                if( ! is_wp_error($post_types) && ! empty ($post_types) ) {
                    foreach( $post_types as $post_type ) {
                        $options [$post_type] = ucfirst($post_type);
                    }
                }
                return $options;
            break;
        }

        self::handle_query_args();

        switch( $_q_type ) {
            case "cpt":
                self::$query = new WP_Query(self::$query_args);
                $result = self::$query->posts;
            break;
            case 'cat':
                $result = get_terms(self::$query_args);
            break;
            case 'menu':
                $result = wp_get_nav_menus(self::$query_args);
            break;
        }

        if( is_wp_error($result) || is_null($result) || empty($result) ) {
            return array();
        }

        $result = self::handle_query_data($result, array( $option_key, $option_value ), array(
            $default_key,
            $default_value,
        ));

        return $result;
    }

    private static function handle_query_args() {
        foreach( self::$query_args as $id => $value ) {
            if( in_array($value, array( 'false', '0' )) ) {
                self::$query_args[$id] = FALSE;
            }

            if( in_array($value, array( 'true', '1' )) ) {
                self::$query_args[$id] = TRUE;
            }
        }
    }

    public static function handle_query_data($data = array(), $required = array(), $default = array()) {
        $return = array();

        foreach( $data as $values ) {
            $opk = self::option_data($required[0], $default[0], $values);
            $opv = self::option_data($required[1], $default[1], $values);
            $return[$opk] = $opv;
        }

        return $return;
    }

    private static function option_data($key, $default, $data) {
        return ( isset($data->{$key}) && ! empty($data->{$key}) ) ? $data->{$key} : $data->{$default};
    }
}

return WPSFramework_Query::instance();