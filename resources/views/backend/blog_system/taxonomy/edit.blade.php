@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Taxonomy Information')}}</h5>
                    <a href="{{ route('taxonomy.index') }}" class="btn btn-link text-reset">
                        <i class="las la-angle-left"></i>
                        <span>{{translate('Back to taxonomy list')}}</span>
                    </a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('taxonomy.update', $taxonomy->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Name')}}</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="{{ $taxonomy->name }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Slug')}}
                                <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="slug" id="slug" value="{{ $taxonomy->slug }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">{{translate('Link')}}</label>
                            <div class="col-md-9">
                            <a href="{{ url($taxonomy->slug) }}">{{ url($taxonomy->slug) }}</a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-from-label">{{ translate('Is Hierarchical') }}</label>
                            </div>
                            <div class="col-md-9">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="is_hierarchical" id="is_hierarchical" @php if ($taxonomy->is_hierarchical == 1) echo 'checked' @endphp />
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
                                    <input type="checkbox" name="show_on_header" id="show_on_header" @php if ($taxonomy->show_on_header == 1) echo 'checked' @endphp />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="description" rows="8" class="form-control">{{ $taxonomy->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{translate('Display Order')}}
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="display_order" class="form-control" value="{{ $taxonomy->display_order }}" id="display_order" placeholder="{{translate('Display Order')}}">
                                <small>{{translate('Higher number has high priority')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title" value="{{ $taxonomy->meta_title }}" placeholder="{{translate('Meta Title')}}">
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
                                    <input type="hidden" name="meta_img" class="selected-files" value="{{ $taxonomy->meta_img }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5" class="form-control">{{ $taxonomy->meta_description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{translate('Save')}}
                            </button>
                            <a href="{{route('taxonomy.index')}}" class="btn btn-outline-info">
                                {{translate('Cancel')}}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


