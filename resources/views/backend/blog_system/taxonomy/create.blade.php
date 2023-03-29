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
                    <form class="form-horizontal" method="POST" action="{{ route('taxonomy.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Name')}}</label>
                            <div class="col-md-9">
                                <input type="text" onkeyup="makeSlug(this.value)" id="name" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Slug')}}
                                <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-from-label">{{ translate('Is Hierarchical') }}</label>
                            </div>
                            <div class="col-md-9">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="is_hierarchical" id="is_hierarchical" />
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
                                    <input type="checkbox" name="show_on_header" id="show_on_header" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="description" rows="8" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{translate('Display Order')}}
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="display_order" class="form-control" id="display_order" placeholder="{{translate('Display Order')}}">
                                <small>{{translate('Higher number has high priority')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
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
                                    <input type="hidden" name="meta_img" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5" class="form-control"></textarea>
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
    </script>
@endsection

