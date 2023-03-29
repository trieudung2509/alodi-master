@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('All Terms')}}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ url('admin/term/create') }}" class="btn btn-primary">
                    <span>{{translate('Add New Term')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="sort_terms" action="" method="GET">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="search" name="search" placeholder="{{ translate('Name') }}"
                                       @isset($sort_search) value="{{ $sort_search }}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="{{ translate('Slug') }}"
                                       @isset($sort_slug) value="{{ $sort_slug }}" @endisset>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">{{ translate('Show On Home Page') }}</label>
                            <div class="col-md-7">
                                <select class="aiz-selectpicker" name="show_on_home_page">
                                    <option value="" @if ($show_on_home_page !== "1") selected @endif >{{ translate('All') }}</option>
                                    <option value="1" @if ($show_on_home_page === "1") selected @endif >{{ translate('Show On Home Page') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="taxonomy_name" name="taxonomy_name" placeholder="{{ translate('Taxonomy Name') }}"
                                       @isset($sort_taxonomy) value="{{ $sort_taxonomy }}" @endisset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('term.index')}}" class="btn btn-outline-info confirm-exit">
                            {{translate('Clear')}}
                        </a>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{ translate('Slug') }}</th>
                    <th data-breakpoints="lg">{{ translate('Taxonomy Name') }}</th>
                    <th>{{ translate('Show On Home Page') }}</th>
                    <th>{{ translate('Show On Header') }}</th>
                    <th>{{ translate('Display Order') }}</th>
                    <th>{{ translate('Blogs') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($terms as $key => $term)
                    <tr>
                        <td>{{ ($key+1) + ($terms->currentPage() - 1)*$terms->perPage() }}</td>
                        <td>{{ $term->name }}</td>
                        <td>{{ $term->slug }}</td>
                        <td>{{ $term->taxonomy_name }}</td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="change_show_on_home_page(this)"
                                       value="{{ $term->id }}" <?php if ($term->show_on_home_page == 1) echo "checked";?>>
                                <span></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="change_show_on_header(this)"
                                       value="{{ $term->id }}" <?php if ($term->show_on_header == 1) echo "checked";?>>
                                <span></span>
                            </label>
                        </td>
                        <td>{{ $term->display_order }}</td>
                        <td>{{ $term->blogs->count() }}</td>
                        <td>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/term/'. $term->id.'/edit')}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            @if(Auth::user()->user_type == 'admin')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('term.destroy', $term->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $terms->links() }}
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')

    <script type="text/javascript">
        function change_show_on_home_page(el) {
            var show_on_home_page = 0;
            if (el.checked) {
                var show_on_home_page = 1;
            }
            $.post('{{ route('term.change-show-on-home-page') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                show_on_home_page: show_on_home_page
            }, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Change successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

    <script type="text/javascript">
        function change_show_on_header(el) {
            var show_on_header = 0;
            if (el.checked) {
                var show_on_header = 1;
            }
            $.post('{{ route('term.change-show-on-header') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                show_on_header: show_on_header
            }, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Change successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection

