<!DOCTYPE html>
<html lang="en">

@include ('client.layouts.head')
<body data-ng-app="">
<section>
    @include ('client.layouts.header')
    <div class="dashboard">
        <div class="db-left">
            <div class="db-left-1">
                <h4>{{ \Illuminate\Support\Facades\Auth::user()->full_name }}</h4>
                <p>{{ \Illuminate\Support\Facades\Auth::user()->address }}</p>
            </div>
            <div class="db-left-2">
                <ul>
                    <li>
                        <a href="{{ route('profile.mybooking') }}"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db2.png') }}"
                                    alt=""/>{{ __('label.My_booking') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('user.profileInformation') }}"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db7.png') }}"
                                    alt=""/>{{ __('label.My_profile') }}</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db8.png') }}"
                                         alt=""/>{{ __('label.Log_out') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="db-cent">
            @yield('content')
        </div>
        <div class="db-righ">
            <h4>{{ __('label.Notifications') }}</h4>
            <ul class="my-booking-list-noti">
                @foreach($profileNotifications as $notification)
                    <li id="notification-{{ $notification->id }}">
                        <h5>
                            @if ($notification->type == 'invoice_created')
                                {{ __('label.Invoice') }}
                            @endif
                        </h5>
                        <p>
                            @if ($notification->type == 'invoice_created')
                                {{ __('messages.got_new_invoice') }}
                                <br/>
                                {{ __('label.Invoice_code') }}: {{ json_decode($notification->data, true)['code'] }}

                            @endif
                        </p> <span>{{ $notification->created_at }}</span>
                        <br/>
                        <br/>
                        <a href="javascript:;" class="mask-as-read"
                           id="{{ $notification->id }}">{{ __('label.Mark_as_read') }}</a>
                    </li>
                @endforeach
            </ul>
            <a href="javascript:;" class="mask-all-read" style="margin-left: 20px">{{ __('label.Mask_all_read') }}</a>
        </div>
    </div>
    @include ('client.layouts.booking')
</section>
@include ('client.layouts.footer')
@include('client.layouts.chat')
@include ('client.layouts.bottom')
@include ('client.layouts.sidebar')
</body>
</html>
