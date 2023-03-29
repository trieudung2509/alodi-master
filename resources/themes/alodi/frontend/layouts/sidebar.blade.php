<aside class="trawell-sidebar">
    <div id="trawell_category_widget-2" class="widget trawell_category_widget widget_categories">
        <h4 class="widget-title h6">Top điểm đến</h4>
        <ul>
            @php
                $top_categories = \App\Category::with('posts')->where('show_on_home_page', '!=', 0)->get();
            @endphp
            @foreach($top_categories as $top_category)
            <li class="cat-item-{{ $loop->index + 1 }}">
                <a href="{{ url('', $top_category->slug) }}">
                    <span class="label">{{ $top_category->name }}</span>
                    <span class="count">{{ $top_category->posts->count() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="trawell-sidebar-sticky">
        <div id="trawell_posts_widget-2" class="widget trawell_posts_widget">
            <h4 class="widget-title h6">Bài viết phổ biến</h4>
            @foreach($popular_blogs as $popular_blog)
            <article class="trawell-item post type-post status-publish format-standard has-post-thumbnail hentry category-asia tag-blockquote tag-sidebar tag-single-post">
                <a href="{{ url($popular_blog->slug) }}" class="entry-image">
                    <img style="width: 60px;height: 60px" src="{{ uploaded_asset($popular_blog->small_img) }}" class="attachment-thumbnail size-thumbnail wp-post-image"
                         alt="{{ $popular_blog->meta_title }}" loading="lazy"/>
                </a>
                <div class="entry-header">
                    <a href="{{ url($popular_blog->slug) }}" class="h6 entry-title">{{ $popular_blog->title }}</a>
                    <div class="entry-meta entry-meta-small">
                        <span class="meta-item meta-date">
                            <span class="updated">{{ Carbon\Carbon::parse($popular_blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->locale('vi')->diffForHumans() }}</span>
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @if(get_setting('google_adsense') == 1)
            <div id="mks_ads_widget-4" class="widget-no-padding widget mks_ads_widget">
                <ul class="mks_adswidget_ul large">
                    <li data-showind="0">
                        <div style="width:300px; height:250px;">
                            {{--                        <a href="javascript:void(0);" class="mks-ep-trigger-open">--}}
                            {{--                            <img src="">--}}
                            {{--                        </a>--}}

                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxx"
                                    crossorigin="anonymous"></script>
                            <ins class="adsbygoogle"
                                 style="display:block; text-align:center;"
                                 data-ad-layout="in-article"
                                 data-ad-format="fluid"
                                 data-ad-client="ca-pub-xxxx"
                                 data-ad-slot="2422483744"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>

                        </div>
                    </li>
                </ul>
            </div>
    @endif
    
    </div>
</aside>
