@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@endsection

@section('meta_description'){{ $page->meta_description }}@endsection

@section('meta_keywords'){{ $page->tags }}@endsection

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $page->meta_title }}">
<meta itemprop="description" content="{{ $page->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($page->meta_img) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $page->meta_title }}">
<meta name="twitter:description" content="{{ $page->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($page->meta_img) }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $page->meta_title }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ URL($page->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($page->meta_img) }}" />
<meta property="og:description" content="{{ $page->meta_description }}" />
<meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('canonical') {{ url($page->slug) }} @endsection

@section('content')
<style>
    .trawell-header-shadow.trawell-header-indent #trawell-header {
        background-color: #098DA3
    }
</style>
<!-- <section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ $page->title }}</h1>
            </div>

        </div>
    </div>
</section> -->
<section class="trawell-posts">
    <div class="trawell-main">
        <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left" style="width: 50%; text-align: justify">
            <h1 class="fw-600 h4" style="text-align: center; font-size: 4.2rem; margin-top: 2rem; margin-block-start: 0.67rem; margin-block-end: 0.67rem; margin: 20px ;">{{ $page->title }}</h1>
            {!! $page->content !!}
        </div>
        <!--    SIDEBAR BEGIN-->
        @include('frontend.layouts.sidebar')
        <!--    SIDEBAR END-->
    </div>
</section>

    @if(Auth::user() != null)
        <!--    SWITCHER BEGIN-->
        @include('frontend.layouts.switcher')
        <!--    SWITCHER END-->
    @endif
@endsection
