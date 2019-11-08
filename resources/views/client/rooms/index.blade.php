@extends('client.layouts.master')
@section('content')
    @include('client.layouts.headerWithFilter', ['headerImage' => asset('bower_components/client_layout/images/detailed-banner.jpg')])
    <div class="inn-body-section pad-bot-55">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>{{ __('label.List_rooms') }}</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong
                        phú</p>
                </div>
                @foreach ($rooms as $room)
                    @php
                        $stars = round((int)$room->rating);
                        $whiteStars = 5 - (int)$room->rating;
                    @endphp
                    @if ($room->roomDetails->toArray())
                        <div class="room">
                            <div class="r1 r-com"><img
                                        src="{{ asset(config('common.uploads.rooms'))  . '/' . $room->image }}"/>
                            </div>
                            <div class="r2 r-com">
                                <h4>{{ session('locale') == config('common.languages.default') ? $room->roomName->name : $room->name }}</h4>
                                <div class="r2-ratt">
                                    @for ($i = 0; $i < $stars; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for ($i = 0; $i < $whiteStars; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                    <span>{{ $room->rating }} / 5</span></div>
                                <ul>
                                    <li>{{ __('label.Adult') }} : {{ $room->adults }}</li>
                                    <li>{{ __('label.Kid') }} : {{ $room->children }}</li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                            <div class="r3 r-com">
                                <ul>
                                    @foreach ($room->properties as $property)
                                        @if (session('locale') == config('common.languages.default'))

                                            <li>{{ $property->name }}</li>
                                        @else
                                            @php
                                                $transProperty = $propertyRepository->where('lang_parent_id', '=', $property->id)->first();
                                            @endphp
                                            <li>{{ $transProperty ? $transProperty->name : '' }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="r4 r-com">
                                <p>{{ __('label.Price_for_one_night') }}</p>
                                <p>
                                    @if ($room->sale_status)
                                        <span class="custom-price room-price">{{ $room->roomDetails[0]->price }}</span>
                                        <br/>
                                        <span style="font-size: 20px"
                                              class="custom-price room-price-1">{{ $room->roomDetails[0]->sale_price }} {{ session('locale') == config('common.languages.default') ? 'vnđ' : '$' }}</span>
                                    @else
                                        <span style="font-size: 20px"
                                              class="custom-price room-price-1">{{ $room->roomDetails[0]->price }} {{ session('locale') == config('common.languages.default') ? 'vnđ' : '$' }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="r5 r-com">
                                <div class="r2-available">Available</div>
                                <a style="font-size: 18px"
                                   href="{{ route('rooms.detail', [$location->id, $room->id]) }}"
                                   class="inn-room-book">{{ __('label.Detail') }}
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="col-md-4">
                    @include('client.pagination.index', ['paginator' => $rooms])
                </div>
            </div>
        </div>
    </div>
@endsection
