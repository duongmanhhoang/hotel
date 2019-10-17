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
                                    Quản lý thu chi
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
                                                              action="{{ route('admin.category.list') }}">
                                                            <input type="text" class="form-control m-input"
                                                                   name="name"
                                                                   value="{{ $nameSearch ?? '' }}"
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
                                            <a href="{{ route('admin.bill.postView') }}"
                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span><i class="la la-plus"></i> Thêm</span>
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
                                        <th>Nội dung</th>
                                        <th>Kiểu</th>
                                        <th>Tiền</th>
                                        <th>Địa điểm</th>
                                        <th>Phòng</th>
                                        <th>Thời gian</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->body }}</td>
                                            <td>{{ $value->type == 1 ? 'Thu' : 'Chi' }}</td>
                                            <td>{{ number_format($value->money) }}</td>
                                            <td>{{ $value->location->name ?? 'Nowhere' }}</td>
                                            <td>{{ $value->room_id ?? 'No room' }}</td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.bill.editView', $value->id) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Chỉnh sửa">
                                                    <i class="la la-edit"></i>
                                                </a>

                                                <form id="form-{{ $value->id }}" method="post"
                                                      action="{{ route('admin.bill.delete', $value->id) }}"
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
