@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Work Reports')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ url('admin/work-report/create') }}" class="btn btn-primary">
                <span>{{translate('Add New Work Report')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="sort_work_reports" action="" method="GET">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ translate('Blog Name') }}</label>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search"
                               @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    </div>
                </div>
            </div>

            @if(Auth::user()->user_type == 'admin') 
            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ translate('User Name') }}</label>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="user_search" name="user_search"
                               @isset($sort_search_user) value="{{ $sort_search_user }}" @endisset>
                    </div>
                </div>
            </div>
            @endif

            <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('work-report.index')}}" class="btn btn-outline-info confirm-exit">
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
                    <th>{{translate('Blog Name')}}</th>
                    <th data-breakpoints="lg">{{ translate('Work Type') }}</th>
                    <th data-breakpoints="lg">{{ translate('User Name') }}</th>
                    <th data-breakpoints="lg">{{ translate('Work Date') }}</th>
                    <th data-breakpoints="lg">{{ translate('Words Count') }}</th>
                    <th data-breakpoints="lg">{{ translate('Images Count') }}</th>
                    <th data-breakpoints="lg">{{ translate('Display Link') }}</th>  
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($work_reports as $key => $work_report)
                @if(Auth::user()->user_type != 'admin' 
                    && Auth::user()->id != App\User::find($work_report->user_id)->id)
                @continue
                @endif 
                <tr>
                    <td>{{ ($key+1) + ($work_reports->currentPage() - 1) * $work_reports->perPage() }}</td>
                    <td>{{ $work_report->blog_name }}</td> 
                    <td>
                        <?php
                        if ($work_report->is_created == 1)  {
                            echo "Create";
                        } else {
                            echo "Update";
                        }
                        ?>
                    </td>
                    <td>{{ $user_name = App\User::find($work_report->user_id)->name }}</td>
                    <td>
                        {{ Carbon\Carbon::parse($work_report->work_date, 'UTC')->setTimezone('Asia/Bangkok') }}
                    </td>
                    <td>{{ $work_report->words_count }}</td>
                    <td>{{ $work_report->images_count }}</td>
                    <td>{{ $work_report->display_link }}</td>
                    <td>
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/work-report/'.$work_report->id.'/edit')}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>
                        @if(Auth::user()->user_type == 'admin')
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('work-report.destroy', $work_report->id)}}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $work_reports->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
@include('modals.delete_modal')
@endsection

