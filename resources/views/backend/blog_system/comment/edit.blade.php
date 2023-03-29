@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Comment Information')}}</h5>
                    <a href="{{ route('comment.index') }}" class="btn btn-link text-reset">
                        <i class="las la-angle-left"></i>
                        <span>{{translate('Back to comment list')}}</span>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('comment.update', $comment->id) }}" class="form-horizontal" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label class="col-md-3">{{translate('Blog Title')}}</label>
                            <div class="col-md-9">
                                <span name="blog_title" class="">{{ $comment->blog->title }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">{{translate('Slug')}}</label>
                            <div class="col-md-9">
                                <span name="slug" class="">{{ $comment->blog->slug }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 " >{{translate('Link')}}</label>
                            <div class="col-md-9" >
                            <a href="{{ url($comment->blog->slug) }}">{{ url($comment->blog->slug) }}</a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">{{translate('User')}}</label>
                            <div class="col-md-9">
                                <span name="author_name" class="">{{ $comment->author_name }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">{{translate('Email')}}</label>
                            <div class="col-md-9">
                                <span name="author_email" class="">{{ $comment->author->email }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Message')}}</label>
                            <div class="col-md-9">
                                <textarea rows="10" name="description" class="form-control">{{ $comment->description }}</textarea>
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
