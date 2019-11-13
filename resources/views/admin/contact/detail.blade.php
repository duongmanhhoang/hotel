@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h2>{{ $data->subject }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <p style="font-size: 18px">Người gửi: {{ $data->name }} <span style="font-size: 14px; color: lightgrey; margin-left: 24px">Ngày gửi: {{ $data->updated_at }}</span></p>

                        <hr>
                        <p style="font-size: 18px">Nội dung: {{ $data->text }}</p>

                        <a href="{{ route('admin.contact.index') }}" class="btn btn-danger">Quay lại</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
