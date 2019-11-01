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
                                    Danh sách phòng - {{ $location->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input m-input--solid"
                                                       placeholder="Tìm kiếm..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('admin.rooms.create', $location->id) }}"
                                       class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
												<span>
													<i class="la la-plus"></i>
													<span>Thêm mới</span>
												</span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>

                        <!--end: Search Form -->

                        <!--begin: Datatable -->
                        <div class="m_datatable" id="local_data"></div>
                    </div>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="dataUrl" value="{{ route('admin.rooms.datatable', $location->id) }}">
    <div class="modal fade" id="modal_prop" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel"></h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-6">
                        <div class="m-scrollable m-scroller ps"
                             data-scrollbar-shown="true"
                             data-scrollable="true"
                             data-height="150">
                            <form>
                                <ul id="list-not-use-prop" class="list-not-use-prop">
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="m-scrollable m-scroller ps"
                             data-scrollbar-shown="true"
                             data-scrollable="true"
                             data-height="150">
                            <ul id="list-props" class="list-props">
                            </ul>
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

            $('body').on('click', '.btn-add-prop', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let room_id = $(this).attr2('data-room');
                let url = $(this).attr('addUrl');
                let deleteUrl = $(this).attr('deleteUrl');
                let formData = new FormData();
                formData.append('id', id);
                formData.append('room_id', room_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'errors') {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                        }

                        if (response.messages == 'success') {
                            $('.item-' + room_id + '-' + id).remove();
                            $('.list-props-' + room_id).append('<li class="list-prop-item-' + response.data.room_id + '-' + id + '">' +
                                '<span class="list-prop-item">' + response.data.property_name + '</span>' +
                                '<button data-room=' + response.data.room_id + ' id=' + response.data.id + '' +
                                ' addUrl=' + url + ' deleteUrl=' + deleteUrl + ' class="btn m-btn m-btn--hover-danger m-btn--icon btn-delete-prop"><i class="la la-trash"></i></button>' +
                                '</li>');
                            toastr.success('Thêm thành công', 'Thành công');
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });

            $('body').on('click', '.btn-delete-prop', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let room_id = $(this).attr2('data-room');
                let url = $(this).attr('addUrl');
                let deleteUrl = $(this).attr('deleteUrl');
                let formData = new FormData();
                formData.append('id', id);
                formData.append('room_id', room_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: deleteUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'success') {
                            $('.list-prop-item-' + room_id + '-' + id).remove();
                            $('.list-not-use-prop-' + room_id).append('<li class="item-' + response.data.room_id + '-' + id + '">' +
                                '<span class="add-property-item">' + response.data.property_name + '</span>' +
                                '<button data-room=' + response.data.room_id + ' id=' + response.data.id + '' +
                                ' addUrl=' + url + ' deleteUrl=' + deleteUrl + ' class="btn m-btn m-btn--hover-success m-btn--icon btn-add-prop"><i class="la la-plus"></i></button>' +
                                '</li>');
                            toastr.success('Xóa thành công', 'Thành công');
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });
        });

        function deleteRoom(t) {
            let id = $(t).attr('roomId');
            let dataRow = parseInt($(t).attr('dataRow')) + 1;
            swal({
                title: "Bạn chắc chắn chứ",
                text: "Khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Hủy",
                confirmButtonText: "Đồng ý"
            }).then(function (e) {
                e.value && $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('admin.rooms.delete', [$location->id, '']) }}/${id}`,
                    type: 'POST',
                    success: function (response) {
                        if (response.messages == 'used') {
                            toastr.error('Phòng này đang được sử dụng', 'Thất bại');
                        }
                        if (response.messages == 'error') {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                        }
                        if (response.messages == 'success') {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload")
                        }
                        ;
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    },
                });
            })
        }

        let DataTable = {
            init: function () {
                let t;
                t = $(".m_datatable").mDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: $('#dataUrl').val(),
                                method: 'GET',
                                map: function (t) {
                                    let e = t;
                                    return void 0 !== t.data && (e = t.data), e
                                }
                            }
                        },
                    },
                    pageSize: 10,
                    serverPaging: !0,
                    serverFiltering: !0,
                    serverSorting: !0,
                    layout: {theme: "default", class: "", scroll: !1, footer: !1},
                    sortable: !0,
                    pagination: !0,
                    search: {input: $("#generalSearch")},
                    columns: [
                        // {
                        //     field: "id",
                        //     title: "#",
                        //     width: 50,
                        //     sortable: !1,
                        //     textAlign: "center",
                        //     selector: {class: "m-checkbox--solid m-checkbox--brand"}
                        // },
                        {
                            field: "image",
                            title: "Ảnh đại diện",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                return `<img src="{{ config('common.uploads.rooms') }}/${e.image}" class="rooms-image">`
                            }
                        },
                        {
                            field: "name",
                            title: "Tên phòng"
                        },
                        {
                            field: "price",
                            title: "Giá",
                            template: function (e) {
                                const sale = `<span><del>${e.price}</del></span><br/>
                                              <span>${e.sale_price} ${e.currency}`;
                                const normal = `<span>${e.price} ${e.currency}`;
                                if (e.sale_status) {
                                    return sale;
                                }

                                return normal;
                            }
                        },
                        {
                            field: "rating",
                            title: "Đánh giá",
                            template: function (e) {
                                return `${e.rating} {{ session('locale') == config('common.languages.default') ? 'sao' : 'stars' }}`
                            }
                        },
                        {
                            title: "Xem bản gốc",
                            field: "Origin",
                            template: function (e) {
                                if (`{{ session('locale') }}` != `{{ config('common.languages.default') }}`) {
                                    return `<a href="{{ route('admin.rooms.showOriginal', [$location->id, '']) }}/${e.id}">Xem bản gốc</a>`
                                }

                                return '-'
                            }
                        },
                        {
                            field: "Actions",
                            width: 150,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e, a) {
                                const edit = `<a href="{{ route('admin.rooms.edit', [$location->id, '']) }}/${e.id}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                       id="edit-${e.id}"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;
                                const translate = `<a href="{{ route('admin.rooms.translation', [$location->id, '']) }}/${e.baseLangId}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Dịch">
                                                        <i class="la la-exchange"></i>
                                             </a>`;
                                const deleteRoom = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="deleteRoom(this)" dataRow="${a}" roomId="${e.room_details[0].id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;
                                const addProps = `<button data-toggle="modal"
                                                            data-target="#modal_prop"
                                                            onclick="addProps(this)"
                                                            roomId="${e.id}"
                                                            class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                                                            title="Thêm tiện nghi"><i
                                                            class="la la-magic"></i></button>`;

                                // if (e.status == 1) {
                                //     return `${edit} ${deactive}`
                                // }

                                return `${edit} ${translate} ${deleteRoom} ${addProps}`
                            }
                        }
                    ]
                }), $("#m_form_status").on("change", function () {
                    t.search($(this).val(), "status")
                }), $("#m_form_status, #m_form_type").selectpicker()
            }
        };
        jQuery(document).ready(function () {
            DataTable.init()
        });

        function addProps(t) {
            let id = $(t).attr('roomId');
            $('#list-props').removeClass();
            $('#list-props li').remove();
            $('#list-not-use-prop li').remove();
            $('#list-not-use-prop').removeClass();
            $('#list-props').addClass(`list-props-${id}`);
            $('#list-not-use-prop').addClass(`list-not-use-prop-${id}`);
            $.ajax({
                contentType: false,
                processData: false,
                url: `{{ route('admin.properties.getByRoom', '') }}/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    let listNotUse = $(`.list-not-use-prop-${id}`);
                    let listUsed = $(`.list-props-${id}`);
                    let propertiesUsed = response.used.map(item => (
                        `<li class="list-prop-item-${id}-${item.id}">
                                    <span class="list-prop-item">${item.name}</span>
                                    <button
                                            data-room="${id}"
                                            id="${item.id}"
                                            addUrl="{{ route('admin.rooms.addProperties', $location->id) }}"
                                            deleteUrl="{{ route('admin.rooms.deleteProperties', $location->id) }}"
                                            class="btn m-btn m-btn--hover-danger m-btn--icon btn-delete-prop">
                                        <i class="la la-trash"></i>
                                    </button>
                                </li>`
                    ));
                    let propertiesNotUse = response.notUse.map(item => (
                        `<li class="item-${id}-${item.id}">
                                            <span class="add-property-item">${item.name}</span>
                                            <button
                                                    data-room="${id}"
                                                    id="${item.id}"
                                                    addUrl="{{ route('admin.rooms.addProperties', $location->id) }}"
                                                    deleteUrl="{{ route('admin.rooms.deleteProperties', $location->id) }}"
                                                    class="btn m-btn m-btn--hover-success m-btn--icon btn-add-prop">
                                                <i class="la la-plus"></i>
                                            </button>
                                        </li>`));
                    listNotUse.append(propertiesNotUse);
                    listUsed.append(propertiesUsed);
                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                },
            });
        }
    </script>
@endsection
