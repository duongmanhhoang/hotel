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
                                    Danh sách phòng - {{ $location->name }}
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
                                                              action="{{ route('admin.rooms.index', $location->id) }}">
                                                            <input type="text" class="form-control m-input"
                                                                   name="keyword"
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
                                            <a href="{{ route('admin.rooms.create', $location->id) }}"
                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span><i class="la la-plus"></i>Thêm</span>
                                            </a>
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Tên phòng</th>
                                        <th>Giá</th>
                                        <th>Đánh giá</th>
                                        <th>Xem bản gốc</th>
                                        <th>Hàng động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach($rooms as $room)
                                        @if (!is_null($keyword))
                                            <?php
                                            $roomDetail = $room->roomDetails()->where('lang_id', session('locale'))->where('name', 'LIKE', '%' . $keyword . '%')->first();
                                            ?>
                                        @else
                                            <?php
                                            $roomDetail = $room->roomDetails()->where('lang_id', session('locale'))->first();
                                            ?>
                                        @endif
                                        @if ($roomDetail != null)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    <img src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                                         style="width: 200px"></td>
                                                <td>{{ $roomDetail->name }}</td>
                                                <td>
                                                    @if ($room->sale_status == 0)
                                                        <p class="price">{{ $roomDetail->price }} {{ __('messages.currency') }}</p>
                                                    @else
                                                        <p>
                                                            <del class="price">{{ $roomDetail->price }}</del>
                                                        </p>
                                                        <p class="price">{{ $roomDetail->sale_price }} {{ __('messages.currency') }}</p>
                                                    @endif
                                                </td>
                                                <td>{{ $room->rating }} {{ __('messages.star') }}</td>
                                                <td>
                                                    @if ($roomDetail->lang_parent_id != 0)
                                                        @php($roomId = $roomDetail->room->id)
                                                        <a href="{{ route('admin.rooms.showOriginal', [$location->id, $roomId]) }}">Xem
                                                            bản gốc</a>
                                                    @else
                                                        <p>Bản gốc</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.rooms.edit', [$location->id, $room->id]) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                       title="Chỉnh sửa">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.rooms.translation', session('locale') == config('common.languages.default') ? [$location->id, $roomDetail->id] : [$location->id, $roomDetail->lang_parent_id]) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                       title="Tạo bản dịch">
                                                        <i class="la la-exchange"></i>
                                                    </a>
                                                    <form id="form-{{ $roomDetail->id }}"
                                                          method="post"
                                                          action="{{ route('admin.rooms.delete', [$location->id, $roomDetail->id]) }}">
                                                        @csrf
                                                        <button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                                title="Xóa"
                                                                roomId="{{ $roomDetail->id }}"
                                                        >
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @php($i++)
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $rooms->links() }}
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
                let id = $(this).attr('roomId');
                let form = $('#form-' + id);
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
