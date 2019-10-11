@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            @if (session('locale') == config('common.languages.default'))
                <div class="col-xl-4">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Thêm tiện nghi
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <form method="post" action="{{ route('admin.properties.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" name="name" class="form-control m-input">
                                    </div>
                                    @if ($errors->has('name'))
                                        <b class="text-danger">{{ $errors->first('name') }}</b>
                                    @endif
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn-primary btn">Tạo
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-8">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Danh sách tiện nghi
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
                                                <div class="col-md-6">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <form method="get"
                                                              action="{{ route('admin.properties.index') }}">
                                                            <input type="text" class="form-control m-input"
                                                                   name="keyword"
                                                                   placeholder="Nhập tên">
                                                        </form>
                                                        <span class="m-input-icon__icon m-input-icon__icon--left"
                                                              style="margin-top: 10px">
                                                            <i class="la la-search search-item"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>Tên</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($properties as $property)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="name-property-{{ $property->id }}"> {{ $property->name }}</td>
                                            <td>
                                                <button data-toggle="modal"
                                                        data-target="#m_modal_edit_{{ $property->id }}"
                                                        class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                        title="Chỉnh sửa"><i class="la la-edit"></i>
                                                </button>
                                                <a href="{{ route('admin.properties.translation', session('locale') == config('common.languages.default') ? $property->id : $property->lang_parent_id) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill float-left"
                                                   title="{{ __('messages.Create_translate') }}">
                                                    <i class="la la-exchange"></i>
                                                </a>
                                                <form method="post" id="form-{{ $property->id }}"
                                                      action="{{ route('admin.properties.delete', $property->id) }}"
                                                      class="float-left">
                                                    @csrf
                                                    <button
                                                        propertyId="{{ $property->id }}"
                                                        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-delete"
                                                        title="Xóa"><i class="la la-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php ($i++)
                                        <div class="modal fade show" id="m_modal_edit_{{ $property->id }}" tabindex="-1"
                                             role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">Chỉnh sửa: {{ $property->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="form-control-label">Tên</label>
                                                                <input type="text" id="name-{{ $property->id }}"
                                                                       name="name" class="form-control"
                                                                       value="{{ old('name', $property->name) }}">
                                                            </div>
                                                            <input type="hidden" name="id" id="id-{{ $property->id }}"
                                                                   value="{{ $property->id }}">
                                                            <input type="hidden" name="url" id="url-{{ $property->id }}"
                                                                   value="{{ route('admin.properties.update', $property->id) }}">
                                                            <div class="form-group">
                                                                <button id="{{ $property->id }}"
                                                                        class="btn btn-primary btn-submit-edit">Cập nhập
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $properties->links() }}
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
                let id = $(this).attr('propertyId');
                let form = $('#form-' + id);
                swal({
                    title: "Bạn chắc chắn chứ",
                    text: "Khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
                    type: "warning",
                    showCancelButton: !0,
                    cancelButtonText: "Hủy",
                    confirmButtonText: "Đồng ý"
                }).then(function (e) {
                    e.value && form.submit();
                })
            })

            $('.btn-submit-edit').click(function (e) {
                e.preventDefault();
                let pro_id = $(this).attr('id');
                let id = $('#id-' + pro_id).val();
                let name = $('#name-' + pro_id).val();
                let url = $('#url-' + pro_id).val();
                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'error') {
                            toastr.error(response.errors.name, 'Cảnh báo!!');
                        }

                        if (response.messages == 'success') {
                            toastr.success('Cập nhập thành công', 'Thành công');
                            $('.name-property-' + pro_id).text(response.data['name'])
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });
        });
    </script>
@endsection
