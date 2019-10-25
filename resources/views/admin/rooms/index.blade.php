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
                                    @php ($stt = 1)
                                    @foreach($rooms as $room)
                                        @php($roomDetail = $room->roomDetails()->where('lang_id', session('locale'))->first())
                                        @if ($roomDetail != null)
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>
                                                    <img
                                                        src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                                        style="width: 200px"></td>
                                                <td>{{ (session('locale') == config('common.languages.default')
                                                 ? $room->roomName->name
                                                  : \App\Models\RoomName::where('lang_id', session('locale'))->where('lang_parent_id', $room->room_name_id)->first()->name) }}</td>
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
                                                        <button
                                                            class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                            title="Xóa"
                                                            roomId="{{ $roomDetail->id }}"
                                                        >
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>
                                                    <button data-toggle="modal"
                                                            data-target="#modal_prop_{{ $room->id }}"
                                                            class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                            title="Thêm tiện nghi"><i
                                                            class="la la-magic"></i></button>
                                                    <div class="modal fade" id="modal_prop_{{ $room->id }}"
                                                         tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body row">
                                                                    <div class="col-6">
                                                                        <div class="m-scrollable m-scroller ps"
                                                                             data-scrollbar-shown="true"
                                                                             data-scrollable="true"
                                                                             data-height="150">
                                                                            <ul class="list-props-{{ $room->id }}">
                                                                                <?php
                                                                                $room_properties = $room->properties()->get();
                                                                                $room_prop_id = [];
                                                                                $i = 0;
                                                                                ?>
                                                                                @foreach ($room_properties as $room_property)
                                                                                    <li class="list-prop-item-{{ $room->id }}-{{ $room_property->id }}">
                                                                                        <span
                                                                                            class="list-prop-item">{{ $room_property->name }}</span>
                                                                                        <button
                                                                                            data-room="{{ $room->id }}"
                                                                                            id="{{ $room_property->id }}"
                                                                                            addUrl="{{ route('admin.rooms.addProperties', $location->id) }}"
                                                                                            deleteUrl="{{ route('admin.rooms.deleteProperties', $location->id) }}"
                                                                                            class="btn m-btn m-btn--hover-danger m-btn--icon btn-delete-prop">
                                                                                            <i class="la la-trash"></i>
                                                                                        </button>
                                                                                    </li>
                                                                                    <?php
                                                                                    $room_prop_id[$i] = $room_property->id;
                                                                                    $i++;
                                                                                    ?>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="m-scrollable m-scroller ps"
                                                                             data-scrollbar-shown="true"
                                                                             data-scrollable="true"
                                                                             data-height="150">
                                                                            <form>
                                                                                <ul class="list-not-use-prop-{{ $room->id }}">
                                                                                    <?php
                                                                                    $properties_not_use = $properties->getNotUse($room_prop_id, config('common.languages.default'));
                                                                                    ?>
                                                                                    @foreach ($properties_not_use as $property)
                                                                                        <li class="item-{{$room->id}}-{{$property->id}}">
                                                                                            <span
                                                                                                class="add-property-item">{{ $property->name }}</span>
                                                                                            <button
                                                                                                data-room="{{ $room->id }}"
                                                                                                id="{{ $property->id }}"
                                                                                                addUrl="{{ route('admin.rooms.addProperties', $location->id) }}"
                                                                                                deleteUrl="{{ route('admin.rooms.deleteProperties', $location->id) }}"
                                                                                                class="btn m-btn m-btn--hover-success m-btn--icon btn-add-prop">
                                                                                                <i class="la la-plus"></i>
                                                                                            </button>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($stt++)
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
            });

            $('body').on('click', '.btn-add-prop', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let room_id = $(this).attr2('data-room');
                let url = $(this).attr('addUrl');
                let deleteUrl = $(this).attr('deleteUrl');
                let formData = new FormData();
                formData.append('id', id);
                formData.append('room_id', room_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'errors') {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                        }

                        if (response.messages == 'success') {
                            $('.item-' + room_id + '-' + id).remove();
                            $('.list-props-' + room_id).append('<li class="list-prop-item-' + response.data.room_id + '-' + id + '">' +
                                '<span class="list-prop-item">' + response.data.property_name + '</span>' +
                                '<button data-room=' + response.data.room_id + ' id=' + response.data.id + '' +
                                ' addUrl=' + url + ' deleteUrl=' + deleteUrl + ' class="btn m-btn m-btn--hover-danger m-btn--icon btn-delete-prop"><i class="la la-trash"></i></button>' +
                                '</li>');
                            toastr.success('Thêm thành công', 'Thành công');
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });

            $('body').on('click', '.btn-delete-prop', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let room_id = $(this).attr2('data-room');
                let url = $(this).attr('addUrl');
                let deleteUrl = $(this).attr('deleteUrl');
                let formData = new FormData();
                formData.append('id', id);
                formData.append('room_id', room_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: deleteUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'success') {
                            $('.list-prop-item-' + room_id + '-' + id).remove();
                            $('.list-not-use-prop-' + room_id).append('<li class="item-' + response.data.room_id + '-' + id + '">' +
                                '<span class="add-property-item">' + response.data.property_name + '</span>' +
                                '<button data-room=' + response.data.room_id + ' id=' + response.data.id + '' +
                                ' addUrl=' + url + ' deleteUrl=' + deleteUrl + ' class="btn m-btn m-btn--hover-success m-btn--icon btn-add-prop"><i class="la la-plus"></i></button>' +
                                '</li>');
                            toastr.success('Xóa thành công', 'Thành công');
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });
        });
    </script>
@endsection
