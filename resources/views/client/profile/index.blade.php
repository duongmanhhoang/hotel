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
							<a href="dashboard.html"><img src="{{ asset('bower_components/client_layout/images/icon/db1.png') }}" alt="" /> All</a>
						</li>
						<li>
							<a href="db-booking.html"><img src="{{ asset('bower_components/client_layout/images/icon/db2.png') }}" alt="" /> My Bookings</a>
						</li>
						<li>
							<a href="db-new-booking.html"><img src="{{ asset('bower_components/client_layout/images/icon/db3.png') }}" alt="" /> New Booking</a>
						</li>
						<li>
							<a href="db-event.html"><img src="{{ asset('bower_components/client_layout/images/icon/db4.png') }}" alt="" /> Event</a>
						</li>
						<li>
							<a href="db-activity.html"><img src="{{ asset('bower_components/client_layout/images/icon/db5.png') }}" alt="" /> Activity</a>
						</li>
						<li>
							<a href="db-profile.html"><img src="{{ asset('bower_components/client_layout/images/icon/db7.png') }}" alt="" /> Profile</a>
						</li>
						<li>
							<a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db6.png') }}" alt="" /> Payments</a>
						</li>
						<li>
							<a href="#"><img src="{{ asset('bower_components/client_layout/images/icon/db8.png') }}" alt="" /> Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="db-cent">
				<div class="db-cent-1">
					<p>Tran Dan,</p>
					<h4>Chào mừng bạn tới trang quản lí tài khoản</h4> </div>
				<div class="db-cent-2">
					<div class="db-2-main-1">
						<div class="db-2-main-2"> <img src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}" alt=""> <span>My Bookings</span>
							<p>All the Lorem Ipsum generators on the</p>
							<h2>12</h2> </div>
					</div>
					<div class="db-2-main-1">
						<div class="db-2-main-2"> <img src="{{ asset('bower_components/client_layout/images/icon/dbc6.png') }}" alt=""> <span>Activity</span>
							<p>All the Lorem Ipsum generators on the</p>
							<h2>04</h2> </div>
					</div>
					<div class="db-2-main-1">
						<div class="db-2-main-2"> <img src="{{ asset('bower_components/client_layout/images/icon/dbc3.png') }}" alt=""> <span>Payment</span>
							<p>All the Lorem Ipsum generators on the</p>
							<h2>16</h2> </div>
					</div>
				</div>
				<div class="db-cent-3">
					<div class="db-cent-table db-com-table">
						<div class="db-title">
							<h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}" alt=""/> My Bookings</h3>
							<p>Lịch sử đặt phòng</p>
						</div>
						<table class="bordered responsive-table">
							<thead>
								<tr>
									<th>No</th>
									<th>Tên</th>
									<th>Số điện thoại</th>
									<th>Thành phố</th>
									<th>Ngày đến</th>
									<th>Ngày đi</th>
									<th>Số lượng thành viên</th>
									<th>Thanh toán</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>01</td>
									<td>Tran Dan</td>
									<td>+84 376 594 637</td>
									<td><span class="db-tab-hi">New york,</span>USA</td>
									<td>12may</td>
									<td>20may</td>
									<td>04</td>
									<td><a href="#" class="db-success">Success</a>
									</td>
								</tr>
								<tr>
									<td>01</td>
									<td>Tran Dan</td>
									<td>+84 376 594 637</td>
									<td><span class="db-tab-hi">New york,</span>USA</td>
									<td>12may</td>
									<td>20may</td>
									<td>04</td>
									<td><a href="#" class="db-success">Success</a>
									</td>
								</tr>
								<tr>
									<td>03</td>
									<td>Tran Dan</td>
									<td>+84 376 594 637</td>
									<td><span class="db-tab-hi">New york,</span>USA</td>
									<td>12may</td>
									<td>20may</td>
									<td>04</td>
									<td><a href="#" class="db-not-success">Pending</a>
									</td>
								</tr>
								<tr>
									<td>01</td>
									<td>Tran Dan</td>
									<td>+84 376 594 637</td>
									<td><span class="db-tab-hi">New york,</span>USA</td>
									<td>12may</td>
									<td>20may</td>
									<td>04</td>
									<td><a href="#" class="db-success">Success</a>
									</td>
								</tr>
								<tr>
									<td>03</td>
									<td>Tran Dan</td>
									<td>+84 376 594 637</td>
									<td><span class="db-tab-hi">New york,</span>USA</td>
									<td>12may</td>
									<td>20may</td>
									<td>04</td>
									<td><a href="#" class="db-not-success">Pending</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="db-cent-3">
					<div class="db-cent-acti">
						<div class="db-title">
							<h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc1.png') }}" alt=""/> My Activity</h3>
							<p>Hoạt động gần đây...</p>
						</div>
						<ul>
							<li>
								<div class="db-cent-wr-img"> <img src="{{ asset('bower_components/client_layout/images/users/100.png') }}" alt=""> </div>
								<div class="db-cent-wr-con">
									<h6>Hotel Booking Canceled</h6> <span class="lr-revi-date">21th May, 2019</span>
									<p>Bạn đã hủy đặt phòng vì lí do gì đó omewa lul nani dafug hoho nammo nammo nammo nammo nammo nammo.</p>
									<ul>
										<li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
									</ul>
								</div>
							</li>
							<li>
								<div class="db-cent-wr-img"> <img src="{{ asset('bower_components/client_layout/images/users/100.png') }}" alt=""> </div>
								<div class="db-cent-wr-con">
									<h6>Hotel Payment Success</h6> <span class="lr-revi-date">08th Msy, 2019</span>
									<p>Bạn đã hủy đặt phòng vì lí do gì đó omewa lul nani dafug hoho nammo nammo nammo nammo nammo nammo.</p>
									<ul>
										<li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
										<li><a href="#!"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="db-righ">
				<h4>Notifications(05)</h4>
				<ul>
					<li>
						<a href="#!"> <img src="{{ asset('bower_components/client_layout/images/icon/dbr1.jpg') }}" alt="">
							<h5>New blog</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>2 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="{{ asset('bower_components/client_layout/images/icon/dbr2.jpg') }}" alt="">
							<h5>Thanh toán thành công</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>4 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="{{ asset('bower_components/client_layout/images/icon/dbr3.jpg') }}" alt="">
							<h5>Thanh toán thành công</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>10 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="{{ asset('bower_components/client_layout/images/icon/dbr4.jpg') }}" alt="">
							<h5>Thanh toán thành công</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>12 hours ago</span> </a>
					</li>
				</ul>
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
						<h5>Phone:  (+84) 376 594 637</h5> </div>
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