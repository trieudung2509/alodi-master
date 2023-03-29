@extends('backend.layouts.app')

@section('content')
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="">
        <div class="alert alert-danger d-flex align-items-center">
            {{translate('Please Configure SMTP Setting to work all email sending functionality')}},
            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
        </div>
    </div>
@endif

<div class="row gutters-10">
    @if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
    <div class="col-sm-12">
        <div class="row gutters-10">
            <div class="col-6 col-sm-3">
                <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Users') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\User::count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Category') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Category::count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Posts') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Blog::count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Views') }}
                        </div>
                        @php
                            $total_page_views = $analytics_data->sum('pageViews');
                        @endphp
                        <div class="h3 fw-700 mb-3">{{ $total_page_views }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-sm-12">
        <div class="aiz-titlebar text-left mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <h1 class="h3">{{translate('All Posts')}}</h1>
                </div>
                <div class="col text-right">
                    <a href="{{ route('blog.create') }}" class="btn btn-circle btn-info">
                        <span>{{translate('Add New Post')}}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 aiz-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Title')}}</th>
                        <th data-breakpoints="xs">{{translate('Status')}}</th>
                        <th data-breakpoints="xs">{{translate('Views')}}</th>
                        <th data-breakpoints="sm">{{translate('Author')}}</th>
                        <th data-breakpoints="sm">{{translate('Last edited by')}}</th>
                        <th class="text-right">{{translate('Options')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $key => $blog)
                        <tr>
                            <td>
                                {{ ($key+1) + ($blogs->currentPage() - 1) * $blogs->perPage() }}
                            </td>
                            <td>
                                {{ $blog->title }}
                            </td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" onchange="change_status(this)"
                                           value="{{ $blog->id }}" <?php if ($blog->status == 1) echo "checked";?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                @php
                                    $data_for_this_blog = $analytics_data->filter(function($row, $key) use($blog){
                                        return $row['url'] == "/{$blog->slug}";
                                    })->first();
                                @endphp
                                @if ($data_for_this_blog != null && $data_for_this_blog['pageViews'] != null)
                                    {{ $data_for_this_blog['pageViews'] }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                {{ optional($blog->author)->name }}
                            </td>
                            <td>
                                {{ $blog->editor != null ? $blog->editor->name : "" }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                   href="{{ route('blog.edit',$blog->id)}}" title="{{ translate('Edit') }}">
                                    <i class="las la-pen"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

@section('script')

    <script type="text/javascript">
        function change_status(el) {
            var status = 0;
            if (el.checked) {
                var status = 1;
            }
            $.post('{{ route('blog.change-status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Change blog status successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection
