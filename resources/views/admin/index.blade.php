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
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table>
                            <tr>
                                <th style="width: 50px">STT</th>
                                <th style="width: 300px">Đường dẫn</th>
                                <th style="width: 100px">Số lượt</th>
                            </tr>
                            @foreach($pages as $key => $page)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $page->page }}</td>
                                    <td>{{ $page->total }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="chartLabel" name="chartLabel" value="{{ json_encode($analyticUser['label']) }}">
    <input type="hidden" id="chartData" name="chartData" value="{{ json_encode($analyticUser['total']) }}">
@endsection
@section('script')
    <script src="{{ asset('bower_components/chart.js/dist/Chart.js') }}"></script>
    <script>
        let label = JSON.parse($('#chartLabel').val());
        let data = JSON.parse($('#chartData').val());
        let ctx = document.getElementById('myChart');
        new Chart(ctx, {
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
        });
    </script>

@endsection