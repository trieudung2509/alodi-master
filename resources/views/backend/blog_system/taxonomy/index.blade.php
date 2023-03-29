@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('All Taxonomies')}}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ url('admin/taxonomy/create') }}" class="btn btn-primary">
                    <span>{{translate('Add New Taxonomy')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="sort_taxonomies" action="" method="GET">
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
                            <label class="col-md-5 col-form-label">{{ translate('Show On Header') }}</label>
                            <div class="col-md-7">
                                <select class="aiz-selectpicker" name="show_on_header">
                                    <option value="" @if ($show_on_header !== "1") selected @endif >{{ translate('All') }}</option>
                                    <option value="1" @if ($show_on_header === "1") selected @endif >{{ translate('Show On Header') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('taxonomy.index')}}" class="btn btn-outline-info confirm-exit">
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
                    <th>{{ translate('Is Hierarchical') }}</th>
                    <th>{{ translate('Show On Header') }}</th>
                    <th>{{ translate('Display Order') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taxonomies as $key => $taxonomy)
                    <tr>
                        <td>{{ ($key+1) + ($taxonomies->currentPage() - 1)*$taxonomies->perPage() }}</td>
                        <td>{{ $taxonomy->name }}</td>
                        <td>{{ $taxonomy->slug }}</td>
                        <td>{{ $taxonomy->is_hierarchical }}</td>
                        <td>{{ $taxonomy->show_on_header }}</td>
                        <td>{{ $taxonomy->display_order }}</td>
                        <td>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/taxonomy/'. $taxonomy->id.'/edit')}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            @if(Auth::user()->user_type == 'admin')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('taxonomy.destroy', $taxonomy->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $taxonomies->links() }}
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection
