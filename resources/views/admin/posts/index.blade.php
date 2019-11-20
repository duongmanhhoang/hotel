@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <a href="{{ route('admin.post.list', ['status' => config('common.posts.approve_value.1')]) }}"
                                   class="btn btn-success mr-1"
                                >
                                    Đã được duyệt
                                </a>
                                <a href="{{ route('admin.post.list', ['status' => config('common.posts.approve_value.0')]) }}"
                                   class="btn btn-info mr-1"
                                >
                                    Chờ phê duyệt
                                </a>
                                <a href="{{ route('admin.post.list', ['status' => config('common.posts.approve_value.-1')]) }}"
                                   class="btn btn-danger mr-1"
                                >
                                    Không được duyệt
                                </a>
                                <a href="{{ route('admin.post.list', ['status' => 'request-edited']) }}"
                                   class="btn btn-accent mr-1"
                                >
                                    Chỉnh sửa từ bài viết đã được duyệt
                                </a>

                            </div>
                        </div>
                    </div>
                    {{--<div class="m-portlet__body">--}}
                        {{--<div class="m-section">--}}
                            {{--<div class="m-section__content">--}}
                                {{--<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<div class="col-xl-8 order-2 order-xl-1">--}}
                                            {{--<div class="form-group m-form__group row align-items-center">--}}
                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="m-input-icon m-input-icon--left">--}}
                                                        {{--<form method="get"--}}
                                                              {{--action="">--}}
                                                            {{--<input type="text" class="form-control m-input"--}}
                                                                   {{--name="title"--}}
                                                                   {{--value="{{ $titleSearch }}"--}}
                                                                   {{--placeholder="Tìm kiếm">--}}
                                                        {{--</form>--}}
                                                        {{--<span class="m-input-icon__icon m-input-icon__icon--left">--}}
                                                            {{--<span><i class="la la-search"></i></span>--}}
                                                        {{--</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xl-4 order-1 order-xl-2 m--align-right">--}}
                                            {{--<a href="{{ route('admin.post.addAction') }}"--}}
                                               {{--class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">--}}
                                                {{--<span><i class="la la-plus"></i> Thêm bài viết</span>--}}
                                            {{--</a>--}}
                                            {{--<div class="m-separator m-separator--dashed d-xl-none"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<table class="table">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>#</th>--}}
                                        {{--<th>Tiêu đề</th>--}}
                                        {{--<th>Ảnh</th>--}}
                                        {{--<th>Mô tả</th>--}}
                                        {{--<th>Danh mục</th>--}}
                                        {{--<th>Bản dịch gốc</th>--}}
                                        {{--<th>Trạng thái</th>--}}
                                        {{--<th>Đăng bởi</th>--}}
                                        {{--<th>Duyệt bởi</th>--}}
                                        {{--@if(strpos(url()->current(), config('common.posts.approve_value.-1')))--}}
                                            {{--<th>Lí do bị từ chối</th>--}}
                                        {{--@endif--}}
                                        {{--<th>Hành động</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@php ($i = 1)--}}
                                    {{--@foreach ($data as $value)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{ $i }}</td>--}}
                                            {{--<td>{{ $value->title }}</td>--}}
                                            {{--<td><img style="width: 125px;  height: 125px; object-fit: cover;"--}}
                                                     {{--src="{{ asset(config('common.uploads.posts')) . '/' . $value->image }}">--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--{{ $value->description }}--}}
                                            {{--</td>--}}
                                            {{--<td>{{ $value->category != null ? $value->category->name : config('common.posts.undefined_category') }}</td>--}}
                                            {{--<td>--}}
                                                {{--@if($value->parentTranslate != null)--}}
                                                    {{--<a href="{{ route('admin.post.editView', ['id' => $value->parentTranslate->id]) }}">{{ $value->parentTranslate->title }}</a>--}}
                                                {{--@else--}}
                                                    {{--Bản gốc--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            {{--                                            <td>{{ config("common.posts.approve.$value->approve") }}</td>--}}
                                            {{--<td>{{ $value->postedBy->email }}</td>--}}
                                            {{--<td>{{ $value->approveBy != null ? $value->approveBy->email : config("common.posts.approve.0") }}</td>--}}
                                            {{--@if(strpos(url()->current(), config('common.posts.approve_value.-1')))--}}
                                                {{--<td><p class="text-danger">{{ $value->message_reject ?? ''}}</p></td>--}}
                                            {{--@endif--}}
                                            {{--<td>--}}
                                                {{--<a href="{{ route('admin.post.editView', ['id' => $value->id]) }}"--}}
                                                   {{--class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                   {{--title="Chỉnh sửa">--}}
                                                    {{--<i class="la la-edit"></i>--}}
                                                {{--</a>--}}

                                                {{--@if(!strpos(url()->current(), config('common.posts.approve_value.-1')) && !strpos(url()->current(), 'requestEdited'))--}}
                                                    {{--<a href="{{ route('admin.post.translateView', $value->id) }}"--}}
                                                       {{--class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                       {{--title="Ngôn Ngữ">--}}
                                                        {{--<i class="la la-file-word-o"></i>--}}
                                                    {{--</a>--}}
                                                {{--@endif--}}

                                                {{--<form id="form-{{ $value->id }}" method="post"--}}
                                                      {{--action="{{ route('admin.post.delete', $value->id) }}"--}}
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
                        {{--</div>--}}
                    {{--</div>--}}

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
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('admin.post.addView') }}"
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
@endsection


@section('script')
    <script>
        let currentUrl = "{{ url()->current() }}";
        let postStatus = currentUrl.substr(currentUrl.lastIndexOf('/') + 1);

        if (postStatus === 'posts') postStatus = 'approved';

        let routePostDataTable = "{{ route('admin.post.datatable', ':status') }}";
        let urlGetDataTable = routePostDataTable.replace(':status', postStatus);

        let titlePage = 'Bài viết';

        switch (postStatus) {
            case 'approved':
                titlePage = 'Đã chấp thuận';
                break;

            case 'pending':
                titlePage = 'Chờ phê duyệt';
                break;

            case 'request-edited':
                titlePage = 'Yêu cầu chỉnh sửa';
                break;

            case 'rejected':
                titlePage = 'Đã từ chối';
                break;
        }

        $('#title-page').html(titlePage);

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

            const routeDelete = "{{ route('admin.post.delete', ':id') }}";
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
                        // {
                        //     field: "id",
                        //     title: "#",
                        //     width: 50,
                        //     sortable: !1,
                        //     textAlign: "center",
                        //     selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        // },
                        {
                            field: "title",
                            title: "Tiêu đề",
                            template: function (e) {
                                let layoutReturn = `<p> ${e.title} </p>`;

                                if(e.message_reject != null && e.approve == "{{ config('common.posts.approve_key.rejected') }}") {
                                    layoutReturn += `<p> Lí do: <span class='text-danger'>${e.message_reject}</span> </p>`
                                }

                                return layoutReturn;

                            }
                        },
                        {
                            field: "image",
                            title: "Ảnh",
                            template: function (e) {
                                return `<img style="width: 125px;  height: 125px; object-fit: cover;"
                                                     src="{{ asset(config('common.uploads.posts')) . '/' }}${e.image}">`;
                            }
                        },
                        {
                            field: "description",
                            title: "Mô tả"
                        },
                        {
                            field: "category",
                            title: "Danh mục",
                            template: function (e) {
                                return e.category != null ? e.category.name : 'Không danh mục' ;
                            }
                        },
                        {
                            field: "parentTranslate",
                            title: "Bản dịch gốc",
                            template: function (e) {
                                let parentCategory = 'Bản gốc';

                                if (e.parent_translate != null) {
                                    const editRoute = "{{ route('admin.post.editView', ':id') }}";
                                    const urlEdit = editRoute.replace(':id', e.parent_translate.id);

                                    parentCategory = `<a href="${urlEdit}">${e.parent_translate.title}</a>`;
                                }

                                return parentCategory;
                            }
                        },
                        {
                            field: "postedBy",
                            title: "Người đăng",
                            template: function (e) {
                                return e.posted_by.email;
                            }
                        },
                        {
                            field: "approveBy",
                            title: "Người duyệt",
                            template: function (e) {
                                return e.approve_by != null ? e.approve_by.email : " {{ config("common.posts.approve.0") }} ";
                            }
                        },
                        // {
                        //     field: "message_reject",
                        //     title: "Lí do",
                        //     template: function (e) {
                        //         // if(e.message_reject == null) { $(this) }
                        //         return `<p class='text-danger'> ${e.message_reject} </p>`;
                        //     }
                        // },
                        {
                            field: "Actions",
                            width: 150,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                let editRoute = "{{ route('admin.post.editView', ':id') }}";
                                let translateRoute = "{{ route('admin.post.translateView', ':id') }}";
                                let detailRoute = "{{ route('admin.post.detailPost', ':id') }}";
                                let urlEdit = editRoute.replace(':id', e.id);
                                let urlTranslate = translateRoute.replace(':id', e.id);
                                let urlDetail = detailRoute.replace(':id', e.id);

                                let edit = `<a href="${urlEdit}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;

                                let detail = `<a href="${urlDetail}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chi tiết"
                                                    >
                                                        <i class="la la-eye"></i>
                                                    </a>`;

                                let translate = `<a href="${urlTranslate}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Dịch">
                                                        <i class="la la-exchange"></i>
                                             </a>`;
                                let del = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="remove(this)" postId="${e.id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;

                                if(postStatus === 'rejected') {translate = ''}

                                return `${detail} ${edit} ${translate} ${del}`
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