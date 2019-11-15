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
                                    Danh sách đánh giá
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
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin đánh giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Email: <span id="email-comment"></span></p>
                    <p>Phòng: <span id="room-name-comment"></span></p>
                    <p>Đánh giá: <span id="rating-comment"></span></p>
                    <p>Nội dung:
                        <p style="word-break: break-all" id="body-comment"></p>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        let DataTable = {
            init: function () {
                let t;
                t = $(".m_datatable").mDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: "{{ route('admin.comments.datatable') }}",
                                method: 'GET',
                                map: function (t) {
                                    let e = t;
                                    return void 0 !== t.data && (e = t.data), e
                                }
                            }
                        },
                    },
                    pageSize: 10,
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0,
                    layout: {theme: "default", class: "", scroll: !1, footer: !1},
                    sortable: !0,
                    pagination: !0,
                    search: {input: $("#generalSearch")},
                    columns: [
                        // {
                        //     field: "id",
                        //     title: "#",
                        //     width: 50,
                        //     sortable: !1,
                        //     textAlign: "center",
                        //     selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        // },
                        {
                            field: "roomName",
                            title: "Tên phòng"
                        },
                        {
                            field: "email",
                            title: "Email",
                            class: "comment-email",
                            template: function (e) {
                                const email = `<p class="comment-email">${e.email}</p>`;

                                return email;
                            }
                        },
                        {
                            field: "rating",
                            title: "Đánh giá"
                        },
                        {
                            field: "body",
                            title: "Nội dung",
                            template: function (e, a, i) {
                                const body = e.body;

                                return body;
                            }
                        },
                        {
                            field: "Actions",
                            width: 110,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                const show = `<a href="javascript:;" id="${e.id}"
                                                       onclick="showComment(this)" data-toggle="modal" data-target="#modalShow"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                    >
                                                        <i class="la la-eye"></i>
                                                    </a>`;
                                const deleteProp = `<button
                                                        propId="${e.id}"
                                                        onclick="deleteProp(this)"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Xóa">
                                                        <i class="la la-trash"></i>
                                                    </button>`;

                                return `${show} ${deleteProp}`
                            }
                        }
                    ]
                })
            }
        };
        jQuery(document).ready(function () {
            DataTable.init()
        });

        function deleteProp(t) {
            let id = $(t).attr('propId');
            swal({
                title: "Bạn chắc chắn chứ",
                text: "Khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Hủy",
                confirmButtonText: "Đồng ý"
            }).then(function (e) {
                e.value && $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.comments.delete', '') }}/${id}`,
                    type: 'POST',
                    success: function (response) {
                        if (response.messages === 'error') {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                        }
                        if (response.messages === 'success') {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload")
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    },
                });
            })
        }

        showComment = (t) => {
            const id = $(t).attr('id');
            $.ajax({
                contentType: false,
                processData: false,
                url: `{{ route('admin.comments.show', '') }}/${id}`,
                type: 'GET',
                success: function (response) {
                    const {data} = response;
                    if (response.messages === 'success') {
                        $('#email-comment').text(data.email);
                        $('#room-name-comment').text(data.roomName);
                        $('#rating-comment').text(data.rating);
                        $('#body-comment').text(data.body);
                    }
                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                },
            });
        }
    </script>
@endsection
