@extends('frontend.layouts.app')

@section('meta_title')Alodi - {{ $searchString }}@endsection

@section('meta_description')Kết quả tìm kiếm @endsection

@section('meta_keywords'){{ $searchString }}@endsection

@section('canonical'){{ url('') }} @endsection

@section('content')

    <style>
        .trawell-header-shadow.trawell-header-indent #trawell-header {
            background-color: #098DA3
        }
    </style>
    <div class="trawell-main" >
        <div class="trawell-sections trawell-front-page">
            <div class="trawell-section trawell-layout-d2">
                <div class="container">
                    <div class="archive-heading trawell-entry">
                        <h1 class="archive-title h1 md-h1 sm-h1">Kết quả tìm kiếm cho: {{ $searchString }}</h1>
                        <br/>
                        <form class="trawell-search-form" action="{{ route('home') }}" method="GET">
                            <input name="query" type="text" value="" placeholder="Nhập để tìm kiếm...">
                            <button type="submit" class="trawell-button trawell-button-large">Tìm kiếm</button><br>
                        </form>
                    </div>


                    <div class="row trawell-posts">
                        @if($blogs->isEmpty())
                            <p>Xin lỗi, nhưng chúng tôi không tìm thấy kết quả</p>
                        @else
                            @foreach($blogs as $blog)
                                <div class="col-12">
                                    <article class="trawell-item row post type-post status-publish format-standard has-post-thumbnail hentry tag-blockquote tag-sidebar tag-single-post">
                                        <div class="col-12 col-md-4 offset-md-1 text-center">
                                            <a href="{{ url($blog->slug) }}" class="entry-image">
                                                <img style="width: 200px"
                                                     src="{{ uploaded_asset($blog->small_img) }}"
                                                     class="attachment-trawell-b1-sid size-trawell-b1-sid wp-post-image"
                                                     alt="{{ $blog->meta_title }}" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="col-12 col-md-6 sm-no-left-padding">
                                            <div class="entry-header">
                                                <div class="entry-category pill-small">
                                                    @foreach($blog->categories as $blog_category)
                                                        <a href="{{ url($blog_category->slug) }}" rel="tag" class="cat-{{ $loop->index }}">{{$blog_category->name}}</a>
                                                    @endforeach
                                                </div>

                                                <h3 class="entry-title h4 sm-h3">
                                                    <a href="{{ url($blog->slug) }}" >{{ $blog->title }}</a>
                                                </h3>
                                                <div class="entry-meta entry-meta-small">
                                                <span class="meta-item meta-date">
                                                    <span class="updated">{{ $blog->display_date }}</span>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="entry-content excerpt-small">
                                                <p>{{ $blog->short_description }}</p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--    SIDEBAR BEGIN-->
        @include('frontend.layouts.sidebar')
        <!--    SIDEBAR END-->
    </div>

    @if(Auth::user() != null)
        <!--    SWITCHER BEGIN-->
        @include('frontend.layouts.switcher')
        <!--    SWITCHER END-->
    @endif

@endsection
