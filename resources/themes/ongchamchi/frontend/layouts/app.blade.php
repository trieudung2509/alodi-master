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


    <script type='text/javascript' src={{static_asset('assets/js/jquery.min.js')}} id='jquery-core-js'></script>
    <script type='text/javascript' src={{static_asset('assets/js/jquery-migrate.min.js')}} id='jquery-migrate-js'></script>
    <link rel="canonical" href="https://ongchamchi.com"/>
    <link rel='shortlink' href='https://ongchamchi.com/'/>


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
{{--        NEED TO CHANGE TO ADSENSE OF ONGCHAMCHI --}}

    @endif

</head>

<body>

@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')

</body>
</html>
