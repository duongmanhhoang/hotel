@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Quản lý ngôn ngữ
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <form method="get"
                                                              action="">
                                                            <input type="text" class="form-control m-input"
                                                                   name="keyword"
                                                                   placeholder="Tìm kiếm">
                                                        </form>
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span><i class="la la-plus"></i> Thêm</span>
                                            </a>
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cờ</th>
                                        <th>Ngôn ngữ</th>
                                        <th>Tên viết tắt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($languages as $language)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{ asset($language->flag) }}"></td>
                                            <td>
                                                {{ $language->name }}
                                            </td>
                                            <td>{{ $language->short }}</td>
{{--                                            <td>--}}
{{--                                                <a href="{{ route('admin.locations.edit', $location->id) }}"--}}
{{--                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"--}}
{{--                                                   title="{{ __('messages.Edit') }}"><i class="la la-edit"></i></a>--}}
{{--                                                <form method="post"--}}
{{--                                                      action="{{ route('admin.locations.destroy', $location->id) }}"--}}
{{--                                                      class="form_content" id="form-delete-{{ $location->id }}">--}}
{{--                                                    {{ method_field('DELETE') }}--}}
{{--                                                    @csrf--}}
{{--                                                    <button id="{{ $location->id }}" type="submit"--}}
{{--                                                            class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-submit"--}}
{{--                                                            title="{{ __('messages.Delete') }}">--}}
{{--                                                        <i class="la la-trash"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
                                        </tr>
                                        @php ($i++)
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $languages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
