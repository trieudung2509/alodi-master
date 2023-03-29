@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Blog Information')}}</h5>
                <a href="{{ route('blog.index') }}" class="btn btn-link text-reset confirm-exit">
                    <i class="las la-angle-left"></i>
                    <span>{{translate('Back to blog list')}}</span>
                </a>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('blog.update',$blog->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Title')}}
                            <span class="text-danger">*</span>
                            <small>( {{ translate('Current characters: ') }} <span id="title-character-count">0</span> )</small>
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="title" name="title" value="{{ $blog->title }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Sub Title')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="sub_title" name="sub_title" value="{{ $blog->sub_title }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Slug')}}</label>
                        <div class="col-md-10">
                            <input
                                @if (Auth::user()->user_type != 'admin')
                                readonly="readonly"
                                @endif
                                type="text" name="slug" id="slug" value="{{ $blog->slug }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">{{translate('Link')}}</label>
                        <div class="col-md-10">
                            <a href="{{ url($blog->slug) }}">{{ url($blog->slug) }}</a>
                        </div>
                    </div>

                    <div class="form-group row" id="category">
                        <label class="col-md-2 col-from-label">
                            {{translate('Category')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <select
                                class="form-control aiz-selectpicker"
                                name="category_ids[]"
                                id="category_ids"
                                data-live-search="true"
                                multiple
                            >
                                @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @if(in_array($category->id, $blog->categories->map(function($item) {return $item->id;})->toArray())) selected @endif
                                >
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="category">
                        <label class="col-md-2 col-from-label">
                            {{translate('Terms')}}
                        </label>
                        <div class="col-md-10">
                            <select
                                class="form-control aiz-selectpicker"
                                name="term_ids[]"
                                id="term_ids"
                                data-live-search="true"
                                multiple
                            >
                                @foreach ($terms as $term)
                                    <option
                                        value="{{ $term->id }}"
                                        @if(in_array($term->id, $blog->terms->map(function($item) {return $item->id;})->toArray())) selected @endif
                                    >
                                        {{ $term->taxonomy_name . ' -> ' . $term->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-2 col-form-label">{{translate('Version')}}</label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            <input type="text" name="version" id="version" value="{{ $blog->version }}" class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{ translate('Featured') }}
                        </label>
                        <div class="col-md-10 col-form-label">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="featured" id="featured" @php if ($blog->featured == 1) echo 'checked' @endphp/>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{ translate('Published Date') }}
                        </label>
                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control aiz-date-range"
                                   data-single="true"
                                   data-future-disable="true"
                                   data-time-picker="true"
                                   data-format="DD-MM-Y HH:mm:ss"
                                   name="published_date"
                                   value="{{ \Carbon\Carbon::parse($blog->published_date, 'UTC')->setTimezone('Asia/Bangkok')->format('d-m-Y H:m:s') }}"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">
                            {{translate('Small Image')}}
                            <small>(200 x 200)</small>
                        </label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="small_img" class="selected-files" value="{{ $blog->small_img }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-2 col-form-label">{{translate('Source URL')}}</label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            <input type="text" name="source_url" id="source_url" value="{{ $blog->source_url }}" class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-2 col-form-label">--}}
{{--                            {{translate('Short Description')}}--}}
{{--                        </label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            <textarea name="short_description" rows="5" class="form-control">{{ $blog->short_description }}</textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">
                            {{translate('Description')}}
                            <br/><br/>
                            (<span id="total-words">{{ $blog->description_word_count }}</span> {{ translate("words") }})
                            <input type="hidden" id="input-total-words" name="description_word_count" value="{{ $blog->description_word_count }}">
                        </label>
                        <div class="col-md-10">
                            <textarea data-min-height="500" class="aiz-text-editor" name="description" data-format="true">{{ $blog->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_title" value="{{ $blog->meta_title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">
                            {{translate('Meta Image')}}
                        </label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="meta_img" class="selected-files" value="{{ $blog->meta_img }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{ translate('Meta Description') }}
                            <br>
                            <small>( {{ translate('Max length: 1000 characters') }} )</small>
                            <br>
                            <small>( {{ translate('Current characters: ') }} <span id="meta_description-character-count">0</span> )</small>
                        </label>
                        <div class="col-md-10">
                            <textarea id="meta_description" name="meta_description" rows="5" class="form-control" maxlength="1000">{{ $blog->meta_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Meta Keywords')}}
                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="4">{{ $blog->meta_keywords }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                        <a href="{{route('blog.index')}}" class="btn btn-outline-info confirm-exit">
                            {{translate('Cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.exit_modal')
@endsection
