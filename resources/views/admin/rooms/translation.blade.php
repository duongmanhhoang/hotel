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
                                    Tạo bản dịch của {{ $room->roomName->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post"
                                      action="{{ route('admin.rooms.storeTranslation', [$location_id, $origin->id]) }}"
                                      onsubmit="return validation()">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Chọn ngôn ngữ <b
                                                    class="text-danger">*</b></label>
                                        <select class="form-control m-input" name="lang_id">
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
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
                                            @if ($errors->has('sale_price'))
                                                <b class="text-danger">{{ $errors->first('sale_price') }}</b>
                                            @endif
                                            <b class="text-danger errors-sale-price"></b>
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
                                        <label>Mô tả chi tiết <b class="text-danger">*</b></label>
                                        <textarea class="form-control" name="description"
                                                  id="description">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <b class="text-danger">{{ $errors->first('description') }}</b>
                                        @endif
                                    </div>
                                    <input type="hidden" name="room_id" value="{{ $origin->room->id }}">
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
    @if ($origin->sale_price != null)
        <script>
            function validation() {
                 let sale_price = $('#sale_price').val();
                 if (sale_price.length == 0) {
                     $('.errors-sale-price').text('Vui lòng không để trống khi bản gốc có giá khuyến mãi');

                     return false;
                 }
            }
        </script>

    @endif
    <script>
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
