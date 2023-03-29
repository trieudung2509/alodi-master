@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Blog Categories')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ url('admin/category/create') }}" class="btn btn-primary">
                <span>{{translate('Add New category')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="sort_categories" action="" method="GET">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ translate('Name') }}</label>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search"
                               @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    </div>
                </div>
            </div>

            <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('category.index')}}" class="btn btn-outline-info confirm-exit">
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
                    <th data-breakpoints="lg">{{ translate('Parent Category') }}</th>
                    <th data-breakpoints="lg">{{ translate('Display Order') }}</th>
                    <th data-breakpoints="lg">{{ translate('Level') }}</th>
                    <th>{{ translate('Blogs') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @php
                            $parent = \App\Category::where('id', $category->parent_id)->first();
                        @endphp
                        @if ($parent != null)
                            {{ $parent->name }}
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $category->display_order }}</td>
                    <td>{{ $category->level }}</td>
                    <td>{{ $category->posts->count() }}</td>
                    <td>
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/category/'.$category->id.'/edit')}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>
                        @if(Auth::user()->user_type == 'admin')
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('category.destroy', $category->id)}}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
@include('modals.delete_modal')
@endsection

