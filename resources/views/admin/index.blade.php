@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-8">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Thống kê lượt truy cập
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <form style="float: right; margin-right: 30px">
                            <div class="form-group">
                                <select class="form-control" id="user-analytic" style="width: 150px;">
                                    <option value="{{ \App\Models\Analytic::WEEKLY }}">7 ngày trước</option>
                                    <option value="{{ \App\Models\Analytic::MONTHLY }}">30 ngày trước</option>
                                    <option value="{{ \App\Models\Analytic::YEAR }}">Năm nay</option>
                                </select>
                            </div>
                        </form>
                        <div style="float: right; margin-right: 40px">
                            <a href="javascript:;" data-target="#modalAdvance" data-toggle="modal"
                               class="btn btn-primary">Nâng cao</a>
                        </div>
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Trang được truy cập nhiều nhất
                                </h3>
                            </div>
                            <div class="form-group" style="margin-left: 80px">
                                <select class="form-control" id="user-access" style="width: 130px;">
                                    <option value="{{ \App\Models\Analytic::TODAY_ACCESS }}">Hôm nay</option>
                                    <option value="{{ \App\Models\Analytic::YESTERDAY_ACCESS }}">Hôm qua</option>
                                    <option value="{{ \App\Models\Analytic::WEEK_AGO_ACCESS }}">7 ngày trước</option>
                                    <option value="{{ \App\Models\Analytic::MONTH_AGO_ACCESS }}">30 ngày trước</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table id="page-access-cover">
                            <tr>
                                <th style="width: 50px">STT</th>
                                <th style="width: 300px">Đường dẫn</th>
                                <th style="width: 100px">Số lượt</th>
                            </tr>
                                <tbody id="page-access">
                                @foreach($pages as $key => $page)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $page->page }}</td>
                                        <td>{{ $page->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Thống kê chi tiêu
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <canvas id="statistical-bill__chart" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="chartLabel" name="chartLabel" value="{{ json_encode($analyticUser['label']) }}">
    <input type="hidden" id="chartData" name="chartData" value="{{ json_encode($analyticUser['total']) }}">
    <div class="modal fade show" id="modalAdvance" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lọc nâng cao</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-radio-inline">
                        <label class="m-radio">
                            <input type="radio" name="optionAdvance" id="checkMonth" value="1"> Theo tháng chọn
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" name="optionAdvance" id="checkYear" value="2"> Theo năm chọn
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group m-form__group row" id="month-picker" style="display: none">
                        <div class="col-lg-12">
                            <label>Chọn tháng</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input my-datepicker" id="month"
                                       name="month"
                                       autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row" id="year-picker" style="display: none">
                        <div class="col-lg-12">
                            <label>Chọn năm</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input year-picker" id="year"
                                       name="year"
                                       autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary btn-submit-filter-user-analytic">Lọc</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('bower_components/chart.js/dist/Chart.js') }}"></script>
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

        $('.year-picker').datepicker({
            todayHighlight: !0,
            autoclose: !0,
            format: "yyyy",
            minViewMode: "years"
        });
        $('#checkMonth').click(function () {
            $('#month-picker').show();
            $('#year-picker').hide()
        });

        $('#checkYear').click(function () {
            $('#month-picker').hide();
            $('#year-picker').show()
        });

        $('.btn-submit-filter-user-analytic').on('click', function () {
            let option = $("input[name=optionAdvance]:checked");
            let typeAdvance = '';
            let dataAdvance = '';
            if (option.length > 0) {

                let optionValue = $("input[name=optionAdvance]:checked").val();

                if (optionValue == 1) {
                    let month = $('#month').val();
                    if (month.length > 0) {
                        typeAdvance = optionValue;
                        dataAdvance = month;
                        $('#modalAdvance').modal('toggle');
                    } else {
                        toastr.error('Vui lòng chọn tháng', 'Cảnh báo');
                    }
                } else {
                    let year = $('#year').val();
                    if (year.length > 0) {
                        typeAdvance = optionValue;
                        dataAdvance = year;
                        $('#modalAdvance').modal('toggle');
                    } else {
                        toastr.error('Vui lòng chọn năm', 'Cảnh báo');
                    }
                }

                let formData = new FormData();
                formData.append('type', typeAdvance);
                formData.append('data', dataAdvance);
                formData.append('option', 4);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: '{{ route('admin.analytics.users') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'success') {
                            if (config.data.datasets.length > 0 && response.data) {
                                config.data.labels = response.data.label;
                                config.data.datasets.forEach(function (dataset) {
                                    dataset.data = response.data.total;
                                });

                                window.myLine.update();
                            }
                        }
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });

            } else {
                toastr.error('Vui lòng chọn một lựa chọn bất kì', 'Cảnh báo');
            }

        });
        let label = JSON.parse($('#chartLabel').val());
        let data = JSON.parse($('#chartData').val());
        let config = {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'lần truy cập',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
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
                            labelString: 'Số lượng'
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            let ctx = $('#myChart')[0].getContext('2d');
            window.myLine = new Chart(ctx, config);
        };

        $('#user-analytic').on('change', function () {
            let value = $('#user-analytic').val();
            let formData = new FormData();
            formData.append('option', value);
            $.ajax({
                contentType: false,
                processData: false,
                url: '{{ route('admin.analytics.users') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (response) {
                    if (response.messages == 'success') {
                        if (config.data.datasets.length > 0 && response.data) {
                            config.data.labels = response.data.label;
                            config.data.datasets.forEach(function (dataset) {
                                dataset.data = response.data.total;
                            });

                            window.myLine.update();
                        }
                    }
                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                },
            });
        });

        var statisticalElementId = document.getElementById('statistical-bill__chart');

        let statisticalData = JSON.parse('{!! json_encode($statistical) !!}');

        new Chart(statisticalElementId, {
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
                    text: 'Bảng thống kê'
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
        });

        $('#user-access').on('change', function () {
            let value = $('#user-access').val();
            let formData = new FormData();
            formData.append('option', value);
            $.ajax({
                contentType: false,
                processData: false,
                url: '{{ route('admin.analytics.userAccess') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (response) {
                    if (response.messages == 'success') {
                        let pages = response.data;
                        $('#page-access').remove();
                        let html = pages.map((item, index) => `<tr><td>${index + 1}</td><td>${item.page}</td><td>${item.total}</td></tr>`);
                        $('#page-access-cover').append(`<tbody id='page-access'>${html}</tbody>`);
                    }
                }, error: function () {
                    toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                },
            });
        });
    </script>

@endsection