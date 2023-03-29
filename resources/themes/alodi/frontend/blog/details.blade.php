@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@endsection

@section('meta_description'){{ $blog->meta_description }}@endsection

@section('meta_keywords'){{ $blog->meta_keywords }}@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('canonical'){{ url($blog->slug) }} @endsection

@section('content')

    <!--            the body-->


    <div class="trawell-cover">
        <div
            class="trawell-cover-item item-overlay trawell-item-color-overlay trawell-flex align-items-center justify-content-center text-center">
            <a href="{{ url($blog->slug) }}" class="entry-image">
                @php
                    $url_image_blog = '';
                    $upload = \App\Upload::where('id', $blog->meta_img)->first();
                    if ($upload != null) {
                        $url_image_blog = URL::to('/public/').'/'.$upload->file_name;
                    }
                @endphp
                <img width="1920" height="1080"
                     src="{{ $url_image_blog }}" class="attachment-trawell-cover size-trawell-cover wp-post-image"
                     alt="{{ $blog->meta_title }}" loading="lazy"/>
            </a>
            <div class="entry-header element-pos-rel cover-entry">
                <div class="entry-category justify-content-center md-pill-medium sm-pill-small">
                    @foreach($blog->categories as $blog_category)
                        <a href="{{ url($blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index + 1 }}">{{$blog_category->name}}</a>
                    @endforeach
                </div>
                <h3 class="entry-title display-1 md-h1 sm-h1 no-margin">
                    <a href="{{ url($blog->slug) }}">{{ $blog->title }}</a>
                </h3>
                <div class="entry-meta md-entry-meta-small sm-entry-meta-small">
                    <span class="meta-item meta-date">
                        <span class="updated">{{ Carbon\Carbon::parse($blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->locale('vi')->diffForHumans() }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="trawell-main" style="padding-left: 1px; padding-right: 1px;">

        <!--    GOOGLE ADSENSE BEGIN-->
        @if (get_setting('google_adsense') == 1)
        @include('frontend.layouts.google_adsense_left')
        @endif
        <!--    GOOGLE ADSENSE END-->

        <div class="trawell-entry trawell-section">
            <article
                class="trawell-post-single trawell-item post type-post status-publish format-standard has-post-thumbnail tag-blockquote tag-sidebar tag-single-post">
                <div class="entry-header">
                    <h1 class="entry-title h1 md-h1 sm-h1">{{ $blog->title }}</h1>
                    <div class="entry-meta sm-entry-meta-small">
                        <span class="meta-item meta-date">
                            <span class="updated">{{ Carbon\Carbon::parse($blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->locale('vi')->translatedFormat('j F Y, h:i') }}</span>
                        </span>
                    </div>
                </div>
                @if(get_setting('google_adsense') == 1)
                    <br/>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxx"
                            crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-full-width-responsive="true"
                         data-ad-format="auto"
                         data-ad-client="ca-pub-xxxx"
                         data-ad-slot="9815557870"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <br/>
                @endif
                <div class="entry-content link-color">
                    {!! $blog->description !!}
{{--                    <div class="entry-tags">--}}
{{--                        <a href="/trawell/?tag=blockquote" rel="tag">blockquote</a>--}}
{{--                        <a href="/trawell/?tag=sidebar" rel="tag">sidebar</a>--}}
{{--                        <a href="/trawell/?tag=single-post" rel="tag">single post</a>--}}
{{--                    </div>--}}
                </div>
                @if(get_setting('google_adsense') == 1)
                    <br/>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxx"
                            crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-full-width-responsive="true"
                         data-ad-format="auto"
                         data-ad-client="ca-pub-xxxx"
                         data-ad-slot="9815557870"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <br/>
                @endif
            </article>
{{--            <div class="trawell-section trawell-layout-b2 trawell-related">--}}
{{--                <div class="container">--}}
{{--                    <h3 class="section-title h5">--}}
{{--                        <span>Related posts</span>--}}
{{--                    </h3>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            <article class="trawell-item row">--}}
{{--                                <div class="col-5">--}}
{{--                                    <a href="/trawell/?p=80" class="entry-image">--}}
{{--                                        <img width="385" height="217"--}}
{{--                                             src="/trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-385x217.jpg"--}}
{{--                                             class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image" alt=""--}}
{{--                                             loading="lazy"--}}
{{--                                             srcset="/trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-385x217.jpg 385w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-1200x675.jpg 1200w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-800x450.jpg 800w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-585x330.jpg 585w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-380x214.jpg 380w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-247x139.jpg 247w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-278x157.jpg 278w, /trawell/wp-content/uploads/2018/02/deanna-ritchie-227649-unsplash-178x101.jpg 178w"--}}
{{--                                             sizes="(max-width: 385px) 100vw, 385px"/>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-7 no-left-padding">--}}
{{--                                    <div class="entry-header">--}}
{{--                                        <div class="entry-category color-text">--}}
{{--                                            <a href="/trawell/?cat=4" rel="tag" class="cat-4">Asia</a>--}}
{{--                                        </div>--}}
{{--                                        <h3 class="entry-title h4 sm-h6">--}}
{{--                                            <a href="/trawell/?p=80">Staying at Coconut Garden beach resort in--}}
{{--                                                Indonesia</a>--}}
{{--                                        </h3>--}}
{{--                                        <div class="entry-meta entry-meta-small">--}}
{{--                        <span class="meta-item meta-date">--}}
{{--                          <span class="updated">2 weeks ago</span>--}}
{{--                        </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </article>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            @if ($blog->comments != null && $blog->comments->count() > 0)
                @php
                    $approved_comments = $blog->comments->where('is_approved', '!=', 0);
                    $unapproved_comments = $blog->comments->where('is_approved', '=', 0);
                @endphp
                <h4 id="comments" class="section-title h5">
                    <span>{{ translate('Comments') }}</span>
                </h4>
                <ul class="comment-list">
                    @foreach ($approved_comments as $comment)
                        <li id="comment-{{ $comment->id }}" class="comment even thread-even depth-1">
                            <article id="div-comment-{{ $comment->id }}" class="comment-body">
                                <footer class="comment-meta">
                                    <div class="comment-author vcard">
                                        <img src="{{ static_asset('assets/img/avatar-place.png') }}" class='avatar avatar-60 photo' height='60' width='60' loading='lazy' />
                                        <b class="fn">{{ $comment->author_name }}</b>
                                    </div>
                                    <div class="comment-metadata">
                                        <a href="#comment-{{ $comment->id }}">
                                            <time datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
                                        </a>
                                    </div>
                                </footer>
                                <!-- .comment-meta -->
                                <div class="comment-content" style="text-align: justify;">{{ $comment->description }}</div>
                                <!-- .comment-content -->
                            </article>
                            <!-- .comment-body -->
                        </li>
                    @endforeach

                    @if ($unapproved_comments->count() > 0)
                            <li id="unapproved-comment" class="comment even thread-even depth-1">
                                <article class="comment-body">
                                    <footer class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="user-avatar" class='avatar avatar-60 photo' height='60' width='60' loading='lazy' />
                                            <b class="fn">{{ translate('Me') }}</b>
                                        </div>
                                        <em class="comment-awaiting-moderation" style="text-align: justify;">Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.</em>
                                    </footer>
                                </article>
                            </li>
                    @endif
                    <!-- #comment-## -->
                </ul>
            @endif

            <br/>
            <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="section-title h5">
                    {{ translate('Leave a reply') }}
                </h3>
                <form action="{{ route('blog.comment', ['slug' => $blog->slug]) }}" method="post" id="commentform" class="comment-form">
                    @csrf
                    <p class="comment-notes">
                        <span id="email-notes">{{ translate('Your email address will not be published.') }}</span>
                        <span class="required-field-message" aria-hidden="true">{{ translate('Required fields are marked') }} <span class="required" aria-hidden="true">*</span></span>
                    </p>
                    <p class="comment-form-comment">
                        <label for="comment">{{ translate('Message') }} <span class="required" aria-hidden="true">*</span>
                        </label>
                        <textarea id="comment" name="description" cols="45" rows="8" maxlength="65525" required></textarea>
                    </p>
                    <p class="comment-form-author">
                        <label for="author">{{ translate('Name') }} <span class="required" aria-hidden="true">*</span>
                        </label>
                        <input id="author" name="author_name" type="text" value="" size="30" maxlength="245" required />
                    </p>
                    <p class="comment-form-email">
                        <label for="email">{{ translate('Email') }} <span class="required" aria-hidden="true">*</span>
                        </label>
                        <input id="email" name="author_email" type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" size="30" maxlength="100" aria-describedby="email-notes" required />
                    </p>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p class="form-submit">
                        <input name="add_comment"
                               type="submit"
                               id="add_comment"
                               value="{{ translate('Add Comment') }}"
                                @if(get_setting('google_recaptcha') == 1)
                                    class="g-recaptcha submit"
                                     data-sitekey="{{ env('CAPTCHA_KEY') }}"
                                    data-callback="onSubmit"
                                    data-action="submit"
                                @else
                                    class="submit"
                                @endif
                            />
                        <input type='hidden' name='blog_id' value='{{ $blog->id }}' id='blog_id' />
                    </p>

                </form>
            </div>
        </div>
        @if(get_setting('google_adsense') == 1)
            <script>
                jQuery(document).ready(function () {
                    if (!!document.querySelector('.entry-content h2:nth-of-type(3)')) {
                        var middleH2 = document.querySelector('.entry-content h2:nth-of-type(3)');

                        // Create script element
                        var script = document.createElement('script');
                        script.async = true;
                        script.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6864443082899760";
                        script.setAttribute('crossorigin', 'anonymous');

                        middleH2.appendChild(script)

                        // Create INS element
                        var ins = document.createElement('ins');
                        ins.className = "adsbygoogle";
                        ins.style = "display:block;text-align:center;";
                        ins.setAttribute('data-full-width-responsive', "true");
                        ins.setAttribute('data-ad-layout', "in-article");
                        ins.setAttribute('data-ad-format', "auto");
                        ins.setAttribute('data-ad-client', "ca-pub-6864443082899760");
                        ins.setAttribute('data-ad-slot', "9815557870");


                        middleH2.appendChild(ins);
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                })
            </script>
        @endif



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
    @if (get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("commentform").submit();
            }
        </script>
    @endif
@endsection

