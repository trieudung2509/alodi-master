@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Term Information')}}</h5>
                    <a href="{{ route('term.index') }}" class="btn btn-link text-reset">
                        <i class="las la-angle-left"></i>
                        <span>{{translate('Back to term list')}}</span>
                    </a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('term.update', $term->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Name')}}
                                <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="{{ $term->name }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Slug')}}
                                <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input
                                    @if (Auth::user()->user_type != 'admin')
                                    readonly="readonly"
                                    @endif
                                    type="text" name="slug" id="slug" value="{{ $term->slug }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-3">{{translate('Link')}}</label>
                        <div class="col-md-9">
                        <a href="{{ url($term->slug) }}">{{ url($term->slug) }}</a>
                        </div>
                    </div>

                        <div class="form-group row" id="taxonomy">
                            <label class="col-md-3 col-form-label">
                                {{translate('Taxonomy')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="taxonomy_id" id="taxonomy_id" data-live-search="true">
                                    @foreach ($taxonomies as $taxonomy)
                                        <option
                                            value="{{ $taxonomy->id }}"
                                            @if ($taxonomy->id == $term->taxonomy_id) selected @endif
                                        >
                                            {{ $taxonomy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-from-label">{{ translate('Show On Home Page') }}</label>
                            </div>
                            <div class="col-md-9">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="show_on_home_page" id="show_on_home_page" @php if ($term->show_on_home_page == 1) echo 'checked' @endphp />
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
                                    <input type="checkbox" name="show_on_header" id="show_on_header" @php if ($term->show_on_header == 1) echo 'checked' @endphp />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">
                                {{translate('Small Image')}}
                                <small>(200 x 200)</small>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse')}}
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="small_img" class="selected-files" value="{{ $term->small_img }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="description" rows="8" class="form-control">{{ $term->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{translate('Display Order')}}
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="display_order" class="form-control" value="{{ $term->display_order }}" id="display_order" placeholder="{{translate('Display Order')}}">
                                <small>{{translate('Higher number has high priority')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title" value="{{ $term->meta_title }}" placeholder="{{translate('Meta Title')}}">
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
                                    <input type="hidden" name="meta_img" class="selected-files" value="{{ $term->meta_img }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5" class="form-control">{{ $term->meta_description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{translate('Save')}}
                            </button>
                            <a href="{{route('term.index')}}" class="btn btn-outline-info">
                                {{translate('Cancel')}}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


