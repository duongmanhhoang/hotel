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
                                    Quản lý modules
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
                                    </div>
                                </div>
                                @foreach ($routes as $route)
                                            <div class="form-group m-form__group row">
                                                <label class="col-form-label col-lg-3 col-sm-12">{{ $route->name }}</label>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <select class="form-control m-select2 role-select" name="role_id" multiple="multiple" data-id="{{ $route->id }}">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" {{ in_array($role->id, $route->getPermission) ? 'selected' : '' }} >{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                @endforeach
                                {{ $routes->links() }}
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
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".role-select").select2({placeholder: "Chọn role"})
            const count = '{{ $count }}';
            if (count === 'error') {
                toastr.error('Có lỗi xảy ra, không thể cập nhập module', 'Thất bại');
            } else if (count == 0) {
                toastr.success(`Không có module nào được thêm`, 'Thông báo');
            } else {
                toastr.success(`Thêm mới ${count} modules thành công`, 'Thông báo');
            }

            $("select[name='role_id']").each((i,v)=> {
                // add role
                $(v).on('select2:select', (r) => {
                    let role_id = r.params.data.id;
                    let route_id = $(v).attr('data-id');
                    let formData = new FormData();
                    formData.append('id', route_id);
                    formData.append('role_id', role_id);
                    $.ajax({
                        contentType: false,
                        processData: false,
                        url: '{{ route('admin.routes.store') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        success: function (response) {
                            if (response.messages == 'errors') {
                                toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                            }

                            if (response.messages == 'success') {
                                toastr.success('Thêm thành công', 'Thành công');
                            }
                        }, error: function () {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                        },
                    });
                });
                //event unselect

                $(v).on('select2:unselect', (r) => {
                    let role_id = r.params.data.id;
                    let route_id = $(v).attr('data-id');
                    let formData = new FormData();
                    formData.append('id', route_id);
                    formData.append('role_id', role_id);
                    $.ajax({
                        contentType: false,
                        processData: false,
                        url: '{{ route('admin.routes.delete') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        success: function (response) {
                            if (response.messages == 'errors') {
                                toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                            }

                            if (response.messages == 'success') {
                                toastr.success('Xóa thành công', 'Thành công');
                            }
                        }, error: function () {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                        },
                    });
                });
            });
        });
    </script>
@endsection
