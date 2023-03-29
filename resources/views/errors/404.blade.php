@extends('frontend.layouts.app')

@section('meta_title'){{ translate('Page Not Found') }}@endsection

@section('meta_description'){{ translate('Page Not Found') }}@endsection

@section('meta_keywords'){{ translate('Page Not Found') }}@endsection

@section('content')
    <style>
        .trawell-header-shadow.trawell-header-indent #trawell-header {
            background-color: #098DA3
        }

        @media (min-width: 730px) {
            .trawell-main-inline .container,.trawell-has-sidebar .trawell-main,.trawell-sidebar-none .trawell-main {
                max-width: 860px;
                padding-right: 30px;
                padding-left: 30px;
                padding-bottom: 400px;
            }
        }

        @media (min-width: 730px) {
            #main-404 {
                padding-bottom: 300px;
            }
        }

        @media (max-width: 729px) {
            #main-404 {
                padding-bottom: 650px;
            }
        }
    </style>
<section class="text-center py-6" >
	<div class="container">
		<div id="main-404" class="row justify-content-center" >
			<div class="col-lg-6 mx-auto">
				<img src="{{ static_asset('assets/img/404.svg') }}" class="mw-100 mx-auto mb-5" height="300" alt="404 Not Found">
			    <h1 class="fw-700">{{ translate('Page Not Found!') }}</h1>
			    <p class="fs-16 opacity-60">{{ translate('The page you are looking for has not been found on our server.') }}</p>
			</div>
		</div>
    </div>
</section>
@endsection
