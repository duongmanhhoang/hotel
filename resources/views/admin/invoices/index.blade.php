@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Quản lý hóa đơn
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <form method="get"
                                                              action="">
                                                            <input type="text" class="form-control m-input"
                                                                   name="keyword"
                                                                   placeholder="Tìm kiếm">
                                                        </form>
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="{{ route('admin.invoices.create') }}"
                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span><i class="la la-plus"></i> Thêm</span>
                                            </a>
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Ngày đến</th>
                                        <th>Ngày đi</th>
                                        <th>Thông tin khách hàng</th>
                                        <th>Thông tin hóa đơn</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($invoices as $invoice)
                                        <?php
                                        $pivot = $invoice->rooms->first()->pivot;
                                        $room = $invoice->rooms[0];
                                        $roomDetail = $room->roomDetails()->where('lang_parent_id', 0)->first();
                                        ?>
                                        <tr>
                                            <td>{{ $invoice->code }}</td>
                                            <td>
                                                {{ $pivot->check_in_date }}
                                            </td>
                                            <td>
                                                {{ $pivot->check_out_date }}
                                            </td>
                                            <td>
                                                <p>Tên: {{ $invoice->customer_name }}</p>
                                                <p>Số điện thoại: {{ $invoice->customer_phone }}</p>
                                                <p>Email: {{ $invoice->customer_email }}</p>
                                                <p>Địa chỉ: {{ $invoice->customer_address }}</p>
                                                <p>Ghi chú: {{ $invoice->messages }}</p>
                                            </td>
                                            <td>
                                                <p>Tên phòng: {{ $roomDetail->name }}</p>
                                                <p>Số phòng: {{ $pivot->room_number }}</p>
                                                <p class="price">Giá: {{ $pivot->price }} {{ !$pivot->currency ? 'vnđ' : '$' }}</p>
                                                <p class="price">Phí thu thêm: {{ $pivot->extra }}</p>
                                            </td>
                                        </tr>
                                        @php ($i++)
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $invoices->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
