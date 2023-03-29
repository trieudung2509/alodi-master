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
                <form id="add_form" class="form-horizontal" action="{{ route('blog.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Title')}}
                            <span class="text-danger">*</span>
                            <small>( {{ translate('Current characters: ') }} <span id="title-character-count">0</span> )</small>
                        </label>
                        <div class="col-md-10">
                            <input type="text" onkeyup="makeSlug(this.value)" id="title" name="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Sub Title')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="sub_title" name="sub_title" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Slug')}}
                            <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="slug" id="slug" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row" id="category">
                        <label class="col-md-2 col-form-label">
                            {{translate('Category')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="category_ids[]" id="category_ids" data-live-search="true" multiple>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="term">
                        <label class="col-md-2 col-form-label">
                            {{translate('Terms')}}
                        </label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="term_ids[]" id="term_ids" data-live-search="true" multiple>
                                @foreach ($terms as $term)
                                    <option value="{{ $term->id }}">
                                        {{ $term->taxonomy_name . ' -> ' . $term->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">{{translate('Version')}}</label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <input type="text" placeholder="{{translate('Version')}}" name="version" id="version" class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{ translate('Featured') }}
                        </label>
                        <div class="col-md-10 col-form-label">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="featured" id="featured" />
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
                                <input type="hidden" name="small_img" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">{{translate('Source URL')}}</label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <input type="text" placeholder="{{translate('Source URL')}}" name="source_url" id="source_url" class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">--}}
{{--                            {{translate('Short Description')}}--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <textarea name="short_description" rows="5" class="form-control" required=""></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">
                            {{translate('Description')}}
                            <br/><br/>
                            (<span id="total-words">0</span> {{ translate("words") }})
                            <input type="hidden" id="input-total-words" name="description_word_count">
                        </label>
                        <div class="col-md-10">
                            <textarea data-min-height="500" class="aiz-text-editor" name="description" data-format="true"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_title">
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
                                <input type="hidden" name="meta_img" class="selected-files">
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
                            <textarea id="meta_description" name="meta_description" rows="5" class="form-control" maxlength="1000"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Meta Keywords')}}
                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="4"></textarea>
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

@section('script')
<script>
    function makeSlug(val) {
        //Đổi chữ hoa thành chữ thường
        let slug = val.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $('#slug').val(slug);
    }

    $(document).ready(function () {
        $('#title').on("input", function() {
            var currentLength = $(this).val().length;
            $('#title-character-count').text(currentLength);
        });
        $('#meta_description').on("input", function () {
            var currentLength = $(this).val().length;
            $('#meta_description-character-count').text(currentLength);
        })
    });
</script>
@endsection
