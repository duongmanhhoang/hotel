@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <a href="{{ route('admin.post.approveList', ['status' => config('common.posts.approve_value.1')]) }}"
                                   class="btn btn-success mr-1"
                                >
                                    Đã được duyệt
                                    <i class="btn btn-primary m-btn--pill" style="font-style: unset; padding: 10px;">
                                        {{ $countStatusPosts['approve'] }}
                                    </i>
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => config('common.posts.approve_value.0')]) }}"
                                   class="btn btn-info mr-1"
                                >
                                    Chờ phê duyệt
                                    <i class="btn btn-primary m-btn--pill" style="font-style: unset; padding: 10px;">
                                        {{ $countStatusPosts['pending'] }}
                                    </i>
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => config('common.posts.approve_value.-1')]) }}"
                                   class="btn btn-danger mr-1"
                                >
                                    Không được duyệt
                                    <i class="btn btn-primary m-btn--pill" style="font-style: unset; padding: 10px;">
                                        {{ $countStatusPosts['reject'] }}
                                    </i>
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => 'request-edited']) }}"
                                   class="btn btn-accent mr-1"
                                >
                                    Yêu cầu chỉnh sửa
                                    <i class="btn btn-primary m-btn--pill" style="font-style: unset; padding: 10px;">
                                        {{ $countStatusPosts['requestEdit'] }}
                                    </i>
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
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<table class="table">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>#</th>--}}
                                        {{--@if(strpos(url()->current(), 'request-edit'))--}}
                                            {{--<th>Bài viết gốc</th>--}}
                                        {{--@endif--}}
                                        {{--<th>Tiêu đề</th>--}}
                                        {{--<th>Ảnh</th>--}}
                                        {{--<th>Mô tả</th>--}}
                                        {{--<th>Danh mục</th>--}}
                                        {{--<th>Đăng bởi</th>--}}
                                        {{--@if(strpos(url()->current(), config('common.posts.approve_value.-1')))--}}
                                            {{--<td>Lí do bị từ chối</td>--}}
                                        {{--@endif--}}
                                        {{--<th>Hành động</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@php ($i = 1)--}}
                                    {{--@foreach ($data as $value)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{ $i }}</td>--}}
                                            {{--@if($value->parentEdited != null && strpos(url()->current(), 'request-edit'))--}}
                                                {{--<td>--}}
                                                    {{--<a href="{{ route('admin.post.editView', $value->parentEdited->id) }}">--}}
                                                        {{--{{ $value->parentEdited->title }}--}}
                                                        {{--@switch($value->parentEdited->approve)--}}
                                                            {{--@case(config('common.posts.approve_key.approved')) ( <span--}}
                                                                    {{--class="text-success"> Duyệt </span> ) @break--}}
                                                            {{--@case(config('common.posts.approve_key.pending')) ( <span--}}
                                                                    {{--class="text-info"> Chờ </span> ) @break--}}
                                                            {{--@case(config('common.posts.approve_key.rejected')) ( <span--}}
                                                                    {{--class="text-danger"> Từ chối </span> )@break--}}
                                                        {{--@endswitch--}}
                                                    {{--</a>--}}

                                                    {{--@if($value->parentEdited->approve  == config('common.posts.approve_key.rejected'))--}}
                                                        {{--<p>Lí do: <span--}}
                                                                    {{--class="text-danger">{{ $value->parentEdited->message_reject }}</span>--}}
                                                        {{--</p> @endif--}}
                                                {{--</td>--}}
                                            {{--@endif--}}
                                            {{--<td>{{ $value->title }}</td>--}}
                                            {{--<td><img style="width: 125px;  height: 125px; object-fit: cover;"--}}
                                                     {{--src="{{ asset(config('common.uploads.posts')) . '/' . $value->image }}">--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--{{ $value->description }}--}}
                                            {{--</td>--}}
                                            {{--<td>{{ $value->category != null ? $value->category->name : config('common.posts.undefined_category') }}</td>--}}
                                            {{--<td>{{ $value->postedBy->email }}</td>--}}
                                            {{--@if(strpos(url()->current(), config('common.posts.approve_value.-1')))--}}
                                                {{--<td><p class="text-danger">{{ $value->message_reject ?? ''}}</p></td>--}}
                                            {{--@endif--}}
                                            {{--<td>--}}

                                                {{--@if(!strpos(url()->current(), config('common.posts.approve_value.-1')))--}}
                                                    {{--@if(!strpos(url()->current(), config('common.posts.approve_value.1')))--}}
                                                        {{--<a href="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.approved')]) }}"--}}
                                                           {{--class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                           {{--title="Duyệt">--}}
                                                            {{--<i class="la la-check"></i>--}}
                                                        {{--</a>--}}
                                                    {{--@endif--}}
                                                    {{--<a href="javascript:;" data-target="#modalAdvance"--}}
                                                       {{--data-toggle="modal"--}}
                                                       {{--class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">--}}
                                                        {{--<i class="la la-close"></i>--}}
                                                    {{--</a>--}}

                                                {{--@else--}}
                                                    {{--<form id="form-{{ $value->id }}" method="post"--}}
                                                          {{--action="{{ route('admin.post.delete', $value->id) }}"--}}
                                                          {{--class="float-left">--}}
                                                        {{--@csrf--}}
                                                        {{--<a href="javascript:void(0);"--}}
                                                           {{--linkUrl="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.approved')]) }}"--}}
                                                           {{--class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill btn-accepted-approve"--}}
                                                           {{--title="Duyệt">--}}
                                                            {{--<i class="la la-check"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<button locationId="{{ $value->id }}"--}}
                                                                {{--class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                                {{--title="Xóa"><i--}}
                                                                    {{--class="la la-trash"></i>--}}
                                                        {{--</button>--}}
                                                    {{--</form>--}}

                                                {{--@endif--}}

                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--@php ($i++)--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
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
                            </div>
                        </div>

                        <!--end: Search Form -->

                        <!--begin: Datatable -->
                        <div class="m_datatable" id="local_data"></div>

                        <div class="modal fade show" id="modalAdvance" tabindex="-1"
                             role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Từ chối
                                            bài viết</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="reject-post">
                                            @csrf

                                            <div class="form-group m-form__group">
                                                <label>Lí do từ chối <b
                                                            class="text-danger">*</b></label>
                                                <textarea name="message_reject"
                                                          class="form-control"
                                                          style="min-height: 140px"></textarea>
                                                @if ($errors->has('message_reject'))
                                                    <b class="text-danger">{{ $errors->first('message_reject') }}</b>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy
                                        </button>
                                        <button type="button"
                                                class="btn btn-danger submit-reject-post">
                                            Từ chối
                                        </button>
                                    </div>
                                </div>
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

        let currentUrl = "{{ url()->current() }}";
        let postStatus = currentUrl.substr(currentUrl.lastIndexOf('/') + 1);

        if (postStatus === 'approve-posts') postStatus = 'approved';

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

            $('.submit-reject-post').on('click', function () {
                $('#reject-post').submit();
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

            $('.btn-accepted-approve').on('click', function (e) {
                e.preventDefault();
                let removeUrl = $(this).attr('linkUrl');
                swal({
                    title: "Bạn chắc chắn chứ",
                    text: "Duyệt bài viết đã bị từ chối?",
                    type: "warning",
                    showCancelButton: !0,
                    cancelButtonText: "Hủy",
                    confirmButtonText: "Đồng ý"
                }).then(function (e) {
                    if (e.value === true) {
                        window.location.href = removeUrl;
                    }
                })
            })
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
                        } else {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload")
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    },
                });
            })
        }

        function setFormActionUrl(id) {
            let rejectRoute = `{{ route('admin.post.approvingPost', ['', '']) }}/${id}/{{ config('common.posts.approve_key.rejected') }}`;

            let form = $('#reject-post');

            form.attr('action', rejectRoute);
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
                                const routeEdit = `{{ route('admin.post.detailPost', '') }}/${e.id}`;
                                let statusPost = `<span class="text-info"> Chờ </span>`;
                                let reason = '';
                                let layoutReturn = `<p> ${e.title} </p>`;

                                if(e.message_reject != null && e.approve == "{{ config('common.posts.approve_key.rejected') }}") {
                                    layoutReturn += `<p> Lí do: <span class='text-danger'>${e.message_reject}</span> </p>`
                                }

                                if (e.parent_edited != null) {
                                    switch (e.parent_edited.approve) {
                                        case 1:
                                            statusPost = `<span class="text-success"> Duyệt </span>`;
                                            break;
                                        case -1:
                                            statusPost = `<span class="text-danger"> Từ chối </span>`;
                                            break;
                                    }

                                    if (e.parent_edited.approve === -1) {
                                        reason = `<p>Lí do: <span class='text-danger'> ${e.parent_edited.message_reject} </span></p>`;
                                    }

                                    layoutReturn += `<section class='ml-1'><a href='${routeEdit}'> ${e.parent_edited.title} ( ${statusPost} ) </a> ${reason}</section>`;
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
                                return e.category != null ? e.category.name : 'Không danh mục';
                            }
                        },
                        {
                            field: "postedBy",
                            title: "Người đăng",
                            template: function (e) {
                                return e.posted_by.email;
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
                                let approveRoute = `{{ route('admin.post.approvingPost', ['', '']) }}/${e.id}/{{ config('common.posts.approve_key.approved') }}`;
                                let actionRender = '';
                                let detailRoute = "{{ route('admin.post.detailPost', ':id') }}";
                                let urlDetail = detailRoute.replace(':id', e.id);

                                let del = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="remove(this)" postId="${e.id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;

                                let approve = `<a href="${approveRoute}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Duyệt">
                                                   <i class="la la-check"></i>
                                                </a>`;

                                let reject = `<a href="javascript:;"
                                                   data-target="#modalAdvance"
                                                   data-toggle="modal"
                                                   onclick="setFormActionUrl(${e.id})"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Từ chối">
                                                   <i class="la la-close"></i>
                                                </a>`;

                                let detail = `<a href="${urlDetail}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chi tiết"
                                                    >
                                                        <i class="la la-eye"></i>
                                                    </a>`;

                                switch (postStatus) {
                                    case 'approved':
                                        actionRender = `${detail} ${reject}`;
                                        break;

                                    case 'pending':
                                    case 'request-edited':
                                        actionRender = `${detail} ${approve} ${reject}`;
                                        break;

                                    case 'rejected':
                                        actionRender = `${detail} ${approve} ${del}`;
                                        break;

                                    default:
                                        actionRender = `${detail} ${approve} ${reject}`;
                                        break;
                                }

                                return actionRender
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