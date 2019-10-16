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
                                    @if(isset($data)) Sửa bài viết @elseif(isset($dataTranslate)) Dịch bài viết @else
                                        Thêm bài viết @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? null }}">

                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    @if(!isset($dataTranslate))
                                        @php $image = isset($data) ? asset(config('common.uploads.posts')) . '/' . $data->image : asset(config('common.images.default'));  @endphp
                                        <div class="form-group m-form__group">
                                            <label>Ảnh đại diện <b class="text-danger">*</b></label>
                                            <br>
                                            <img id="is_image"
                                                 src="{{ $image }}"
                                                 width="500"
                                                 class="mb-4"
                                            >
                                            <div></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="select_image"
                                                       name="image"
                                                       accept="image/*">
                                                <label class="custom-file-label"
                                                       for="selectImage">Hãy chọn ảnh</label>
                                            </div>
                                            @if ($errors->has('image'))
                                                <p class="text-danger">{{ $errors->first('image') }}</p>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="form-group m-form__group">
                                        <label>Tiêu đề <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="title"
                                               value="{{ $data->title ?? old('title') }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label>Mô tả <b class="text-danger">*</b></label>
                                        <textarea name="description"
                                                  class="form-control swal2-textarea">{{$data->description ?? ''}}</textarea>
                                        @if ($errors->has('description'))
                                            <b class="text-danger">{{ $errors->first('description') }}</b>
                                        @endif
                                    </div>

                                    @if(isset($categories))
                                        <div class="form-group m-form__group">
                                            <label>Danh mục</label>
                                            <div class="bs-select">
                                                <select class="bs-select form-control" tabindex="-98"
                                                        name="category_id">
                                                    @foreach($categories as $value)
                                                        <option value="{{ $value->id }}" {{( isset($data) && $data->category != null && $data->category->id == $value->id) ? 'selected' : ''}}>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if(isset($dataTranslate))
                                        <div class="form-group m-form__group">
                                            <label>Ngôn ngữ</label>
                                            <div class="bs-select">
                                                <select class="bs-select form-control" tabindex="-98"
                                                        name="lang_id">
                                                    @foreach($language as $value)
                                                        <option value="{{ $value->id }}" {{isset($data) && $data->lang_id == $value->id ? 'selected' : ''}}>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group m-form__group">
                                        <label>Nội dung <b class="text-danger">*</b></label>
                                        <textarea name="body" id="body">{{$data->body ?? ''}}</textarea>
                                        @if ($errors->has('body'))
                                            <b class="text-danger">{{ $errors->first('body') }}</b>
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

@section('script')
    <script>
        $('#body').summernote({
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
