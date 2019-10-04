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
                                    Thêm ngôn ngữ
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>{{ __('messages.Feature_image') }}</label>
                                        <br>
                                        <img id="is_image"
                                             src="{{ asset(config('upload.default_image')) }}"
                                             class="admin-image-500">
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="select_image" name="image"
                                                   accept="image/*">
                                            <label class="custom-file-label"
                                                   for="selectImage">{{ __('messages.Select_image') }}</label>
                                        </div>
                                        @if ($errors->has('image'))
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Tên <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Tên viết tắt <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="short" value="{{ old('short') }}">
                                        @if ($errors->has('short'))
                                            <b class="text-danger">{{ $errors->first('short') }}</b>
                                        @endif
                                    </div>
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
