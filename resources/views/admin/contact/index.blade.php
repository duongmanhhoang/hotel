@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                Contact
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <h2 class="text" id="title-page"></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                            </div>
                        </div>

                        <div class="m_datatable" id="local_data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        let urlGetDataTable = "{{ route('admin.contact.dataTable') }}";

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            DataTable.init();
        });

        function remove(t) {
            let id = $(t).attr('postId');

            const routeDelete = "{{ route('admin.contact.delete', ':id') }}";
            const urlDelete = routeDelete.replace(':id', id);

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
                    url: urlDelete,
                    type: 'POST',
                    success: function (response) {
                        if (response.is_deleted === false) {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                        }else {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload")
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    },
                });
            })
        }

        let DataTable = {
            init: function () {
                let t;
                t = $(".m_datatable").mDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: urlGetDataTable,
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
                        {
                            field: "subject",
                            title: "Tiêu đề"
                        },
                        {
                            field: "email",
                            title: "Email"
                        },
                        {
                            field: "name",
                            title: "Người gửi"
                        },
                        {
                            field: "location_id",
                            title: "Địa điểm",
                            template: function (e) {
                                return e.location.name
                            }
                        },
                        {
                            field: "userReader",
                            title: "Đã xem bởi",
                            template: function (e) {
                                console.log(e)
                                const readers = [];

                                for (let i = 0; i < e.user_reader.length; i++) {
                                    let dataUser = `<div> ${e.user_reader[i].full_name} </div>`;

                                    readers.push(dataUser);
                                }

                                console.log(readers);

                                return `<div style='max-height: 100px; overflow-y: scroll'> ${readers} </div>`
                            }
                        },
                        {
                            field: "Actions",
                            width: 150,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                console.log(e);
                                let editRoute = "{{ route('admin.contact.detail', ':id') }}";
                                let urlEdit = editRoute.replace(':id', e.id);

                                let edit = `<a href="${urlEdit}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chi tiết"
                                                    >
                                                        <i class="la la-eye"></i>
                                                    </a>`;

                                let del = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="remove(this)" postId="${e.id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;


                                return `${edit} ${del}`
                            }
                        }
                    ]
                }), $("#m_form_status").on("change", function () {
                    t.search($(this).val(), "status")
                }), $("#m_form_status, #m_form_type").selectpicker()
            }
        };
    </script>
@endsection