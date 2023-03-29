(function($) {

    $(document).ready(function() {


        var mks_ep_modal_displayed = false;

        /* Modal open manually helper */
        $('body').on('click', '.mks-ep-trigger-open', function(e) {
            e.preventDefault();
            mks_ep_open_modal($('.mks-ep-modal'), 'click-customizer');
            mks_ep_modal_displayed = true;
        });

        if (mks_ep_can_display_modal()) {

            /* Exit trigger */
            $(document).on('mouseleave', function(e) {
                if (!mks_ep_modal_displayed && (e.pageY - $(window).scrollTop()) < 0) {
                    mks_ep_open_modal($('.mks-ep-modal'), 'exit-demo');
                    mks_ep_modal_displayed = true;
                }
            });
        }

        /* Modal close */
        $('.mks-ep-modal').on('click', 'a.mks-ep-close-modal', function(e) {
            e.preventDefault();
            mks_ep_close_modal($(this).closest('.mks-ep-modal'));
        });


        /* Test drive submit */
        $('.mks-ep-modal').on('submit', '.mks-ep-modal-test-drive-form', function(e) {
            e.preventDefault();
            var form = $(this);
            var email = form.find('.mks-ep-test-drive-email').val();
            var theme = form.find('.mks-ep-test-drive-theme').val();
            var ref = form.find('.mks-ep-test-drive-ref').val();

            if (!mks_ep_is_valid_email(email)) {
                return false;
            }

            // $.ajax({

            //     url: mks_ep_settings.ajax_url,
            //     method: 'POST',
            //     data: {
            //         action: 'mks_ep_test_drive_submit',
            //         email: email,
            //         theme: theme
            //     }

            // });

            // form.fadeOut(300, function() {
            //     $('.mks-ep-modal-test-drive-response').fadeIn(300);
            // });

            $('.mks-ep-modal-test-drive-request').fadeOut(300, function() {

                $('.mks-ep-modal-test-drive-loader').show();

                $.ajax({
                    url: mks_ep_settings.ajax_url,
                    type: "POST",
                    data: {
                        action: 'mks_ep_test_drive_submit',
                        email: email,
                        theme: theme,
                        ref: ref
                    },
                    timeout: 8000,
                    success: function(response) {

                        $('.mks-ep-modal-test-drive-loader').hide();
                        var res = JSON.parse(response);
                        if (res.success) {
                            $('.mks-ep-modal-test-drive-response-success').html(res.data);
                            $('.mks-ep-modal-test-drive-response').fadeIn(300);

                        } else {
                            $('.mks-ep-modal-test-drive-response-error').html(res.data);
                            $('.mks-ep-modal-test-drive-request').fadeIn(300);
                        }

                        // setTimeout(function() {
                        //     mks_clear_blur($('#modal-try .content-wrapper'));
                        // }, 500);

                    },

                    error: function(xmlhttprequest, textstatus, message) {

                        $('.mks-ep-modal-test-drive-loader').hide();

                        if (textstatus === 'timeout') {
                            $('.mks-ep-modal-test-drive-response-success').html('All set, thanks! We will send you an email when your website is ready, in a couple of minutes.');

                            $('.mks-ep-modal-test-drive-response').show().animate({
                                opacity: 1
                            }, 300);

                        } else {
                            $('.mks-ep-modal-test-drive-response-error').html(message);
                            $('.mks-ep-modal-test-drive-request').fadeIn(300);
                        }

                        // setTimeout(function() {
                        //     mks_clear_blur($('#modal-try .content-wrapper'));
                        // }, 500);


                    }
                });
            });
        });

    });

    /* Check if we modal should be displayed */
    function mks_ep_can_display_modal() {

        if (!mks_ep_is_desktop() || mks_ep_in_iframe() || !$('.mks-ep-modal').length || mks_ep_read_cookie('mks_exit_' + $('.mks-ep-test-drive-theme').val())) {
            return false;
        }

        // if (!mks_ep_is_desktop() || mks_ep_in_iframe() || !$('.mks-ep-modal').length) {
        //   return false;
        // }

        return true;

    }


    /* Close modal */
    function mks_ep_close_modal(obj) {
        obj.removeClass('active');
        $('body, html').removeClass('mks-ep-modal-open');
    }



    /* Open modal */
    function mks_ep_open_modal(obj, ref) {

        var window_height = $(window).height();

        obj.css('height', window_height + 'px').css('top', $(window).scrollTop() + 'px').addClass('active');

        $('body, html').addClass('mks-ep-modal-open');
        $('.mks-ep-modal-test-drive-response').hide();
        $('.mks-ep-modal-test-drive-request').show();

        //mks_ep_center(obj.find('.mks-ep-section'));

        $('.mks-ep-test-drive-ref').val(ref);

        var cookie_name = 'mks_exit_' + obj.find('.mks-ep-test-drive-theme').val();

        if (!mks_ep_read_cookie(cookie_name)) {
            mks_ep_create_cookie(cookie_name, true, 30);
        }

    }



    /* Is in iFrame */
    function mks_ep_in_iframe() {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    }


    /* Check if is desktop */
    function mks_ep_is_desktop() {

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return false;
        }

        return true;
    }


    /* Create cookie */
    function mks_ep_create_cookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }


    /* Read/check cookie */
    function mks_ep_read_cookie(name) {
        var nameEQ = encodeURIComponent(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }


    /* Delete cookie */
    function mks_ep_erase_cookie(name) {
        createCookie(name, "", -1);
    }


    /* Validate email */
    function mks_ep_is_valid_email(email) {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/.test(email)) {
            return true;

        }

        return false;
    }

    /* Function to center elements */
    function mks_ep_center(obj) {

        var parent_height = obj.parent().height();
        var obj_height = obj.height();

        if (parent_height > obj_height + 80) {
            obj.css("position", "absolute");
            obj.css("top", ((parent_height - obj_height) / 2) + "px");
        } else {
            obj.css("padding-top", '40px').css("padding-bottom", '40px');
        }



    }



})(jQuery);