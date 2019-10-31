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
                                                          action="{{ route('admin.category.list') }}"
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
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <form method="get"
                                                              action="{{ route('admin.category.list') }}">
                                                            <input type="text" class="form-control m-input"
                                                                   name="name"
                                                                   value="{{ $nameSearch ?? '' }}"
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
                                            <a href="{{ route('admin.bill.postView') }}"
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
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Kiểu</th>
                                        <th>Tiền</th>
                                        <th>Địa điểm</th>
                                        <th>Phòng</th>
                                        <th>Thời gian</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 1)
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->body }}</td>
                                            <td>{{ $value->type == 1 ? 'Thu' : 'Chi' }}</td>
                                            <td>{{ number_format($value->money) }}</td>
                                            <td>{{ $value->location->name ?? 'Nowhere' }}</td>
                                            <td>{{ $value->room_id ?? 'No room' }}</td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.bill.editView', $value->id) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                                   title="Chỉnh sửa">
                                                    <i class="la la-edit"></i>
                                                </a>

                                                <form id="form-{{ $value->id }}" method="post"
                                                      action="{{ route('admin.bill.delete', $value->id) }}"
                                                      class="float-left">
                                                    @csrf
                                                    <button locationId="{{ $value->id }}"
                                                            class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                                                            title="Xóa"><i
                                                                class="la la-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php ($i++)
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
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

        $('.my-datepicker').datepicker({
            todayHighlight: !0,
            autoclose: !0,
            format: "yyyy-mm",
            minViewMode: "months"
        });

        $(document).ready(function () {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('locationId');
                var form = $('#form-' + id);
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

            let formData = new FormData();
            formData.append('data_filter', dataFilter);

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
        });


    </script>

@endsection
