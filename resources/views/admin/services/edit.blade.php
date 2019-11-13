@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sửa dịch vụ
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.services.update', $service->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Ảnh đại diện <b class="text-danger">*</b></label>
                                        <br>
                                        <img id="is_image"
                                             src="{{ asset(config('common.uploads.services' ). '/' . $service->image) }}"
                                             width="100"
                                             class="mb-4"
                                        >
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="select_image" name="image"
                                                   accept="image/*">
                                            <label class="custom-file-label"
                                                   for="selectImage">Hãy chọn ảnh</label>
                                        </div>
                                        @if ($errors->has('image'))
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>
                                    @if (session('locale') == config('common.languages.default'))
                                        <div class="form-group m-form__group">
                                            <label>Đơn vị <b class="text-danger">*</b></label>
                                            <select class="form-control m-select2" id="unit_select" name="unit_id">
                                                @foreach ($units as $unit)
                                                    <option {{ $unit->id == $service->unit_id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label>Danh mục <b class="text-danger">*</b></label>
                                            <select class="form-control m-select2" id="categories_select"
                                                    name="cate_id">
                                                @foreach ($categories as $category)
                                                    <option {{ $category->id == $service->cate_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group m-form__group">
                                        <label>Tên <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="name"
                                               value="{{ old('name', $service->name) }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Giá tiền <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="price"
                                               value="{{ old('price', $service->price) }}">
                                        @if ($errors->has('price'))
                                            <b class="text-danger">{{ $errors->first('price') }}</b>
                                        @endif
                                    </div>
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
        $("#unit_select, #categories_select").select2({placeholder: ""})
    </script>
@endsection