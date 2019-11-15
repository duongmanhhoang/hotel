@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thông tin cá nhân
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="form-group m-form__group m--margin-top-10 col-xl-12">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <form method="post" action="{{ route('admin.users.updateInformation') }}">
                                            @csrf

                                            <div class="form-group m-form__group">
                                                <label>Họ và tên <b class="text-danger">*</b></label>
                                                <input type="text" class="form-control m-input" name="full_name"
                                                       value="{{ $user->full_name }}">
                                                @if ($errors->has('full_name'))
                                                    <b class="text-danger">{{ $errors->first('full_name') }}</b>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Điện thoại <b class="text-danger">*</b></label>
                                                <input type="text" class="form-control m-input" name="phone"
                                                       value="{{ $user->phone }}">
                                                @if ($errors->has('phone'))
                                                    <b class="text-danger">{{ $errors->first('phone') }}</b>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Địa chỉ</label>
                                                <input type="text" class="form-control m-input" name="address"
                                                       value="{{ $user->address }}">
                                                @if ($errors->has('address'))
                                                    <b class="text-danger">{{ $errors->first('address') }}</b>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group">
                                                <button class="btn btn-primary">Sửa thông tin</button>
                                                <a class="btn btn-danger" href="{{ route('admin.users.index') }}">Quay lại</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-xl-6">
                                        <form method="post" action="{{ route('admin.users.updatePassword') }}">
                                            @csrf
                                            <div class="form-group m-form__group">
                                                <label>Mật khẩu cũ <b class="text-danger">*</b></label>
                                                <input type="password" id="password_confirmation" class="form-control m-input" name="old_password">
                                                @if ($errors->has('old_password'))
                                                    <b class="text-danger">{{ $errors->first('old_password') }}</b>
                                                @endif
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label>mật khẩu mới <b class="text-danger">*</b></label>
                                                <input type="password" id="password_confirmation" class="form-control m-input" name="password">
                                                @if ($errors->has('password'))
                                                    <b class="text-danger">{{ $errors->first('password') }}</b>
                                                @endif
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label>Xác nhận mật khẩu <b class="text-danger">*</b></label>
                                                <input type="password" class="form-control m-input" name="password_confirmation"
                                                       value="{{ old('password_confirmation') }}">
                                            </div>
                                            <div class="form-group m-form__group">
                                                <button class="btn btn-primary">Cập nhật password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
