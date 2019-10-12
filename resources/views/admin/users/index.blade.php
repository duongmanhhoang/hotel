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
	                                    Quản lý người dùng
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
	                                            <a href="{{ route('admin.users.create') }}"
	                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
	                                                <span><i class="la la-plus"></i> Thêm</span>
	                                            </a>
	                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <table class="table">
	                                    <thead>
	                                    <tr>
	                                        <th>STT</th>
	                                        <th>Tên người dùng</th>
	                                        <th>Email</th>
	                                        <th>Số điện thoại</th>
	                                        <th>Địa chỉ</th>
	                                        <th>Vai trò</th>
	                                        <th>Trạng thái</th>
	                                        <th>Hành động</th>
	                                    </tr>
	                                    </thead>
	                                    <tbody>
	                                    @php ($i = 1)
	                                    @foreach ($users as $user)
	                                        <tr>
	                                            <td>
	                                            	{{ $i }}
	                                            </td>
	                                            <td>
													{{ $user->full_name }}
	                                            </td>
	                                            <td>
	                                                {{$user->email}}
	                                            </td>
	                                            <td>
	                                            	{{ $user->phone }}
	                                            </td>
	                                            <td>
	                                            	{{ $user->address }}
	                                            </td>
	                                            <td>
	                                            	{{ $user->role->name }}
	                                            </td>
	                                            <td>
	                                            	@if ($user->is_active)
	                                            		<p class="text-success">Đã kích hoạt</p>
	                                            	@else 
	                                            		<p class="text-danger">Chưa kích hoạt</p>
	                                            	@endif
	                                            	
	                                            </td>
	                                            <td>
	                                                <a href="{{ route('admin.users.edit', $user->id) }}"
	                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
	                                                   title="Chỉnh sửa">
	                                                    <i class="la la-edit"></i>
	                                                </a>
	                                                @if ( $user->is_active )
														<a href="{{ route('admin.users.deactive', $user->id) }}"
		                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
		                                                   title="Hủy kích hoạt">
		                                                    <i class="la la-ban"></i>
	                                                	</a>
	                                                @else 
														<a href="{{ route('admin.users.active', $user->id) }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Kích hoạt">
                                                        <i class="la la-check"></i>
                                                    	</a>
	                                                @endif
		                                                <form id="form-{{ $user->id }}" method="post" 
	                                                      action="{{ route('admin.users.delete', $user->id) }}" class="float-left">
		                                                    @csrf
		                                                    <button userId="{{ $user->id }}"
		                                                            class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa"><i
		                                                                class="la la-trash"></i>
		                                                    </button>
	                                                	</form>
	                                            </td>
	                                        </tr>
	                                        @php ($i++)
	                                    @endforeach
	                                    </tbody>
	                                </table>
	                                {{ $users->links() }}
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
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('userId');
                var form = $('#form-' + id);
                swal({
                    title: "Bạn có chắc chắn muốn xóa tài khoản này không?",
                    text: "Khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
                    type: "warning",
                    showCancelButton: !0,
                    cancelButtonText: "Hủy",
                    confirmButtonText: "Đồng ý"
                }).then(function (e) {
                    e.value && form.submit();
                })
            })
        });
    </script>
@endsection