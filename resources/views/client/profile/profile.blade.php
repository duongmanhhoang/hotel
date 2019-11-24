@extends('client.layouts.profileLayout')
@section('content')
    <div class="db-cent-1">
        <p>Hi {{ $detailUser->full_name }},</p>
        <h4>Chào mừng bạn tới trang quản lí tài khoản</h4></div>
    <div class="db-profile"><img src="{{ asset('bower_components/client_layout/images/user.jpg') }}" alt="">
        <h4>{{ $detailUser->full_name }}</h4>
        <p>{{ $detailUser->address }}</p>
    </div>
    <div class="db-profile-view">
        <table>
            <thead>
            <tr>
                <th>{{ __('label.user.address') }}</th>
                <th>{{ __('label.user.join_date') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $detailUser->address }} </td>
                <td>{{ $detailUser->created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="db-profile-edit">
        <h1>{{ __('label.user.update_info') }}</h1>
        <form class="col s12" action="{{ route('user.updateInformation') }}" method="post">
            @csrf
            <div>
                <label class="col s4">{{ __('label.user.full_name') }}</label>
                <div class="input-field col s8">
                    <input type="text" value="{{ $detailUser->full_name }}" class="validate" name="full_name"></div>
            </div>
            <div>
                <label class="col s4">{{ __('label.user.phone') }}</label>
                <div class="input-field col s8">
                    <input type="text" value="{{ $detailUser->phone }}" class="validate" name="phone"></div>
                @if ($errors->has('phone'))
                    <b class="text-danger">{{ $errors->first('phone') }}</b>
                @endif
            </div>
            <div>
                <label class="col s4">{{ __('label.user.address') }}</label>
                <div class="input-field col s8">
                    <input type="text" value="{{ $detailUser->address }}" class="validate" name="address"></div>
            </div>
            <div>
                <div class="input-field col s8">
                    <input type="submit" value="{{ __('label.user.update_info_submit') }}" class="waves-effect waves-light pro-sub-btn"
                           id="pro-sub-btn">
                </div>
            </div>
        </form>


        <h1>{{ __('label.user.update_password') }}</h1>
        <form class="col s12" action="{{ route('user.updatePassword') }}" method="post">
            @csrf
            <div>
                <label class="col s4">{{ __('label.user.old_password') }}</label>
                <div class="input-field col s8">
                    <input type="password"  class="validate" name="old_password"></div>
                @if ($errors->has('old_password'))
                    <b class="text-danger">{{ $errors->first('old_password') }}</b>
                @endif
            </div>

            <div>
                <label class="col s4">{{ __('label.user.password') }}</label>
                <div class="input-field col s8">
                    <input type="password" class="validate" name="password"></div>
                @if ($errors->has('password'))
                    <b class="text-danger">{{ $errors->first('password') }}</b>
                @endif
            </div>

            <div>
                <label class="col s4">{{ __('label.user.password_confirmation') }}</label>
                <div class="input-field col s8">
                    <input type="password" class="validate" name="password_confirmation"></div>
            </div>


            <div>
                <div class="input-field col s8">
                    <input type="submit" value="{{ __('label.user.update_password_submit') }}" class="waves-effect waves-light pro-sub-btn"
                           id="pro-sub-btn">
                </div>
            </div>
        </form>
    </div>
@endsection