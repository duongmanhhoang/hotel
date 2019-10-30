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
                                    Quản lý bài viết
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
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="{{ route('admin.post.addAction') }}"
                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span><i class="la la-plus"></i> Thêm bài viết</span>
                                            </a>
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
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
                                            <td><img style="width: 225px;  height: 225px; object-fit: cover;"
                                                     src="{{ asset(config('common.uploads.posts')) . '/' . $value->image }}">
                                            </td>
                                            <td>
                                                {{ $value->description }}
                                            </td>
                                            <td>{{ $value->category != null ? $value->category->name : config('common.posts.undefined_category') }}</td>
                                            <td>{{ $value->postedBy->email }}</td>
                                            <td>

                                                <a href="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.approved')]) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Duyệt">
                                                    <i class="la la-check"></i>
                                                </a>

                                                <a href="javascript:;" data-target="#modalAdvance" data-toggle="modal"
                                                   class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                    <i class="la la-close"></i>
                                                </a>


                                                <div class="modal fade show" id="modalAdvance" tabindex="-1"
                                                     role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Từ chối bài viết</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="reject-post"
                                                                      action="{{ route('admin.post.approvingPost', ['id' => $value->id, 'approve' => config('common.posts.approve_key.reject')]) }}"
                                                                      >
                                                                    @csrf

                                                                    <div class="form-group m-form__group">
                                                                        <label>Lí do từ chối <b class="text-danger">*</b></label>
                                                                        <textarea name="message_reject" class="form-control" style="min-height: 140px"></textarea>
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
            $('.submit-reject-post').on('click', function() {
                $('#reject-post').submit();
            })
        });
    </script>
@endsection