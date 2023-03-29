@extends('frontend.layouts.app')

@section('meta_title')
    {{ get_setting('meta_title').' | '.get_setting('site_motto') }}
@endsection

@section('canonical') {{ url('') }} @endsection

@section('content')

    <!--            the body-->

    <div class="trawell-cover trawell-cover-slider">

        @php
            $top_blogs = App\Blog::where('featured', true)
                ->where('status', '!=', 0)
                ->orderBy('published_date', 'desc')
                ->take(15)
                ->get();
        @endphp
        @if ($top_blogs->isEmpty())
            <div class="trawell-cover-item item-overlay trawell-item-color-overlay trawell-flex align-items-center justify-content-center text-center">
                <a class="entry-image">
                    <img class="attachment-trawell-cover size-trawell-cover wp-post-image"
                         loading="lazy" srcset="" sizes="(max-width: 1920px) 100vw, 1920px"/>
                </a>
            </div>
        @else
            @foreach($top_blogs as $top_blog)
            <div class="trawell-cover-item item-overlay trawell-item-color-overlay trawell-flex align-items-center justify-content-center text-center">
                <a href="{{ url($top_blog->slug) }}" class="entry-image">
                    <img width="1920" height="1080" src="{{ uploaded_asset($top_blog->meta_img) }}"
                         class="attachment-trawell-cover size-trawell-cover wp-post-image"
                         alt="{{ $top_blog->meta_title }}" loading="lazy" srcset="" sizes="(max-width: 1920px) 100vw, 1920px"/>
                </a>
                <div class="entry-header element-pos-rel cover-entry">
                    <div class="entry-category justify-content-center md-pill-medium sm-pill-small">
                        @foreach($top_blog->categories as $top_blog_category)
                            <a href="{{ url($top_blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index + 1 }}">{{$top_blog_category->name}}</a>
                        @endforeach
                    </div>
                    <h3 class="entry-title display-1 md-h1 sm-h1 no-margin">
                        <a href="{{ url($top_blog->slug) }}">{{ $top_blog->title }}</a>
                    </h3>
                    <div class="entry-meta md-entry-meta-small sm-entry-meta-small">
                            <span class="meta-item meta-date">
                                <span class="updated">{{ Carbon\Carbon::parse($top_blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->locale('vi')->diffForHumans() }}</span>
                            </span>
    {{--                    <span class="meta-item meta-rtime">4 min read</span>--}}
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    <div class="trawell-main" style="padding-left: 1px; padding-right: 1px;">

        <!--    GOOGLE ADSENSE BEGIN -->
        @if (get_setting('google_adsense') == 1)
        @include('frontend.layouts.google_adsense_left')
        @endif
        <!--    GOOGLE ADSENSE END-->

        <div class="trawell-sections trawell-front-page">
{{--            <div class="trawell-section trawell-layout-cat-c2">--}}
{{--                <div class="container">--}}
{{--                    <h3 class="section-title h5">--}}
{{--                        <span>Top điểm đến</span>--}}
{{--                    </h3>--}}
{{--                    <div class="row">--}}
{{--                        @foreach ($categories as $category)--}}
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <article class="trawell-item item-overlay trawell-item-color-overlay text-center cat-item cat-item-1 post-195 page type-page status-publish hentry">--}}
{{--                                <a href="{{ url($category->slug) }}" class="entry-image">--}}
{{--                                    <img width="385" height="257" src="{{ uploaded_asset($category->meta_img) }}" class="attachment-trawell-cat-c2-sid size-trawell-cat-c2-sid" alt="{{ $category->meta_title }}" loading="lazy"/>--}}
{{--                                </a>--}}
{{--                                <div class="entry-header element-pos-center">--}}
{{--                                    <h3 class="entry-title h2 sm-h2 no-margin">--}}
{{--                                        <a href="{{ url($category->slug) }}">{{ $category->name }}</a>--}}
{{--                                    </h3>--}}
{{--                                    <div class="entry-meta">--}}
{{--                                        <span>8 articles</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </article>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


            <div class="trawell-section trawell-layout-b1">
                <div class="container">
{{--                BLOGS LISTING --}}
{{--                    <h3 class="section-title h5">--}}
{{--                        <span>Bài viết mới nhất</span>--}}
{{--                    </h3>--}}
{{--                    <div class="row trawell-posts">--}}
{{--                        @foreach($pagedBlogs as $blog)--}}
{{--                        <div class="col-12">--}}
{{--                            <article class="trawell-item row post type-post status-publish format-standard has-post-thumbnail hentry tag-blockquote tag-sidebar tag-single-post">--}}
{{--                                <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-center">--}}
{{--                                    <a href="{{ url($blog->slug) }}" class="entry-image">--}}
{{--                                        <img style="width: 200px;height: 200px"--}}
{{--                                             src="{{ uploaded_asset($blog->small_img) }}"--}}
{{--                                             class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"--}}
{{--                                             alt="{{ $blog->meta_title }}" loading="lazy" />--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-md-6 col-lg-7 col-xl-8 sm-no-left-padding">--}}
{{--                                    <div class="entry-header">--}}
{{--                                        <div class="entry-category pill-small">--}}
{{--                                            @foreach($blog->categories as $blog_category)--}}
{{--                                            <a href="{{ url($blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index + 1 }}">{{$blog_category->name}}</a>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}

{{--                                        <h3 class="entry-title h4 sm-h3">--}}
{{--                                            <a href="{{ url($blog->slug) }}" >{{ $blog->title }}</a>--}}
{{--                                        </h3>--}}
{{--                                        <div class="entry-meta entry-meta-small">--}}
{{--                                                <span class="meta-item meta-date">--}}
{{--                                                    <span class="updated">{{ $blog->display_date }}</span>--}}
{{--                                                </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="entry-content excerpt-small" style="text-align: justify">--}}
{{--                                        <p>{{ $blog->meta_description }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </article>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    @if ($pagedBlogs->links()->paginator->hasPages())--}}
{{--                        <div class="trawell-pagination alignnone">--}}
{{--                            {{ $pagedBlogs->links() }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                END BLOGS LISTING --}}

{{--                TERM META IMAGE WITH BLOG SMALL IMAGE    --}}
{{--                    <h3 class="section-title h5">--}}
{{--                        <span>{{ translate('Most interesting taxonomies') }}</span>--}}
{{--                    </h3>--}}
{{--                    @foreach($terms as $term)--}}
{{--                    <div class="row trawell-posts">--}}
{{--                        <div class="col-12">--}}
{{--                            <article class="trawell-item item-overlay trawell-item-gradient post type-post status-publish format-standard has-post-thumbnail hentry category-asia tag-blockquote tag-sidebar tag-single-post">--}}
{{--                                <a href="{{ url($term->slug) }}" class="entry-image">--}}
{{--                                    <img--}}
{{--                                        style="width: 100%; text-align: center; max-height: 1080px"--}}
{{--                                        src="{{ uploaded_asset($term->meta_img) }}"--}}
{{--                                        class="attachment-trawell-d2 size-trawell-d2 wp-post-image"--}}
{{--                                        alt="{{ $term->meta_title }}" loading="lazy" />--}}
{{--                                </a>--}}

{{--                                <div class="entry-header element-pos-abs element-pos-bottom">--}}
{{--                                    <h3 class="entry-title h2 md-h4 sm-h5 no-margin">--}}
{{--                                        <a href="{{ url($term->slug) }}">{{ $term->name }}</a></h3>--}}
{{--                                </div>--}}
{{--                            </article>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        @foreach($term->blogs as $blog)--}}
{{--                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">--}}
{{--                                <article class="trawell-item post-609 post type-post status-publish format-standard has-post-thumbnail hentry category-asia tag-blockquote tag-sidebar tag-single-post">--}}
{{--                                    <a href="{{ url($blog->slug) }}" class="entry-image">--}}
{{--                                        <img style="width: 200px;height: 200px"--}}
{{--                                             src="{{ uploaded_asset($blog->small_img) }}"--}}
{{--                                             class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"--}}
{{--                                             alt="{{ $blog->meta_title }}" loading="lazy" />--}}
{{--                                    <div class="entry-header">--}}
{{--                                        <h3 class="entry-title h6 md-h4 sm-h3 m-h1">--}}
{{--                                            <a href="{{ url($blog->slug) }}">{{ $blog->title }}</a>--}}
{{--                                        </h3>--}}
{{--                                        <div class="entry-meta entry-meta-small">--}}
{{--                                            @php--}}
{{--                                                $term_blog_display_date = Carbon\Carbon::parse($blog->display_date, 'UTC')->setTimezone('Asia/Bangkok');--}}
{{--                                            @endphp--}}
{{--                                            <span class="meta-item meta-date">--}}
{{--                                                <span class="updated">--}}
{{--                                                    {{ $term_blog_display_date->locale('vi')->diffForHumans() }}--}}
{{--                                                </span>--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </article>--}}
{{--                            </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <article class="trawell-item row post type-post status-publish format-standard has-post-thumbnail hentry tag-blockquote tag-sidebar tag-single-post">--}}
{{--                                <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-center">--}}
{{--                                    <a href="{{ url($blog->slug) }}" class="entry-image">--}}
{{--                                        <img style="width: 200px;height: 200px"--}}
{{--                                             src="{{ uploaded_asset($blog->small_img) }}"--}}
{{--                                             class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"--}}
{{--                                             alt="{{ $blog->meta_title }}" loading="lazy" />--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-md-6 col-lg-7 col-xl-8 sm-no-left-padding">--}}
{{--                                    <div class="entry-header">--}}
{{--                                        <div class="entry-category pill-small">--}}
{{--                                            @foreach($blog->categories as $blog_category)--}}
{{--                                                <a href="{{ url($blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index + 1 }}">{{$blog_category->name}}</a>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}

{{--                                        <h3 class="entry-title h4 sm-h3">--}}
{{--                                            <a href="{{ url($blog->slug) }}" >{{ $blog->title }}</a>--}}
{{--                                        </h3>--}}
{{--                                        <div class="entry-meta entry-meta-small">--}}
{{--                                            <span class="meta-item meta-date">--}}
{{--                                                <span class="updated">{{ $blog->display_date }}</span>--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="entry-content excerpt-small" style="text-align: justify">--}}
{{--                                        <p>{{ $blog->meta_description }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </article>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                END TERM META IMAGE WITH BLOG SMALL IMAGE    --}}

{{--                TERM SMALL IMAGE    --}}
                    <h3 class="section-title h5">
                        <span>{{ translate('Most interesting taxonomies') }}</span>
                    </h3>
                    <div class="row trawell-posts">
                        @foreach($terms as $term)
                            <div class="col-12">
                                <article class="trawell-item row post type-post status-publish format-standard has-post-thumbnail hentry tag-blockquote tag-sidebar tag-single-post">
                                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-center">
                                        <a href="{{ url($term->slug) }}" class="entry-image">
                                            <img style="width: 200px;height: 200px"
                                                 src="{{ uploaded_asset($term->small_img) }}"
                                                 class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"
                                                 alt="{{ $term->meta_title }}" loading="lazy" />
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-7 col-xl-8 sm-no-left-padding">
                                        <div class="entry-header">

                                            <h3 class="entry-title h4 sm-h3">
                                                <a href="{{ url($term->slug) }}" >{{ $term->name }}</a>
                                            </h3>
                                        </div>
                                        <div class="entry-content excerpt-small link-color" style="text-align: justify">
                                            <p>{{ $term->meta_description }}</p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach

                        @if ($terms->links()->paginator->hasPages())
                        <div class="trawell-pagination alignnone">
                        {{ $terms->links() }}
                        </div>
                        @endif
                    </div>

{{--                END TERM SMALL IMAGE    --}}




{{--                    <div class="trawell-pagination alignnone">--}}
{{--                        <nav class="navigation load-more">--}}
{{--                            <a href="https://alodi.net/trawell/?home=1&#038;paged=2">Load More</a>--}}
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
