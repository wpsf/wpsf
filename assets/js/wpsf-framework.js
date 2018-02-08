/*-------------------------------------------------------------------------------------------------
 This file is part of the WPSF package.                                                           -
 This package is Open Source Software. For the full copyright and license                         -
 information, please view the LICENSE file which was distributed with this                        -
 source code.                                                                                     -
                                                                                                  -
 @package    WPSF                                                                                 -
 @author     Varun Sridharan <varunsridharan23@gmail.com>                                         -
 -------------------------------------------------------------------------------------------------*/

;( function ($, window, document, undefined) {
    'use strict';


    $.WPSF_HELPER = {
        COLOR_PICKER: {
            parse: function ($value) {
                var val = $value.replace(/\s+/g, ''),
                    alpha = ( val.indexOf('rgba') !== -1 ) ? parseFloat(val.replace(/^.*,(.+)\)/, '$1') * 100) : 100,
                    rgba = ( alpha < 100 ) ? true : false;
                return {value: val, alpha: alpha, rgba: rgba};
            }
        },
        CSS_BUILDER: {
            validate: function (val) {
                var s = val;
                if ( $.isNumeric(val) ) {
                    return val + 'px';
                } else if ( val.indexOf('px') > -1 || val.indexOf('%') > -1 || val.indexOf('em') > -1 ) {
                    var checkPx = s.replace("px", "");
                    var checkPct = s.replace("%", "");
                    var checkEm = s.replace("em", "");
                    if ( $.isNumeric(checkPx) || $.isNumeric(checkPct) || $.isNumeric(checkEm) ) {
                        return val;
                    } else {
                        return "0px";
                    }
                } else {
                    return '0px';
                }

            },

            update: {
                border: function ($el) {
                    $el.find('.wpsf-css-builder-border').css({
                        "border-top-left-radius": $el.find('.wpsf-border-radius-top-left :input').val(),
                        "border-top-right-radius": $el.find('.wpsf-border-radius-top-right :input').val(),
                        "border-bottom-right-radius": $el.find('.wpsf-border-radius-bottom-left :input').val(),
                        "border-bottom-left-radius": $el.find('.wpsf-border-radius-bottom-right :input').val(),
                        'border-style': $el.find('.wpsf-element-border-style select').val(),
                        'border-color': $el.find('.wpsf-element-border-color input.wpsf-field-color-picker').val(),
                    });

                    $el.find('.wpsf-css-builder-margin').css({
                        'background-color': $el.find('.wpsf-element-background-color input.wpsf-field-color-picker').val(),
                        'color': $el.find('.wpsf-element-text-color input.wpsf-field-color-picker').val(),
                    });

                },
                all: function ($el, $type, $main) {
                    var $newVal = $el.val(),
                        $val = $.WPSF_HELPER.CSS_BUILDER.validate($newVal),
                        $is_all = $('.wpsf-' + $type + '-checkall').hasClass('checked');

                    if ( $is_all === true ) {
                        $main.find('.wpsf-element.wpsf-' + $type + ' :input').val($val);
                    } else {
                        $el.val($val);
                    }

                    $.WPSF_HELPER.CSS_BUILDER.update.border($main);

                },
            }
        },
        LIMITER: {
            counter: function (val, countBy) {
                if ( $.trim(val) == '' ) {
                    return 0;
                }

                return countBy ? val.match(/\S+/g).length : val.length;
            },
            subStr: function (val, start, len, subByWord) {
                if ( !subByWord ) {
                    return val.substr(start, len);
                }

                var lastIndexSpace = val.lastIndexOf(' ');
                return val.substr(start, lastIndexSpace);
            }
        },
        ADVANCED_TYPO: {
            font_style: function ($fontWeightStyle) {
                var $weight_val = '400',
                    $style_val = 'normal';

                switch ( $fontWeightStyle ) {
                    case '100':
                        $weight_val = '100';
                        break;
                    case '100italic':
                        $weight_val = '100';
                        $style_val = 'italic';
                        break;
                    case '300':
                        $weight_val = '300';
                        break;
                    case '300italic':
                        $weight_val = '300';
                        $style_val = 'italic';
                        break;
                    case '500':
                        $weight_val = '500';
                        break;
                    case '500italic':
                        $weight_val = '500';
                        $style_val = 'italic';
                        break;
                    case '700':
                        $weight_val = '700';
                        break;
                    case '700italic':
                        $weight_val = '700';
                        $style_val = 'italic';
                        break;
                    case '900':
                        $weight_val = '900';
                        break;
                    case '900italic':
                        $weight_val = '900';
                        $style_val = 'italic';
                        break;
                    case 'italic':
                        $style_val = 'italic';
                        break;
                }
                return {weight: $weight_val, style: $style_val}
            },
            update: function ($el) {
                var $font_field = $el.find('.wpsf_font_field'),
                    $parentName = $font_field.attr('data-id'),
                    $preview = $font_field.find('#preview-' + $parentName),
                    $fontColor = $font_field.find('.wp-picker-input-wrap input'),
                    $fontSize = $font_field.find('input[data-font-size=""]'),
                    $lineHeight = $font_field.find('input[data-font-line-height=""]'),
                    $fontFamily = $font_field.find('.wpsf-typo-family'),
                    $fontWeight = $font_field.find('.wpsf-typo-variant'),
                    $font = $fontFamily.val(),
                    $fontWeightStyle = $fontWeight.find(':selected').text(),
                    $font_style = $.WPSF_HELPER.ADVANCED_TYPO.font_style($fontWeightStyle),
                    $attrs = '',
                    href = 'http://fonts.googleapis.com/css?family=' + $font + ':' + $font_style.weight,
                    html = '<link href="' + href + '" class="wpsf-font-preview-' + $parentName + '" rel="stylesheet" type="text/css" />';

                if ( jQuery('.wpsf-font-preview-' + $parentName).length > 0 ) {
                    jQuery('.wpsf-font-preview-' + $parentName).attr('href', href);
                } else {
                    jQuery('head').append(html);
                }

                $attrs = ' font-family:' + $font + '; ' +
                    ' font-weight:' + $font_style.weight + '; ' +
                    ' font-style:' + $font_style.style + '; ' +
                    ' color:' + $fontColor.val() + ' !important; ' +
                    ' line-height:' + $lineHeight.val() + 'px !important; ' +
                    ' font-size:' + $fontSize.val() + 'px !important; ';

                $preview.attr("style", $attrs);
            }
        },
        NAV_BAR: {
            modern: function ($el, $single_page) {
                var $this = $el,
                    $nav = $this.find('.wpsf-nav'),
                    $reset = $this.find('.wpsf-reset'),
                    $reset_parent = $this.find('.wpsf_parent_section_id'),
                    $expand = $this.find('.wpsf-expand-all');

                $nav.find('ul:first a').on('click', function (e) {
                    e.preventDefault();
                    var $el = $(this),
                        $next = $el.next(),
                        $target = $el.data('section'),
                        $parent = $el.data("parent-section");

                    if ( $next.is('ul') ) {
                        $next.slideToggle('fast');
                        $el.closest('li').toggleClass('wpsf-tab-active');
                    } else {
                        if ( $single_page === 'yes' ) {
                            var $is_parent = '';
                            if ( $parent ) {
                                var $is_parent = $parent + '-';
                            }

                            $this.find('#wpsf-tab-' + $is_parent + $target).show().siblings().hide();
                            $nav.find('a').removeClass('wpsf-section-active');
                            $el.addClass('wpsf-section-active');
                            $reset.val($target);
                            $reset_parent.val($parent);
                        } else {
                            window.location.href = $el.attr("href");
                        }
                    }
                    $('body').trigger('wpsf_settings_nav_updated', [$parent, $target, $el]);
                });

                $expand.on('click', function (e) {
                    e.preventDefault();
                    $this.find('.wpsf-body').toggleClass('wpsf-show-all');
                    $(this).find('.fa').toggleClass('fa-eye-slash').toggleClass('fa-eye');
                });
            },
            simple: function ($el, $single_page) {
                var $this = $el,
                    $main_nav = $this.find('.wpsf-main-nav'),
                    $sub_nav = $this.find('.wpsf-subnav-container'),
                    $reset_parent = $this.find('.wpsf_parent_section_id'),
                    $reset = $this.find('.wpsf-reset');

                $main_nav.find("a").on("click", function (e) {
                    e.preventDefault();

                    var $el = $(this),
                        $target = $el.data('section'),
                        $parent = $el.data('parent-section');

                    if ( $single_page === 'yes' ) {
                        var $cdiv = $this.find('#wpsf-tab-' + $target);
                        $cdiv.show().siblings().hide();

                        $main_nav.find("a").removeClass('nav-tab-active');
                        $el.addClass('nav-tab-active');
                        $reset.val($target);
                        var $parent = $cdiv.find("#wpsf-tab-" + $target + " a.current").data('section');
                        $reset_parent.val($parent);
                    } else {
                        window.location.href = $el.attr("href");
                    }

                    $('body').trigger('wpsf_settings_nav_updated', [$target, $parent, $el]);

                });

                $sub_nav.find(".wpsf-submenus a").on("click", function (e) {
                    e.preventDefault();

                    var $el = $(this),
                        $target = $el.data('section'),
                        $parent = $el.data('parent-section');

                    $this.find('#wpsf-tab-' + $parent + '-' + $target).show().siblings().hide();
                    $sub_nav.find("#wpsf-tab-" + $parent + " a").removeClass('current');
                    $el.addClass('current');
                    $reset.val($target);
                    $reset_parent.val($parent);

                    $('body').trigger('wpsf_settings_nav_updated', [$parent, $target, $el]);
                })

                if ( $single_page === 'no' ) {
                    var $parent = $main_nav.find('a.nav-tab-active').data('section');
                    var $section = $sub_nav.find("a.current").attr('data-section');
                    $reset_parent.val($parent);
                    $reset.val($section);
                }
            }
        },
        DEP_ELEM: function ($elem, $is_sub) {
            var $return = null;
            switch ( $elem ) {
                case 'page_template' :
                    $return = 'select#page_template';
                    break;
                case 'menu_order':
                    $return = 'input#menu_order';
                    break;
                case 'parent_id':
                    $return = 'select#parent_id';
                    break;
                case 'post_status':
                    $return = 'select#post_status';
                    break;
                case 'visibility':
                    $return = 'input[name=visibility]';
                    break;
                case 'post_format':
                    $return = 'input[name=post_format]';
                    break;
            }
            if ( $return !== null ) {
                return $return;
            }

            if ( $is_sub === true ) {
                return '[data-sub-depend-id="' + $elem + '"]';
            }
            return '[data-depend-id="' + $elem + '"]';
        },
        ELM_ARGS: function (elem, $options) {
            var $final_data = {};

            $.each($options, function (key, defaults) {
                var $data = elem.data(key);
                if ( $data === undefined ) {
                    $final_data[key] = defaults;
                } else {
                    $final_data[key] = $data;
                }
            });

            return $final_data;
        },
        ELM_ARGS_TYPE: function ($args) {
            $.each($args, function ($code, $value) {
                if ( $value == '1' ) {
                    $args[$code] = true;
                } else if ( $value == '0' ) {
                    $args[$code] = false;
                }

            });
            return $args;

        }
    };
    $.WPSF_DEPENDENCY = function (el, param) {
        var base = this;
        base.$el = $(el);
        base.el = el;

        base.init = function () {
            base.ruleset = $.deps.createRuleset();
            var cfg = {
                show: function (el) {
                    el.removeClass('hidden');
                },
                hide: function (el) {
                    el.addClass('hidden');
                },
                log: false,
                checkTargets: false
            };

            if ( param !== undefined ) {
                base.depSub();
            } else {
                base.depRoot();
            }

            $.deps.enable(base.$el, base.ruleset, cfg);
        };

        base.depRoot = function () {
            base.$el.each(function () {
                $(this).find('[data-controller]').each(function () {
                    var $this = $(this),
                        _controller = $this.data('controller').split('|'),
                        _condition = $this.data('condition').split('|'),
                        _value = $this.data('value').toString().split('|'),
                        _rules = base.ruleset;

                    $.each(_controller, function (index, element) {
                        var value = _value[index] || '',
                            condition = _condition[index] || _condition[0];
                        _rules = _rules.createRule($.WPSF_HELPER.DEP_ELEM(element, false), condition, value);
                        _rules.include($this);
                    });
                });
            });
        };

        base.depSub = function () {
            base.$el.each(function () {
                $(this).find('[data-sub-controller]').each(function () {
                    var $this = $(this),
                        _controller = $this.data('sub-controller').split('|'),
                        _condition = $this.data('sub-condition').split('|'),
                        _value = $this.data('sub-value').toString().split('|'),
                        _rules = base.ruleset;
                    $.each(_controller, function (index, element) {
                        var value = _value[index] || '',
                            condition = _condition[index] || _condition[0];
                        _rules = _rules.createRule($.WPSF_HELPER.DEP_ELEM(element, true), condition, value);
                        _rules.include($this);
                    });
                });
            });
        };
        base.init();
    };

    /**
     * Below Code Used To INIT Few WPSF Fields
     */
    $.fn.WPSF_CHOSEN = function () {
        return this.each(function () {
            $(this).chosen({
                allow_single_deselect: true,
                disable_search_threshold: 15,
                width: parseFloat($(this).actual('width') + 25) + 'px'
            });
        });
    };
    $.fn.WPSF_SELECT2 = function () {
        return this.each(function () {
            var $settings = {};
            if ( $(this).attr("data-has-settings") === 'yes' ) {
                var $parent = $(this).parent();
                var $request_param = JSON.parse($parent.find('.wpsf-element-settings').html());
                $settings = {
                    ajax: {
                        url: ajaxurl,
                        data: function ($term) {
                            $request_param['s'] = $term['term'];
                            return $request_param;
                        },
                        method: 'post',
                        processResults: function (data, params) {
                            var terms = [];
                            if ( data ) {
                                data = JSON.parse(data);
                                jQuery.each(data, function (id, text) {
                                    terms.push({id: id, text: text});
                                });
                            }
                            return {
                                results: terms
                            };
                        }
                    }
                }
            }
            $(this).select2($settings);
        });
    };
    $.fn.WPSF_IMAGE_SELECT = function () {
        return this.each(function () {
            $(this).find('label').on('click', function () {
                $(this).siblings().find('input').prop('checked', false);
            })
        });
    };
    $.fn.WPSF_SORTER = function () {
        return this.each(function () {
            var $this = $(this),
                $enabled = $this.find('.wpsf-enabled'),
                $disabled = $this.find('.wpsf-disabled');

            $enabled.sortable({
                connectWith: $disabled,
                placeholder: 'ui-sortable-placeholder',
                update: function (event, ui) {

                    var $el = ui.item.find('input');

                    if ( ui.item.parent().hasClass('wpsf-enabled') ) {
                        $el.attr('name', $el.attr('name').replace('disabled', 'enabled'));
                    } else {
                        $el.attr('name', $el.attr('name').replace('enabled', 'disabled'));
                    }

                }
            });

            // avoid conflict
            $disabled.sortable({
                connectWith: $enabled,
                placeholder: 'ui-sortable-placeholder'
            });

        });
    };
    $.fn.WPSF_UPLOADER = function () {
        return this.each(function () {
            var $this = $(this),
                $add = $this.find('.wpsf-add'),
                $input = $this.find('input'),
                wp_media_frame;

            $add.on('click', function (e) {
                e.preventDefault();

                // Check if the `wp.media.gallery` API exists.
                if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
                    return;
                }

                // If the media frame already exists, reopen it.
                if ( wp_media_frame ) {
                    wp_media_frame.open();
                    return;
                }

                // Create the media frame.
                wp_media_frame = wp.media({
                    // Set the title of the modal.
                    title: $add.data('frame-title'),
                    // Tell the modal to show only images.
                    library: {
                        type: $add.data('upload-type')
                    },
                    // Customize the submit button.
                    button: {
                        // Set the text of the button.
                        text: $add.data('insert-title'),
                    }

                });

                // When an image is selected, run a callback.
                wp_media_frame.on('select', function () {
                    // Grab the selected attachment.
                    var attachment = wp_media_frame.state().get('selection').first();
                    $input.val(attachment.attributes.url).trigger('change');
                });

                // Finally, open the modal.
                wp_media_frame.open();
            });
        });
    };
    $.fn.WPSF_IMAGE_UPLOADER = function () {
        return this.each(function () {
            var $this = $(this),
                $add = $this.find('.wpsf-add'),
                $preview = $this.find('.wpsf-image-preview'),
                $remove = $this.find('.wpsf-remove'),
                $input = $this.find('input'),
                $img = $this.find('img'),
                wp_media_frame;

            $add.on('click', function (e) {
                e.preventDefault();
                // Check if the `wp.media.gallery` API exists.
                if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
                    return;
                }

                // If the media frame already exists, reopen it.
                if ( wp_media_frame ) {
                    wp_media_frame.open();
                    return;
                }

                // Create the media frame.
                wp_media_frame = wp.media({
                    library: {
                        type: 'image'
                    }
                });

                // When an image is selected, run a callback.
                wp_media_frame.on('select', function () {
                    var attachment = wp_media_frame.state().get('selection').first().attributes;
                    var thumbnail = ( typeof attachment.sizes !== 'undefined' && typeof attachment.sizes.thumbnail !== 'undefined' ) ? attachment.sizes.thumbnail.url : attachment.url;
                    $preview.removeClass('hidden');
                    $img.attr('src', thumbnail);
                    $input.val(attachment.id).trigger('change');

                });

                // Finally, open the modal.
                wp_media_frame.open();
            });

            // Remove image
            $remove.on('click', function (e) {
                e.preventDefault();
                $input.val('').trigger('change');
                $preview.addClass('hidden');
            });
        });
    };
    $.fn.WPSF_IMAGE_GALLERY = function () {
        return this.each(function () {
            var $this = $(this),
                $edit = $this.find('.wpsf-edit'),
                $remove = $this.find('.wpsf-remove'),
                $list = $this.find('ul'),
                $input = $this.find('input'),
                $img = $this.find('img'),
                wp_media_frame;

            $this.on('click', '.wpsf-add, .wpsf-edit', function (e) {
                var $el = $(this),
                    ids = $input.val(),
                    what = ( $el.hasClass('wpsf-edit') ) ? 'edit' : 'add',
                    state = ( what === 'add' && !ids.length ) ? 'gallery' : 'gallery-edit';

                e.preventDefault();

                // Check if the `wp.media.gallery` API exists.
                if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
                    return;
                }

                // Open media with state
                if ( state === 'gallery' ) {
                    wp_media_frame = wp.media({
                        library: {
                            type: 'image'
                        },
                        frame: 'post',
                        state: 'gallery',
                        multiple: true
                    });
                    wp_media_frame.open();
                } else {
                    wp_media_frame = wp.media.gallery.edit('[gallery ids="' + ids + '"]');
                    if ( what === 'add' ) {
                        wp_media_frame.setState('gallery-library');
                    }
                }
                // Media Update
                wp_media_frame.on('update', function (selection) {
                    $list.empty();
                    var selectedIds = selection.models.map(function (attachment) {
                        var item = attachment.toJSON();
                        var thumb = ( typeof item.sizes.thumbnail !== 'undefined' ) ? item.sizes.thumbnail.url : item.url;
                        $list.append('<li><img src="' + thumb + '"></li>');
                        return item.id;
                    });
                    $input.val(selectedIds.join(',')).trigger('change');
                    $remove.removeClass('hidden');
                    $edit.removeClass('hidden');
                });
            });

            // Remove image
            $remove.on('click', function (e) {
                e.preventDefault();
                $list.empty();
                $input.val('').trigger('change');
                $remove.addClass('hidden');
                $edit.addClass('hidden');
            });
        });
    };
    $.fn.WPSF_TYPOGRAPHY = function () {
        return this.each(function () {
            var typography = $(this),
                family_select = typography.find('.wpsf-typo-family'),
                variants_select = typography.find('.wpsf-typo-variant'),
                typography_type = typography.find('.wpsf-typo-font');

            family_select.on('change', function () {
                var _this = $(this),
                    _type = _this.find(':selected').data('type') || 'custom',
                    _variants = _this.find(':selected').data('variants');
                console.log(_variants);
                if ( variants_select.length ) {
                    variants_select.find('option').remove();
                    $.each(_variants.split('|'), function (key, text) {
                        variants_select.append('<option value="' + text + '">' + text + '</option>');
                    });
                    variants_select.find('option[value="regular"]').prop('selected', 'selected').trigger('chosen:updated');
                }
                typography_type.val(_type);
            });
        });
    };
    $.fn.WPSF_GROUP = function () {
        return this.each(function () {
            var $this = $(this),
                $elem = $(this);

            if ( $this.find('> .wpsf-fieldset').length > 0 ) {
                $elem = $this.find('> .wpsf-fieldset');
            }

            var field_groups = $elem.find('> .wpsf-groups'),
                accordion_group = $elem.find(' > .wpsf-accordion'),
                clone_group = $elem.find('.wpsf-group:first').clone();

            var $heading = field_groups.find('> .wpsf-group > .wpsf-group-title');

            if ( accordion_group.length ) {
                accordion_group.each(function () {
                    $(this).accordion({
                        header: '> .wpsf-group > .wpsf-group-title',
                        collapsible: true,
                        active: false,
                        animate: 250,
                        heightStyle: 'content',
                        icons: {
                            'header': 'dashicons dashicons-arrow-right',
                            'activeHeader': 'dashicons dashicons-arrow-down'
                        },
                        beforeActivate: function (event, ui) {
                            $(ui.newPanel).WPSF_DEPENDENCY('sub');
                        }
                    });
                });
            }

            field_groups.sortable({
                axis: 'y',
                handle: $heading,
                helper: 'original',
                cursor: 'move',
                placeholder: 'widget-placeholder',
                start: function (event, ui) {
                    var inside = ui.item.children('.wpsf-group-content');
                    if ( inside.css('display') === 'block' ) {
                        inside.hide();
                        field_groups.sortable('refreshPositions');
                    }
                },
                stop: function (event, ui) {
                    ui.item.children('.wpsf-group-title').triggerHandler('focusout');
                    accordion_group.accordion({
                        active: false
                    });
                }
            });

            $elem.find('> .wpsf-add-group').on('click', function (e) {
                e.preventDefault();
                var $ex_c = $(this).attr('data-count');
                if ( $ex_c === undefined ) {
                    $ex_c = $(this).parent().find('> .wpsf-groups > .wpsf-group').length;
                    if ( !$ex_c ) {
                        $ex_c = -1;
                    }
                }

                $ex_c = parseInt($ex_c, 10) + 1;


                var $is_child = $(this).attr('data-child');
                var $db_id = $(this).attr('data-group-id');
                if ( $db_id === undefined ) {
                    $db_id = '';
                }
                $db_id = $db_id.replace('[_nonce]', '');

                clone_group.find('input, select, textarea').each(function () {
                    if ( $is_child === 'yes' ) {
                        var $sp = this.name.split('[_nonce]');
                        var $H = '';
                        $.each($sp, function ($ec, $c) {
                            if ( $ec !== 0 ) {
                                $c = $c.replace(/\[(\d+)\]/, function () {
                                    return '[' + $ex_c + ']';
                                });
                                $c = '[_nonce]' + $c;
                            }
                            $H += $c;
                        });

                        this.name = $H;

                    } else {
                        this.name = this.name.replace(/\[(\d+)\]/, function (string, id) {
                            return '[' + $ex_c + ']';
                        });
                    }

                });

                var cloned = clone_group.clone().removeClass('hidden');
                field_groups.append(cloned);

                if ( accordion_group.length ) {
                    field_groups.accordion('refresh');
                    field_groups.accordion({
                        active: cloned.index()
                    });
                }

                field_groups.find('input, select, textarea').each(function () {
                    this.name = this.name.replace('[_nonce]', '');
                });

                cloned.WPSF_DEPENDENCY('sub');
                cloned.WPSF_RELOAD();
                $(this).attr('data-count', $ex_c);
                $this.find('.wpsf-field-group').WPSF_GROUP();
                $this.find('.wpsf-field-group .wpsf-add-group').attr('data-child', 'yes');
            });

            field_groups.on('click', '.wpsf-remove-group', function (e) {
                e.preventDefault();
                $(this).closest('.wpsf-group').remove();
            });


        })
    };
    $.fn.WPSF_TABS = function () {
        return this.each(function () {
            $(this).find('.wpsf-user-tabs-nav > li > a.wpsf-tab-a').on('click', function (e) {
                e.preventDefault();

                var $li = $(this).parent(),
                    panel = $li.data('panel'),
                    $wrapper = $li.closest('.wpsf-user-tabs'),
                    $panel = $wrapper.find('.wpsf-user-tabs-panel-' + panel);

                $li.addClass('wpsf-user-tabs-active').siblings().removeClass('wpsf-user-tabs-active');
                $panel.siblings().hide();
                $panel.show();
            });
        });
    };
    $.fn.WPSF_ACCORDION = function () {
        return this.each(function () {
            $(this).find('.wpsf-accordion').accordion({
                header: '> .wpsf-group-title',
                collapsible: true,
                active: false,
                animate: 250,
                heightStyle: 'content',
                icons: {
                    'header': 'dashicons dashicons-arrow-right',
                    'activeHeader': 'dashicons dashicons-arrow-down'
                },
                beforeActivate: function (event, ui) {
                    $(ui.newPanel).WPSF_DEPENDENCY('sub');
                }
            });
        });
    };
    $.fn.WPSF_TAXONOMY = function () {
        return this.each(function () {
            var $this = $(this),
                $parent = $this.parent();
            // Only works in add-tag form
            if ( $parent.attr('id') === 'addtag' ) {
                var $submit = $parent.find('#submit'),
                    $name = $parent.find('#tag-name'),
                    $wrap = $parent.find('.wpsf-framework'),
                    $clone = $wrap.find('.wpsf-element').clone(),
                    $list = $('#the-list'),
                    flooding = false;

                $submit.on('click', function () {
                    if ( !flooding ) {
                        $list.on('DOMNodeInserted', function () {
                            if ( flooding ) {
                                $wrap.empty();
                                $wrap.html($clone);
                                $clone = $clone.clone();
                                $wrap.WPSF_RELOAD();
                                $wrap.WPSF_DEPENDENCY();
                                flooding = false;
                            }
                        });
                    }
                    flooding = true;
                });
            }
        });
    };
    $.fn.WPSF_WPLINKS = function () {
        return this.each(function () {
            $(this).on('click', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $parent = $this.parent(),
                    $textarea = $parent.find('#sample_wplinks'),
                    $link_submit = $("#wp-link-submit"),
                    $wpsf_link_submit = $('<input type="submit" name="wpsf-link-submit" id="wpsf_link-submit" class="button-primary" value="' + $link_submit.val() + '">');
                $link_submit.hide();
                $wpsf_link_submit.insertBefore($link_submit);
                var $dialog = !window.wpLink && $.fn.wpdialog && $("#wp-link").length ? {
                    $link: !1,
                    open: function () {
                        this.$link = $('#wp-link').wpdialog({
                            title: wpLinkL10n.title,
                            width: 480,
                            height: "auto",
                            modal: !0,
                            dialogClass: "wp-dialog",
                            zIndex: 3e5
                        })
                    },
                    close: function () {
                        this.$link.wpdialog('close');
                    }
                } : window.wpLink;

                $dialog.open($textarea.attr('id'));
                $wpsf_link_submit.unbind('click.wpsf-wpLink').bind('click.wpsf-wpLink', function (e) {
                    e.preventDefault(), e.stopImmediatePropagation();

                    var $url = $("#wp-link-url").length ? $("#wp-link-url").val() : $("#url-field").val(),
                        $title = $("#wp-link-text").length ? $("#wp-link-text").val() : $("#link-title-field").val(),
                        $checkbox = $($("#wp-link-target").length ? "#wp-link-target" : "#link-target-checkbox"),
                        $target = $checkbox[0].checked ? " _blank" : "";

                    $parent.find('span.link-title-value').html($title);
                    $parent.find('span.url-value').html($url);
                    $parent.find('span.target-value').html($target);

                    $parent.find('input.wpsf-url').val($url);
                    $parent.find('input.wpsf-title').val($title);
                    $parent.find('input.wpsf-target').val($target);

                    $dialog.close(),
                        $link_submit.show(),
                        $wpsf_link_submit.unbind("click.wpsf-wpLink"),
                        $wpsf_link_submit.remove(),
                        $("#wp-link-cancel").unbind("click.wpsf-wpLink"),
                        window.wpLink.textarea = "";
                });

                $("#wp-link-cancel").unbind("click.wpsf-wpLink").bind("click.wpsf-wpLink", function (e) {
                    e.preventDefault(),
                        $dialog.close(),
                        $wpsf_link_submit.unbind("click.wpsf-wpLink"),
                        $wpsf_link_submit.remove(),
                        $("#wp-link-cancel").unbind("click.wpsf-wpLink"),
                        window.wpLink.textarea = ""
                });
            })
        })
    };
    $.fn.WPSF_COLOR_PICKER = function () {
        return this.each(function () {
            var $this = $(this),
                $wpsf_body = $('body');

            if ( $this.data('rgba') !== false ) {
                var picker = $.WPSF_HELPER.COLOR_PICKER.parse($this.val());

                $this.wpColorPicker({
                    clear: function () {
                        $this.trigger('keyup');
                    },

                    change: function (event, ui) {
                        var ui_color_value = ui.color.toString();
                        // update checkerboard background color
                        $this.closest('.wp-picker-container').find('.wpsf-alpha-slider-offset').css('background-color', ui_color_value);
                        $this.val(ui_color_value).trigger('change');
                    },

                    create: function () {
                        // set variables for alpha slider
                        var a8cIris = $this.data('a8cIris'),
                            $container = $this.closest('.wp-picker-container'),
                            // appending alpha wrapper
                            $alpha_wrap = $('<div class="wpsf-alpha-wrap">' +
                                '<div class="wpsf-alpha-slider"></div>' +
                                '<div class="wpsf-alpha-slider-offset"></div>' +
                                '<div class="wpsf-alpha-text"></div>' +
                                '</div>').appendTo($container.find('.wp-picker-holder')),
                            $alpha_slider = $alpha_wrap.find('.wpsf-alpha-slider'),
                            $alpha_text = $alpha_wrap.find('.wpsf-alpha-text'),
                            $alpha_offset = $alpha_wrap.find('.wpsf-alpha-slider-offset');

                        // alpha slider
                        $alpha_slider.slider({
                            // slider: slide
                            slide: function (event, ui) {
                                var slide_value = parseFloat(ui.value / 100);
                                // update iris data alpha && wpColorPicker color option && alpha text
                                a8cIris._color._alpha = slide_value;
                                $this.wpColorPicker('color', a8cIris._color.toString());
                                $alpha_text.text(( slide_value < 1 ? slide_value : '' ));
                            },

                            // slider: create
                            create: function () {
                                var slide_value = parseFloat(picker.alpha / 100),
                                    alpha_text_value = slide_value < 1 ? slide_value : '';
                                // update alpha text && checkerboard background color
                                $alpha_text.text(alpha_text_value);
                                $alpha_offset.css('background-color', picker.value);
                                // wpColorPicker clear for update iris data alpha && alpha text && slider color option
                                $container.on('click', '.wp-picker-clear', function () {
                                    a8cIris._color._alpha = 1;
                                    $alpha_text.text('').trigger('change');
                                    $alpha_slider.slider('option', 'value', 100).trigger('slide');
                                });
                                // wpColorPicker default button for update iris data alpha && alpha text && slider color option
                                $container.on('click', '.wp-picker-default', function () {
                                    var default_picker = $.WPSF_HELPER.COLOR_PICKER.parse($this.data('default-color')),
                                        default_value = parseFloat(default_picker.alpha / 100),
                                        default_text = default_value < 1 ? default_value : '';
                                    a8cIris._color._alpha = default_value;
                                    $alpha_text.text(default_text);
                                    $alpha_slider.slider('option', 'value', default_picker.alpha).trigger('slide');
                                });

                                // show alpha wrapper on click color picker button
                                $container.on('click', '.wp-color-result', function () {
                                    $alpha_wrap.toggle();
                                });

                                // hide alpha wrapper on click body
                                $wpsf_body.on('click.wpcolorpicker', function () {
                                    $alpha_wrap.hide();
                                });

                            },
                            // slider: options
                            value: picker.alpha,
                            step: 1,
                            min: 1,
                            max: 100
                        });
                    }
                })

            } else {
                $this.wpColorPicker({
                    clear: function () {
                        $this.trigger('keyup');
                    },
                    change: function (even, ui) {
                        $this.val(ui.color.toString()).trigger('change');
                    }
                })
            }
        })
    };
    $.fn.WPSF_CSS_BUILDER = function () {
        return this.each(function () {
            var $this = $(this);

            $this.find('.wpsf-css-checkall').on('click', function () {
                $(this).toggleClass('checked');
            });

            $this.find('.wpsf-element.wpsf-margin :input').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.all($(this), 'margin', $this);
            });

            $this.find('.wpsf-element.wpsf-padding :input').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.all($(this), 'padding', $this);
            });

            $this.find('.wpsf-element.wpsf-border :input').on('change, blur', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.all($(this), 'border', $this);
            });

            $this.find('.wpsf-element.wpsf-border-radius :input').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.all($(this), 'border-radius', $this);
            });

            $this.find('.wpsf-element-border-style select').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.border($this);
            });

            $this.find('.wpsf-element-border-color input.wpsf-field-color-picker').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.border($this);
            });

            $this.find('.wpsf-element-text-color input.wpsf-field-color-picker').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.border($this);
            });

            $this.find('.wpsf-element-background-color input.wpsf-field-color-picker').on('change', function () {
                $.WPSF_HELPER.CSS_BUILDER.update.border($this);
            });

        })
    };
    $.fn.WPSF_LIMITER = function () {
        return this.each(function () {
            var $this = $(this),
                $parent = $this.parent(),
                $limiter = $parent.find('> .text-limiter'),
                $counter = $limiter.find('span.counter'),
                $limit = parseInt($limiter.find('span.maximum').html()),
                $countByWord = 'word' == $limiter.data('limit-type');

            var $val = $.WPSF_HELPER.LIMITER.counter($this.val(), $countByWord);
            $counter.html($val);

            $this.on('input', function () {
                var text = $this.val(),
                    length = $.WPSF_HELPER.LIMITER.counter(text, $countByWord);

                if ( length > $limit ) {
                    text = $.WPSF_HELPER.LIMITER.subStr(text, 0, $limit, $countByWord);
                    $this.val(text);
                    $counter.html($limit);
                } else {
                    $counter.html(length);
                }
            });
        })
    };
    $.fn.WPSF_ADVANCED_TYPOGRAPHY = function () {
        return this.each(function () {
            var $main = $(this);
            $main.find('.wpsf-font-preview').attr('contenteditable', true);
            $.WPSF_HELPER.ADVANCED_TYPO.update($main);

            $main.find(':input').on('change', function () {
                $.WPSF_HELPER.ADVANCED_TYPO.update($main);
            });
        })
    };
    $.fn.WPSF_TOOLTIP = function () {
        return this.each(function () {
            $(this).tooltip({
                html: true,
                container: 'body'
            });
        });
    };
    $.fn.WPSF_ANIMATE_CSS = function () {
        return this.each(function () {
            var $parent = $(this);
            $parent.find("select").on('change', function () {
                var $val = $(this).val();
                var $h3 = $parent.find('.animation-preview h3');
                $h3.removeClass();
                $h3.addClass($val + ' animated ').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass();
                });
            })
        })
    };
    $.fn.WPSF_DATE_PICKER = function () {
        return this.each(function () {
            var $input = $(this).find('input.wpsf-datepicker');
            var $INPUTID = $input.data('datepicker-id');
            var $settings = {};
            if ( typeof window[$INPUTID] == 'object' ) {
                $settings = window[$INPUTID];
            }
            $settings = $.WPSF_HELPER.ELM_ARGS_TYPE($settings);
            $input.flatpickr($settings);
        });
    };
    /*$.fn.WPSF_DATE_PICKER = function () {
        return this.each(function () {

            var $defaults = {
                'show-other-month': true,
                'select-other-month': true,
                'button-panel': true,
                'change-month': true,
                'date-format': "dd-mm-yy",
                'change-year': true,
                'months-count': 2,
                'min-date': null,
                'max-date': null,
            };

            var $options = $.WPSF_HELPER.ELM_ARGS($(this).find('input'), $defaults);

            $(this).find('input').datepicker({
                showOtherMonths: $options['show-other-month'],
                selectOtherMonths: $options['select-other-month'],
                showButtonPanel: $options['button-panel'],
                changeMonth: $options['change-month'],
                changeYear: $options['change-year'],
                numberOfMonths: $options['months-count'],
                dateFormat: $options['date-format'],
                minDate: $options['min-date'],
                maxDate: $options['max-date']
            });
        })
    }*/

    /**
     * Below Code Used To INIT BASE WPSF Features
     */
    $.fn.WPSF_TAB_NAVIGATION = function () {
        return this.each(function () {
            var wpsf_theme = $(this).attr("data-theme"),
                is_single_page = $(this).attr("data-single-page");

            if ( wpsf_theme == 'modern' ) {
                $.WPSF_HELPER.NAV_BAR.modern($(this), is_single_page);
            } else {
                $.WPSF_HELPER.NAV_BAR.simple($(this), is_single_page);
            }
        })
    };
    $.fn.WPSF_DEPENDENCY = function (param) {
        return this.each(function () {
            new $.WPSF_DEPENDENCY(this, param);
        })
    };
    $.fn.WPSF_STICKY_HEADER = function () {
        return this.each(function () {
            var header = $(this),
                headerOffset = header.offset().top;

            if ( $(this).hasClass('wpsf-sticky-header') ) {
                $(window).on('scroll.wpsfStickyHeader', function () {
                    if ( $(this).scrollTop() > 1 ) {
                        header.addClass("sticky").css('width', $('.wpsf-body').width());
                    } else {
                        header.removeClass("sticky").css('width', 'auto');
                    }
                });
            }
        })
    };
    $.fn.WPSF_RESET_CONFIRM = function () {
        return this.each(function () {
            $(this).on('click', function (e) {
                if ( !confirm('Are you sure?') ) {
                    e.preventDefault();
                }
            });
        });
    };
    $.fn.WPSF_SAVE = function () {
        return this.each(function () {
            var $this = $(this),
                $text = $this.data('save'),
                $value = $this.val(),
                $ajax = $('#wpsf-save-ajax');

            $(document).on('keydown', function (event) {
                if ( event.ctrlKey || event.metaKey ) {
                    if ( String.fromCharCode(event.which).toLowerCase() === 's' ) {
                        event.preventDefault();
                        $this.trigger('click');
                    }
                }
            });

            $this.on('click', function (e) {
                if ( $ajax.length ) {
                    if ( typeof tinyMCE === 'object' ) {
                        tinyMCE.triggerSave();
                    }

                    $this.prop('disabled', true).attr('value', $text);
                    var serializedOptions = $('.wpsf-form').serialize();
                    $.post('options.php', serializedOptions).error(function () {
                        alert('Error, Please try again.');
                    }).success(function () {
                        $this.prop('disabled', false).attr('value', $value);
                        $ajax.hide().fadeIn().delay(250).fadeOut();
                    });
                    e.preventDefault();
                } else {
                    $this.addClass('disabled').attr('value', $text);
                }
            });
        })
    };
    $.fn.WPSF_RELOAD = function () {
        return this.each(function () {
            $.WPSF.reload_fields($(this));
        });
    }

    $.WPSF = {
        body: $('body'),

        icons_manager: function () {
            var base = this,
                onload = true,
                $wpsf_body = $('body'),
                $parent;

            base.init = function () {

                $wpsf_body.on('click', '.wpsf-icon-add', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        $dialog = $('#wpsf-icon-dialog'),
                        $load = $dialog.find('.wpsf-dialog-load'),
                        $select = $dialog.find('.wpsf-dialog-select'),
                        $insert = $dialog.find('.wpsf-dialog-insert'),
                        $search = $dialog.find('.wpsf-icon-search');

                    $parent = $this.closest('.wpsf-icon-select');

                    $dialog.dialog({
                        width: 850,
                        height: 700,
                        modal: true,
                        resizable: false,
                        closeOnEscape: true,
                        position: {
                            my: 'center',
                            at: 'center',
                            of: window
                        },
                        open: function () {
                            $wpsf_body.addClass('wpsf-icon-scrolling');
                            $('.ui-dialog-titlebar-close').addClass('ui-button');

                            $(window).on('resize', function () {
                                var height = $(window).height(),
                                    load_height = Math.floor(height - 237),
                                    set_height = Math.floor(height - 125);
                                $dialog.dialog('option', 'height', set_height).parent().css('max-height', set_height);
                                $dialog.css('overflow', 'auto');
                                $load.css('height', load_height);
                            }).resize();

                        },
                        close: function () {
                            $wpsf_body.removeClass('wpsf-icon-scrolling');
                        }
                    });

                    if ( onload ) {
                        $.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'wpsf-ajax',
                                "wpsf-action": "wpsf-get-icons",
                            },
                            success: function (content) {
                                $load.html(content);
                                onload = false;
                                $load.on('click', 'a', function (e) {
                                    e.preventDefault();
                                    var icon = $(this).data('wpsf-icon');
                                    $parent.find('i').removeAttr('class').addClass(icon);
                                    $parent.find('input').val(icon).trigger('change');
                                    $parent.find('.wpsf-icon-preview').removeClass('hidden');
                                    $parent.find('.wpsf-icon-remove').removeClass('hidden');
                                    $dialog.dialog('close');

                                });

                                $search.keyup(function () {
                                    var value = $(this).val(),
                                        $icons = $load.find('a');
                                    $icons.each(function () {
                                        var $ico = $(this);
                                        if ( $ico.data('wpsf-icon').search(new RegExp(value, 'i')) < 0 ) {
                                            $ico.hide();
                                        } else {
                                            $ico.show();
                                        }
                                    });
                                });

                                $load.find('.wpsf-icon-tooltip').tooltip({
                                    html: true,
                                    placement: 'top',
                                    container: 'body'
                                });
                            }
                        });
                    }
                });

                $wpsf_body.on('click', '.wpsf-icon-remove', function (e) {
                    e.preventDefault();
                    var $this = $(this),
                        $parent = $this.closest('.wpsf-icon-select');
                    $parent.find('.wpsf-icon-preview').addClass('hidden');
                    $parent.find('input').val('').trigger('change');
                    $this.addClass('hidden');
                });
            };

            base.init();
        },

        shortcode_manager: function () {
            var base = this,
                $wpsf_body = $('body'),
                deploy_atts;

            base.init = function () {
                var $dialog = $('#wpsf-shortcode-dialog'),
                    $insert = $dialog.find('.wpsf-dialog-insert'),
                    $shortcodeload = $dialog.find('.wpsf-dialog-load'),
                    $selector = $dialog.find('.wpsf-dialog-select'),
                    shortcode_target = false,
                    shortcode_name,
                    shortcode_view,
                    shortcode_clone,
                    $shortcode_button,
                    editor_id;

                $wpsf_body.on('click', '.wpsf-shortcode', function (e) {
                    e.preventDefault();
                    $selector.WPSF_CHOSEN();
                    $shortcode_button = $(this);
                    shortcode_target = $shortcode_button.hasClass('wpsf-shortcode-textarea');
                    editor_id = $shortcode_button.data('editor-id');

                    $dialog.dialog({
                        width: 850,
                        height: 700,
                        modal: true,
                        resizable: false,
                        closeOnEscape: true,
                        position: {
                            my: 'center',
                            at: 'center',
                            of: window
                        },
                        open: function () {
                            $wpsf_body.addClass('wpsf-shortcode-scrolling');
                            $('.ui-dialog-titlebar-close').addClass('ui-button');

                            // set viewpoint
                            $(window).on('resize', function () {
                                var height = $(window).height(),
                                    load_height = Math.floor(height - 281),
                                    set_height = Math.floor(height - 125);

                                $dialog.dialog('option', 'height', set_height).parent().css('max-height', set_height);
                                $dialog.css('overflow', 'auto');
                                $shortcodeload.css('height', load_height);

                            }).resize();

                            if ( $selector.find('option').length <= 2 ) {
                                $selector.find('option').not(':empty()').first().attr('selected', true);
                                $selector.trigger("change");
                            }
                        },
                        close: function () {
                            shortcode_target = false;
                            $wpsf_body.removeClass('wpsf-shortcode-scrolling');
                        }
                    });

                });

                $selector.on('change', function () {
                    var $elem_this = $(this);
                    shortcode_name = $elem_this.val();
                    shortcode_view = $elem_this.find(':selected').data('view');
                    if ( shortcode_name.length ) {
                        $.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'wpsf-get-shortcode',
                                shortcode: shortcode_name
                            },
                            success: function (content) {
                                $shortcodeload.html(content);
                                $insert.parent().removeClass('hidden');
                                shortcode_clone = $('.wpsf-shortcode-clone', $dialog).clone();
                                $shortcodeload.WPSF_DEPENDENCY();
                                $shortcodeload.WPSF_DEPENDENCY('sub');
                                $shortcodeload.WPSF_RELOAD();
                            }
                        });

                    } else {
                        $insert.parent().addClass('hidden');
                        $shortcodeload.html('');
                    }

                });

                $insert.on('click', function (e) {
                    e.preventDefault();
                    var send_to_shortcode = '',
                        ruleAttr = 'data-atts',
                        cloneAttr = 'data-clone-atts',
                        cloneID = 'data-clone-id';

                    switch ( shortcode_view ) {
                        case 'contents':
                            $('[' + ruleAttr + ']', '.wpsf-dialog-load').each(function () {
                                var _this = $(this),
                                    _atts = _this.data('atts');
                                send_to_shortcode += '[' + _atts + ']';
                                send_to_shortcode += _this.val();
                                send_to_shortcode += '[/' + _atts + ']';
                            });

                            break;

                        case 'clone':
                            send_to_shortcode += '[' + shortcode_name; // begin: main-shortcode
                            // main-shortcode attributes
                            $('[' + ruleAttr + ']', '.wpsf-dialog-load .wpsf-element:not(.hidden)').each(function () {
                                var _this_main = $(this),
                                    _this_main_atts = _this_main.data('atts');
                                send_to_shortcode += base.validate_atts(_this_main_atts, _this_main); // validate empty atts
                            });
                            send_to_shortcode += ']'; // end: main-shortcode attributes
                            // multiple-shortcode each
                            $('[' + cloneID + ']', '.wpsf-dialog-load').each(function () {
                                var _this_clone = $(this),
                                    _clone_id = _this_clone.data('clone-id');

                                send_to_shortcode += '[' + _clone_id; // begin: multiple-shortcode
                                // multiple-shortcode attributes
                                $('[' + cloneAttr + ']', _this_clone.find('.wpsf-element').not('.hidden')).each(function () {

                                    var _this_multiple = $(this),
                                        _atts_multiple = _this_multiple.data('clone-atts');

                                    // is not attr content, add shortcode attribute else write content and close shortcode tag
                                    if ( _atts_multiple !== 'content' ) {
                                        send_to_shortcode += base.validate_atts(_atts_multiple, _this_multiple); // validate empty atts
                                    } else if ( _atts_multiple === 'content' ) {
                                        send_to_shortcode += ']';
                                        send_to_shortcode += _this_multiple.val();
                                        send_to_shortcode += '[/' + _clone_id + '';
                                    }
                                });

                                send_to_shortcode += ']'; // end: multiple-shortcode

                            });

                            send_to_shortcode += '[/' + shortcode_name + ']'; // end: main-shortcode

                            break;

                        case 'clone_duplicate':

                            // multiple-shortcode each
                            $('[' + cloneID + ']', '.wpsf-dialog-load').each(function () {

                                var _this_clone = $(this),
                                    _clone_id = _this_clone.data('clone-id');

                                send_to_shortcode += '[' + _clone_id; // begin: multiple-shortcode

                                // multiple-shortcode attributes
                                $('[' + cloneAttr + ']', _this_clone.find('.wpsf-element').not('.hidden')).each(function () {

                                    var _this_multiple = $(this),
                                        _atts_multiple = _this_multiple.data('clone-atts');


                                    // is not attr content, add shortcode attribute else write content and close shortcode tag
                                    if ( _atts_multiple !== 'content' ) {
                                        send_to_shortcode += base.validate_atts(_atts_multiple, _this_multiple); // validate empty atts
                                    } else if ( _atts_multiple === 'content' ) {
                                        send_to_shortcode += ']';
                                        send_to_shortcode += _this_multiple.val();
                                        send_to_shortcode += '[/' + _clone_id + '';
                                    }
                                });

                                send_to_shortcode += ']'; // end: multiple-shortcode

                            });

                            break;

                        default:

                            send_to_shortcode += '[' + shortcode_name;

                            $('[' + ruleAttr + ']', '.wpsf-dialog-load .wpsf-element:not(.hidden)').each(function () {

                                var _this = $(this),
                                    _atts = _this.data('atts');

                                // is not attr content, add shortcode attribute else write content and close shortcode tag
                                if ( _atts !== 'content' ) {
                                    send_to_shortcode += base.validate_atts(_atts, _this); // validate empty atts
                                } else if ( _atts === 'content' ) {
                                    send_to_shortcode += ']';
                                    send_to_shortcode += _this.val();
                                    send_to_shortcode += '[/' + shortcode_name + '';
                                }

                            });

                            send_to_shortcode += ']';

                            break;

                    }

                    if ( shortcode_target ) {
                        var $textarea = $shortcode_button.next();
                        $textarea.val(base.insertAtChars($textarea, send_to_shortcode)).trigger('change');
                    } else {
                        base.send_to_editor(send_to_shortcode, editor_id);
                    }

                    deploy_atts = null;

                    $dialog.dialog('close');

                });

                // cloner button
                var cloned = 0;
                $dialog.on('click', '#shortcode-clone-button', function (e) {

                    e.preventDefault();

                    // clone from cache
                    var cloned_el = shortcode_clone.clone().hide();

                    cloned_el.find('input:radio').attr('name', '_nonce_' + cloned);

                    $('.wpsf-shortcode-clone:last').after(cloned_el);

                    // add - remove effects
                    cloned_el.slideDown(100);

                    cloned_el.find('.wpsf-remove-clone').show().on('click', function (e) {

                        cloned_el.slideUp(100, function () {
                            cloned_el.remove();
                        });
                        e.preventDefault();

                    });

                    // reloadPlugins
                    cloned_el.WPSF_DEPENDENCY('sub');
                    cloned_el.WPSF_RELOAD();
                    cloned++;

                });

            };

            base.validate_atts = function (_atts, _this) {

                var el_value;

                if ( _this.data('check') !== undefined && deploy_atts === _atts ) {
                    return '';
                }

                deploy_atts = _atts;

                if ( _this.closest('.pseudo-field').hasClass('hidden') === true ) {
                    return '';
                }
                if ( _this.hasClass('pseudo') === true ) {
                    return '';
                }

                if ( _this.is(':checkbox') || _this.is(':radio') ) {
                    el_value = _this.is(':checked') ? _this.val() : '';
                } else {
                    el_value = _this.val();
                }

                if ( _this.data('check') !== undefined ) {
                    el_value = _this.closest('.wpsf-element').find('input:checked').map(function () {
                        return $(this).val();
                    }).get();
                }

                if ( el_value !== null && el_value !== undefined && el_value !== '' && el_value.length !== 0 ) {
                    return ' ' + _atts + '="' + el_value + '"';
                }

                return '';

            };

            base.insertAtChars = function (_this, currentValue) {

                var obj = ( typeof _this[0].name !== 'undefined' ) ? _this[0] : _this;

                if ( obj.value.length && typeof obj.selectionStart !== 'undefined' ) {
                    obj.focus();
                    return obj.value.substring(0, obj.selectionStart) + currentValue + obj.value.substring(obj.selectionEnd, obj.value.length);
                } else {
                    obj.focus();
                    return currentValue;
                }

            };

            base.send_to_editor = function (html, editor_id) {

                var tinymce_editor;

                if ( typeof tinymce !== 'undefined' ) {
                    tinymce_editor = tinymce.get(editor_id);
                }

                if ( tinymce_editor && !tinymce_editor.isHidden() ) {
                    tinymce_editor.execCommand('mceInsertContent', false, html);
                } else {
                    var $editor = $('#' + editor_id);
                    $editor.val(base.insertAtChars($editor, html)).trigger('change');
                }

            };

            base.init();
        },

        reload_fields: function ($this) {
            $('.chosen', $this).WPSF_CHOSEN();
            $('.select2', $this).WPSF_SELECT2();
            $('.wpsf-field-image-select', $this).WPSF_IMAGE_SELECT();
            $('.wpsf-field-sorter', $this).WPSF_SORTER();
            $('.wpsf-field-upload', $this).WPSF_UPLOADER();
            $('.wpsf-field-image', $this).WPSF_IMAGE_UPLOADER();
            $('.wpsf-field-gallery', $this).WPSF_IMAGE_GALLERY();
            $('.wpsf-field-tab', $this).WPSF_TABS();
            $('.wpsf-field-accordion', $this).WPSF_ACCORDION();
            $('.wpsf-wp-link', $this).WPSF_WPLINKS();
            $('.wpsf-field-color-picker', $this).WPSF_COLOR_PICKER();
            $('.wpsf-field-css_builder', $this).WPSF_CSS_BUILDER();
            $('input[data-limit-element="1"],textarea[data-limit-element="1"]', $this).WPSF_LIMITER();
            $('.wpsf-field-typography_advanced', $this).WPSF_ADVANCED_TYPOGRAPHY();
            $('.wpsf-field-typography', $this).WPSF_TYPOGRAPHY();
            $('.wpsf-help', $this).WPSF_TOOLTIP();
            $('.wpsf-field-animate_css', $this).WPSF_ANIMATE_CSS();
            $('.wpsf-field-date_picker', $this).WPSF_DATE_PICKER();
        },

        widget_reload: function () {
            $(document).on('widget-added widget-updated', function (event, $widget) {
                $widget.WPSF_RELOAD();
                $widget.WPSF_DEPENDENCY();
            });
        },

        fixes: {
            popup: function () {
                if ( typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.dialog !== 'undefined' ) {
                    $.widget('ui.dialog', $.ui.dialog, {
                        _createOverlay: function () {
                            this._super();
                            if ( !this.options.modal ) {
                                return;
                            }
                            this._on(this.overlay, {
                                click: 'close'
                            });
                        }
                    });
                }
            },
            colorpicker: function () {
                if ( typeof Color === 'function' ) {
                    // adding alpha support for Automattic Color.js toString function.
                    Color.fn.toString = function () {
                        if ( this._alpha < 1 ) {
                            return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
                        }

                        var hex = parseInt(this._color, 10).toString(16);

                        if ( this.error ) {
                            return '';
                        }

                        // maybe left pad it
                        if ( hex.length < 6 ) {
                            for ( var i = 6 - hex.length - 1; i >= 0; i-- ) {
                                hex = '0' + hex;
                            }
                        }
                        return '#' + hex;
                    };
                }
            }
        },
    };
    $.WPSF.fixes.popup();
    $.WPSF.fixes.colorpicker();

    $(window).on('load', function () {
        if ( $('.wpsf-wc-metabox-fields').length > 0 ) {
            $('.wpsf-wc-metabox-fields').WPSF_RELOAD();
            $('#woocommerce-product-data').on('woocommerce_variations_loaded', function () {
                $('.wpsf-wc-metabox-fields').WPSF_RELOAD();
            });
        }
    });
    $(document).ready(function () {
        $.WPSF.icons_manager();
        $.WPSF.shortcode_manager();
        $.WPSF.widget_reload();

        $('.wpsf-framework').WPSF_TAB_NAVIGATION();
        $('.wpsf-content, .wp-customizer, .widget-content, .wpsf-taxonomy , .wpsf-wc-metabox-fields').WPSF_DEPENDENCY();
        $('.wpsf-framework, #widgets-right').WPSF_RELOAD()
        $('.wpsf-taxonomy').WPSF_TAXONOMY();
        $('.wpsf-field-group').WPSF_GROUP();
        $('.wpsf-header').WPSF_STICKY_HEADER();
        $('.wpsf-reset-confirm, .wpsf-import-backup').WPSF_RESET_CONFIRM();
        $('.wpsf-save').WPSF_SAVE();
    });
} )(jQuery, window, document);