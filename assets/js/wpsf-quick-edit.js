/*-------------------------------------------------------------------------------------------------
 This file is part of the WPSF package.                                                           -
 This package is Open Source Software. For the full copyright and license                         -
 information, please view the LICENSE file which was distributed with this                        -
 source code.                                                                                     -
                                                                                                  -
 @package    WPSF                                                                                 -
 @author     Varun Sridharan <varunsridharan23@gmail.com>                                         -
 -------------------------------------------------------------------------------------------------*/
;
( function ($, window, document, undefined) {
    'use strict';

    $.WPSFQE = $.WPSFQE || {};

    $.WPSFQE.db_values = {};

    $.WPSFQE.post_id = null;

    $.WPSFQE.inline = null;

    $.WPSFQE.fields = null;

    $.WPSFQE.string_to_array = function ($string) {
        if ( $string === undefined ) {
            return false;
        }
        var $s = $string.split('[');
        $.each($s, function ($i, $v) {
            $s[$i] = $v.replace(']', '');
            $s[$i] = $s[$i].replace('[', '');
        });
        return $s;
    };

    $.WPSFQE.retrive_db_values = function () {
        $.WPSFQE.inline.find(' > div').each(function () {
            var $ID = $(this).attr("id");
            var $values = JSON.parse($(this).text());
            console.log($values);
            $.WPSFQE.db_values[$ID] = $values;
        });
    };

    $.WPSFQE.get_field_db_name = function ($name, $type) {
        $name = $.WPSFQE.string_to_array($name);
        if ( $type === 'db' ) {
            return $name[0];
        } else {
            return $name[1];
        }
    };

    $.WPSFQE.get_field_value = function ($db_key, $field_id) {
        if ( $.WPSFQE.db_values[$db_key] !== undefined ) {
            if ( $.WPSFQE.db_values[$db_key][$field_id] !== undefined ) {
                return $.WPSFQE.db_values[$db_key][$field_id];
            } else {
                return null;
            }
        }
        return null;
    };

    $.WPSFQE.set_select_prop = function ($elem, $value) {
        $elem.find('option').each(function ($i, $c) {
            $(this).prop('select', false);
            if ( $value === $(this).val() ) {
                $(this).prop('select', true);
            }
        });
    };

    $.WPSFQE.handle_select_values = function ($elem, $value) {
        if ( $value === undefined ) {
            return;
        }
        var $is_m = $elem.attr('multiple');
        if ( $is_m === undefined ) {
            var $val = $value;

            if ( ( typeof $value === 'object' || typeof $value === 'array' ) && $value !== null ) {
                var $arr = $.WPSFQE.string_to_array($elem.attr("name"));
                var $last = $arr[$arr.length - 1];
                $val = $value[$last];
            }

            if ( $val ) {
                $elem.find('option').removeAttr("selected");
                $.WPSFQE.set_select_prop($elem, $val);
            }
        } else {
            $elem.find('option').removeAttr("selected");
            $.each($value, function ($i, $v) {
                $.WPSFQE.set_select_prop($elem, $v);
            });
        }
    };

    $.WPSFQE.handle_input_values = function ($elem, $value) {
        if ( $value === '' ) {
            return;
        }
        var $type = $elem.attr('type');
        switch ( $type ) {
            case 'select':
                $elem.prop('select', false);
                if ( ( typeof $value === 'object' || typeof $value === 'array' ) && $value != null ) {
                    $.each($value, function ($i, $v) {
                        if ( $v === $elem.val() ) {
                            $elem.prop('select', true);
                        }
                    })
                } else {
                    if ( $value === $elem.val() ) {
                        $elem.prop('select', true);
                    }
                }
                break;
            case 'checkbox':
            case 'radio':
                $elem.prop('checked', false);
                if ( ( typeof $value === 'object' || typeof $value === 'array' ) && $value != null ) {
                    $.each($value, function ($i, $v) {
                        if ( $v === $elem.val() ) {
                            $elem.prop('checked', true);
                        }
                    })
                } else {
                    if ( $value === $elem.val() ) {
                        $elem.prop('checked', true);
                    }
                }
                break;
            default:
                if ( ( typeof $value === 'object' || typeof $value === 'array' ) && $value != null ) {
                    var $arr = $.WPSFQE.string_to_array($elem.attr("name"));
                    var $last = $arr[$arr.length - 1];
                    if ( $value[$last] !== undefined ) {
                        $elem.val($value[$last]);
                    }
                } else {
                    if ( $elem.hasClass('wpsf-icon-value') ) {
                        var $parent = $elem.parent();
                        $parent.find('i').removeAttr('class').addClass($value);
                        $parent.find('input').val($value).trigger('change');
                        $parent.find('.wpsf-icon-preview').removeClass('hidden');
                        $parent.find('.wpsf-icon-remove').removeClass('hidden');
                    } else {
                        $elem.val($value);
                    }
                }

                break;
        }
    };

    $.WPSFQE.find_inputs = function ($elem, $type) {
        if ( $type == 'main' ) {
            return $elem.find('.wpsf-element');
        }
        return $elem.find(':input');
    };

    $.WPSFQE.loop_inputs = function ($elem) {
        var $main_inputs = $.WPSFQE.find_inputs($elem, 'main');

        if ( $main_inputs ) {
            $main_inputs.each(function () {
                var $sub_inputs = $.WPSFQE.find_inputs($(this), 'sub');
                if ( $sub_inputs ) {
                    $sub_inputs.each(function () {
                        var $e = $(this);
                        var $qeid = $.WPSFQE.get_field_db_name($e.attr("name"), 'db');
                        var $fiid = $.WPSFQE.get_field_db_name($e.attr("name"), 'slug');
                        var $default_value = $.WPSFQE.get_field_value($qeid, $fiid);

                        if ( $e.is('textarea') ) {
                            $e.html($default_value);
                        } else if ( $e.is('input') ) {
                            $.WPSFQE.handle_input_values($e, $default_value);
                        } else if ( $e.is('select') ) {
                            $.WPSFQE.handle_select_values($e, $default_value);
                        } else {
                        }
                    });
                }
                $.WPSFQE.loop_inputs($(this));
            })
        }
    };

    $.WPSFQE.handle_field_values = function () {
        $.WPSFQE.loop_inputs($.WPSFQE.fields);
        $.WPSFQE.fields.WPSF_RELOAD();
    };

    $.WPSFQE.handle_quick_edit_click = function ($elem) {
        $.WPSFQE.post_id = $elem.closest('tr').attr('id');
        $.WPSFQE.post_id = $.WPSFQE.post_id.replace('post-', '');
        $.WPSFQE.inline = $("#wpsf_quick_edit_" + $.WPSFQE.post_id);
        $.WPSFQE.fields = $(".inline-edit-row").find('.wpsf_quick_edit_fields');

        $.WPSFQE.retrive_db_values();
        $.WPSFQE.handle_field_values();
    };

    $(document).ready(function () {
        if ( $('#the-list').length > 0 ) {
            $('#the-list').on('click', '.editinline', function () {
                $.WPSFQE.handle_quick_edit_click($(this));
            });
        }
    });

} )(jQuery, window, document);