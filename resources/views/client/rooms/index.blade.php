@extends('client.layouts.master')
@section('content')
    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>{{ __('label.List_rooms') }}</h4>
                <p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong phú.
                <p>
            </div>
        </div>
    </div>
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
                {{--<div class="room">--}}
                {{--<div class="ribbon ribbon-top-left"><span>Featured</span>--}}
                {{--</div>--}}
                {{--<div class="r1 r-com"><img src="images/room/1.jpg" alt="" />--}}
                {{--</div>--}}
                {{--<div class="r2 r-com">--}}
                {{--<h4>Master Room</h4>--}}
                {{--<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  4.5 / 5</span> </div>--}}
                {{--<ul>--}}
                {{--<li>Max Adult : 3</li>--}}
                {{--<li>Max Child : 1</li>--}}
                {{--<li></li>--}}
                {{--<li></li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="r3 r-com">--}}
                {{--<ul>--}}
                {{--<li>2 quả smoke</li>--}}
                {{--<li>2 quả smoke</li>--}}
                {{--<li>2 quả smoke</li>--}}
                {{--<li>2 quả smoke</li>--}}
                {{--<li>2 quả smoke</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="r4 r-com">--}}
                {{--<p>Giá cho 1 đêm</p>--}}
                {{--<p><span class="room-price-1">5000</span> <span class="room-price">$: 7000</span>--}}
                {{--</p>--}}
                {{--<p>Không hoàn tiền</p>--}}
                {{--</div>--}}
                {{--<div class="r5 r-com">--}}
                {{--<div class="r2-available">Available</div>--}}
                {{--<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Book</a> </div>--}}
                {{--</div>--}}
                @foreach ($rooms as $room)
                    @php
                        $roomDetail = $room->roomDetails()->where('lang_id', session('locale'))->first();
                        $stars = round((int)$room->rating);
                        $whiteStars = 5 - (int)$room->rating;
                        $properties = $room->properties()->where('lang_id', session('locale'))->get();
                    @endphp
                    @if ($roomDetail)
                        <div class="room">
                            <div class="r1 r-com"><img
                                        src="{{ asset(config('common.uploads.rooms'))  . '/' . $room->image }}"/>
                            </div>
                            <div class="r2 r-com">
                                <h4>{{ $roomDetail->name }}</h4>
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
                                    @foreach ($properties as $property)
                                        <li>{{ $property->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="r4 r-com">
                                <p>{{ __('label.Price_for_one_night') }}</p>
                                <p>
                                    @if ($room->sale_status)
                                        <span class="custom-price room-price-1">{{ $roomDetail->sale_price }} {{ session('locale') == config('common.languages.default') ? 'vnđ' : '$' }}</span>
                                        <span class="custom-price room-price">{{ $roomDetail->price }}</span>
                                    @else
                                        <span class="custom-price room-price-1">{{ $roomDetail->price }} {{ session('locale') == config('common.languages.default') ? 'vnđ' : '$' }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="r5 r-com">
                                <div class="r2-available">Available</div>
                                <a href="{{ route('rooms.detail', $room->id) }}" class="inn-room-book">{{ __('label.Detail') }}</a></div>
                        </div>
                    @endif
                @endforeach
                {{ $rooms->links() }}
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
                <div class="foot-com foot-3">
                    <!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a
                            class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a></div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="images/card.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div>
		<div class="inn-banner">
			<div class="container">
				<div class="row">
					<h4>Danh sách phòng</h4>
					<p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong phú.
						<p>
				</div>
			</div>
		</div>
		<div class="inn-body-section pad-bot-70">
			<div class="container">
				<div class="row">
					<div class="page-head">
						<h2>Danh sách phòng</h2>
						<div class="head-title">
							<div class="hl-1"></div>
							<div class="hl-2"></div>
							<div class="hl-3"></div>
						</div>
						<p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong phú.</p>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
					<div class="room room-1">
						<div class="r1 r-com r-com-1 r1-1"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" /> </div>
						<div class="r2 r-com r-com-1">
							<h3>Master Suite</h3>
							<h4>Review</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
							<div class="r2-available r2-available-1">Available</div>
						</div>
						<div class="r3 r-com r-com-1">
							<h4>Tiện nghi</h4>
							<ul>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
								<li>Free internet</li>
							</ul>
						</div>
						<div class="r4 r-com r-com-1">
							<h4>Price</h4>
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">Rs: 7000</span> </p>
							<p>Không hoàn trả</p>
						</div>
						<div class="r5 r-com r-com-1 r5-1">
							<p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="hom-footer-section">
			<div class="container">
				<div class="row">
					<div class="foot-com foot-1">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
						</ul>
					</div>
					<div class="foot-com foot-2">
						<h5>Phone: (+84) 376 594 637</h5> </div>
					<div class="foot-com foot-3">
						<!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a> </div>
					<div class="foot-com foot-4">
						<a href="#"><img src="images/card.png" alt="" /> </a>
					</div>
				</div>
			</div>
		</div>

	<div class="col-md-4">
		<ul class="pagination">
				<li class="disabled">
					<a href="#!"></a>
				</li>
				<li class="active"><a href="#!">1</a>
				</li>
				<li class="waves-effect"><a href="#!">2</a>
				</li>
				<li class="waves-effect"><a href="#!">3</a>
				</li>
				<li class="waves-effect"><a href="#!">4</a>
				</li>
				<li class="waves-effect"><a href="#!">5</a>
				</li>
				<li class="waves-effect"><a href="#!">></a>
				</li>
	   </ul>
    </div>
@endsection