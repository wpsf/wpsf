/*-------------------------------------------------------------------------------------------------
 This file is part of the WPSF package.                                                           -
 This package is Open Source Software. For the full copyright and license                         -
 information, please view the LICENSE file which was distributed with this                        -
 source code.                                                                                     -
                                                                                                  -
 @package    WPSF                                                                                 -
 @author     Varun Sridharan <varunsridharan23@gmail.com>                                         -
 -------------------------------------------------------------------------------------------------*/

+
    function ($) {
        'use strict';
        var VSPButton = function (element, options) {
            this.$element = $(element)
            this.options = $.extend({}, VSPButton.DEFAULTS, options)
            this.isLoading = false
        }

        VSPButton.VERSION = '3.3.7'

        VSPButton.DEFAULTS = {
            loadingText: 'loading...'
        }

        VSPButton.prototype.setState = function (state) {
            var d = 'disabled'
            var $el = this.$element
            var val = $el.is('input') ? 'val' : 'html'
            var data = $el.data()
            state += 'Text'
            if ( data.resetText == null ) $el.data('resetText', $el[val]())

            setTimeout($.proxy(function () {
                $el[val](data[state] == null ? this.options[state] : data[state])
                if ( state == 'loadingText' ) {
                    this.isLoading = true
                    $el.addClass(d).attr(d, d).prop(d, true)
                } else if ( this.isLoading ) {
                    this.isLoading = false
                    $el.removeClass(d).removeAttr(d).prop(d, false)
                }
            }, this), 0)
        }

        VSPButton.prototype.toggle = function () {
            var changed = true
            var $parent = this.$element.closest('[data-toggle="buttons"]')

            if ( $parent.length ) {
                var $input = this.$element.find('input')
                if ( $input.prop('type') == 'radio' ) {
                    if ( $input.prop('checked') ) changed = false
                    $parent.find('.active').removeClass('active')
                    this.$element.addClass('active')
                } else if ( $input.prop('type') == 'checkbox' ) {
                    if ( ( $input.prop('checked') ) !== this.$element.hasClass('active') ) changed = false
                    this.$element.toggleClass('active')
                }
                $input.prop('checked', this.$element.hasClass('active'))
                if ( changed ) $input.trigger('change')
            } else {
                this.$element.attr('aria-pressed', !this.$element.hasClass('active'))
                this.$element.toggleClass('active')
            }
        }

        function vspbutton_plugin(option) {
            return this.each(function () {
                var $this = $(this)
                var data = $this.data('vsp.button')
                var options = typeof option == 'object' && option
                if ( !data ) $this.data('vsp.button', ( data = new VSPButton(this, options) ))
                if ( option == 'toggle' ) data.toggle()
                else if ( option ) data.setState(option)
            })
        }

        var old = $.fn.vspbutton
        $.fn.vspbutton = vspbutton_plugin
        $.fn.vspbutton.Constructor = VSPButton
        $.fn.vspbutton.noConflict = function () {
            $.fn.vspbutton = old;
            return this
        }
    }(jQuery);
