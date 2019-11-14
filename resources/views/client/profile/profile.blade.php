@extends('client.layouts.master')
@section('content')
    <div class="dashboard">
        <div class="db-left">
            <div class="db-left-1">
                <h4>{{ $detailUser->full_name }}</h4>
                <p>{{ $detailUser->address }}</p>
            </div>
            <div class="db-left-2">
                <ul>
                    <li>
                        <a href="{{ route('user.profile') }}"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db1.png') }}" alt=""/> All</a>
                    </li>
                    <li>
                        <a href="db-booking.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db2.png') }}" alt=""/> My
                            Bookings</a>
                    </li>
                    <li>
                        <a href="db-new-booking.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db3.png') }}" alt=""/> New
                            Booking</a>
                    </li>
                    <li>
                        <a href="db-event.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db4.png') }}" alt=""/>
                            Event</a>
                    </li>
                    <li>
                        <a href="db-activity.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db5.png') }}" alt=""/>
                            Activity</a>
                    </li>
                    <li>
                        <a href="db-profile.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db7.png') }}" alt=""/>
                            Profile</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db6.png') }}"
                                         alt=""/> Payments</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db8.png') }}"
                                         alt=""/> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="db-cent">
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
        </div>
        <div class="db-righ">
            <h4>Notifications(05)</h4>
            <ul>
                <li>
                    <a href="#!"> <img src="images/icon/dbr1.jpg" alt="">
                        <h5>New blog</h5>
                        <p>All the Lorem Ipsum generators on the</p> <span>2 hours ago</span> </a>
                </li>
                <li>
                    <a href="#!"> <img src="images/icon/dbr2.jpg" alt="">
                        <h5>Thanh toán thành công</h5>
                        <p>All the Lorem Ipsum generators on the</p> <span>4 hours ago</span> </a>
                </li>
                <li>
                    <a href="#!"> <img src="images/icon/dbr3.jpg" alt="">
                        <h5>Thanh toán thành công</h5>
                        <p>All the Lorem Ipsum generators on the</p> <span>10 hours ago</span> </a>
                </li>
                <li>
                    <a href="#!"> <img src="images/icon/dbr4.jpg" alt="">
                        <h5>Thanh toán thành công</h5>
                        <p>All the Lorem Ipsum generators on the</p> <span>12 hours ago</span> </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="hom-footer-section">
        <div class="container">
            <div class="row">
                <div class="foot-com foot-1">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="foot-com foot-2">
                    <h5>Phone: (+84) 376 594 637</h5></div>
                <div class="foot-com foot-3">
                    <!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a
                            class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a></div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="images/card.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection