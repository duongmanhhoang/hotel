@extends('client.layouts.master')
@section('content')
		<div class="inn-banner">
			<div class="container">
				<div class="row">
					<h4>Tin tức & sự kiện</h4>
					<p>Cùng Atlantic khám phá những tin tức mới nhất về xu hướng du lịch và nghỉ dưỡng.
						<p>
				</div>
			</div>
		</div>
		<div class="inn-body-section pad-bot-55">
			<div class="container">
				<div class="row inn-page-com">
					<div class="page-head">
						<h2> {{ $data->title ?? ''}} </h2>
						<div class="head-title">
							<div class="hl-1"></div>
							<div class="hl-2"></div>
							<div class="hl-3"></div>
						</div>
						<p> {{ $data->description ?? '' }} </p>
					</div>
					<div class="col-md-8">
						<div class="row inn-services in-blog">
							<div class="col-md-12"> <img id="img-blog" src="{{ asset(config('common.uploads.posts')) . '/' . $data->image }}" alt="" /> </div>
							<div class="col-md-12">
								<span class="blog-date">Date: {{ $data->updated_at }}</span>
								<span class="blog-author">Author: {{ $data->postedBy->full_name }}</span>

								{!! $data->body !!}
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="head-typo typo-com rec-post">
							<h3>Bài viết cùng danh mục</h3>
							<ul>
								@foreach($sameCategory as $value)
									<li>
										<div class="rec-po-img"> <img src="{{ asset(config('common.uploads.posts')) . '/' . $value->image }}" alt="" /> </div>
										<div class="rec-po-title"> <a href="{{ route('post.detail', $value->id) }}"><h4> {{ $value->title }}</h4></a>
											<p> {{ $value->description }} </p> <span class="blog-date">Date: {{ $value->updated_at }}</span> </div>
									</li>
								@endforeach
							</ul>
						</div>
						<div class="head-typo typo-com">
							<h3>Atlantic</h3>
							<p>TLorem Ipsum is simply dummy text of the printing and typesetting industry., but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
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
@endsection