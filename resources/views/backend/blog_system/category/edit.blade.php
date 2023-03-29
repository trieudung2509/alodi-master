@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Blog Category Information')}}</h5>
                <a href="{{ route('category.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{translate('Back to blog category list')}}</span>
                </a>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}}</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Parent Category')}}</label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{ $category->parent_id }}">
                                <option value="0">{{ translate('No Parent') }}</option>
                                @foreach ($all_categories as $category_in_all_categories)
                                    <option value="{{ $category_in_all_categories->id }}">{{ $category_in_all_categories->name }}</option>
                                    @foreach ($category_in_all_categories->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Slug')}}</label>
                        <div class="col-md-9">
                            <input
                                @if (Auth::user()->user_type != 'admin')
                                readonly="readonly"
                                @endif
                                type="text" name="slug" id="slug" value="{{ $category->slug }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3">{{translate('Link')}}</label>
                        <div class="col-md-9">
                        <a href="{{ url($category->slug) }}">{{ url($category->slug) }}</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="col-from-label">{{ translate('Show On Home Page') }}</label>
                        </div>
                        <div class="col-md-9">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="show_on_home_page" id="show_on_home_page" @php if ($category->show_on_home_page == 1) echo 'checked' @endphp />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="col-from-label">{{ translate('Show On Header') }}</label>
                        </div>
                        <div class="col-md-9">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="show_on_header" id="show_on_header" @php if ($category->show_on_header == 1) echo 'checked' @endphp />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Display Order')}}
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="display_order" class="form-control" id="display_order" value="{{ $category->display_order }}" placeholder="{{translate('Display Order')}}">
                            <small>{{translate('Higher number has high priority')}}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                        <div class="col-md-9">
                            <textarea data-min-height="800" name="description" class="aiz-text-editor" data-format="true">{{ $category->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}" value="{{ $category->meta_title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">
                            {{translate('Meta Image')}}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="meta_img" class="selected-files" value="{{ $category->meta_img }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control">{{ $category->meta_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                        <a href="{{route('comment.index')}}" class="btn btn-outline-info">
                            {{translate('Cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
