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
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                               href="{{ route('roles.edit', ['id'=>$role->id, 'lang'=> $language->code] ) }}">
                                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11"
                                     class="mr-1">
                                <span>{{$language->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <form class="p-4" action="{{ route('roles.update', $role->id) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label" for="name">{{translate('Name')}} <i
                                class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name"
                                   class="form-control" value="{{ $role->getTranslation('name', $lang) }}" required>
                        </div>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Permissions') }}</h5>
                    </div>
                    <br>
                    @php
                        $permissions = json_decode($role->permissions);
                    @endphp
                    <div class="form-group row">
                        <label class="col-md-2 col-from-label" for="banner"></label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="col-form-label font-weight-bold">{{translate('Module')}}</label>
                                </div>
                                <div class="col-md-2 pr-15px pl-15px text-center">
                                    <label class="col-form-label">{{translate('All Access')}}</label>
                                </div>
{{--                                <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                    <label class="col-form-label">{{translate('Create')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                    <label class="col-form-label">{{translate('Delete')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 pr-15px pl-15px text-center">--}}
{{--                                    <label class="col-form-label">{{translate('Publish')}}</label>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="col-from-label">{{ translate('Dashboard') }}</label>
                                </div>
                                <div class="col-md-2 text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="1" @php if(in_array(1, $permissions)) echo "checked"; @endphp>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-md-10">--}}
{{--                                    <label class="col-from-label">{{ translate('Marketing') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="11" @php if(in_array(11, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="col-from-label">{{ translate('Website Setup') }}</label>
                                </div>
                                <div class="col-md-2 text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="13" @php if(in_array(13, $permissions)) echo "checked"; @endphp>
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
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="14" @php if(in_array(14, $permissions)) echo "checked"; @endphp>
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
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="20" @php if(in_array(20, $permissions)) echo "checked"; @endphp>
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
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="22" @php if(in_array(22, $permissions)) echo "checked"; @endphp>
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
                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"
                                               value="23" @php if(in_array(23, $permissions)) echo "checked"; @endphp>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="230" @php if(in_array(230, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="2300" @php if(in_array(2300, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="23000"@php if(in_array(23000, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-md-10">--}}
{{--                                    <label class="col-from-label">{{ translate('Blog Categories') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="41" @php if(in_array(41, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="410" @php if(in_array(410, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 text-center">--}}
{{--                                    <label class="aiz-switch aiz-switch-success mb-0">--}}
{{--                                        <input type="checkbox" name="permissions[]" class="form-control demo-sw"--}}
{{--                                               value="4100" @php if(in_array(4100, $permissions)) echo "checked"; @endphp>--}}
{{--                                        <span class="slider round"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        <a href="{{route('roles.index')}}" class="btn btn-sm btn-outline-info">{{translate('Cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
@endsection
