@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Chỉnh sửa thông tin cơ bản của người dùng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control m-input" name="full_name" value="{{ old('full_name', $user->full_name) }}">
                                        @if ($errors->has('full_name'))
                                            <b class="text-danger">{{ $errors->first('full_name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Điện thoại</label>
                                        <input type="text" class="form-control m-input" name="phone" value="{{ old('phone', $user->phone) }}">
                                        @if ($errors->has('phone'))
                                            <b class="text-danger">{{ $errors->first('phone') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control m-input" name="address" value="{{ old('address', $user->address) }}">
                                        @if ($errors->has('address'))
                                            <b class="text-danger">{{ $errors->first('address') }}</b>
                                        @endif
                                    </div>
                                    @if ($user->role_id != config('common.roles.super_admin') )
                                    <div class="form-group m-form__group">
                                        <label>Vai trò</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            @foreach ($roles as $role)
                                                <option  
                                                    @if ($role->id === $user->role_id)
                                                        selected
                                                    @endif
                                                value="{{ $role->id }}">
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <b class="text-danger">{{ $errors->first('role_id') }}</b>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="form-group m-form__group">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" class="form-control m-input" name="password" value="{{ old('password') }}">
                                        @if ($errors->has('password'))
                                            <b class="text-danger">{{ $errors->first('password') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Xác nhận mật khẩu mới</label>
                                        <input type="password" id="password-confirm" class="form-control m-input" name="password_confirmation">
                                    </div>
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary">Sửa</button>
                                        <a class="btn btn-danger" href="{{ route('admin.users.index') }}">Quay lại</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
