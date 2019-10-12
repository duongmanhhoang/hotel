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
                                    Thêm danh mục
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

                                    <div class="form-group m-form__group">
                                        <label>Tên <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="name"
                                               value="{{ $data->name ?? $dataTranslate->name ?? old('name') }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>

                                    @if(!isset($dataTranslate))
                                        <div class="form-group m-form__group">
                                            <label>Danh mục cha</label>
                                            <div class="bs-select">
                                                <select class="bs-select form-control" tabindex="-98" name="parent_id">
                                                    <option value="{{ 0 }}"></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ isset($data) && $data->parent_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if(isset($dataTranslate))
                                        @if(isset($language))
                                            <div class="form-group m-form__group">
                                                <label>Ngôn ngữ</label>
                                                <div class="bs-select">
                                                    <select class="bs-select form-control" tabindex="-98"
                                                            name="lang_id">
                                                        @foreach($language as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

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
