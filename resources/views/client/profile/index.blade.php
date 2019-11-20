@extends('client.layouts.profileLayout')
@section('content')
    <div class="db-cent-1">
        <p>{{ $detailUser->full_name }},</p>
        <h4>Chào mừng bạn tới trang quản lí tài khoản</h4></div>
    <div class="db-cent-2">
        <div class="db-2-main-1">
            <div class="db-2-main-2"><img
                        src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}" alt=""> <span>My Bookings</span>
                <p>All the Lorem Ipsum generators on the</p>
                <h2>{{ count($detailUser->invoices) }}</h2></div>
        </div>
        <div class="db-2-main-1">
            <div class="db-2-main-2"><img
                        src="{{ asset('bower_components/client_layout/images/icon/dbc6.png') }}" alt=""> <span>Activity</span>
                <p>All the Lorem Ipsum generators on the</p>
                <h2>04</h2></div>
        </div>
        <div class="db-2-main-1">
            <div class="db-2-main-2"><img
                        src="{{ asset('bower_components/client_layout/images/icon/dbc3.png') }}" alt=""> <span>Payment</span>
                <p>All the Lorem Ipsum generators on the</p>
                <h2>16</h2></div>
        </div>
    </div>
    <div class="db-cent-3">
        <div class="db-cent-table db-com-table">
            <div class="db-title">
                <h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}" alt=""/> My
                    Bookings</h3>
                <p>Lịch sử đặt phòng</p>
            </div>
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Thành phố</th>
                    <th>Ngày đến</th>
                    <th>Ngày đi</th>
                    <th>Thành viên</th>
                    <th>Phòng</th>
                    <th>Số phòng</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                </tr>
                </thead>
                <tbody>
                @foreach($detailUser->invoices as $key => $invoice)

                    @php
                        switch ($invoice->rooms[0]->pivot_status) {
                         case 1: {
                                $statusClass = 'db-success';
                                $statusName = 'Đã thanh toán';
                            }
                         break;

                         case 2: {
                                $statusClass = 'db-success';
                                $statusName = 'Đã trả phòng';
                            }
                         break;

                         default: {
                                $statusClass = 'db-success';
                                $statusName = 'Chưa thanh toán';
                         }
                        }
                    @endphp

                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $invoice->customer_name }}</td>
                        <td>{{ $invoice->customer_phone }}</td>
                        <td>{{ $invoice->customer_address }}</td>
                        <td>{{ $invoice->rooms[0]->pivot->check_in_date }}</td>
                        <td>{{ $invoice->rooms[0]->pivot->check_out_date }}</td>
                        <td>{{ $invoice->rooms[0]->adults + $invoice->rooms[0]->children }}</td>
                        <td>{{ $invoice->rooms[0]->roomName->name }}</td>
                        <td>{{ $invoice->rooms[0]->pivot->room_number }}</td>
                        <td>{{ number_format($invoice->total) }} VND</td>
                        <td>
                            <a href="#" class="{{ $statusClass }}">
                                {{ $statusName }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="db-cent-3">
        <div class="db-cent-acti">
            <div class="db-title">
                <h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc1.png') }}" alt=""/> My
                    Activity</h3>
                <p>Hoạt động gần đây...</p>
            </div>
            <ul>
                <li>
                    <div class="db-cent-wr-img"><img
                                src="{{ asset('bower_components/client_layout/images/users/100.png') }}" alt="">
                    </div>
                    <div class="db-cent-wr-con">
                        <h6>Hotel Booking Canceled</h6> <span class="lr-revi-date">21th May, 2019</span>
                        <p>Bạn đã hủy đặt phòng vì lí do gì đó omewa lul nani dafug hoho nammo nammo nammo nammo
                            nammo nammo.</p>
                        <ul>
                            <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="db-cent-wr-img"><img
                                src="{{ asset('bower_components/client_layout/images/users/100.png') }}" alt="">
                    </div>
                    <div class="db-cent-wr-con">
                        <h6>Hotel Payment Success</h6> <span class="lr-revi-date">08th Msy, 2019</span>
                        <p>Bạn đã hủy đặt phòng vì lí do gì đó omewa lul nani dafug hoho nammo nammo nammo nammo
                            nammo nammo.</p>
                        <ul>
                            <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#!"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection