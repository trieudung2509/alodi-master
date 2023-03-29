@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Work Report Information')}}</h5>
                <a href="{{ route('work-report.index') }}" class="btn btn-link text-reset confirm-exit">
                    <i class="las la-angle-left"></i>
                    <span>{{translate('Back to Work Report list')}}</span>
                </a>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('work-report.update',$work_report->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Name')}}
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="blog_name" name="blog_name" value="{{ $work_report->blog_name}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row" id="is_created">
                        <label class="col-md-2 col-form-label">
                            {{translate('Work Type')}}
                        </label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="is_created" id="is_created" data-live-search="true" >
                            <option value="1" @if($work_report->is_created == 1) selected @endif> {{ translate('Create') }} </option>
                            <option value="0" @if($work_report->is_created == 0) selected @endif> {{ translate('Update') }} </option>
                            </select>
                        </div>
                    </div>

                    @if(Auth::user()->user_type == 'admin')
                    <div class="form-group row" id="user">
                        <label class="col-md-2 col-from-label">
                            {{translate('User Name')}}
                        </label>
                        <div class="col-md-10">
                            <select
                                class="form-control aiz-selectpicker"
                                name="user_id"
                                id="user_id"
                                data-live-search="true"
                            >
                                @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}"
                                    @if($user->id == $work_report->user_id) selected @endif
                                >
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{ translate('Work Date') }}
                        </label>
                        <div class="col-md-10">
                            <input type="text"
                                   class="form-control aiz-date-range"
                                   data-single="true"
                                   data-time-picker="true"
                                   data-format="DD-MM-Y HH:mm:ss"
                                   name="work_date" value="{{ \Carbon\Carbon::parse($work_report->work_date, 'UTC')->setTimezone('Asia/Bangkok')->format('d-m-Y H:m:s') }}"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Words Count')}}
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="words_count" name="words_count" value="{{ $work_report->words_count }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Images Count')}}
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="images_count" name="images_count" value="{{ $work_report->images_count }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Display Link')}}
                        </label>
                        <div class="col-md-10">
                            <input type="text" id="display_link" name="display_link" value="{{ $work_report->display_link}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Notes')}}
                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="notes" name="notes" rows="4">{{ $work_report->notes }}</textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                        <a href="{{route('work-report.index')}}" class="btn btn-outline-info confirm-exit">
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
