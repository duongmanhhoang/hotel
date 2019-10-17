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
                                    <tr>
                                        <td id="select_role_{{ $route->id }}">
                                            <div class="form-group">
                                                {{--                                                <select class="form-control" name="role_id" class="m-input select-role" multiple data-id="{{ $route->id }}">--}}
                                                {{--                                                    @foreach($roles as $role)--}}
                                                {{--                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                            </div>
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

                                        </td>
                                    </tr>
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
                    // ls.block('#select_role_' + $(v).attr('data-id'));
                    // ls.ajax(
                    //     {role_id:role_id,route_id:route_id,action:'addRole'},2,
                    //     ['val','#routeRouteAjax'],
                    //     (r,s,x) => {
                    //         if(s === "success") {
                    //             ls.unblock('#select_role_' + $(v).attr('data-id'));
                    //         }
                    //     },
                    //     (x,s,e) => {
                    //         if(s === "error") {
                    //             ls.unblock('#select_role_' + $(v).attr('data-id'));
                    //             swal(i18n.messages.error_swal,i18n.messages.error_swal_mess,"error");
                    //         }
                    //     }
                    // );
                });
                //event unselect
                $(v).on('select2:unselect', (r) => {
                    let role_id = r.params.data.id;
                    let route_id = $(v).attr('data-id');
                    ls.block('#select_role_' + $(v).attr('data-id'));
                    ls.ajax(
                        {role_id:role_id,route_id:route_id,action:'removeRole'},2,
                        ['val','#routeRouteAjax'],
                        (r,s,x) => {
                            if(s === "success") {
                                ls.unblock('#select_role_' + $(v).attr('data-id'));
                            }
                        },
                        (x,s,e) => {
                            if(s === "error") {
                                ls.unblock('#select_role_' + $(v).attr('data-id'));
                                swal(i18n.messages.error_swal,i18n.messages.error_swal_mess,"error");
                            }
                        }
                    );
                });
            });
        });
    </script>
@endsection
