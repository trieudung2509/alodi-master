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
        'active-align-style': function (context) {
            var self = this;
            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            $editor = context.layoutInfo.editor;
            this.highlight = function (we, e) {
                var node = e.target.style.textAlign;
                var left = "Align left (CTRL+SHIFT+L)";
                var center = "Align center (CTRL+SHIFT+E)";
                var right = "Align right (CTRL+SHIFT+R)";
                var justify = "Justify full (CTRL+SHIFT+J)";
                e.stopPropagation();
                // Remove active class from old list
                $editor.find('.note-align .note-btn').removeClass('active');
                // Add active class to current style
                if (node == "justify") {
                    $editor.find('.note-align [aria-label="' + justify + '"]').addClass('active');
                } else if (node == "center") {
                    $editor.find('.note-align [aria-label="' + center + '"]').addClass('active');
                } else if (node == "right") {
                    $editor.find('.note-align [aria-label="' + right + '"]').addClass('active');
                } else {
                    $editor.find('.note-align [aria-label="' + left + '"]').addClass('active');
                }
                
            }; 
            this.events = {
                'summernote.mousedown': this.highlight,
                'summernote.keyup': this.highlight
            }
        }
    });
}));
