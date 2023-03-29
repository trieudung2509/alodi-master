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
}(function ($) {
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
        'tableofcontent': function(context) {
            var self = this;

            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            var ui = $.summernote.ui;
            var $note    = context.layoutInfo.note;
            //var $code =   $note.summernote('code');
            var $editor  = context.layoutInfo.editor;
            var $editable = context.layoutInfo.editable;
            var $toolbar = context.layoutInfo.toolbar;
            var options  = context.options;
            var lang     = options.langInfo;
            // add tableofcontent button
            context.memo('button.tableofcontent', function() {
                // create button
                var button = ui.button({
                    contents: 'ToC',
                    tooltip: 'Create a table of content',
                    click: function() {
                        // invoke insertText method with 'hello' on editor module.
                        if ($editable.find("div[id='toc']").length != 0)
                            $editable.find("div[id='toc']").remove();
                        var h2 = $editable.find('h2');
                        var hList= "<h2>Table of content</h2><ul id='tableofcontent'>";
                        var node = document.createElement('div');


                        node.od = id = 'toc';
                        for (var i = 0; i < h2.length; i++)
                        {
                            if ($(h2[i]).text() != "")
                            {
                                if ($(h2[i]).text().replace(/^\s+/, '').replace(/\s+$/, '')  == '')
                                {
                                    //Whitespace
                                }
                                else
                                {
                                    //$(h1[i]).append("<a name='h1_" + i + "'/>"); //Update???
                                    $(h2[i]).attr("id","h2_" + i);
                                    hList += "<li><a href='#h2_" + i + "'>" +$(h2[i]).text().replace(/(\r\n\t|\n|\r\t)/gm,"") + "</a></li>";
                                }
                            }

                            //H2
                            var h3 = $(h2[i]).nextUntil('h2').filter('h3');
                            if (h3.length > 0)
                            {
                                hList += "<ul>";
                                for (var j = 0; j < h3.length; j++)
                                {
                                    if ($(h3[j]).text() != "")
                                    {
                                        if ($(h3[j]).text().replace(/^\s+/, '').replace(/\s+$/, '')  == '')
                                        {
                                            //Whitespace
                                        }
                                        else
                                        {
                                            //$(h2[j]).append("<a name='h2_" +i + "_"+ j + "'/>");
                                            $(h3[j]).attr("id","h3_" + i + "_" + j);
                                            hList += "<li><a href='#h3_" + i + "_" + j + "'>" +$(h3[j]).text().replace(/(\r\n\t|\n|\r\t)/gm,"") + "</a></li>";
                                        }
                                    }
                                }
                                hList += "</ul>";
                            }
                        }
                        hList += "</ul>";
                        node.innerHTML = hList;

                        $note.summernote('insertNode', node);
                    }});

                // create jQuery object from button instance.
                var $tableofcontent = button.render();
                return $tableofcontent;
            });

            // This method will be called when editor is initialized by $('..').summernote();
            // You can create elements for plugin
            this.initialize = function() {
                /*this.$panel = $('<div class="hello-panel"/>').css({
                  position: 'absolute',
                  width: 100,
                  height: 100,
                  left: '50%',
                  top: '50%',
                  background: 'red'
                }).hide();

                this.$panel.appendTo('body');*/
            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            this.destroy = function() {
                /* this.$panel.remove();
                 this.$panel = null;*/
            };
        }
    });
}));
