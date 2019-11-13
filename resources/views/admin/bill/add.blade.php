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
                                    @if(isset($data)) Sửa thu chi @elseif(isset($dataTranslate)) Dịch ngôn ngữ @else
                                        Thêm thu chi @endif
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
                                        <input type="text" class="form-control m-input" name="title"
                                               value="{{ $data->title ?? $dataTranslate->title ?? old('title') }}">
                                        @if ($errors->has('title'))
                                            <b class="text-danger">{{ $errors->first('title') }}</b>
                                        @endif
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label>Loại <b class="text-danger">*</b></label>
                                        <select name="type" class="form-control">
                                            @php $typeArrays = [1 => 'Thu', 2 => 'Chi']@endphp
                                            @foreach($typeArrays as $key => $value)
                                                <option value="{{$key}}" {{isset($data) && $data->type == $key ? 'selected' : ''}}> {{ $value }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label>Địa điểm <b class="text-danger">*</b></label>
                                        <select name="location_id" class="form-control">
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}" {{ isset($data) && $data->location->id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label>Tiền <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="money"
                                               value="{{ $data->money ?? $dataTranslate->money ?? old('money') }}">
                                        @if ($errors->has('money'))
                                            <b class="text-danger">{{ $errors->first('money') }}</b>
                                        @endif
                                    </div>

                                    {{--<div class="form-group m-form__group">--}}
                                    {{--<label>Phòng <b class="text-danger">*</b></label>--}}
                                    {{--<select name="location_id" class="form-control">--}}
                                    {{--@foreach($rooms as $room)--}}
                                    {{--<option value="{{$room->id}}">{{ $room->name }}</option>--}}
                                    {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--</div>--}}

                                    <div class="form-group m-form__group">
                                        <label>Nội dung <b class="text-danger">*</b></label>
                                        <textarea name="body" class="form-control"
                                                  style="height: 124px">{{$data->body ?? ''}}</textarea>
                                        @if ($errors->has('body'))
                                            <b class="text-danger">{{ $errors->first('body') }}</b>
                                        @endif
                                    </div>

                                    <div class="form-group m-form__group">
                                        <a href="{{ route('admin.bill.list') }}" class="btn btn-danger">Quay lại</a>
                                        <button class="btn btn-primary">@if(isset($data)) Sửa  @else Tạo @endif</button>
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