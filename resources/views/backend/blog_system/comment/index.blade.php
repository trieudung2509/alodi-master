@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('All Blog Comments')}}</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="sort_categories" action="" method="GET">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ translate('Message') }}</label>
                    <div class="col-md-7">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" name="search"
                                   @isset($sort_search) value="{{ $sort_search }}" @endisset>
                        </div>
                    </div>
                </div>

                <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('comment.index')}}" class="btn btn-outline-info confirm-exit">
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
                    <th>{{ translate('Blog Title') }}</th>
                    <th>{{translate('Message')}}</th>
                    <th data-breakpoints="lg">{{ translate('User') }}</th>
                    <th data-breakpoints="lg">{{ translate('Email') }}
                    <th>{{ translate('Approved') }}</th>
                    @if(Auth::user()->user_type == 'admin')
                    <th width="10%">{{translate('Options')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key => $comment)
                    <tr>
                        <td>{{ ($key+1) + ($comments->currentPage() - 1)*$comments->perPage() }}</td>
                        <td>{{ $comment->blog->title }}</td>
                        <td>{{ Str::words($comment->description, 15, '...') }}</td>
                        <td>{{ $comment->author_name }}</td>
                        <td>{{ $comment->author->email }}</td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="change_status(this)"
                                       value="{{ $comment->id }}" <?php if ($comment->is_approved == 1) echo "checked";?>>
                                <span></span>
                            </label>
                        </td>
                        <td>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                               href="{{ route('comment.edit',$comment->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-pen"></i>
                            </a>
                            @if(Auth::user()->user_type == 'admin')
                                <a href="#"
                                   class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                   data-href="{{route('comment.destroy', $comment->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')

    <script type="text/javascript">
        function change_status(el) {
            var status = 0;
            if (el.checked) {
                var status = 1;
            }
            $.post('{{ route('comment.change-status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                is_approved: status
            }, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Change comment status successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection
