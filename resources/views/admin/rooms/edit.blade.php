@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sửa : {{ $roomDetail->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.rooms.update', [$location->id, $room->id]) }}"
                                      enctype="multipart/form-data" onsubmit="return validation()">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--brand" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link @if (!session('image_active')) {{'active'}} @endif"
                                               data-toggle="tab" href="#m_tabs_info" role="tab">
                                                <i class="la la-info-circle"></i> Thông tin</a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link @if (session('image_active')) {{'active'}} @endif"
                                               data-toggle="tab" href="#m_tabs_images" role="tab">
                                                <i class="la la-image"></i> Ảnh</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane @if (!session('image_active')) {{'active'}} @endif"
                                             id="m_tabs_info" role="tabpanel">
                                            <div class="form-group m-form__group">
                                                <label>Ảnh</label>
                                                <br>
                                                <img id="is_image"
                                                     src="{{ asset(config('common.uploads.rooms')) . '/' . $room->image }}"
                                                     width="500px"
                                                     class="mb-4">
                                                <div></div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="select_image" name="image"
                                                           accept="image/*">
                                                    <label class="custom-file-label"
                                                           for="selectImage">Chọn ảnh</label>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Hạng phòng <b class="text-danger">*</b></label>
                                                <input type="text" class="form-control m-input" name="name"
                                                       value="{{ old('name', $roomDetail->name) }}">
                                                @if ($errors->has('name'))
                                                    <b class="text-danger">{{ $errors->first('name') }}</b>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <label>Số người lớn</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="number" class="form-control m-input"
                                                               value="{{ old('adults', $room->adults) }}"
                                                               name="adults"
                                                               min="0" max="10"
                                                               autocomplete="off">
                                                    </div>
                                                    <b class="text-danger">
                                                        @if ($errors->has('adults'))
                                                            {{ $errors->first('adults') }}
                                                        @endif
                                                    </b>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="">Số trẻ em</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="number" class="form-control m-input"
                                                               value="{{ old('children', $room->children) }}" id="children"
                                                               name="children"
                                                               min="0" max="10"
                                                               autocomplete="off">
                                                    </div>
                                                    <b class="text-danger">
                                                        @if ($errors->has('children'))
                                                            {{ $errors->first('children') }}
                                                        @endif
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Danh sách phòng <b
                                                            class="text-danger">*</b></label>
                                                <br>
                                                <div class="form-group m-form__group">
                                                    <div>
                                                        <div class="col-lg-10">
                                                            @php($i = 0)
                                                            @foreach($listRoomNumber as $item)
                                                                <div data-repeater-item="{{ $item }}"
                                                                     class="row m--margin-bottom-10-desktop"
                                                                     id="room-number-{{ $item }}">
                                                                    <div class="col-md-3">
                                                                        <p>{{ $item }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a href="javascript:;"
                                                                           data-repeater-delete="{{ $item }}"
                                                                           class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill btn-list-room-number-delete">
                                                                            <i class="la la-trash-o"></i>Xóa
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @php($i++)
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m_repeater_edit">
                                                    <div class="form-group  m-form__group row m_repeater_edit">
                                                        <div data-repeater-list="" class="col-lg-10">
                                                            <div data-repeater-item
                                                                 class="form-group m-form__group row align-items-center">
                                                                <div class="col-md-3">
                                                                    <div class="m-form__group m-form__group--inline">
                                                                        <div class="m-form__control">
                                                                            <input type="text" name="room_number[]"
                                                                                   class="form-control m-input">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div data-repeater-delete=""
                                                                         class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
                                                                        <i class="la la-trash-o"></i>Xóa
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-form__group form-group row">
                                                        <div class="col-lg-4">
                                                            <div data-repeater-create=""
                                                                 class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                                                                <i class="la la-plus"></i>Thêm
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($errors->has('list_room_number.*'))
                                                    <b class="text-danger">{{ $errors->first('list_room_number.*') }}</b>
                                                @endif
                                                @if (session('room_number_used'))
                                                    <b class="text-danger">{{ __('messages.Room_number_used') }}</b>
                                                @endif
                                                <b class="text-danger" id="errors-room-number"></b>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <label>Giá</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="text" class="form-control m-input" name="price"
                                                               value="{{ old('price', $roomDetail->price) }}">
                                                    </div>
                                                    @if ($errors->has('price'))
                                                        <b class="text-danger">{{ $errors->first('price') }}</b>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="">Giá khuyến mãi</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="text" class="form-control m-input" name="sale_price"
                                                               value="{{ old('sale_price', $roomDetail->sale_price) }}" id="sale_price">
                                                    </div>
                                                    <b class="sale_price_errors text-danger">
                                                        @if ($errors->has('sale_price'))
                                                            {{ $errors->first('sale_price') }}
                                                        @endif
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <label>Ngày bắt đầu</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="text" class="form-control m-input my-datepicker"
                                                               value="{{ old('sale_start_at', $room->sale_start_at) }}" id="sale_start_at"
                                                               name="sale_start_at"
                                                               autocomplete="off">
                                                    </div>
                                                    <b class="sale_start_at_errors text-danger">
                                                        @if ($errors->has('sale_start_at'))
                                                            {{ $errors->first('sale_start_at') }}
                                                        @endif
                                                    </b>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="">Ngày kết thúc</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="text" class="form-control m-input my-datepicker"
                                                               value="{{ old('sale_end_at', $room->sale_end_at) }}" id="sale_end_at"
                                                               name="sale_end_at"
                                                               autocomplete="off">
                                                    </div>
                                                    <b class="sale_end_at_errors text-danger">
                                                        @if ($errors->has('sale_end_at'))
                                                            {{ $errors->first('sale_end_at') }}
                                                        @endif
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Mô tả ngắn <b
                                                            class="text-danger">*</b></label>
                                                <textarea class="form-control" name="short_description"
                                                          rows="10">{{ old('short_description', $roomDetail->short_description) }}</textarea>
                                                @if ($errors->has('short_description'))
                                                    <b class="text-danger">{{ $errors->first('short_description') }}</b>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label>Chi tiết <b class="text-danger">*</b></label>
                                                <textarea class="form-control" name="description"
                                                          id="description">{{ old('description', $roomDetail->description) }}</textarea>
                                                @if ($errors->has('description'))
                                                    <b class="text-danger">{{ $errors->first('description') }}</b>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tab-pane @if (session('image_active')) {{'active'}} @endif"
                                             id="m_tabs_images" role="tabpanel">
                                            <div class="form-group m-form__group">
                                                <button type="button" class="btn btn-primary btn-upload"
                                                        data-toggle="modal" data-target="#m_modal_4"
                                                        deleteUrl="{{ route('admin.rooms.destroyImage') }}">Thêm ảnh
                                                </button>
                                            </div>
                                            <div class="row">
                                                @foreach ($images as $image)
                                                    <div class="col-md-3 admin-image-grid">
                                                        <img src="{{ asset(config('common.uploads.libraries')) }}/{{ $image->name }}"
                                                             class="img-fluid admin-image-gallery">
                                                        <a href="{{ route('admin.rooms.deleteImage', $image->id) }}"
                                                           class="btn btn-danger btn-img">Xóa
                                                            ảnh</a>
                                                    </div>
                                                @endforeach
                                                <div class="modal fade show" id="m_modal_4" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Thêm
                                                                    ảnh</h5>
                                                                <a href="">x</a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="m-dropzone dropzone m-dropzone--success dz-clickable"
                                                                     action="{{ route('admin.rooms.uploadImage', $room->id) }}"
                                                                     id="m-dropzone-three">
                                                                    @csrf
                                                                    <div class="m-dropzone__msg dz-message needsclick">
                                                                        <h3 class="m-dropzone__msg-title">Thả ảnh
                                                                            vào để tải lên (Ảnh sẽ tự động
                                                                            upload)</h3>
                                                                        <span class="m-dropzone__msg-desc">Chỉ chấp nhận ảnh định dạng jpg, jpeg, png. Dung lượng tối đa là 2MB</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($roomIds as $key => $roomId)
                                        <input type="hidden" name="roomIds[{{ $key }}]" value="{{ $roomId }}">
                                    @endforeach
                                    <input type="hidden" name="listRoomsNumber" id="listRoomsNumber"
                                           value="{{ json_encode($listLocationRoomsNumber) }}">
                                    <input type="hidden" name="roomDetailId" value="{{ $roomDetail->id }}">
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary">Sửa</button>
                                    </div>
                                </form>
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
        function validation() {
            let sale_price = $('#sale_price').val();
            let sale_start_at = $('#sale_start_at').val();
            let sale_end_at = $('#sale_end_at').val();
            let listRoomsNumner = JSON.parse($('#listRoomsNumber').val());
            if (sale_start_at.length || sale_end_at.length != 0) {
                if (sale_price.length == 0) {
                    $('.sale_price_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
                    $('.sale_start_at_errors').text('');
                    $('.sale_end_at_errors').text('');
                    return false;
                }
                if (sale_start_at.length == 0) {
                    $('.sale_price_errors').text('');
                    $('.sale_start_at_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
                    $('.sale_end_at_errors').text('');
                    return false;
                }
                if (sale_end_at.length == 0) {
                    $('.sale_price_errors').text('');
                    $('.sale_start_at_errors').text('');
                    $('.sale_end_at_errors').text('Vui lòng không bỏ trống nếu bạn đặt lịch khuyến mãi');
                    return false;
                }
            }

            let listUsed = [];
            $("input[name='room_number[]']").map(function () {
                let value = $(this).val();

                if (listRoomsNumner.find(item => item == value)) {
                    listUsed.push(value);
                }
            });

            if (listUsed.length > 0) {
                $('#errors-room-number').text(`Các số phòng sau đã được sử dụng ${listUsed.join()}`);

                return false;
            }

        }

        $(".m_repeater_edit").repeater({
            initEmpty: true, show: function () {
                $(this).slideDown();
            }, hide: function (e) {
                $(this).slideUp(e)
            }
        });

        $('.my-datepicker').datepicker({
            todayHighlight: !0,
            autoclose: !0,
            format: "yyyy-mm-dd"
        });

        $('#description').summernote({
            height: 400,
            toolbar: [
                ['style', ['fontname', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                ['color', ['color']],
                ['height', ['height']],
                ['misc', ['codeview', 'undo', 'redo']]
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-list-room-number-delete').click(function () {
            let room_number = $(this).attr('data-repeater-delete');
            let formData = new FormData();
            formData.append('room_number', room_number);
            $.ajax({
                contentType: false,
                processData: false,
                url: '{{ route('admin.rooms.deleteRoomNumber', [$location->id, $room->id]) }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (response) {
                    if (response.messages == 'last-room') {
                        toastr.error('Bạn không thể xóa toàn bộ phòng', 'Không thể xóa');
                    }
                    if (response.messages == 'error') {
                        toastr.error('Phòng này đang được sử dụng', 'Không thể xóa');
                    }
                    if (response.messages == 'success') {
                        toastr.success('Xóa thành công', 'Thành công');
                        $('#room-number-' + room_number).remove();
                    }

                }, error: function () {

                },
            });
        });

        let deleteUrl = $('.btn-upload').attr('deleteUrl');
        let DropzoneDemo = {
            init: function () {
                Dropzone.options.mDropzoneThree = {
                    maxFilesize: 2,
                    maxFiles: 1000,
                    dictRemoveFile: 'Xóa',
                    dictFileTooBig: 'File lớn hơn 2 MB',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    acceptedFiles: ".jpeg,.jpg,.png,",
                    addRemoveLinks: true,
                    renameFile: function (file) {
                        let dt = new Date();
                        let time = dt.getTime();
                        return time + '-' + file.name;
                    },
                    timeout: 5000,
                    success: function (file, response) {
                        console.log(response);
                    },
                    error: function (file, response) {
                        return false;
                    },
                    removedfile: function (file) {
                        let name = file.upload.filename;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            url: deleteUrl,
                            data: {filename: name},
                            success: function (data) {
                                console.log(name);
                            },
                            error: function (e) {
                                console.log(e);
                            }
                        });
                        let fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    },

                    success: function (file, response) {
                        console.log(response);
                    },
                    error: function (file, response) {
                        return false;
                    }
                }
            }
        };
        DropzoneDemo.init();
    </script>
@endsection

