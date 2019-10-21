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
                                    Tạo phòng trong cơ sở: {{ $location->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.rooms.store', $location->id) }}"
                                      enctype="multipart/form-data" onsubmit="return validation()">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ảnh</label>
                                        <br>
                                        <img id="is_image"
                                             src="{{ asset(config('common.images.default')) }}" width="500px"
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
                                               value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>Số người lớn</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="number" class="form-control m-input"
                                                       value="{{ old('adults') }}"
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
                                                       value="{{ old('children') }}" id="children"
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
                                        <label>Danh sách phòng <b class="text-danger">*</b></label>
                                        <br>
                                        <div class="m_repeater">
                                            <div class="form-group  m-form__group row m_repeater">
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
																<span>
																	<i class="la la-trash-o"></i>
																	<span>Xóa</span>
																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group form-group row">
                                                <div class="col-lg-4">
                                                    <div data-repeater-create=""
                                                         class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
														<span>
															<i class="la la-plus"></i>
															<span>Thêm</span>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('room_number.*'))
                                            <b class="text-danger">{{ $errors->first('room_number.*') }}</b>
                                        @endif
                                        @if ($errors->has('room_number'))
                                            <b class="text-danger">{{ $errors->first('room_number') }}</b>
                                        @endif
                                        <b class="text-danger" id="errors-room-number"></b>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>Giá</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control m-input" name="price"
                                                       value="{{ old('price') }}">
                                            </div>
                                            @if ($errors->has('price'))
                                                <b class="text-danger">{{ $errors->first('price') }}</b>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="">Giá khuyến mãi</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control m-input" name="sale_price"
                                                       value="{{ old('sale_price') }}" id="sale_price">
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
                                                       value="{{ old('sale_start_at') }}" id="sale_start_at"
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
                                                       value="{{ old('sale_end_at') }}" id="sale_end_at"
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
                                                  rows="10">{{ old('short_description') }}</textarea>
                                        @if ($errors->has('short_description'))
                                            <b class="text-danger">{{ $errors->first('short_description') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Chi tiết <b class="text-danger">*</b></label>
                                        <textarea class="form-control" name="description"
                                                  id="description">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <b class="text-danger">{{ $errors->first('description') }}</b>
                                        @endif
                                    </div>
                                    @foreach($roomIds as $key => $roomId)
                                        <input type="hidden" name="roomIds[{{ $key }}]" value="{{ $roomId }}">
                                    @endforeach
                                    <input type="hidden" name="listRoomsNumber" id="listRoomsNumber"
                                           value="{{ json_encode($listRoomsNumber) }}">
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary">Tạo</button>
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

        $(".m_repeater").repeater({
            initEmpty: !1, show: function () {
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
    </script>
@endsection

