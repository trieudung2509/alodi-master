@extends('backend.layouts.app')

@section('content')

@if(Auth::user()->user_type == 'admin')
<div class="col-lg-7 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Role Information')}}</h5>
            <a href="{{ route('roles.index') }}" class="btn btn-link text-reset">
                <i class="las la-angle-left"></i>
                <span>{{translate('Back to role list')}}</span>
            </a>
        </div>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label" for="name">{{translate('Name')}}</label>
                    <div class="col-md-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Permissions') }}</h5>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label"></label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-form-label font-weight-bold">{{translate('Module')}}</label>
                            </div>
                            <div class="col-md-2 pr-15px pl-15px text-center">
                                <label class="col-form-label">{{translate('All Access')}}</label>
                            </div>
{{--                            <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                <label class="col-form-label">{{translate('Create')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                <label class="col-form-label">{{translate('Delete')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                <label class="col-form-label">{{translate('Publish')}}</label>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('Dashboard') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-10">--}}
{{--                                <label class="col-from-label">{{ translate('Marketing') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2 text-center">--}}
{{--                                <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="11">--}}
{{--                                    <span class="slider round"></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('Website Setup') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="13">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('Setup & Configurations') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="14">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('All Staffs') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="22" >
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('Uploaded Files') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="22">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="col-from-label">{{ translate('Blog System') }}</label>
                            </div>
                            <div class="col-md-2 text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="23">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    <a href="{{route('roles.index')}}" class="btn btn-sm btn-outline-info">{{translate('Cancel')}}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
