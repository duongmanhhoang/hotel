@extends('client.layouts.profileLayout')
@section('content')
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
                    <th>{{ __('label.Room') }}</th>
                    <th>{{ __('label.Price') }}</th>
                    <th>{{ __('label.Total') }}</th>
                    <th>{{ __('label.Status') }}</th>
                    <th>{{ __('label.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->code }}</td>
                        <td>{{ formatDate($invoice->room['pivot']->check_in_date) }}</td>
                        <td>{{ formatDate($invoice->room['pivot']->check_out_date) }}</td>
                        <td>{{ $invoice->roomName }} ({{ $invoice->room['pivot']->room_number }})</td>
                        <td> {{ number_format($invoice->room['pivot']->price) }}
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