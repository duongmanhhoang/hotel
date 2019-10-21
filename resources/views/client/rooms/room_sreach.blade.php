@extends('client.layouts.master')
@section('content')
		<div class="inn-banner">
			<div class="container">
				<div class="row">
					<h4>Danh sách phòng</h4>
					<p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong phú.
						<p>
				</div>
			</div>
		</div>
		<div class="inn-body-section pad-bot-55">
			<div class="container">
				<div class="row">
					<div class="page-head">
						<h2>Danh sách phòng</h2>
						<div class="head-title">
							<div class="hl-1"></div>
							<div class="hl-2"></div>
							<div class="hl-3"></div>
						</div>
						<p>Đến với Atlantic để trải nghiệm dịch vụ nghỉ dưỡng bậc nhất Việt Nam với hệ thống phòng phong phú</p>
					</div>
					<div class="room">
						<div class="ribbon ribbon-top-left"><span>Featured</span>
						</div>
						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/1.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 3</li>
								<li>Max Child : 1</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">5000</span> <span class="room-price">$: 7000</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
					</div>

					<div class="room">
						<div class="ribbon ribbon-top-left"><span>Featured</span>
						</div>
						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/2.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.2 / 5</span> </div>
							<ul>
								<li>Max Adult : 2</li>
								<li>Max Child : 2</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">4000</span> <span class="room-price">$: 4500</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
					</div>

					<div class="room">
						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/3.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  3.9 / 5</span> </div>
							<ul>
								<li>Max Adult : 4</li>
								<li>Max Child : 2</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">3500</span> <span class="room-price">$: 4000</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
					</div>
					<div class="room">
						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/4.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.0 / 5</span> </div>
							<ul>
								<li>Max Adult : 5</li>
								<li>Max Child : 2</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">3000</span> <span class="room-price">$: 3500</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
					</div>

					<div class="room">
						<div class="ribbon ribbon-top-left"><span>Special</span>
						</div>
						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/5.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  4.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 5</li>
								<li>Max Child : 2</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">4000</span> <span class="room-price">$: 5000</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
					</div>
					<div class="room">

						<div class="r1 r-com"><img src="{{ asset('bower_components/client_layout/images/room/6.jpg') }}" alt="" />
						</div>
						<div class="r2 r-com">
							<h4>Master Room</h4>
							<div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="{{ asset('bower_components/client_layout/images/h-trip.png') }}" alt="" /> <span>Excellent  3.5 / 5</span> </div>
							<ul>
								<li>Max Adult : 4</li>
								<li>Max Child : 4</li>
								<li></li>
								<li></li>
							</ul>
						</div>
						<div class="r3 r-com">
							<ul>
								<<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
								<li>2 quả smoke</li>
							</ul>
						</div>
						<div class="r4 r-com">
							<p>Giá cho 1 đêm</p>
							<p><span class="room-price-1">2000</span> <span class="room-price">$: 2500</span>
							</p>
							<p>Không hoàn tiền</p>
						</div>
						<div class="r5 r-com">
							<div class="r2-available">Available</div>
							<p>Giá cho 1 đêm</p> <a href="room_detail.html" class="inn-room-book">Detail</a> </div>
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
						<h5>Phone: (+84) 376 594 637</h5> </div>
					<div class="foot-com foot-3">
						<!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a> </div>
					<div class="foot-com foot-4">
						<a href="#"><img src="{{ asset('bower_components/client_layout/images/card.png') }}" alt="" />
						</a>
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