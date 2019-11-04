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
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => config('common.posts.approve_value.0')]) }}"
                                   class="btn btn-info mr-1"
                                >
                                    Chờ phê duyệt
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => config('common.posts.approve_value.-1')]) }}"
                                   class="btn btn-danger mr-1"
                                >
                                    Không được duyệt
                                </a>
                                <a href="{{ route('admin.post.approveList', ['status' => 'requestEdited']) }}"
                                   class="btn btn-accent mr-1"
                                >
                                    Chỉnh sửa từ bài viết đã được duyệt
                                </a>
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
                                                                   name="title"
                                                                   value="{{ $titleSearch }}"
                                                                   placeholder="Tìm kiếm">
                                                        </form>
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Ảnh</th>
                                        <th>Mô tả</th>
                                        <th>Danh mục</th>
                                        <th>Đăng bởi</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td><img style="width: 125px;  height: 125px; object-fit: cover;"
                                                     src="{{ asset(config('common.uploads.posts')) . '/' . $value->image }}">
                                            </td>
                                            <td>
                                                {{ $value->description }}
                                            </td>
                                            <td>{{ $value->category != null ? $value->category->name : config('common.posts.undefined_category') }}</td>
                                            <td>{{ $value->postedBy->email }}</td>
                                            <td>

                                                @if(!strpos(url()->current(), config('common.posts.approve_value.-1')))
                                                    @if(!strpos(url()->current(), config('common.posts.approve_value.1')))
                                                        <a href="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.approved')]) }}"
                                                           class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                           title="Duyệt">
                                                            <i class="la la-check"></i>
                                                        </a>
                                                    @endif
                                                    <a href="javascript:;" data-target="#modalAdvance"
                                                       data-toggle="modal"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                        <i class="la la-close"></i>
                                                    </a>

                                                @else
                                                    <form id="form-{{ $value->id }}" method="post"
                                                          action="{{ route('admin.post.delete', $value->id) }}"
                                                          class="float-left">
                                                        @csrf
                                                        <a href="javascript:void(0);"
                                                           linkUrl="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.approved')]) }}"
                                                           class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill btn-accepted-approve"
                                                           title="Duyệt">
                                                            <i class="la la-check"></i>
                                                        </a>
                                                        <button locationId="{{ $value->id }}"
                                                                class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                                title="Xóa"><i
                                                                    class="la la-trash"></i>
                                                        </button>
                                                    </form>

                                                @endif

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
                                                                <form id="reject-post"
                                                                      action="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.rejected')]) }}"
                                                                >
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
                                            </td>
                                        </tr>
                                        @php ($i++)
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
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
        $(document).ready(function () {
            $('.submit-reject-post').on('click', function () {
                $('#reject-post').submit();
            })
        });

        $(document).ready(function () {
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
    </script>
@endsection