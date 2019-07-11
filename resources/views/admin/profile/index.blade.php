@extends('admin.layouts.app')
@section('title') صفحه مدیریت پروفایل @endsection

@section('breadcrumb')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">صفحه مدیریت پروفایل</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">مدیریت پرفایل</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="pcoded-inner-content rtl text-right">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <!-- Profile -->
                        <div class="col-lg-8 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-user full-card"></i></span>
                                    <h5>ویرایش پروفایل</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <form action="{{route('admin.profile.update')}}" method="post" class="form-material">
                                        @csrf
                                        <div class="row">
                                            {{-- Name --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('name') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{old('name',auth('admin')->user()->name)}}" class="form-control isf" name="name" id="name">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('name'))
                                                        <span class="input-error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                    <label for="name" class="float-label">نام و نام خانوادگی</label>
                                                </div>
                                            </div>
                                            {{-- Email --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('email') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="email" value="{{old('name',auth('admin')->user()->email)}}" class="form-control ltr text-left isf" name="email" id="email">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('email'))
                                                        <span class="input-error">{{ $errors->first('email') }}</span>
                                                    @endif
                                                    <label for="email" class="float-label">ایمیل</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="submit" class="btn btn-info waves-effect waves-light w-100">ثبــــت</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="col-lg-4 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-lock full-card"></i></span>
                                    <h5>تغییر رمز عبور</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <form action="{{route('admin.profile.password')}}" method="post" class="form-material">
                                        @csrf
                                        <div class="row">

                                            {{-- Old Password --}}
                                            <div class="col-lg-12">
                                                <div class="form-group {{ $errors->has('old_password') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="password" class="form-control ltr text-left isf" name="old_password" id="old_password">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('old_password'))
                                                        <span class="input-error">{{ $errors->first('old_password') }}</span>
                                                    @endif
                                                    <label for="old_password" class="float-label">رمز عبور قبلی</label>
                                                </div>
                                            </div>

                                            {{-- New Password --}}
                                            <div class="col-lg-12">
                                                <div class="form-group {{ $errors->has('new_password') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="password" class="form-control ltr text-left isf" name="new_password" id="new_password">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('new_password'))
                                                        <span class="input-error">{{ $errors->first('new_password') }}</span>
                                                    @endif
                                                    <label for="new_password" class="float-label">رمز عبور جدید</label>
                                                </div>
                                            </div>

                                            {{-- Confirm Password --}}
                                            <div class="col-lg-12">
                                                <div class="form-group {{ $errors->has('new_password_confirmation') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="password" class="form-control ltr text-left isf" name="new_password_confirmation" id="new_password_confirmation">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('new_password_confirmation'))
                                                        <span class="input-error">{{ $errors->first('new_password_confirmation') }}</span>
                                                    @endif
                                                    <label for="new_password_confirmation" class="float-label"> تایید رمز عبور</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-info waves-effect waves-light w-100">ویــرایش</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('admin.partials.notify')
@endsection