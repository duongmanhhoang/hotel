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
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label style="width: 60px">Trạng thái:</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_status">
                                                        <option value="">Tất cả</option>
                                                        <option value="0">Chưa thanh toán</option>
                                                        <option value="1">Thanh toán (Chưa trả phòng)</option>
                                                        <option value="2">Trả phòng sớm</option>
                                                        <option value="3">Trả phòng muộn</option>
                                                        <option value="4">Thanh toán (đã trả phòng)</option>
                                                        <option value="5">Hủy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input m-input--solid"
                                                       placeholder="Tìm kiếm..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('admin.invoices.create') }}"
                                       class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
												<span>
													<i class="la la-plus"></i>
													<span>Thêm mới</span>
												</span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>

                        <!--end: Search Form -->

                        <!--begin: Datatable -->
                        <div class="m_datatable" id="local_data"></div>

                        <!--end: Datatable -->
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
    <input type="hidden" id="dataTable" value="{{ $dataTable }}">
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

        var DatatableDataLocalDemo = {
            init: function () {
                let e, a;
                e = JSON.parse($('#dataTable').val()), a = $(".m_datatable").mDatatable({
                    data: {
                        type: "local",
                        source: e,
                        pageSize: 10
                    },
                    layout: {theme: "default", class: "", scroll: !1, footer: !1},
                    sortable: !0,
                    pagination: !0,
                    search: {input: $("#generalSearch")},
                    columns: [
                        {
                            field: "id",
                            title: "#",
                            width: 50,
                            sortable: !1,
                            textAlign: "center",
                            selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        },
                        {
                            field: "code",
                            title: "Mã hóa đơn"
                        },
                        {
                            field: "checkIn",
                            title: "Ngày đến",
                        },
                        {
                            field: "checkOut",
                            title: "Ngày về"
                        },
                        {
                            field: "customer_info",
                            title: "Thông tin khách hàng",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                return `Tên: ${e.customer_name} <br>
                                 Số điện thoại: ${e.customer_phone} <br>
                                 Email: ${e.customer_email ? e.customer_email : 'Không có' } <br>
                                 Địa chỉ: ${e.customer_address ? e.customer_address : 'Không có'} <br>
                                 `
                            }
                        },
                        {
                            field: "room_info",
                            title: "Thông tin hóa đơn",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                return `Hạng phòng: ${e.room_name} <br>
                                 Số phòng: ${e.room_number} <br>
                                 Giá theo hóa đơn: ${e.price} ${e.currency}<br>
                                 Tổng: ${e.total} ${e.currency}
                                 `
                            }
                        },
                        {
                            field: "status",
                            title: "Status",
                            template: function (e) {
                                let a = {
                                    0: {title: "Chưa thanh toán", class: "m-badge--brand"},
                                    1: {title: "Thanh toán (Chưa trả phòng)", class: "m-badge--primary"},
                                    2: {title: "Trả phòng sớm", class: "m-badge--info"},
                                    3: {title: "Trả phòng muộn", class: "m-badge--warning"},
                                    4: {title: "Thanh toán (đã trả phòng)", class: "m-badge--success"},
                                    5: {title: "Hủy", class: " m-badge--danger"},
                                };
                                return '<span class="m-badge ' + a[e.status].class + ' m-badge--wide">' + a[e.status].title + "</span>"
                            }
                        },
                        {
                            field: "Actions",
                            width: 110,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e, a, i) {
                                const full = `<a href="{{ route('admin.invoices.edit', '') }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                       id="edit-${e.id}"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       url="{{ route('admin.invoices.markAsReturn', '') }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill btn-mark"
                                                       data-toggle="modal" data-target="#modal_mark"
                                                       title="Đánh dấu là khách đã trả phòng"
                                                       id="mark-${e.id}"
                                                    >
                                                        <i class="la la-check"></i>
                                                    </a>
                                                    <a href="{{ route('admin.invoices.show','') }}/${e.id}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Chi tiết">
                                                    <i class="la la-eye"></i>
                                                </a>`;
                                const onlyShow = `<a href="{{ route('admin.invoices.show','') }}/${e.id}" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Chi tiết"><i class="la la-eye"></i>`
                                if (e.status == 0 || e.status == 1) {
                                    return full;
                                }

                                return onlyShow;
                            }
                        }
                    ]
                }), $("#m_form_status").on("change", function () {
                    a.search($(this).val(), "status")
                }), $("#m_form_type").on("change", function () {
                    a.search($(this).val(), "Type")
                }), $("#m_form_status, #m_form_type").selectpicker()
            }
        };
        jQuery(document).ready(function () {
            DatatableDataLocalDemo.init()
        });
    </script>
@endsection
