@extends('client.layouts.master')
@section('content')
		<div class="inn-banner">
			<div class="container">
				<div class="row">
					<h4>Về Atlantic</h4>
					<p>Atlantic là khách sạn hàng đầu trong ngành nghỉ dưỡng tại khu vực Asia</p>
					<p> </p>
				</div>
			</div>
		</div>
		<div class="inn-body-section">
			<div class="container">
				<div class="row">
					<div class="page-head">
						<h2>About Us</h2>
						<div class="head-title">
							<div class="hl-1"></div>
							<div class="hl-2"></div>
							<div class="hl-3"></div>
						</div>
						<p>Atlantic là khách sạn hàng đầu trong ngành nghỉ dưỡng tại khu vực Asia với hệ thống thông minh hiện đại</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="about-left">
							<h2>Welcome to <span>Atlantic</span></h2>
							<h4>Atlantic là khách sạn hàng đầu trong ngành nghỉ dưỡng tại khu vực Asia với hệ thống thông minh hiện đại.</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> <a href="#" class="link-btn">Gọi cho chúng tôi: (+84) 376 594 637</a> </div>
					</div>
					<div class="col-md-6">
						<div class="about-right"> <img src="{{ asset('bower_components/client_layout/images/about.jpg') }}" alt=""> </div>
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
						<a href="#"><img src="images/card.png" alt="" />
						</a>
					</div>
				</div>
			</div>
		</div>
@endsection