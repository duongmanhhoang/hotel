<?php
use App\Models\RoomInvoice;
?>
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
                                        <th>Trạng thái</th>
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
                                                <p class="price">
                                                    Giá: {{ $pivot->price }} {{ !$pivot->currency ? 'vnđ' : '$' }}</p>
                                                <p class="price">Phí thu thêm: {{ $pivot->extra }}</p>
                                            </td>
                                            <td>
                                                @if ($pivot->status == RoomInvoice::NOT_PAY)
                                                    Chưa thanh toán
                                                @elseif ($pivot->status == RoomInvoice::PAID)
                                                    Thanh toán (Chưa ở hoặc chưa trả phòng)
                                                @elseif ($pivot->status == RoomInvoice::PAID_AND_RETURN)
                                                    Thanh toán (Đã trả phòng)
                                                @elseif ($pivot->status == RoomInvoice::PAID_SOON)
                                                    Thanh toán sớm
                                                @elseif ($pivot->status == RoomInvoice::PAID_LATE)
                                                    Thanh toán muộn
                                                @elseif ($pivot->status == RoomInvoice::CANCEL)
                                                    Hủy
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pivot->status == RoomInvoice::NOT_PAY || $pivot->status == RoomInvoice::PAID)
                                                    <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                       id="edit-{{ $invoice->id }}"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       url="{{ route('admin.invoices.markAsReturn', $invoice->id) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill btn-mark"
                                                       data-toggle="modal" data-target="#modal_mark"
                                                       title="Đánh dấu là khách đã trả phòng"
                                                       id="mark-{{ $invoice->id }}"
                                                    >
                                                        <i class="la la-check"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.invoices.show', $invoice->id) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Chi tiết">
                                                    <i class="la la-eye"></i>
                                                </a>
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
    <div class="modal fade" id="modal_mark"
         tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel">Đánh dấu khách đã trả phòng</h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger m-alert m-alert--default" role="alert">
                        Khi đã đánh dấu bạn sẽ không thể chỉnh sửa hóa đơn này
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <select class="form-control" name="status" id="mark-status">
                                <option value="{{ RoomInvoice::PAID_AND_RETURN }}">Trả phòng đúng hẹn</option>
                                <option value="{{ RoomInvoice::PAID_SOON }}">Trả phòng sớm</option>
                                <option value="{{ RoomInvoice::PAID_LATE }}">Trả phòng muộn</option>
                                <option value="{{ RoomInvoice::CANCEL }}">Hủy</option>
                            </select>
                        </div>
                        <input type="hidden" id="mark-url">
                        <div class="form-group">
                            <button class="btn btn-primary submit-mark" type="submit">Lưu</button>
                            <button class="btn btn-danger" type="reset" data-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.btn-mark', function () {
            let url = $(this).attr('url');
            $('#mark-url').val(url);
        });

        $('body').on('click', '.submit-mark', function (e) {
            e.preventDefault();
            let url = $('#mark-url').val();
            let status = $('#mark-status').val();
            let formData = new FormData();
            formData.append('status', status);
            swal({
                title: "Bạn chắc chắn chứ",
                text: "Khi đã đánh dấu bạn sẽ không thể chỉnh sửa hóa đơn này",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Hủy",
                confirmButtonText: "Đồng ý"
            }).then(function (e) {
                e.value && $.ajax({
                    contentType: false,
                    processData: false,
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'not_found') {
                            toastr.error('Không tìm thấy hóa đơn', 'Cảnh báo');
                        }
                        if (response.messages == 'success') {
                            toastr.success('Cập nhập trạng thái thành công', 'Thành công');
                            $(`#edit-${response.data}`).remove();
                            $(`#mark-${response.data}`).remove();
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });

        });
    </script>
@endsection
