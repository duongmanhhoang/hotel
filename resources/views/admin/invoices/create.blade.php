@extends('admin.layouts.master')
@section('content')

    <div class="m-content">
        <div class="m-subheader mb-5">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Thêm hóa đơn</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <div class="form-group m-form__group m--margin-top-10">
                                <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                    Những field có dấu * bắt buộc phải điền
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('admin.invoices.store') }}">
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
                                                       value="{{ old('check_in_date') }}" id="check_in_date"
                                                       name="check_in_date"
                                                       autocomplete="off">
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
                                                       value="{{ old('check_out_date') }}" id="check_out_date"
                                                       name="check_out_date"
                                                       autocomplete="off">
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
                                        <select class="form-control" name="room_id" id="room_id">
                                            <option></option>
                                        </select>
                                        @if ($errors->has('room_id'))
                                            <b class="text-danger">{{ $errors->first('room_id') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Chọn số phòng <b class="text-danger">*</b></label>
                                        <select class="form-control" name="room_number" id="room_number">
                                        </select>
                                        @if ($errors->has('room_id'))
                                            <b class="text-danger">{{ $errors->first('room_id') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Loại tiền <b class="text-danger">*</b></label>
                                        <select class="form-control" name="currency">
                                            <option value="{{ config('common.currency.vi') }}">VNĐ</option>
                                            <option value="{{ config('common.currency.en') }}">$</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Trạng thái <b class="text-danger">*</b></label>
                                        <select class="form-control" name="status">
                                            <option value="{{ \App\Models\RoomInvoice::NOT_PAY }}">Chưa thanh toán</option>
                                            <option value="{{ \App\Models\RoomInvoice::PAID }}">Đã thanh toán</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Khoản tiền thu thêm (Nếu có)</label>
                                        <input type="number" name="extra" class="form-control" min="0">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ghi chú khoản thu thêm (Nếu có)</label>
                                        <textarea class="form-control" rows="8" name="note">{{ old('note') }}</textarea>
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
                                               value="{{ old('customer_name') }}">
                                        @if ($errors->has('customer_name'))
                                            <b class="text-danger">{{ $errors->first('customer_name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Số điện thoại <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="customer_phone"
                                               value="{{ old('customer_phone') }}">
                                        @if ($errors->has('customer_phone'))
                                            <b class="text-danger">{{ $errors->first('customer_phone') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Email</label>
                                        <input type="text" class="form-control m-input" name="customer_email"
                                               value="{{ old('customer_email') }}">
                                        @if ($errors->has('customer_email'))
                                            <b class="text-danger">{{ $errors->first('customer_email') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control m-input" name="customer_address"
                                               value="{{ old('customer_address') }}">
                                        @if ($errors->has('customer_address'))
                                            <b class="text-danger">{{ $errors->first('customer_address') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ghi chú</label>
                                        <textarea class="form-control" name="messages" rows="8">{{ old('messages') }}</textarea>
                                        @if ($errors->has('messages'))
                                            <b class="text-danger">{{ $errors->first('messages') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary float-right">Thêm</button>
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
        $(document).ready(function(){
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
                e.preventDefault();
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.invoices.getAvailableRoomNumbers', '') }}/${room_id}?checkIn=${checkIn}&checkOut=${checkOut}`,
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
                e.preventDefault();
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.invoices.getAvailableRoom') }}?checkIn=${checkIn}&checkOut=${checkOut}`,
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
    </script>
@endsection
