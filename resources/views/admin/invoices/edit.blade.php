<?php

use App\Models\RoomInvoice;

?>
@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="m-subheader mb-5">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Chỉnh sửa hóa đơn</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <div class="form-group m-form__group m--margin-top-10">
                                <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                    Những field có dấu * bắt buộc phải điền<br>
                                    Nếu bạn muốn chỉnh sửa thông tin liên quan đến phòng, xin vui lòng cập nhập lại ngày
                                    tháng năm để hệ thống có thể tìm kiếm những phòng khả dụng
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('admin.invoices.update', $invoice->id) }}">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Thông tin hóa đơn
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>Ngày đến <b class="text-danger">*</b></label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control m-input my-datepicker"
                                                       value="{{ old('check_in_date', $checkIn) }}" id="check_in_date"
                                                       name="check_in_date"
                                                       autocomplete="off"
                                                        {{ $disable ? 'disabled' : '' }}
                                                >
                                            </div>
                                            <b class="check_in_date_errors text-danger">
                                                @if ($errors->has('check_in_date'))
                                                    {{ $errors->first('check_in_date') }}
                                                @endif
                                            </b>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="">Ngày đi <b class="text-danger">*</b></label>
                                            <div class="m-input-icon m-input-icon--right" id="check-out">
                                                <input type="text" class="form-control m-input my-datepicker"
                                                       value="{{ old('check_out_date', $checkOut) }}"
                                                       id="check_out_date"
                                                       name="check_out_date"
                                                       autocomplete="off"
                                                        {{ $disable ? 'disabled' : '' }}
                                                >
                                            </div>
                                            <b class="check_out_date_errors text-danger">
                                                @if ($errors->has('check_out_date'))
                                                    {{ $errors->first('check_out_date') }}
                                                @endif
                                            </b>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Chọn phòng <b class="text-danger">*</b></label>
                                        <select class="form-control" name="room_id"
                                                id="room_id" {{ $disable ? 'disabled' : '' }}>
                                            <option></option>
                                            <option selected value="{{ $room->id }}">{{ session('locale') == config('common.languages.default')
                                             ? $room->roomName->name
                                             : $roomNameRepository->where('lang_id', '=', session('locale'))->where('lang_parent_id', '=', $room->id)->first()->name }}</option>
                                        </select>
                                        @if ($errors->has('room_id'))
                                            <b class="text-danger">{{ $errors->first('room_id') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Chọn số phòng <b class="text-danger">*</b></label>
                                        <select class="form-control" name="room_number"
                                                id="room_number" {{ $disable ? 'disabled' : '' }}>
                                            <option
                                                    value="{{ $invoiceRoom->room_number }}">{{ $invoiceRoom->room_number }}</option>
                                        </select>
                                        @if ($errors->has('room_id'))
                                            <b class="text-danger">{{ $errors->first('room_id') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Loại tiền <b class="text-danger">*</b></label>
                                        <select class="form-control" name="currency" onchange="onChangeCurrency(value)">
                                            <option
                                                    value="{{ config('common.currency.vi') }}" {{ !$invoiceRoom->currency ? 'selected' : '' }}>
                                                VNĐ
                                            </option>
                                            <option
                                                    value="{{ config('common.currency.en') }}" {{ $invoiceRoom->currency ? 'selected' : '' }}>
                                                $
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Dịch vụ</label>
                                        <select class="form-control m-select2" multiple="multiple" id="services-select"
                                                name="services[]">
                                            @foreach($services as $service)
                                                @php
                                                    $selected = false;
                                                        $usedService = $usedServices->filter(function ($value) use ($service) {
                                                                    return $value->id == $service->id;
                                                                    })->first();
                                                if ($usedService) {
                                                    $selected = true;
                                                }
                                                @endphp
                                                <option value="{{ $service->id }}"
                                                        title={{ $service->price }} {{ $selected ? 'selected' : '' }} >{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Trạng thái <b class="text-danger">*</b></label>
                                        <select class="form-control" name="status">
                                            <option
                                                    value="{{ RoomInvoice::NOT_PAY }}" {{ $invoiceRoom->status == RoomInvoice::NOT_PAY ? 'selected' : '' }}>
                                                Chưa thanh toán
                                            </option>
                                            <option
                                                    value="{{ RoomInvoice::PAID }}" {{ $invoiceRoom->status == RoomInvoice::PAID ? 'selected' : '' }}>
                                                Đã thanh toán (Chưa nhận phòng)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Khoản tiền thu thêm (Nếu có)</label>
                                        <input type="number" name="extra" class="form-control" min="0"
                                               value="{{ old('extra', $invoiceRoom->extra) }}" id="extra">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ghi chú khoản thu thêm (Nếu có)</label>
                                        <textarea class="form-control" rows="8"
                                                  name="note">{{ old('note', $invoiceRoom->note) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Thông tin khách hàng
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <div class="form-group m-form__group">
                                        <label>Tên <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="customer_name"
                                               value="{{ old('customer_name', $invoice->customer_name) }}">
                                        @if ($errors->has('customer_name'))
                                            <b class="text-danger">{{ $errors->first('customer_name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Số điện thoại <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="customer_phone"
                                               value="{{ old('customer_phone', $invoice->customer_phone) }}">
                                        @if ($errors->has('customer_phone'))
                                            <b class="text-danger">{{ $errors->first('customer_phone') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Email</label>
                                        <input type="text" class="form-control m-input" name="customer_email"
                                               value="{{ old('customer_email', $invoice->customer_email) }}">
                                        @if ($errors->has('customer_email'))
                                            <b class="text-danger">{{ $errors->first('customer_email') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control m-input" name="customer_address"
                                               value="{{ old('customer_address', $invoice->customer_address) }}">
                                        @if ($errors->has('customer_address'))
                                            <b class="text-danger">{{ $errors->first('customer_address') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ghi chú</label>
                                        <textarea class="form-control" name="messages"
                                                  rows="8">{{ old('messages', $room->messages) }}</textarea>
                                        @if ($errors->has('messages'))
                                            <b class="text-danger">{{ $errors->first('messages') }}</b>
                                        @endif
                                    </div>
                                    <input type="hidden" name="disabled" value="{{ $disable ? '1' : '0' }}">
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary float-right">Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#services-select").select2({placeholder: ""});
            $('.my-datepicker').datepicker({
                todayHighlight: !0,
                autoclose: !0,
                format: "dd-mm-yyyy"
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#room_id").select2({placeholder: "Chọn phòng"});

            $('#room_id').on('change', function (e) {
                let room_id = $('#room_id').val();
                let checkIn = $('#check_in_date').val();
                let checkOut = $('#check_out_date').val();
                let invoiceRoom = '{{ $invoiceRoom->id }}';
                e.preventDefault();
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.invoices.getAvailableRoomNumbers', '') }}/${room_id}?checkIn=${checkIn}&checkOut=${checkOut}&roomInvoice=${invoiceRoom}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#room_number').find('option').remove();
                        if (response.messages == 'not_found') {
                            toastr.error('Phòng này không tồn tại', 'Cảnh báo!!');
                        }
                        if (response.messages == 'success') {
                            const {data} = response;
                            data.forEach(item => {
                                $('#room_number').append($('<option>', {
                                    value: item.room_number,
                                    text: item.room_number
                                }));
                            });
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });
            $('#check_in_date').on('change', function (e) {
                $('#room_id').find('option').remove();
                $('#room_number').find('option').remove();
                $('#check_out_date').val('');
            });
            $('#check-out').on('change', function (e) {
                let checkIn = $('#check_in_date').val();
                let checkOut = $('#check_out_date').val();
                let invoiceRoom = '{{ $invoiceRoom->id }}';
                e.preventDefault();
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.invoices.getAvailableRoom') }}?checkIn=${checkIn}&checkOut=${checkOut}&roomInvoice=${invoiceRoom}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#room_id').find('option').remove();
                        $('#room_number').find('option').remove();
                        if (response.messages == 'fail') {
                            toastr.error('Không tìm thấy phù hợp', 'Cảnh báo!!');
                        }
                        if (response.messages == 'success') {
                            const {data} = response;
                            $('#room_id').append($('<option>', {}));
                            data.forEach(item => {
                                $('#room_id').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            })
        });

        $("select[name='services[]']").each((i, v) => {
            $(v).on('select2:select', (r) => {
                let extra = $('#extra').val();
                let price = r.params.data.title;
                $('#extra').val(Number(extra) + Number(price));
            });

            $(v).on('select2:unselect', (r) => {
                let extra = $('#extra').val();
                let price = r.params.data.title;
                $('#extra').val(Number(extra) - Number(price));
            });
        });

        function onChangeCurrency(type) {
            $('#extra').val('');
            $.ajax({
                contentType: false,
                processData: false,
                url: `{{ route('admin.invoices.getServices', '') }}/${type}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let select = $('#services-select');
                    select.find('option').remove();
                    response.forEach(item => {
                        select.append($('<option>', {
                            value: item.id,
                            text: item.name,
                            title: item.price
                        }));
                    });

                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                },
            });
        }
    </script>
@endsection
