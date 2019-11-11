@extends('client.layouts.master')
@section('content')
    <div class="dashboard">
        <div class="db-left">
            <div class="db-left-1">
                <h4>Tran Dan</h4>
                <p>Newyork, United States</p>
            </div>
            <div class="db-left-2">
                <ul>
                    <li>
                        <a href="{{ route('profile.mybooking') }}"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db2.png') }}"
                                    alt=""/>{{ __('label.My_booking') }}</a>
                    </li>
                    <li>
                        <a href="db-profile.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/db7.png') }}"
                                    alt=""/>{{ __('label.My_profile') }}</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db8.png') }}"
                                         alt=""/>{{ __('label.Log_out') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="db-cent">
            <div class="db-cent-1">
            </div>
            <div class="db-cent-3">
                <div class="db-cent-table db-com-table">
                    <div class="db-title">
                        <h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}"
                                 alt=""/> {{ __('label.My_booking') }}</h3>
                    </div>
                    <table class="bordered responsive-table">
                        <thead>
                        <tr>
                            <th>{{ __('label.Invoice_code') }}</th>
                            <th>{{ __('label.Check_in') }}</th>
                            <th>{{ __('label.Check_out') }}</th>
                            <th>Phòng</th>
                            <th>Số phòng</th>
                            <th>Giá phòng/ngày(theo hóa đơn)</th>
                            <th>Tổng cộng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->code }}</td>
                                <td>{{ formatDate($invoice->room['pivot']->check_in_date) }}</td>
                                <td>{{ formatDate($invoice->room['pivot']->check_out_date) }}</td>
                                <td>{{ $invoice->roomName }}</td>
                                <td>{{ $invoice->room['pivot']->room_number }}</td>
                                <td>
                                    {{ number_format($invoice->room['pivot']->price) }}
                                    {{ $invoice->room['pivot']->currency == config('common.currency.vi') ? 'đ' : '$' }}
                                </td>
                                <td>
                                    {{ number_format($invoice->total) }}
                                    {{ $invoice->room['pivot']->currency == config('common.currency.vi') ? 'đ' : '$' }}
                                </td>
                                <td>
                                    @switch($invoice->room['pivot']->status)
                                        @case(\App\Models\RoomInvoice::NOT_PAY)
                                        <p class="label label-default">{{ __('label.Not_pay') }}</p>
                                        @break

                                        @case(\App\Models\RoomInvoice::PAID)
                                        <p class="label label-success">{{ __('label.Paid') }}</p>
                                        @break

                                        @case(\App\Models\RoomInvoice::PAID_SOON)
                                        <p class="label label-primary">{{ __('label.Paid_soon') }}</p>
                                        @break

                                        @case(\App\Models\RoomInvoice::PAID_AND_RETURN)
                                        <p class="label label-info">{{ __('label.Paid_and_return') }}</p>
                                        @break

                                        @case(\App\Models\RoomInvoice::PAID_LATE)
                                        <p class="label label-warning">{{ __('label.Paid_late') }}</p>
                                        @break

                                        @case(\App\Models\RoomInvoice::CANCEL)
                                        <p class="label label-danger">{{ __('label.Cancel') }}</p>
                                        @break

                                        @default
                                        <span>Something went wrong, please try again</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($invoice->show_delete)
                                        <form id="cancel-booking-{{ $invoice->id }}" method="post"
                                              action="{{ route('profile.cancelBooking', $invoice->id) }}">
                                            @csrf
                                            <button id="{{ $invoice->id }}" class="btn btn-danger btn-cancel"><i
                                                        class="fa fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="db-pagi">
                    @include('client.pagination.index', ['paginator' => $invoices])
                </div>
            </div>
        </div>
        <div class="db-righ">
            <h4>{{ __('label.Notifications') }}</h4>
            <ul class="my-booking-list-noti">
                @foreach($notifications as $notification)
                    <li id="notification-{{ $notification->id }}">
                        <h5>
                            @if ($notification->type == 'invoice_created')
                                {{ __('label.Invoice') }}
                            @endif
                        </h5>
                        <p>
                            @if ($notification->type == 'invoice_created')
                                {{ __('messages.got_new_invoice') }}
                                <br/>
                                {{ __('label.Invoice_code') }}: {{ json_decode($notification->data, true)['code'] }}

                            @endif
                        </p> <span>{{ $notification->created_at }}</span>
                        <br/>
                        <br/>
                        <a href="javascript:;" class="mask-as-read"
                           id="{{ $notification->id }}">{{ __('label.Mark_as_read') }}</a>
                    </li>
                @endforeach
            </ul>
            <a href="javascript:;" class="mask-all-read" style="margin-left: 20px">{{ __('label.Mask_all_read') }}</a>
        </div>
    </div>
    <div class="hom-footer-section">
        <div class="container">
            <div class="row">
                <div class="foot-com foot-1">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="foot-com foot-2">
                    <h5>Phone: (+84) 376 594 637</h5></div>
                <div class="foot-com foot-3">
                    <!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a
                            class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a></div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="{{ asset('bower_components/client_layout/images/card.png') }}" alt=""/>
                    </a>
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

            $('.mask-as-read').on('click', function () {
                const id = $(this).attr('id');
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('profile.maskAsRead', '') }}/${id}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        $(`#notification-${id}`).remove();
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            })

            $('.mask-all-read').on('click', function () {
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: `{{ route('profile.maskAllRead') }}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        $('.my-booking-list-noti').remove();
                    }, error: function () {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
                    },
                });
            });

            $('.btn-cancel').on('click', function (e) {
                e.preventDefault();
                const id = $(this).attr('id');
                swal({
                    title: '{{ __('label.Warning') }}',
                    text: "{{ __('messages.Confirm_cancel_booking') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(`#cancel-booking-${id}`).submit();
                    }
                });
            });
        })
    </script>
@endsection