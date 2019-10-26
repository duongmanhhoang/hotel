@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet">
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-invoice-2">
                            <div class="m-invoice__wrapper">
                                <div class="m-invoice__head">
                                    <div class="m-invoice__container m-invoice__container--centered">
                                        <div class="m-invoice__logo">
                                            <a href="javascript:;">
                                                <h1>Hóa đơn</h1>
                                            </a>
                                            <a href="#">
                                                <img src="../../assets/app/media/img//logos/logo_client_color.png">
                                            </a>
                                        </div>
                                        <div class="m-invoice__items">
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Ngày</span>
                                                <span
                                                    class="m-invoice__text">Checkin: {{ formatDate($invoiceRoom->check_in_date) }}</span>
                                                <span
                                                    class="m-invoice__text">Checkout: {{ formatDate($invoiceRoom->check_out_date) }}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Mã hóa đơn</span>
                                                <span class="m-invoice__text">#{{ $invoice->code }}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Thông tin khách hàng</span>
                                                <span class="m-invoice__text">{{ $invoice->customer_name }}</span>
                                                <span class="m-invoice__text">{{ $invoice->customer_phone }}</span>
                                                <span class="m-invoice__text">{{ $invoice->customer_email }}</span>
                                                <span class="m-invoice__text">{{ $invoice->customer_address }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-invoice__body m-invoice__body--centered">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Ảnh đại diện</th>
                                                <th>Tên phòng</th>
                                                <th>Số phòng</th>
                                                <th>Giá hiện tại</th>
                                                <th>Giá trong hóa đơn</th>
                                                <th>Khoản thu thêm</th>
                                                <th>Tổng cộng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><img
                                                        src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                                        width="200"/></td>
                                                <td>
                                                    @if (session('locale') == config('common.languages.default'))
                                                        {{ $room->roomName->name }}
                                                    @else
                                                        {{ \App\Models\RoomName::where('lang_id', session('locale'))->where('lang_parent_id', $room->id)->first()->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $invoiceRoom->room_number }}</td>
                                                <td class="price">
                                                    {{ $price }} {{ $currency }}
                                                </td>
                                                <td class="price">{{ $invoiceRoom->price }} {{ $currency }}</td>
                                                <td class="price">{{ $invoiceRoom->extra ? $invoiceRoom->extra . $currency : 'Không có'}}</td>
                                                <td class="m--font-danger price">{{ $invoice->total }} {{ $currency }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        @if ($invoiceRoom->note)
                                            <div class="mt-5">
                                                <h3>Chi tiết các khoản thu thêm</h3>
                                                <p>{{ $invoiceRoom->note }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="m-invoice__footer">
                                    <div class="m-invoice__table  m-invoice__table--centered table-responsive">
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
