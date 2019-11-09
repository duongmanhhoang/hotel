@extends('client.layouts.master')
@section('content')
    <div class="inn-body-section inn-booking">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if ($detail && $name)
                        <div class="book-title">
                            <div class="card-hover">
                                <div class="card">
                                    <img id="img-detail"
                                         style="object-fit: cover"
                                         src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                         alt=""
                                         class="img-fluid"
                                    >
                                </div>
                                <div class="room-detail">
                                    <h4 class="text-booking">{{ $name }}</h4>
                                    <h4 class="text-booking">{{ $room->sale_status ? number_format($detail->sale_price) : number_format($detail->price) }} {{ config('common.languages.default') == session('locale') ? 'đ' : '$'}}</h4>
                                    <h4 class="text-booking">{{ __('label.Check_in') }}: {{ $checkIn }}</h4>
                                    <h4 class="text-booking">{{ __('label.Check_out') }}: {{ $checkOut }}</h4>
                                </div>
                                {{--                                    <ul class="collapsible popout" data-collapsible="accordion">--}}
                                {{--                                        <li>--}}
                                {{--                                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>First--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="collapsible-body"><span>lul.</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>First--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="collapsible-body"><span>lul.</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>First--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="collapsible-body"><span>lul.</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                            </div>
                        </div>
                    @else
                        <h2 style="margin-top: 50px">{{ __('messages.Not_enough_info') }}</h2>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="book-form inn-com-form">
                        <form class="col s123" method="post" action="{{ route('booking.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="customer_name"  value="{{ old('customer_name', $user ? $user->full_name : null) }}">
                                    <label>{{ __('label.Full_name') }} <b class="text-danger">*</b></label>

                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="customer_email" value="{{ old('customer_email', $user ? $user->email : null) }}">
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('customer_name'))
                                    <div class="col s6">
                                        <div class="text-danger">{{ $errors->first('customer_name') }}</div>
                                    </div>
                                @endif
                                @if ($errors->has('customer_email'))
                                    <div class="col s6">
                                        <div class="text-danger">{{ $errors->first('customer_email') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" class="validate" name="customer_phone"  value="{{ old('customer_phone', $user ? $user->phone : null) }}">
                                    <label>{{ __('label.Phone') }} <b class="text-danger">*</b></label>
                                </div>
                                @if ($errors->has('customer_phone'))
                                    <div class="input-field col s12">
                                        <div class="text-danger">{{ $errors->first('customer_phone') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" class="validate" name="customer_address"  value="{{ old('customer_address', $user ? $user->address : null) }}">
                                    <label>{{ __('label.Address') }}</label>
                                </div>
                                @if ($errors->has('customer_address'))
                                    <div class="input-field col s12">
                                        <div class="text-danger">{{ $errors->first('customer_address') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" data-length="120" name="messages"></textarea>
                                    <label>{{ __('label.Note') }}</label>
                                </div>
                            </div>
                            <input type="hidden" name="total" value="{{ $room->sale_status ? $detail->sale_price : $detail->price }}">
                            <input type="hidden" name="price" value="{{ $room->sale_status ? $detail->sale_price : $detail->price }}">
                            <input type="hidden" name="currency" value="{{ config('common.languages.default') == session('locale') ? config('common.currency.vi') : config('common.currency.en') }}">
                            <input type="hidden" name="checkIn" value="{{ $checkIn }}">
                            <input type="hidden" name="checkOut" value="{{ $checkOut }}">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="submit" value="{{ __('label.Submit') }}" class="form-btn"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                <div class="foot-com foot-3"><a class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a>
                </div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="images/card.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
