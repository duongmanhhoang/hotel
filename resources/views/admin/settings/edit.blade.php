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
                                    Chỉnh sửa thông tin website
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.settings.update', $inforWeb->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Logo <b class="text-danger">*</b></label><br>
                                        <img id="is_image"
                                             src="{{ config('common.uploads.logo') . '/' . $inforWeb->logo }}"
                                             width="100"
                                             class="mb-4"
                                        >
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="select_image" name="logo"
                                                   accept="image/*">
                                            <label class="custom-file-label"
                                                   for="selectImage">Hãy chọn ảnh</label>
                                        </div>
                                        @if ($errors->has('logo'))
                                            <b class="text-danger">{{ $errors->first('logo') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Facebook <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="facebook" value="{{ old('facebook', $inforWeb->facebook) }}">
                                        @if ($errors->has('facebook'))
                                            <b class="text-danger">{{ $errors->first('facebook') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Twitter <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="twitter" value="{{ old('twitter', $inforWeb->twitter) }}">
                                        @if ($errors->has('twitter'))
                                            <b class="text-danger">{{ $errors->first('twitter') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Instagram <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="instagram" value="{{ old('instagram', $inforWeb->instagram) }}">
                                        @if ($errors->has('instagram'))
                                            <b class="text-danger">{{ $errors->first('instagram') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Linkedin <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="linkedin" value="{{ old('linkedin', $inforWeb->linkedin) }}">
                                        @if ($errors->has('linkedin'))
                                            <b class="text-danger">{{ $errors->first('linkedin') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Tripadvisor <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="tripadvisor" value="{{ old('tripadvisor', $inforWeb->tripadvisor) }}">
                                        @if ($errors->has('tripadvisor'))
                                            <b class="text-danger">{{ $errors->first('tripadvisor') }}</b>
                                        @endif
                                    </div>
                                    <input type="hidden" name="current_image" value="{{ $inforWeb->logo }}">
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
