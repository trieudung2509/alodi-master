<html lang="vi">

<head>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">


    <title>@yield('meta_title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">

    @yield('meta')

    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">



    <link rel='dns-prefetch' href='//maps.google.com'/>
    <link rel='dns-prefetch' href='//fonts.googleapis.com'/>
    <!-- CSS Files -->
    <link rel='stylesheet' id='wp-block-library-css' href={{ static_asset('assets/css/alodi/wp-block-library.css') }} type='text/css' media='all'/>
    <link rel='stylesheet' id='wc-blocks-vendors-style-css' href={{ static_asset('assets/css/alodi/wc-blocks-vendors-style.css') }} type='text/css' media='all'/>
    <link rel='stylesheet' id='wc-blocks-style-css' href={{ static_asset('assets/css/alodi/wc-blocks-style.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='extendify-sdk-utility-classes-css' href={{ static_asset("assets/css/alodi/extendify-sdk-utility-classes.css")}} type='text/css' media='all'/>
    <link rel='stylesheet' id='titan-adminbar-styles-css' href={{ static_asset('assets/css/alodi/titan-adminbar-styles.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='mks-ep-style-css' href={{ static_asset('assets/css/alodi/mks-ep-style.css')}} type='text/css' media='screen'/>
    <link rel='stylesheet' id='mks_shortcodes_fntawsm_css-css' href={{static_asset('assets/css/alodi/mks-shortcodes-fntawsm.css')}} type='text/css' media='screen'/>
    <link rel='stylesheet' id='mks_shortcodes_simple_line_icons-css' href={{ static_asset('assets/css/alodi/mks-shortcodes-simple-line-icons.css')}} type='text/css' media='screen'/>
    <link rel='stylesheet' id='mks_shortcodes_css-css' href={{static_asset('assets/css/alodi/mks-shortcodes.css')}} type='text/css' media='screen'/>
    <link rel='stylesheet' id='woocommerce-layout-css' href={{static_asset('assets/css/alodi/woocommerce-layout.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href={{static_asset('assets/css/alodi/woocommerce-smallscreen.css')}} type='text/css' media='only screen and (max-width: 768px)'/>
    <link rel='stylesheet' id='woocommerce-general-css' href={{static_asset('assets/css/alodi/woocommerce-general.css')}} type='text/css' media='all'/>
    <style id='woocommerce-inline-inline-css' type='text/css'>
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>
    <link rel='stylesheet' id='mks-map-css-css' href={{static_asset('assets/css/alodi/mks-map.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='trawell-fonts-css' href='https://fonts.googleapis.com/css?family=Open+Sans%3A400%7CQuicksand%3A400%2C700&#038;subset=latin%2Clatin-ext&#038;ver=1.7' type='text/css' media='all'/>
    <link rel='stylesheet' id='trawell-main-css' href={{static_asset('assets/css/alodi/trawell-main.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id="trawell-main-inline" href={{static_asset("assets/css/alodi/trawell-main-inline.css")}} type="text/css" media="all"/>
    <link rel='stylesheet' id='trawell-woocommerce-css' href={{static_asset('assets/css/alodi/trawell-woocommerce.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks-ads-widget-css' href={{static_asset('assets/css/alodi/meks-ad-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks_instagram-widget-styles-css' href={{static_asset('assets/css/alodi/meks-instagram-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks-flickr-widget-css' href={{static_asset('assets/css/alodi/meks-flickr-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks-author-widget-css' href={{static_asset('assets/css/alodi/meks-author-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks-social-widget-css' href={{static_asset('assets/css/alodi/meks-social-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks-themeforest-widget-css' href={{static_asset('assets/css/alodi/meks-themeforest-widget.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='meks_ess-main-css' href={{static_asset('assets/css/alodi/meks-ess-main.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='bos_sb_main_css-css' href={{static_asset('assets/css/alodi/bob-sb-main.css')}} type='text/css' media='all'/>
    <link rel='stylesheet' id='alodi-custom-css' href={{static_asset('assets/css/alodi/alodi-frontend-custom.css')}} type='text/css' media='all'/>
    <script type='text/javascript' src={{static_asset('assets/js/jquery.min.js')}} id='jquery-core-js'></script>
    <script type='text/javascript' src={{static_asset('assets/js/jquery-migrate.min.js')}} id='jquery-migrate-js'></script>
    <link rel="canonical" href="@yield('canonical')"/>
    <link rel='shortlink' href='https://alodi.net/'/>
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>


@if (get_setting('google_analytics') == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (get_setting('google_analytics_4') == 1)
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('MEASUREMENT_ID') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ env('MEASUREMENT_ID') }}');
    </script>
@endif

@if (get_setting('google_adsense') == 1)
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxx"
                crossorigin="anonymous"></script>
@endif

</head>

<body class="home page-template-default page page-id-195 wp-embed-responsive theme-trawell woocommerce-no-js trawell-header-wide trawell-header-shadow trawell-header-indent trawell-has-sidebar trawell-sidebar-right trawell-v_1_7">

@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Background of PhotoSwipe.
 It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>
    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">
        <!-- Container that holds slides.
    PhotoSwipe keeps only 3 of them in the DOM to save memory.
    Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <!-- <button class="pswp__button pswp__button--share" title="Share"></button> -->
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<div class="trawell-body-overlay"></div>
<script type="text/javascript">
    (function() {
            var c = document.body.className;
            c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
            document.body.className = c;
        }
    )();
</script>
<script type='text/javascript' id='mks-ep-script-js-extra'>
    /* <![CDATA[ */
    var mks_ep_settings = {
        "ajax_url": "https:\/\/alodi.net\/trawell\/wp-admin\/admin-ajax.php"
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/mks-ep-script.js')}} id='mks-ep-script-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/mks-shortcodes.js')}} id='mks_shortcodes_js-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/jquery.blockUI.min.js')}} id='jquery-blockui-js'></script>
<script type='text/javascript' id='wc-add-to-cart-js-extra'>
    /* <![CDATA[ */
    var wc_add_to_cart_params = {
        "ajax_url": "\/trawell\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/trawell\/?wc-ajax=%%endpoint%%",
        "i18n_view_cart": "View cart",
        "cart_url": "https:\/\/alodi.net\/trawell\/?page_id=471",
        "is_cart": "",
        "cart_redirect_after_add": "no"
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/wc-add-to-cart.js')}} id='wc-add-to-cart-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/js.cookie.min.js')}} id='js-cookie-js'></script>
<script type='text/javascript' id='woocommerce-js-extra'>
    /* <![CDATA[ */
    var woocommerce_params = {
        "ajax_url": "\/trawell\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/trawell\/?wc-ajax=%%endpoint%%"
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/woocommerce.min.js')}} id='woocommerce-js'></script>
<script type='text/javascript' id='wc-cart-fragments-js-extra'>
    /* <![CDATA[ */
    var wc_cart_fragments_params = {
        "ajax_url": "\/trawell\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/trawell\/?wc-ajax=%%endpoint%%",
        "cart_hash_key": "wc_cart_hash_d715d2fb354ab4e1f368145720f41630",
        "fragment_name": "wc_fragments_d715d2fb354ab4e1f368145720f41630",
        "request_timeout": "5000"
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/cart-fragments.min.js')}} id='wc-cart-fragments-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/mks-map-google-map-infoBox.js')}} id='mks-map-google-map-infoBox-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/mks-map-google-map-markerClusterer.js')}} id='mks-map-google-map-markerClusterer-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/mks-map.js')}} id='mks-map-js-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/imagesloaded.min.js')}} id='imagesloaded-js'></script>
<script type='text/javascript' id='trawell-main-js-extra'>
    /* <![CDATA[ */
    var trawell_js_settings = {
        "rtl_mode": "",
        "header_sticky_offset": "150",
        "header_sticky_up": "",
        "home_slider_autoplay": "",
        "home_slider_autoplay_time": "5",
        "use_gallery": "1",
        "home_cover_video_image_fallback": "1",
        "home_counter_animate": "",
        "cover_parallax": ""
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/trawell-main.min.js')}} id='trawell-main-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/meks-ess-main.js')}} id='meks_ess-main-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/bos_main.js')}} id='bos_main_js-js'></script>
<script type='text/javascript' id='bos_date_js-js-extra'>
    /* <![CDATA[ */
    var objectL10n = {
        "destinationErrorMsg": "Sorry, we need at least part of the name to start searching.",
        "tooManyDays": "Your check-out date is more than 30 nights after your check-in date. Bookings can only be made for a maximum period of 30 nights. Please enter alternative dates and try again.",
        "dateInThePast": "Your check-in date is in the past. Please check your dates and try again.",
        "cObeforeCI": "Please check your dates, the check-out date appears to be earlier than the check-in date.",
        "calendar_nextMonth": "Next month",
        "calendar_open": "Open calendar and pick a date",
        "calendar_prevMonth": "Prev month",
        "calendar_closeCalendar": "Close calendar",
        "january": "January",
        "february": "February",
        "march": "March",
        "april": "April",
        "may": "May",
        "june": "June",
        "july": "July",
        "august": "August",
        "september": "September",
        "october": "October",
        "november": "November",
        "december": "December",
        "mo": "Mo",
        "tu": "Tu",
        "we": "We",
        "th": "Th",
        "fr": "Fr",
        "sa": "Sa",
        "su": "Su",
        "updating": "Updating...",
        "close": "Close",
        "placeholder": "e.g. city, region, district or specific hotel",
        "aid": "382821",
        "dest_type": "select",
        "calendar": "0",
        "month_format": "short",
        "flexible_dates": "0",
        "logodim": "blue_150x25",
        "logopos": "left",
        "buttonpos": "right",
        "bgcolor": "#FEBA02",
        "textcolor": "#003580",
        "submit_bgcolor": "#0896FF",
        "submit_bordercolor": "#0896FF",
        "submit_textcolor": "#FFFFFF",
        "aid_starts_with_four": "affiliate ID is different from partner ID: should start with a 1, 3, 8 or 9. Please change it.",
        "images_js_path": "https:\/\/alodi.net\/trawell\/wp-content\/plugins\/bookingcom-official-searchbox\/images"
    };
    /* ]]> */
</script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/bos_date.js')}} id='bos_date_js-js'></script>
<script type='text/javascript' src={{static_asset('assets/js/alodi/wp-embed.min.js')}} id='wp-embed-js'></script>

</body>
<!-- END html -->
</html>
