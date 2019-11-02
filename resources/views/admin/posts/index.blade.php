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
                                <a href="{{ route('admin.post.list', ['status' => 'requestEdited']) }}"
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
                                        <th>Bản dịch gốc</th>
                                        {{--<th>Trạng thái</th>--}}
                                        <th>Đăng bởi</th>
                                        <th>Duyệt bởi</th>
                                        @if(strpos(url()->current(), config('common.posts.approve_value.-1')))
                                            <th>Lí do bị từ chối</th>
                                        @endif
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
                                            <td>
                                                @if($value->parentTranslate != null)
                                                    <a href="{{ route('admin.post.editView', ['id' => $value->parentTranslate->id]) }}">{{ $value->parentTranslate->title }}</a>
                                                @else
                                                    Bản gốc
                                                @endif
                                            </td>
                                            {{--                                            <td>{{ config("common.posts.approve.$value->approve") }}</td>--}}
                                            <td>{{ $value->postedBy->email }}</td>
                                            <td>{{ $value->approveBy != null ? $value->approveBy->email : config("common.posts.approve.0") }}</td>
                                            @if(strpos(url()->current(), config('common.posts.approve_value.-1')))
                                                <td><p class="text-danger">{{ $value->message_reject ?? ''}}</p></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('admin.post.editView', ['id' => $value->id]) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Chỉnh sửa">
                                                    <i class="la la-edit"></i>
                                                </a>

                                                @if(!strpos(url()->current(), config('common.posts.approve_value.-1')) && !strpos(url()->current(), 'requestEdited'))
                                                    <a href="{{ route('admin.post.translateView', $value->id) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Ngôn Ngữ">
                                                        <i class="la la-file-word-o"></i>
                                                    </a>
                                                @endif

                                                <form id="form-{{ $value->id }}" method="post"
                                                      action="{{ route('admin.post.delete', $value->id) }}"
                                                      class="float-left">
                                                    @csrf
                                                    <button locationId="{{ $value->id }}"
                                                            class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                            title="Xóa"><i
                                                                class="la la-trash"></i>
                                                    </button>
                                                </form>
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
    </script>
@endsection