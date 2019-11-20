@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">

            <div class="col-xl-12">

                <div class="m-portlet">

                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-12">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="m-input-icon m-input-icon--left">
                                                    <form method="get"
                                                          id="chart-statistical">
                                                        <div class="row">

                                                            <div class="form-group col-md-4">
                                                                <label>Lọc dữ liệu theo tháng</label>
                                                                <div class="bs-select">
                                                                    <input type="text"
                                                                           class="form-control m-input my-datepicker"
                                                                           id="filter-chart"
                                                                           name="month"
                                                                           autocomplete="off"
                                                                           style="padding-left: 12px"
                                                                    >
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <canvas id="myChart" width="400" height="100"></canvas>

                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Quản lý thu chi
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
                                    <a href="{{ route('admin.bill.postView') }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript" src="{{ asset('bower_components/chart.js/dist/Chart.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let urlGetDataTable = "{{ route('admin.bill.datatable') }}";
        let currentDate = new Date();


        $('.my-datepicker').datepicker({
            todayHighlight: !0,
            autoclose: !0,
            format: "yyyy-mm",
            minViewMode: "months"
        });

        $(document).ready(function () {
            DataTable.init();
        });

        let statisticalData = JSON.parse('{!! json_encode($statistical) !!}');

        let configChart = {
            type: 'line',
            data: {
                labels: statisticalData.day,
                datasets: [{
                    label: 'Tiền Vào',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: statisticalData.incoming,
                    fill: false,
                }, {
                    label: 'Tiền ra',
                    fill: false,
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: statisticalData.outgoing,
                }]
            },

            options: {
                responsive: true,
                title: {
                    display: true,
                    text: statisticalData.table_message
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Ngày'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Số tiền'
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            let ctx = $('#myChart')[0].getContext('2d');
            window.myLine = new Chart(ctx, configChart);
        };

        $('#chart-statistical').on('change', function () {

            let dataFilter = $('#filter-chart').val();


            updateLineChart(dataFilter);
        });

        function updateLineChart (dataFilter) {
            let formData = new FormData();

            formData.append('data_filter', dataFilter);

            console.log(dataFilter);

            $.ajax({
                contentType: false,
                processData: false,
                url: '{!! route('admin.statistical.list') !!}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (response) {

                    if (typeof response.data !== 'string') {
                        configChart.options.title.text = response.data.table_message;
                        configChart.data.labels = response.data.day;
                        configChart.data.datasets[0].data = response.data.incoming;
                        configChart.data.datasets[1].data = response.data.outgoing;

                        window.myLine.update();
                    } else {
                        toastr.error('Không có dữ liệu!!');
                    }

                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                },
            });
        }

        function del(t) {
            let id = $(t).attr('billId');

            const routeDelete = "{{ route('admin.bill.delete', ':id') }}";
            const urlDelete = routeDelete.replace(':id', id);

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
                    url: urlDelete,
                    type: 'POST',
                    success: function (response) {
                        console.log(response);
                        if (response.status === false) {
                            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                        }else {
                            toastr.success('Xóa thành công', 'Thành công');
                            $('.m_datatable').mDatatable("reload");

                            // let dayTime = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1);
                            // updateLineChart(dayTime);

                            $.ajax({
                                url: " {{ route('admin.statistical.getByMonth') }}",
                                type: 'get',
                                success: function (res) {

                                    configChart.options.title.text = res.table_message;
                                    configChart.data.labels = res.day;
                                    configChart.data.datasets[0].data = res.incoming;
                                    configChart.data.datasets[1].data = res.outgoing;

                                    window.myLine.update();
                                }
                            })

                        }
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
                                url: urlGetDataTable,
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
                            field: "title",
                            title: "Tên"
                        },
                        {
                            field: "body",
                            title: "Nội dung"
                        },
                        {
                            field: "type",
                            title: "Kiểu",
                            template : function (e) {
                                return e.type === 1 ? 'Thu' : 'Chi';
                            }
                        },
                        {
                            field: "money",
                            title: "Tiền",
                            template : function (e) {
                                return new Intl.NumberFormat('en-Us', {style: 'currency', currency: 'VND'}).format(e.money)
                            }
                        },
                        {
                            field: "location_id",
                            title: "Địa điểm",
                            template : function (e) {
                                return e.location.name
                            }
                        },
                        {
                            field: "room_id",
                            title: "Phòng",
                            template : function (e) {
                                return "None"
                            }
                        },
                        {
                            field: "updated_at",
                            title: "Thời gian"
                        },
                        {
                            field: "Actions",
                            width: 150,
                            title: "Thao tác",
                            sortable: !1,
                            overflow: "visible",
                            template: function (e) {
                                let editRoute = "{{ route('admin.bill.editView', ':id') }}";
                                let urlEdit = editRoute.replace(':id', e.id);

                                const edit = `<a href="${urlEdit}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                       title="Chỉnh sửa"
                                                    >
                                                        <i class="la la-edit"></i>
                                                    </a>`;

                                const del = `<button class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Xóa" onclick="del(this)" billId="${e.id}">
                                                            <i class="la la-trash"></i>
                                                    </button>`;

                                return `${edit} ${del}`
                            }
                        }
                    ]
                }), $("#m_form_status").on("change", function () {
                    t.search($(this).val(), "status")
                }), $("#m_form_status, #m_form_type").selectpicker()
            }
        };

    </script>

@endsection
