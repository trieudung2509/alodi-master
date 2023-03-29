@extends('frontend.layouts.app')

@section('meta_title'){{ $term->meta_title }}@endsection

@section('meta_description'){{ $term->meta_description }}@endsection

@section('meta_keywords'){{ $term->meta_keywords }}@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $term->meta_title }}">
    <meta itemprop="description" content="{{ $term->meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $term->meta_title }}">
    <meta name="twitter:description" content="{{ $term->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $term->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('term.blogs', $term->slug) }}" />
    <meta property="og:description" content="{{ $term->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('canonical') {{ url($term->slug) }} @endsection

@section('content')

    <!--            the body-->

    <div class="trawell-cover trawell-cover-color trawell-cover-image-text">

        <div class="trawell-cover-item item-overlay trawell-item-color-overlay trawell-flex align-items-center justify-content-center text-center ">

            <div class="entry-image">
                <img width="1920" height="1280"
                     src="{{ uploaded_asset($term->meta_img) }}"
                     class="attachment-trawell-cover size-trawell-cover"
                     alt="{{ $term->meta_title }}" loading="lazy" /></div>


            <div class="archive-heading trawell-entry">
                <h1 class="archive-title h1 md-h1 sm-h1">{{ $term->name }}</h1>
                {{--                <span class="archive-meta entry-meta md-entry-meta-middle sm-entry-meta-small">8 articles</span>--}}
                <p>{{ $term->meta_description }}</p>
            </div>

        </div>

    </div>
    <div class="trawell-main" style="padding-left: 1px; padding-right: 1px;">
        
        <!--    GOOGLE ADSENSE BEGIN-->
        @if (get_setting('google_adsense') == 1)
        @include('frontend.layouts.google_adsense_left')
        @endif
        <!--    GOOGLE ADSENSE END-->

        <div class="trawell-sections">
            <div class="trawell-section trawell-layout-b1">
                <div class="container">
                    <div class="row trawell-posts">
                        @foreach($term->blogs as $blog)
                            <div class="col-12">
                                <article class="trawell-item row post type-post status-publish format-standard has-post-thumbnail hentry category-asia tag-blockquote tag-sidebar tag-single-post">
                                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-center">
                                        <a href="{{ url($blog->slug) }}" class="entry-image">
                                            <img style="width: 200px;height: 200px"
                                                 src="{{ uploaded_asset($blog->small_img)}}"
                                                 class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"
                                                 alt="{{ $blog->meta_title }}" loading="lazy"/>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-7 col-xl-8 sm-no-left-padding">
                                        <div class="entry-header">
                                            <div class="entry-category pill-small">
                                                @foreach($blog->categories as $blog_category)
                                                    <a href="{{ url($blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index }}">{{$blog_category->name}}</a>
                                                @endforeach
                                            </div>
                                            <h3 class="entry-title h4 sm-h3">
                                                <a href="{{ url($blog->slug) }}">{{ $blog->title }}</a>
                                            </h3>
                                            <div class="entry-meta entry-meta-small">
                                                <span class="meta-item meta-date">
                                                    <span class="updated">{{ Carbon\Carbon::parse($blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->locale('vi')->diffForHumans() }}</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="entry-content excerpt-small">
                                            <p>
                                                {{ $blog->meta_description }}
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach

                        @if ($term->blogs->links()->paginator->hasPages())
                        <div class="trawell-pagination alignnone">
                        {{ $term->blogs->links() }}
                        </div>
                        @endif
                    </div>
                    {{--                    <div class="trawell-pagination alignnone">--}}
                    {{--                        <nav class="navigation trawell-infinite-scroll">--}}
                    {{--                            <a href="/trawell/?cat=1&#038;paged=2">Load More</a>--}}
                    {{--                            <div class="trawell-loader">--}}
                    {{--                                <div class="double-bounce1"></div>--}}
                    {{--                                <div class="double-bounce2"></div>--}}
                    {{--                            </div>--}}
                    {{--                        </nav>--}}
                    {{--                    </div>--}}

                </div>
            </div>

        </div>

        <!--    SIDEBAR BEGIN-->
    @include('frontend.layouts.sidebar')
    <!--    SIDEBAR END-->

        <!--    GOOGLE ADSENSE BEGIN-->
        @if (get_setting('google_adsense') == 1)
        @include('frontend.layouts.google_adsense_right')
        @endif
        <!--    GOOGLE ADSENSE END-->

    </div>

    @if(Auth::user() != null)
        <!--    SWITCHER BEGIN-->
        @include('frontend.layouts.switcher')
        <!--    SWITCHER END-->
    @endif

    <!--the end body-->

@endsection


