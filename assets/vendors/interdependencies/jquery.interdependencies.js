/*-------------------------------------------------------------------------------------------------
 This file is part of the WPSF package.                                                           -
 This package is Open Source Software. For the full copyright and license                         -
 information, please view the LICENSE file which was distributed with this                        -
 source code.                                                                                     -
                                                                                                  -
 @package    WPSF                                                                                 -
 @author     Varun Sridharan <varunsridharan23@gmail.com>                                         -
 -------------------------------------------------------------------------------------------------*/
/*global console, window*/
( function ($) {
    "use strict";

    function log(msg) {
        if ( window.console && window.console.log ) {
            console.log(msg);
        }
    }

    function safeFind(context, selector) {
        if ( selector[0] == "#" ) {
            if ( selector.indexOf(" ") < 0 ) {
                return $(selector);
            }
        }
        return context.find(selector);
    }

    var configExample = {
        show: null,
        hide: null,
        log: false,
        checkTargets: true
    };

    function Rule(controller, condition, value) {
        this.init(controller, condition, value);
    }

    $.extend(Rule.prototype, {
        init: function (controller, condition, value) {
            this.controller = controller;
            this.condition = condition;
            this.value = value;
            this.rules = [];
            this.controls = [];
        },
        evalCondition: function (context, control, condition, val1, val2) {
            if ( condition == "==" || condition == "OR" ) {
                return this.checkBoolean(val1) == this.checkBoolean(val2);
            } else if ( condition == "!=" ) {
                return this.checkBoolean(val1) != this.checkBoolean(val2);
            } else if ( condition == ">=" ) {
                return Number(val2) >= Number(val1);
            } else if ( condition == "<=" ) {
                return Number(val2) <= Number(val1);
            } else if ( condition == ">" ) {
                return Number(val2) > Number(val1);
            } else if ( condition == "<" ) {
                return Number(val2) < Number(val1);
            } else if ( condition == "()" ) {
                return window[val1](context, control, val2);
            } else if ( condition == "in" ) {
                if ( val2 == '' || val2 == null ) {
                    return false;
                }
                if ( typeof val2 === 'object' ) {
                    for ( var i = 0; i <= val2.length; i++ ) {
                        if ( val2[i] !== undefined ) {
                            if ( val2[i] == val1 ) {
                                return true;
                            }
                        }
                    }

                }
                return false;
            } else if ( condition == "any" ) {
                return $.inArray(val2, val1.split(',')) > -1;
            } else if ( condition == "not-any" ) {
                return $.inArray(val2, val1.split(',')) == -1;
            } else {
                throw new Error("Unknown condition:" + condition);
            }
        },
        checkCondition: function (context, cfg) {
            if ( !this.condition ) {
                return true;
            }
            var control = context.find(this.controller);
            if ( control.length === 0 && cfg.log ) {
                log("Evaling condition: Could not find controller input " + this.controller);
            }
            var val = this.getControlValue(context, control);
            if ( cfg.log && val === undefined ) {
                log("Evaling condition: Could not exctract value from input " + this.controller);
            }
            if ( val === undefined ) {
                return false;
            }
            val = this.normalizeValue(control, this.value, val);
            return this.evalCondition(context, control, this.condition, this.value, val);
        },
        normalizeValue: function (control, baseValue, val) {
            if ( typeof baseValue == "number" ) {
                return parseFloat(val);
            }
            return val;
        },
        getControlValue: function (context, control) {
            if ( ( control.attr("type") == "radio" || control.attr("type") == "checkbox" ) && control.length > 1 ) {
                return control.filter(":checked").val();
            }
            if ( control.attr("type") == "checkbox" || control.attr("type") == "radio" ) {
                return control.is(":checked");
            }
            return control.val();
        },
        createRule: function (controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },
        include: function (input) {
            if ( !input ) {
                throw new Error("Must give an input selector");
            }
            this.controls.push(input);
        },
        applyRule: function (context, cfg, enforced) {
            var result;
            if ( enforced === undefined ) {
                result = this.checkCondition(context, cfg);
            } else {
                result = enforced;
            }
            if ( cfg.log ) {
                log("Applying rule on " + this.controller + "==" + this.value + " enforced:" + enforced + " result:" + result);
            }
            if ( cfg.log && !this.controls.length ) {
                log("Zero length controls slipped through");
            }
            var show = cfg.show || function (control) {
                control.show();
            };
            var hide = cfg.hide || function (control) {
                control.hide();
            };
            var controls = $.map(this.controls, function (elem, idx) {
                var control = context.find(elem);
                if ( cfg.log && control.length === 0 ) {
                    log("Could not find element:" + elem);
                }
                return control;
            });
            if ( result ) {
                $(controls).each(function () {
                    if ( cfg.log && $(this).length === 0 ) {
                        log("Control selection is empty when showing");
                        log(this);
                    }
                    show(this);
                });
                $(this.rules).each(function () {
                    this.applyRule(context, cfg);
                });
            } else {
                $(controls).each(function () {
                    if ( cfg.log && $(this).length === 0 ) {
                        log("Control selection is empty when hiding:");
                        log(this);
                    }
                    hide(this);
                });
                $(this.rules).each(function () {
                    this.applyRule(context, cfg, false);
                });
            }
        },
        checkBoolean: function (value) {
            switch ( value ) {
                case true:
                case 'true':
                case 1:
                case '1':
                    value = true;
                    break;
                case false:
                case 'false':
                case 0:
                case '0':
                    value = false;
                    break;
            }
            return value;
        },
    });

    function Ruleset() {
        this.rules = [];
    }

    $.extend(Ruleset.prototype, {
        createRule: function (controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },
        applyRules: function (context, cfg) {
            var i;
            cfg = cfg || {};
            if ( cfg.log ) {
                log("Starting evaluation ruleset of " + this.rules.length + " rules");
            }
            for ( i = 0; i < this.rules.length; i++ ) {
                this.rules[i].applyRule(context, cfg);
            }
        },
        walk: function () {
            var rules = [];

            function descent(rule) {
                rules.push(rule);
                $(rule.children).each(function () {
                    descent(this);
                });
            }

            $(this.rules).each(function () {
                descent(this);
            });
            return rules;
        },
        checkTargets: function (context, cfg) {
            var controls = 0;
            var rules = this.walk();
            $(rules).each(function () {
                if ( context.find(this.controller).length === 0 ) {
                    throw new Error("Rule's controller does not exist:" + this.controller);
                }
                if ( this.controls.length === 0 ) {
                    throw new Error("Rule has no controls:" + this);
                }
                $(this.controls).each(function () {
                    if ( safeFind(context, this) === 0 ) {
                        throw new Error("Rule's target control " + this + " does not exist in context " + context.get(0));
                    }
                    controls++;
                });
            });
            if ( cfg.log ) {
                log("Controller check ok, rules count " + rules.length + " controls count " + controls);
            }
        },
        install: function (cfg) {
            $.deps.enable($(document.body), this, cfg);
        }
    });

    var deps = {
        createRuleset: function () {
            return new Ruleset();
        },
        enable: function (selection, ruleset, cfg) {
            cfg = cfg || {};
            if ( cfg.checkTargets || cfg.checkTargets === undefined ) {
                ruleset.checkTargets(selection, cfg);
            }
            var self = this;
            if ( cfg.log ) {
                log("Enabling dependency change monitoring on " + selection.get(0));
            }

            var handler = function () {
                ruleset.applyRules(selection, cfg);
            };

            var val = selection.on ? selection.on("change.deps", null, null, handler) : selection.live("change.deps", handler);
            ruleset.applyRules(selection, cfg);
            return val;
        }
    };
    $.deps = deps;

    /* Custom */

    var $WPSFRULES = ['input[name=post_format]', 'select#page_template', 'input#menu_order', 'select#parent_id', 'select#post_status', 'input[name=visibility]'];

    $.extend($.deps, {
        enable: function (selection, ruleset, cfg) {
            cfg = cfg || {};
            if ( cfg.checkTargets || cfg.checkTargets === undefined ) {
                ruleset.checkTargets(selection, cfg);
            }
            var self = this;
            if ( cfg.log ) {
                log("Enabling dependency change monitoring on " + selection.get(0));
            }

            var handler = function () {
                ruleset.applyRules(selection, cfg);
            };

            $.each($WPSFRULES, function (i, e) {
                $('body').find(e).on('change', function () {
                    handler();
                })
            });
            var val = selection.on ? selection.on("change.deps", null, null, handler) : selection.live("change.deps", handler);
            ruleset.applyRules(selection, cfg);
            return val;
        }
    });


    $.extend(Rule.prototype, {
        FieldVal: function (content, control) {
            var val = this.getControlValue(content, control);
            if ( val === undefined ) {
                return false;
            }
            val = this.normalizeValue(this.control, this.value, val);
            return val;
        },

        checkCondition: function (context, cfg) {
            if ( !this.condition ) {
                return true;
            }

            if ( $.inArray(this.controller, $WPSFRULES) !== -1 ) {
                var control = $("body").find(this.controller);

            } else {
                var control = context.find(this.controller);
            }


            if ( control.length === 0 && cfg.log ) {
                log("Evaling condition: Could not find controller input " + this.controller);
            }

            var val = this.FieldVal(context, control);

            if ( cfg.log && val === undefined ) {
                log("Evaling condition: Could not extract value from input " + this.controller);
            }

            if ( val === false ) {
                return false;
            }

            return this.evalCondition(context, control, this.condition, this.value, val);
        },

    });

} )(jQuery);