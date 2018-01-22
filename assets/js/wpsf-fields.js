/*-------------------------------------------------------------------------------------------------
 This file is part of the WPSF package.                                                           -
 This package is Open Source Software. For the full copyright and license                         -
 information, please view the LICENSE file which was distributed with this                        -
 source code.                                                                                     -
                                                                                                  -
 @package    WPSF                                                                                 -
 @author     Varun Sridharan <varunsridharan23@gmail.com>                                         -
 -------------------------------------------------------------------------------------------------*/

function wpsf_str_replace(search, replace, subject, countObj) {
    var i = 0
    var j = 0
    var temp = ''
    var repl = ''
    var sl = 0
    var fl = 0
    var f = [].concat(search)
    var r = [].concat(replace)
    var s = subject
    var ra = Object.prototype.toString.call(r) === '[object Array]'
    var sa = Object.prototype.toString.call(s) === '[object Array]'
    s = [].concat(s)
    var $global = ( typeof window !== 'undefined' ? window : global )
    $global.$locutus = $global.$locutus || {}
    var $locutus = $global.$locutus
    $locutus.php = $locutus.php || {}
    if ( typeof ( search ) === 'object' && typeof ( replace ) === 'string' ) {
        temp = replace
        replace = []
        for ( i = 0; i < search.length; i += 1 ) {
            replace[i] = temp
        }
        temp = ''
        r = [].concat(replace)
        ra = Object.prototype.toString.call(r) === '[object Array]'
    }
    if ( typeof countObj !== 'undefined' ) {
        countObj.value = 0
    }
    for ( i = 0, sl = s.length; i < sl; i++ ) {
        if ( s[i] === '' ) {
            continue
        }
        for ( j = 0, fl = f.length; j < fl; j++ ) {
            temp = s[i] + ''
            repl = ra ? ( r[j] !== undefined ? r[j] : '' ) : r[0]
            s[i] = ( temp ).split(f[j]).join(repl)
            if ( typeof countObj !== 'undefined' ) {
                countObj.value += ( ( temp.split(f[j]) ).length - 1 )
            }
        }
    }
    return sa ? s : s[0]
}

'use strict';

$.WPSFRAMEWORK_FIELDS = $.WPSFRAMEWORK_FIELDS || {};

var $wpsf_body = $('body');

$.WPSFRAMEWORK_FIELDS.get_element_args = function (elem, $options) {
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
}

$.fn.WPSFRAMEWORK_FIELDS_SELECT2 = function () {
    return this.each(function () {
        $(this).select2();
    })
}

$.fn.WPSFRAMEWORK_FIELDS_CHOSEN = function () {
    return this.each(function () {
        $(this).chosen({
            allow_single_deselect: true,
            disable_search_threshold: 15,
            width: parseFloat($(this).actual('width') + 25) + 'px'
        });
    });
};

$.fn.WPSFRAMEWORK_FIELDS_IMAGE_SELECTOR = function () {
    return this.each(function () {

        $(this).find('label').on('click', function () {
            $(this).siblings().find('input').prop('checked', false);
        });

    });
};

$.fn.WPSFRAMEWORK_FIELDS_SORTER = function () {
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

$.fn.WPSFRAMEWORK_FIELDS_UPLOADER = function () {
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

$.fn.WPSFRAMEWORK_FIELDS_IMAGE_UPLOADER = function () {
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

$.fn.WPSFRAMEWORK_FIELDS_IMAGE_GALLERY = function () {
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

$.fn.WPSFRAMEWORK_FIELDS_TYPOGRAPHY = function () {
    return this.each(function () {

        var typography = $(this),
            family_select = typography.find('.wpsf-typo-family'),
            variants_select = typography.find('.wpsf-typo-variant'),
            typography_type = typography.find('.wpsf-typo-font');

        family_select.on('change', function () {

            var _this = $(this),
                _type = _this.find(':selected').data('type') || 'custom',
                _variants = _this.find(':selected').data('variants');

            if ( variants_select.length ) {

                variants_select.find('option').remove();

                $.each(_variants.split('|'), function (key, text) {
                    variants_select.append('<option value="' + text + '">' + text + '</option>');
                });

                variants_select.find('option[value="regular"]').attr('selected', 'selected').trigger('chosen:updated');

            }

            typography_type.val(_type);

        });

    });
};

$.fn.WPSFRAMEWORK_FIELDS_ADVANCED_TYPOGRAPHY = function () {
    this.each(function () {
        var $main = $(this);
        $.WPSFRAMEWORK_FIELDS.ADVANCED_TYPO($main);
        $main.find(':input').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.ADVANCED_TYPO($main);
        })
    });
}

$.fn.WPSFRAMEWORK_FIELDS_GROUP = function () {
    return this.each(function () {
        var _this = $(this),
            field_groups = _this.find('> .wpsf-fieldset > .wpsf-groups'),
            accordion_group = _this.find('> .wpsf-fieldset > .wpsf-accordion'),
            clone_group = _this.find('> .wpsf-fieldset .wpsf-group:first').clone();


        var $heading = field_groups.find(' > .wpsf-group > .wpsf-group-title');
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
                        $(ui.newPanel).WPSFRAMEWORK_DEPENDENCY('sub');
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


        _this.find('> .wpsf-fieldset > .wpsf-add-group').on('click', function (e) {
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
                $db_id = $db_id.replace('[_nonce]','');
                //$db_id = wpsf_str_replace('[_nonce]', '', $db_id);
                $db_id = '';
            }
            $db_id = $db_id.replace('[_nonce]', '');

            /*clone_group.find('input, select, textarea').each(function () {

                var split = this.name.split(/\[(\d+)\]/g);
                var final_change = split.length - 2;
                var final_name = '';

                $.each(split, function (i, value) {
                    if ( $.isNumeric(value) ) {
                        if ( i === final_change ) {
                            value = ( parseInt(value, 10) + 1 );
                        }
                        value = '[' + value + ']';
                    }
                    final_name += value;
                });
                this.name = final_name;

            });*/


            clone_group.find('input, select, textarea').each(function () {
                if ( $is_child === 'yes' ) {
                    var $sp = this.name.split('[_nonce]');
                    var $H = '';
                    $.each($sp, function ($ec, $c) {
                        if ( $ec !== 0 ) {
                            $c = $c.replace(/\[(\d+)\]/, function (string, id) {
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

            cloned.WPSFRAMEWORK_DEPENDENCY('sub');
            cloned.WPSFRAMEWORK_RELOAD_PLUGINS();
            $(this).attr('data-count', $ex_c);
            _this.find('.wpsf-field-group').WPSFRAMEWORK_FIELDS_GROUP();
            _this.find('.wpsf-field-group .wpsf-add-group').attr('data-child', 'yes');
        });

        field_groups.on('click', '.wpsf-remove-group', function (e) {
            e.preventDefault();
            $(this).closest('.wpsf-group').remove();
        });

    });
};

$.fn.WPSFRAMEWORK_FIELDS_TAXONOMY = function () {
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

                            $wrap.WPSFRAMEWORK_RELOAD_PLUGINS();
                            $wrap.WPSFRAMEWORK_DEPENDENCY();

                            flooding = false;

                        }

                    });

                }

                flooding = true;

            });

        }

    });
};

$.fn.WPSFRAMEWORK_FIELDS_TABS = function () {
    return this.each(function () {

        $(this).find('.wpsf-user-tabs-nav').on('click', 'a', function (e) {
            e.preventDefault();

            var $li = $(this).parent(),
                panel = $li.data('panel'),
                $wrapper = $li.closest('.wpsf-user-tabs'),
                $panel = $wrapper.find('.wpsf-user-tabs-panel-' + panel);

            $li.addClass('wpsf-user-tabs-active').siblings().removeClass('wpsf-user-tabs-active');
            $panel.siblings().hide();
            $panel.show();
        });


        $(this).find('.wpsf-user-tabs-nav li:first a').click();
    });
}

$.fn.WPSFRAMEWORK_FIELDS_ACCORDION = function () {
    return this.each(function () {

        $(this).find('.wpsf-accordion').accordion({
            header: '.wpsf-group-title',
            collapsible: true,
            active: false,
            animate: 250,
            heightStyle: 'content',
            icons: {
                'header': 'dashicons dashicons-arrow-right',
                'activeHeader': 'dashicons dashicons-arrow-down'
            },
            beforeActivate: function (event, ui) {
                $(ui.newPanel).WPSFRAMEWORK_DEPENDENCY('sub');
            }
        });
        /*
        if($(this).find(' .wpsf-cover , > .wpsf-fieldset > .wpsf-cover').is(":visible") === false){
            $(this).toggleClass('is-closed');
        }
        $(this).find(' > .wpsf-field-subheading , > .wpsf-fieldset > .wpsf-field-subheading').on('click',function(){

            var $icon = $(this).find("span.accordion > i");
            var $parent = $(this).parent();
            var $wpsf_cover = $parent.find("> .wpsf-cover");
            var $is_open = $wpsf_cover.is(":visible");

            if($is_open === true){
                $icon.removeClass($icon.attr("data-up")).addClass($icon.attr("data-down"));
                $wpsf_cover.slideUp();
            } else {
                $icon.removeClass($icon.attr("data-down")).addClass($icon.attr("data-up"));
                $wpsf_cover.slideDown('slow');
            }

        })*/
    });
};

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

$.WPSFRAMEWORK_FIELDS.ADVANCED_TYPO = function ($elem) {
    var $font_field = $elem.find('.wpsf_font_field');

    var parentName = $font_field.attr('data-id');
    var preview = $font_field.find('#preview-' + parentName);
    var fontColor = $font_field.find('.wp-picker-input-wrap input');
    var fontSize = $font_field.find('input[data-font-size=""]');
    var lineHeight = $font_field.find('input[data-font-line-height=""]');
    var fontFamily = $font_field.find('.wpsf-typo-family');
    var fontWeight = $font_field.find('.wpsf-typo-variant');

    var font = fontFamily.val();
    var fontWeightStyle = fontWeight.find(':selected').text();


    var fontWeightValue = '400';
    var fontStyleValue = 'normal';

    switch ( fontWeightStyle ) {
        case '100':
            fontWeightValue = '100';
            break;
        case '100italic':
            fontWeightValue = '100';
            fontStyleValue = 'italic';
            break;
        case '300':
            fontWeightValue = '300';
            break;
        case '300italic':
            fontWeightValue = '300';
            fontStyleValue = 'italic';
            break;
        case '500':
            fontWeightValue = '500';
            break;
        case '500italic':
            fontWeightValue = '500';
            fontStyleValue = 'italic';
            break;
        case '700':
            fontWeightValue = '700';
            break;
        case '700italic':
            fontWeightValue = '700';
            fontStyleValue = 'italic';
            break;
        case '900':
            fontWeightValue = '900';
            break;
        case '900italic':
            fontWeightValue = '900';
            fontStyleValue = 'italic';
            break;
        case 'italic':
            fontStyleValue = 'italic';
            break;
    }


    var href = 'http://fonts.googleapis.com/css?family=' + font + ':' + fontWeightValue;
    var html = '<link href="' + href + '" class="wpsf-font-preview-' + parentName + '" rel="stylesheet" type="text/css" />';
    if ( jQuery('.wpsf-font-preview-' + parentName).length > 0 ) {
        jQuery('.wpsf-font-preview-' + parentName).attr('href', href).load();
    } else {
        jQuery('head').append(html).load();
    }

    var $attrs = '';

    $attrs += ' font-family:' + font + '; ';
    $attrs += ' font-weight:' + fontWeightValue + '; ';
    $attrs += ' font-style:' + fontStyleValue + '; ';
    $attrs += ' color:' + fontColor.val() + ' !important; ';
    $attrs += ' line-height:' + lineHeight.val() + 'px !important; ';
    $attrs += ' font-size:' + fontSize.val() + 'px !important; ';
    preview.attr("style", $attrs);

}

$.WPSFRAMEWORK_FIELDS.ICONS_MANAGER = function () {

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

            // set parent
            $parent = $this.closest('.wpsf-icon-select');

            // open dialog
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

                    // fix scrolling
                    $wpsf_body.addClass('wpsf-icon-scrolling');

                    // fix button for VC
                    $('.ui-dialog-titlebar-close').addClass('ui-button');

                    // set viewpoint
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

            // load icons
            if ( onload ) {

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'wpsf-get-icons'
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

    // run initializer
    base.init();
};

$.WPSFRAMEWORK_FIELDS.SHORTCODE_MANAGER = function () {

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


            $selector.WPSFRAMEWORK_FIELDS_CHOSEN();

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

                    // fix scrolling
                    $wpsf_body.addClass('wpsf-shortcode-scrolling');

                    // fix button for VC
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

            // check val
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

                        $shortcodeload.WPSFRAMEWORK_DEPENDENCY();
                        $shortcodeload.WPSFRAMEWORK_DEPENDENCY('sub');
                        $shortcodeload.WPSFRAMEWORK_RELOAD_PLUGINS();

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
            cloned_el.WPSFRAMEWORK_DEPENDENCY('sub');
            cloned_el.WPSFRAMEWORK_RELOAD_PLUGINS();
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

    // run initializer
    base.init();
};

if ( typeof Color === 'function' ) {
    // adding alpha support for Automattic Color.js toString function.
    Color.fn.toString = function () {
        // check for alpha
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

$.WPSFRAMEWORK_FIELDS.PARSE_COLOR_VALUE = function (val) {
    var value = val.replace(/\s+/g, ''),
        alpha = ( value.indexOf('rgba') !== -1 ) ? parseFloat(value.replace(/^.*,(.+)\)/, '$1') * 100) : 100,
        rgba = ( alpha < 100 ) ? true : false;

    return {
        value: value,
        alpha: alpha,
        rgba: rgba
    };

};

$.WPSFRAMEWORK_FIELDS.CSS_BUILDER_CHECK_VALUES = function (value) {
    var s = value;
    if ( $.isNumeric(value) ) {
        s = value + 'px';
        return s;
    } else if ( value.indexOf('px') > -1 || value.indexOf('%') > -1 || value.indexOf('em') > -1 ) {
        var checkPx = s.replace("px", "");
        var checkPct = s.replace("%", "");
        var checkEm = s.replace("em", "");
        if ( $.isNumeric(checkPx) || $.isNumeric(checkPct) || $.isNumeric(checkEm) ) {
            return value;
        } else {
            return "0px";
        }
    } else {
        return "0px";
    }
}

$.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_MBP = function ($elem, $type, $this) {
    var $newVal = $elem.val();
    var $val = $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_CHECK_VALUES($newVal);

    var $is_checked_all = $('.wpsf-' + $type + '-checkall').hasClass('checked');

    if ( $is_checked_all === true ) {
        $this.find('.wpsf-element.wpsf-' + $type + ' :input').val($val);
    } else {
        $elem.val($val);
    }

    $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);
}

$.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER = function ($this) {
    $this.find('.wpsf-css-builder-border').css({
        "border-top-left-radius": $this.find('.wpsf-border-radius-top-left :input').val(),
        "border-top-right-radius": $this.find('.wpsf-border-radius-top-right :input').val(),
        "border-bottom-right-radius": $this.find('.wpsf-border-radius-bottom-left :input').val(),
        "border-bottom-left-radius": $this.find('.wpsf-border-radius-bottom-right :input').val(),
    });

    $this.find('.wpsf-css-builder-border').css({
        'border-style': $this.find('.wpsf-element-border-style select').val(),
        'border-color': $this.find('.wpsf-element-border-color input.wpsf-field-color-picker').val(),
    })

    $this.find(".wpsf-css-builder-margin").css({
        'background-color': $this.find('.wpsf-element-background-color input.wpsf-field-color-picker').val(),
        'color': $this.find('.wpsf-element-text-color input.wpsf-field-color-picker').val(),
    })
};

$.fn.WPSFRAMEWORK_FIELDS_COLORPICKER = function () {
    return this.each(function () {
        var $this = $(this);
        var $wpsf_body = $('body');
        // check for rgba enabled/disable
        if ( $this.data('rgba') !== false ) {
            // parse value
            var picker = $.WPSFRAMEWORK_FIELDS.PARSE_COLOR_VALUE($this.val());
            // wpColorPicker core
            $this.wpColorPicker({
                // wpColorPicker: clear
                clear: function () {
                    $this.trigger('keyup');
                },
                // wpColorPicker: change
                change: function (event, ui) {
                    var ui_color_value = ui.color.toString();
                    // update checkerboard background color
                    $this.closest('.wp-picker-container').find('.wpsf-alpha-slider-offset').css('background-color', ui_color_value);
                    $this.val(ui_color_value).trigger('change');
                },

                // wpColorPicker: create
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
                                var default_picker = $.WPSFRAMEWORK_FIELDS.PARSE_COLOR_VALUE($this.data('default-color')),
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
            });
        } else {
            // wpColorPicker default picker
            $this.wpColorPicker({
                clear: function () {
                    $this.trigger('keyup');
                },
                change: function (event, ui) {
                    $this.val(ui.color.toString()).trigger('change');
                }
            });

        }

    });

};

$.fn.WPSFRAMEWORK_FIELDS_WPLINKS = function () {
    return this.each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            var $this = $(this);

            var $parent = $this.parent();
            var $textarea = $parent.find('#sample_wplinks');
            //var $textarea = $parent.find('input');
            var $link_submit = $("#wp-link-submit");
            $('#wpsf_link-submit').remove();
            var $wpsf_link_submit = $('<input type="submit" name="wpsf-link-submit" id="wpsf_link-submit" class="button-primary" value="' + $link_submit.val() + '">');
            $link_submit.hide();

            $wpsf_link_submit.insertBefore($link_submit);


            var dialog = !window.wpLink && $.fn.wpdialog && $("#wp-link").length ? {
                $link: !1,

                open: function () {
                    this.$link = $("#wp-link").wpdialog({
                        title: wpLinkL10n.title,
                        width: 480,
                        height: "auto",
                        modal: !0,
                        dialogClass: "wp-dialog",
                        zIndex: 3e5
                    })
                },
                close: function () {
                    this.$link.wpdialog("close")
                }
            } : window.wpLink;


            dialog.open($textarea.attr("id"));

            $wpsf_link_submit.unbind("click.wpsf-wpLink").bind("click.wpsf-wpLink", function (e) {
                e.preventDefault(), e.stopImmediatePropagation();

                var url = $("#wp-link-url").length ? $("#wp-link-url").val() : $("#url-field").val();
                var title = $("#wp-link-text").length ? $("#wp-link-text").val() : $("#link-title-field").val();
                var $checkbox = $($("#wp-link-target").length ? "#wp-link-target" : "#link-target-checkbox");
                var target = $checkbox[0].checked ? " _blank" : "";


                $parent.find('span.link-title-value').html(title);
                $parent.find('span.url-value').html(url);
                $parent.find('span.target-value').html(target);

                $parent.find('input.wpsf-url').val(url);
                $parent.find('input.wpsf-title').val(title);
                $parent.find('input.wpsf-target').val(target);

                dialog.close(), $link_submit.show(), $wpsf_link_submit.unbind("click.wpsf-wpLink"), $wpsf_link_submit.remove(), $("#wp-link-cancel").unbind("click.wpsf-wpLink"), window.wpLink.textarea = "";
            });

            $("#wp-link-cancel").unbind("click.wpsf-wpLink").bind("click.wpsf-wpLink", function (e) {
                e.preventDefault(), dialog.close(), $wpsf_link_submit.unbind("click.wpsf-wpLink"), $wpsf_link_submit.remove(), $("#wp-link-cancel").unbind("click.wpsf-wpLink"), window.wpLink.textarea = ""
            });
        });
    })
}

$.fn.WPSFRAMEWORK_FIELDS_ICHECK = function () {
    return this.each(function () {
        var $this = $(this);
        var $options = {
            increaseArea: '',
            cursor: false,
            inheritClass: false,
            inheritID: false,
            aria: false,
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green',
        };

        var $is_group = false;
        if ( $this.find("li").length > 0 ) {
            $this.find(':input').each(function () {

                if ( $(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio' ) {
                } else {
                    var $final_data = $.WPSFRAMEWORK_FIELDS.get_element_args($(this), $options);
                    var $theme = '';
                    var $elem = $(this);
                    if ( $elem.data('theme') !== undefined ) {
                        var $theme = $elem.data('theme');
                    }

                    if ( $theme !== undefined ) {
                        $final_data['checkboxClass'] = 'icheckbox_' + $theme;
                        $final_data['radioClass'] = 'iradio_' + $theme;

                        if ( $theme.indexOf('line') !== -1 ) {
                            var $parent = $elem.parent().parent();
                            var $label = $parent.find('label').text();
                            $elem = $parent.append($parent.find('label > :input'));
                            $parent.find('label').remove();
                            $final_data['insert'] = '<div class="icheck_line-icon"></div>' + $label;
                            $label = null;
                        }
                        $elem.iCheck($final_data);
                    }
                }
            });

        } else {
            var $final_data = $.WPSFRAMEWORK_FIELDS.get_element_args($this, $options);
            var $theme = $this.data('theme');
            if ( $theme !== undefined ) {
                $final_data['checkboxClass'] = 'icheckbox_' + $theme;
                $final_data['radioClass'] = 'iradio_' + $theme;
            }
            $this.iCheck($final_data);
        }


    })
}

$.fn.WPSFRAMEWORK_FIELDS_CSS_BUILDER = function () {

    return this.each(function () {
        var $this = $(this);

        $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);

        $this.find('.wpsf-css-checkall').on('click', function () {
            $(this).toggleClass('checked');
        });

        $this.find('.wpsf-element.wpsf-margin :input').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_MBP($(this), 'margin', $this);
        });

        $this.find('.wpsf-element.wpsf-padding :input').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_MBP($(this), 'padding', $this);
        });

        $this.find('.wpsf-element.wpsf-border :input').on('change, blur', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_MBP($(this), 'border', $this);
        });

        $this.find('.wpsf-element.wpsf-border-radius :input').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_MBP($(this), 'border-radius', $this);
        });

        $this.find('.wpsf-element-border-style select').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);
        });

        $this.find('.wpsf-element-border-color input.wpsf-field-color-picker').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);
        });

        $this.find('.wpsf-element-text-color input.wpsf-field-color-picker').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);
        });

        $this.find('.wpsf-element-background-color input.wpsf-field-color-picker').on('change', function () {
            $.WPSFRAMEWORK_FIELDS.CSS_BUILDER_LIVE_UPDATE_BORDER($this);
        });
    })
}