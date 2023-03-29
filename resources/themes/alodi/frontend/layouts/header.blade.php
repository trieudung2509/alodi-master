<header id="trawell-header" class="trawell-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="trawell-slot-l">
            <ul class="trawell-actions margin-padding-reset">
                <li class="trawell-actions-button trawell-hamburger-action">
                    <span class="trawell-hamburger">
                        <span>Menu</span>
                        <i class="o-menu-1"></i>
                    </span>
                </li>
            </ul>
        </div>
        <div class="trawell-slot-c trawell-slot-from-center">
            <div class="trawell-slot-f">
                <nav class="menu-main-1-container">
                    <ul class="menu-main">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            @php
                            $mien_bac = App\Category::with('childrenCategories')->where('name', 'like', 'Miền Bắc%')->first();
                            if ($mien_bac == null) {
                                $mien_bac = new \App\Category();
                                $mien_bac->name = 'Miền Bắc';
                                $mien_bac->slug = 'mien-bac';
                            }
                            @endphp
                            <a href="{{ url('category', $mien_bac->slug) }}" aria-current="page">{{ $mien_bac->name }}</a>
                            @if ($mien_bac->childrenCategories != null && $mien_bac->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_bac->childrenCategories as $category_of_mien_bac)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom" style="width: 33%;">
                                    <a href="{{ url('category', $category_of_mien_bac->slug) }}">{{ $category_of_mien_bac->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            @php
                            $mien_trung = App\Category::with('childrenCategories')->where('name', 'like', 'Miền Trung%')->first();
                            if ($mien_trung == null) {
                                $mien_trung = new \App\Category();
                                $mien_trung->name = 'Miền Trung';
                                $mien_trung->slug = 'mien-trung';
                            }
                            @endphp
                            <a href="{{ url('category', $mien_trung->slug) }}">{{ $mien_trung->name }}</a>
                            @if ($mien_trung->childrenCategories != null && $mien_trung->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_trung->childrenCategories as $category_of_mien_trung)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-283" style="width: 33%;">
                                    <a href="{{ $category_of_mien_trung->slug }}">{{ $category_of_mien_trung->name }}</a>
                                </li>
                                @endforeach
                                {{-- <li class="menu-item menu-item-has-children">--}}
                                {{-- <a href="#=279">Lâm Đồng</a>--}}
                                {{-- <ul class="sub-menu">--}}
                                {{-- <li class="menu-item">--}}
                                {{-- <a href="#?p=101">Đà Lạt</a>--}}
                                {{-- </li>--}}
                                {{-- <li class="menu-item">--}}
                                {{-- <a href="#?p=99">Bảo Lộc</a>--}}
                                {{-- </li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            @php
                            $mien_nam = App\Category::with('childrenCategories')->where('name', 'like', 'Miền Nam%')->first();
                            if ($mien_nam == null) {
                                $mien_nam = new \App\Category();
                                $mien_nam->name = 'Miền Nam';
                                $mien_nam->slug = 'mien-nam';
                            }
                            @endphp
                            <a href="{{ url('category', $mien_nam->slug) }}" aria-current="page">{{ $mien_nam->name }}</a>
                            @if ($mien_nam->childrenCategories != null && $mien_nam->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_nam->childrenCategories as $category_of_mien_nam)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom" style="width: 33%;">
                                    <a href="{{ url('category', $category_of_mien_nam->slug) }}">{{ $category_of_mien_nam->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="trawell-site-branding">
                <span class="site-title h1 ">
                    <a href="{{ url('') }}" rel="home">
                        <picture class="trawell-logo">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) }}" alt="Alodi">
                        </picture>
                    </a>
                </span>
            </div>
            <div class="trawell-slot-f">
                <nav class="menu-main-2-container">
                    <ul class="menu-main">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            <a href="#">Nổi bật</a>
                            @php
                            $noi_bat = App\Category::where('name', 'like', 'Tháng%')->get();
                            @endphp
                            @if ($noi_bat->count() > 0)
                            <ul class="sub-menu">
                                @foreach($noi_bat as $month)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="{{ url('category', $month->slug) }}">{{ $month->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            <a href="#">Gì cũng có</a>
                            @php
                            $kinh_nghiem = App\Category::with('childrenCategories')->where('name', 'like', 'Kinh nghiệm%')->first();
                            $chuan_bi = App\Category::with('childrenCategories')->where('name', 'like', 'Chuẩn bị%')->first();
                            $phuong_thuc_du_lich = App\Category::with('childrenCategories')->where('name', 'like', 'Phương thức du lịch%')->first()
                            @endphp
                            @if ($kinh_nghiem != null || $chuan_bi != null || $phuong_thuc_du_lich != null)
                            <ul class="sub-menu">
                                @if ($kinh_nghiem != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                    <a href="{{ url('category', $kinh_nghiem->slug) }}">{{ $kinh_nghiem->name }}</a>
                                    @if ($kinh_nghiem->childrenCategories != null && $kinh_nghiem->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($kinh_nghiem->childrenCategories as $category_of_kinh_nghiem)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_kinh_nghiem->slug) }}">{{ $category_of_kinh_nghiem->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                                @if ($chuan_bi != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-265">
                                    <a href="{{ url('category', $chuan_bi->slug) }}">{{ $chuan_bi->name }}</a>
                                    @if ($chuan_bi->childrenCategories != null && $kinh_nghiem->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($chuan_bi->childrenCategories as $category_of_chuan_bi)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_chuan_bi->slug) }}">{{ $category_of_chuan_bi->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                                @if ($phuong_thuc_du_lich != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-265">
                                    <a href="{{ url('category', $phuong_thuc_du_lich->slug) }}">{{ $phuong_thuc_du_lich->name }}</a>
                                    @if ($phuong_thuc_du_lich->childrenCategories != null && $phuong_thuc_du_lich->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($phuong_thuc_du_lich->childrenCategories as $category_of_phuong_thuc_du_lich)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_phuong_thuc_du_lich->slug) }}">{{ $category_of_phuong_thuc_du_lich->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-206">
                            <a href="#">Trải nghiệm</a>
                            @php
                            $choi_dau = App\Category::where('name', 'like', 'Chơi đâu%')->first();
                            $an_gi = App\Category::where('name', 'like', 'Ăn gì%')->first();
                            @endphp
                            @if ($choi_dau != null || $an_gi != null)
                            <ul class="sub-menu">
                                @if ($choi_dau != null)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-271">
                                    <a href="{{ url('category', $choi_dau->slug) }}">{{ $choi_dau->name }}</a>
                                </li>
                                @endif
                                @if ($an_gi != null)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-832">
                                    <a href="{{ url('category', $an_gi->slug) }}">{{ $an_gi->name }}</a>
                                </li>
                                @endif
                            </ul>
                            @endif
                        </li>
                        <li class="trawell-actions-button trawell-action-search">
                            <span>
                                <i class="o-search-1"></i>
                            </span>
                            <ul class="sub-menu" style="">
                                <li>
                                    <form class="trawell-search-form" action="{{route('home')}}" method="GET">
                                        <input name="query" type="text" value="" placeholder="Nhập để tìm kiếm...">
                                        <button type="submit" class="trawell-button trawell-button-large">Tìm kiếm</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="trawell-slot-r">
            <ul class="trawell-actions margin-padding-reset">
                <li class="trawell-actions-button trawell-action-search" style="padding-top:25%">
                    <span>
                        <i class="o-search-1"></i>
                    </span>
                    <ul class="sub-menu" style="">
                        <li>
                            <form class="trawell-search-form" action="{{route('home')}}" method="GET">
                                <input name="query" type="text" value="" placeholder="Nhập để tìm kiếm...">
                                <button type="submit" class="trawell-button trawell-button-large">Tìm kiếm</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="trawell-header trawell-header-sticky">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="trawell-slot-l">
            <ul class="trawell-actions margin-padding-reset">
                <li class="trawell-actions-button trawell-hamburger-action">
                    <span class="trawell-hamburger">
                        <span>Menu</span>
                        <i class="o-menu-1"></i>
                    </span>
                </li>
            </ul>
        </div>
        <div class="trawell-slot-c trawell-slot-from-center">
            <div class="trawell-slot-f">
                <nav class="menu-main-1-container">
                    <ul class="menu-main">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-195 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-200">
                            <a href="{{ url('category', $mien_bac->slug) }}" aria-current="page">{{ $mien_bac->name }}</a>
                            @if ($mien_bac->childrenCategories != null && $mien_bac->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_bac->childrenCategories as $category_of_mien_bac)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom" style="width: 33%;">
                                    <a href="{{ url('category', $category_of_mien_bac->slug) }}">{{ $category_of_mien_bac->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-203">
                            <a href="{{ url('category', $mien_trung->slug) }}">{{ $mien_trung->name }}</a>
                            @if ($mien_trung->childrenCategories != null && $mien_trung->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_trung->childrenCategories as $category_of_mien_trung)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-283" style="width: 33%;">
                                    <a href="{{ $category_of_mien_trung->slug }}">{{ $category_of_mien_trung->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                            <a href="{{ url('category', $mien_nam->slug) }}" aria-current="page">{{ $mien_nam->name }}</a>
                            @if ($mien_nam->childrenCategories != null && $mien_nam->childrenCategories->count() > 0)
                            <ul class="sub-menu ba-mien">
                                @foreach ($mien_nam->childrenCategories as $category_of_mien_nam)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom" style="width: 33%;">
                                    <a href="{{ url('category', $category_of_mien_nam->slug) }}">{{ $category_of_mien_nam->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="trawell-site-branding">
                <span class="site-title h1 " style="margin-top:0">
                    <a href="{{ url('') }}" rel="home">
                        <picture class="trawell-logo">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) }}" alt="Alodi">
                        </picture>
                    </a>
                </span>
            </div>
            <div class="trawell-slot-f">
                <nav class="menu-main-2-container">
                    <ul id="menu-main-4" class="menu-main">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-204">
                            <a href="#">Nổi bật</a>
                            @php
                            $noi_bat = App\Category::where('name', 'like', 'Tháng%')->get();
                            @endphp
                            @if ($noi_bat->count() > 0)
                            <ul class="sub-menu">
                                @foreach($noi_bat as $month)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="{{ url('category', $month->slug) }}">{{ $month->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-205">
                            <a href="#">Gì cũng có</a>
                            @if ($kinh_nghiem != null || $chuan_bi != null || $phuong_thuc_du_lich != null)
                            <ul class="sub-menu">
                                @if ($kinh_nghiem != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                    <a href="{{ url('category', $kinh_nghiem->slug) }}">{{ $kinh_nghiem->name }}</a>
                                    @if ($kinh_nghiem->childrenCategories != null && $kinh_nghiem->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($kinh_nghiem->childrenCategories as $category_of_kinh_nghiem)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_kinh_nghiem->slug) }}">{{ $category_of_kinh_nghiem->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                                @if ($chuan_bi != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-265">
                                    <a href="{{ url('category', $chuan_bi->slug) }}">{{ $chuan_bi->name }}</a>
                                    @if ($chuan_bi->childrenCategories != null && $kinh_nghiem->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($chuan_bi->childrenCategories as $category_of_chuan_bi)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_chuan_bi->slug) }}">{{ $category_of_chuan_bi->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                                @if ($phuong_thuc_du_lich != null)
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-265">
                                    <a href="{{ url('category', $phuong_thuc_du_lich->slug) }}">{{ $phuong_thuc_du_lich->name }}</a>
                                    @if ($phuong_thuc_du_lich->childrenCategories != null && $phuong_thuc_du_lich->childrenCategories->count())
                                    <ul class="sub-menu">
                                        @foreach ($phuong_thuc_du_lich->childrenCategories as $category_of_phuong_thuc_du_lich)
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="{{ url('category', $category_of_phuong_thuc_du_lich->slug) }}">{{ $category_of_phuong_thuc_du_lich->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            </ul>
                            @endif
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-206">
                            <a href="#">Trải nghiệm</a>
                            @if ($choi_dau != null || $an_gi != null)
                            <ul class="sub-menu">
                                @if ($choi_dau != null)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-271">
                                    <a href="{{ url('category', $choi_dau->slug) }}">{{ $choi_dau->name }}</a>
                                </li>
                                @endif
                                @if ($an_gi != null)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-832">
                                    <a href="{{ url('category', $an_gi->slug) }}">{{ $an_gi->name }}</a>
                                </li>
                                @endif
                            </ul>
                            @endif
                        </li>
                        <li class="trawell-actions-button trawell-action-search">
                            <span>
                                <i class="o-search-1"></i>
                            </span>
                            <ul class="sub-menu" style="">
                                <li>
                                    <form class="trawell-search-form" action="{{route('home')}}" method="GET">
                                        <input name="query" type="text" value="" placeholder="Nhập để tìm kiếm...">
                                        <button type="submit" class="trawell-button trawell-button-large">Tìm kiếm</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="trawell-slot-r">
            <ul class="trawell-actions margin-padding-reset">
                <li class="trawell-actions-button trawell-action-search" style="padding-top: 25%">
                <span>
                    <i class="o-search-1"></i>
                </span>
                    <ul class="sub-menu" style="">
                        <li>
                            <form class="trawell-search-form" action="{{route('home')}}" method="GET">
                                <input name="query" type="text" value="" placeholder="Nhập để tìm kiếm...">
                                <button type="submit" class="trawell-button trawell-button-large">Tìm kiếm</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</div>
