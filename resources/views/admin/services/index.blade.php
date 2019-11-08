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
                                    Danh sách dịch vụ
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
                                    <a href="{{ route('admin.services.create') }}"
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
                                url: "{{ route('admin.services.datatable') }}",
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
                            field: "id",
                            title: "#",
                            width: 50,
                            sortable: !1,
                            textAlign: "center",
                            selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        },
                        {
                            field: "image",
                            title: "Ảnh dại diện",
                            template: function (e) {
                                return `<img src="{{ asset(config('common.uploads.services')) }}/${e.image}" width="100px">`
                            }
                        },
                        {
                            field: "name",
                            title: "Tên"
                        },
                        {
                            field: "cate_name",
                            title: "Danh mục"
                        },
                        {
                            field: "Origin",
                            title: "Xem bản gốc",
                            template: function (e) {
                                let result = '-';
                                if (e.lang_parent_id != 0) {
                                    result = `<a href="{{ route('admin.services.origin', '') }}/${e.id}">Xem bản gốc</a>`;
                                }

                                return result;
                            }
                        },
                        {
                            field: "Actions",
                            width: 110,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e, a, i) {
                                let translateId = e.id;
                                if (`{{ session('locale') }}` != `{{ config('common.languages.default') }}`) {
                                    translateId = e.lang_parent_id;
                                }
                                const edit = `<a href="{{ route('admin.services.edit', '') }}/${translateId}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;
                                const translate = ` <a href="{{ route('admin.services.translation', '') }}/${translateId}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Dịch">
                                                    <i class="la la-exchange"></i>
                                                </a>`;
                                const deleteProp = `<button
                                                        propId="${e.id}"
                                                        onclick="deleteProp(this)"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Xóa">
                                                        <i class="la la-trash"></i>
                                                    </button>`;

                                return `${edit} ${translate} ${deleteProp}`
                            }
                        }
                    ]
                }), $("#m_form_status").on("change", function () {
                    t.search($(this).val(), "status")
                }), $("#m_form_status, #m_form_type").selectpicker()
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
                    url: `{{ route('admin.properties.delete', '') }}/${id}`,
                    type: 'POST',
                    success: function (response) {
                        if (response.data.messages == 'error') {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                        }
                        if (response.data.messages == 'success') {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload")
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    },
                });
            })
        }
    </script>
@endsection
