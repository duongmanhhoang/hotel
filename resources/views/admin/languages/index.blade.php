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
                                    Quản lý ngôn ngữ
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
                                                        <option value="0">Chưa kích hoạt</option>
                                                        <option value="1">Kích hoạt</option>
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
                                    <a href="{{ route('admin.languages.create') }}"
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
    let DataTable = {
        init: function () {
            let t;
            t = $(".m_datatable").mDatatable({
                data:{
                    type:"remote",
                    source:{
                        read:{
                            url:"{{ route('admin.languages.datatable') }}",
                            method: 'GET',
                            map:function(t){
                                let e=t;
                                return void 0!==t.data&&(e=t.data),e
                            }
                        }
                    },
                },
                pageSize:10,
                serverPaging:!0,
                serverFiltering:!0,
                serverSorting:!0,
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
                        field: "flag",
                        title: "Ảnh đại diện",
                        sortable: !1,
                        overflow: "visible",
                        template: function (e) {
                            return `<img src="{{ asset(config('common.uploads.languages')) }}/${e.flag}" class="flag-languages">`
                        }
                    },
                    {
                        field: "name",
                        title: "Ngôn ngữ"
                    },
                    {
                        field: "short",
                        title: "Viết tắt",
                    },
                    {
                        field: "status",
                        title: "Trạng thái",
                        template: function (e) {
                            let a = {
                                0: {title: "Chưa kích hoạt", class: "m-badge--danger"},
                                1: {title: "Kích hoạt", class: "m-badge--primary"},
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
                            const edit = `<a href="{{ route('admin.languages.edit', '') }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                       id="edit-${e.id}"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;
                            const deactive = `<a href="{{ route('admin.languages.deactive', '') }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Hủy kích hoạt">
                                                        <i class="la la-ban"></i>
                                             </a>`;
                            const active = `<a href="{{ route('admin.languages.active', '') }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Kích hoạt">
                                                        <i class="la la-check"></i>
                                                    </a>`
                            if (e.status == 1) {
                                return `${edit} ${deactive}`
                            }

                            return `${edit} ${active}`
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
</script>
@endsection
