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
                                        <label>Logo header <b class="text-danger">*</b></label><br>
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
                                        <label>Logo footer <b class="text-danger">*</b></label><br>
                                        <img id="is_image_logo_footer"
                                             src="{{ config('common.uploads.logo') . '/' . $inforWeb->logo_footer }}"
                                             width="100"
                                             class="mb-4"
                                        >
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="select_image_logo_footer" name="logo_footer"
                                                   accept="image/*">
                                            <label class="custom-file-label"
                                                   for="selectImage">Hãy chọn ảnh</label>
                                        </div>
                                        @if ($errors->has('logo_footer'))
                                            <b class="text-danger">{{ $errors->first('logo_footer') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Số điện thoại <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="phone" value="{{ old('phone', $inforWeb->phone) }}">
                                        @if ($errors->has('phone'))
                                            <b class="text-danger">{{ $errors->first('phone') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Địa chỉ chính <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="address" value="{{ old('address', $inforWeb->address) }}">
                                        @if ($errors->has('address'))
                                            <b class="text-danger">{{ $errors->first('address') }}</b>
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
                                    <div class="form-group m-form__group">
                                        <label>Youtube <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="youtube" value="{{ old('youtube', $inforWeb->youtube) }}">
                                        @if ($errors->has('youtube'))
                                            <b class="text-danger">{{ $errors->first('youtube') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Google Plus <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="google_plus" value="{{ old('google_plus', $inforWeb->google_plus) }}">
                                        @if ($errors->has('google_plus'))
                                            <b class="text-danger">{{ $errors->first('google_plus') }}</b>
                                        @endif
                                    </div>
                                    <input type="hidden" name="current_image_header" value="{{ $inforWeb->logo }}">
                                    <input type="hidden" name="current_image_footer" value="{{ $inforWeb->logo_footer }}">
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary">Sửa</button>
                                        <a class="btn btn-danger" href="{{ route('admin.index') }}">Hủy</a>
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
