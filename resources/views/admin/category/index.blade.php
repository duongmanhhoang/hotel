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
                                    Quản lý danh mục
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            {{--<div class="m-section__content">--}}
                                {{--<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<div class="col-xl-8 order-2 order-xl-1">--}}

                                            {{--<form method="get"--}}
                                                  {{--action="{{ route('admin.category.list') }}"--}}
                                                  {{--class="form-group m-form__group row align-items-center"--}}
                                            {{-->--}}
                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="m-input-icon m-input-icon--left">--}}
                                                        {{--<input type="text" class="form-control m-input"--}}
                                                               {{--name="name"--}}
                                                               {{--value="{{ $nameSearch ?? '' }}"--}}
                                                               {{--placeholder="Tìm kiếm">--}}
                                                        {{--<span class="m-input-icon__icon m-input-icon__icon--left">--}}
                                                            {{--<span><i class="la la-search"></i></span>--}}
                                                        {{--</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="m-input-icon m-input-icon--left">--}}
                                                        {{--<select class="bs-select form-control" tabindex="-98"--}}
                                                                {{--name="type" onchange="form.submit()">--}}

                                                            {{--@for($i = 0; $i <= 1; $i++)--}}
                                                                {{--<option value="{{ $i }}" {{ isset($type) && $type == $i ? 'selected' : '' }}>--}}
                                                                    {{--@switch($i)--}}
                                                                        {{--@case(0) Bài viết @break;--}}
                                                                        {{--@case(1) Dịch vụ @break;--}}
                                                                    {{--@endswitch--}}
                                                                {{--</option>--}}
                                                            {{--@endfor--}}

                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}


                                        {{--</div>--}}
                                        {{--<div class="col-xl-4 order-1 order-xl-2 m--align-right">--}}
                                            {{--<a href="{{ route('admin.category.postView') }}"--}}
                                               {{--class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">--}}
                                                {{--<span><i class="la la-plus"></i> Thêm</span>--}}
                                            {{--</a>--}}
                                            {{--<div class="m-separator m-separator--dashed d-xl-none"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<table class="table">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>#</th>--}}
                                        {{--<th>Tên danh mục</th>--}}
                                        {{--<th>Danh mục cha</th>--}}
                                        {{--<th>Ngôn ngữ</th>--}}
                                        {{--<th>Bản dịch gốc</th>--}}
                                        {{--<th>Hành động</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@php ($i = 1)--}}
                                    {{--@foreach ($data as $value)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{ $i }}</td>--}}
                                            {{--<td>{{ $value->name }}</td>--}}
                                            {{--<td>{{ !empty($value->parent) ? $value->parent->name : 'None' }}</td>--}}
                                            {{--<td>{{ $value->language->short }}</td>--}}
                                            {{--<td>--}}
                                                {{--@if($value->parentTranslate != null)--}}
                                                    {{--<a href="{{ route('admin.category.editView', $value->parentTranslate->id) }}">{{ $value->parentTranslate->name }}</a>--}}
                                                {{--@else--}}
                                                    {{--Bản gốc--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--<a href="{{ route('admin.category.editView', $value->id) }}"--}}
                                                   {{--class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                   {{--title="Chỉnh sửa">--}}
                                                    {{--<i class="la la-edit"></i>--}}
                                                {{--</a>--}}

                                                {{--<a href="{{ route('admin.category.categoryTranslateView', $value->id) }}"--}}
                                                   {{--class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                   {{--title="Ngôn Ngữ">--}}
                                                    {{--<i class="la la-file-word-o"></i>--}}
                                                {{--</a>--}}

                                                {{--<form id="form-{{ $value->id }}" method="post"--}}
                                                      {{--action="{{ route('admin.category.delete', $value->id) }}"--}}
                                                      {{--class="float-left">--}}
                                                    {{--@csrf--}}
                                                    {{--<button locationId="{{ $value->id }}"--}}
                                                            {{--class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                            {{--title="Xóa"><i--}}
                                                                {{--class="la la-trash"></i>--}}
                                                    {{--</button>--}}
                                                {{--</form>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--@php ($i++)--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                                {{--{{ $data->links() }}--}}
                            {{--</div>--}}

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

                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <select class="bs-select form-control" tabindex="-98"
                                                                name="type" id="typeSearch">

                                                            @for($i = 0; $i <= 1; $i++)
                                                                <option value="{{ $i }}" {{ isset($type) && $type == $i ? 'selected' : '' }}>
                                                                    @switch($i)
                                                                        @case(0) Bài viết @break;
                                                                        @case(1) Dịch vụ @break;
                                                                    @endswitch
                                                                </option>
                                                            @endfor

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="{{ route('admin.category.postView') }}"
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        let urlGetDataTable = "{{ route('admin.category.datatable') }}";

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            DataTable.init();

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('locationId');
                var form = $('#form-' + id);
                swal({
                    title: "Bạn chắc chắn chứ",
                    text: "Khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
                    type: "warning",
                    showCancelButton: !0,
                    cancelButtonText: "Hủy",
                    confirmButtonText: "Đồng ý"
                }).then(function (e) {
                    e.value && form.submit();
                })
            })
        });

        function del(t) {
            let id = $(t).attr('cateId');

            const routeDelete = "{{ route('admin.category.delete', ':id') }}";
            const urlDelete = routeDelete.replace(':id', id);

            console.log(urlDelete);

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
                        // {
                        //     field: "id",
                        //     title: "#",
                        //     width: 50,
                        //     sortable: !1,
                        //     textAlign: "center",
                        //     selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        // },
                        {
                            field: "name",
                            title: "Tên"
                        },
                        {
                            field: "parentTranslate",
                            title: "Bản dịch gốc",
                            template: function (e) {
                                let parentCategory = 'none';

                                if(e.parent_translate != null) {
                                    const editRoute = "{{ route('admin.category.editView', ':id') }}";
                                    const urlEdit = editRoute.replace(':id', e.parent_translate.id);

                                    parentCategory = `<a href="${urlEdit}">${e.parent_translate.name}</a>`;
                                }

                                return parentCategory;
                            }
                        },
                        {
                            field: "Actions",
                            width: 150,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                let editRoute = "{{ route('admin.category.editView', ':id') }}";
                                let translateRoute = "{{ route('admin.category.categoryTranslateView', ':id') }}";
                                let urlEdit = editRoute.replace(':id', e.id);
                                let urlTranslate = translateRoute.replace(':id', e.id);

                                const edit = `<a href="${urlEdit}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;
                                const translate = `<a href="${urlTranslate}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Dịch">
                                                        <i class="la la-exchange"></i>
                                             </a>`;
                                const del = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="del(this)" cateId="${e.id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;

                                return `${edit} ${translate} ${del}`
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
