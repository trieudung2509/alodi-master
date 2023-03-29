/**
 *
 * copyright 2018 Nicolas Fournier.
 * email: nicolas@rousseaufournier.com
 * license: buy me a beer or a house.
 *
 */
/**
 *
 * copyright [year] [your Business Name and/or Your Name].
 * email: your@email.com
 * license: Your chosen license, or link to a license file.
 *
 */
(function (factory) {
    /* Global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
} (function ($) {
    /**
     * @class plugin.examplePlugin
     *
     * example Plugin
     */
// Extends plugins for adding hello.
    //  - plugin is external module for customizing.
    $.extend($.summernote.plugins, {
        /**
         * @param {Object} context - context object has status of editor.
         */
        'current-style': function (context) {
            var self = this;
            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            $editor = context.layoutInfo.editor;
            this.highlight = function (we, e) {
                var node = e.target.nodeName.toLowerCase();
                e.stopPropagation();
                // Remove active class from old list
                $editor.find('.dropdown-style .dropdown-item').removeClass('active');
                // Remove active class from new list
                $editor.find('.dropdown-style a').removeClass('active');
                // Add active class to current style
                $editor.find('.dropdown-style [aria-label="' + node + '"]').addClass('active');
            };
            this.events = {
                'summernote.mousedown': this.highlight,
                'summernote.keyup': this.highlight
            }
        }
    });
}));
