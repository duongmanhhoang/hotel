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
					<p>Hi Tran Dan,</p>
					<h4>Chào mừng bạn tới trang quản lí tài khoản</h4> </div>
				<div class="db-profile"> <img src="{{ asset('bower_components/client_layout/images/user.jpg') }}" alt="">
					<h4>Tran Dan</h4>
					<p>Ha Noi, Viet Nam</p>
				</div>
				<div class="db-profile-view">
					<table>
						<thead>
							<tr>
								<th>Age</th>
								<th>Address</th>
								<th>Join Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>32</td>
								<td>Ha Noi, Viet Nam</td>
								<td>May 2010</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="db-profile-edit">
					<form class="col s12">
						<div>
							<label class="col s4">Full Name</label>
							<div class="input-field col s8">
								<input type="text" value="Tran Dan" class="validate"> </div>
						</div>
						<div>
							<label class="col s4">Email id</label>
							<div class="input-field col s8">
								<input type="email" value="Tran99Dan@gmail.com" class="validate"> </div>
						</div>
						<div>
							<label class="col s4">Phone</label>
							<div class="input-field col s8">
								<input type="number" value="035978456" class="validate"> </div>
						</div>
						<div>
							<label class="col s4">Age</label>
							<div class="input-field col s8">
								<input type="number" value="34" class="validate"> </div>
						</div>
						<div>
							<div class="file-field input-field">
								<div class="btn" id="pro-file-upload"> <span>File</span>
									<input type="file"> </div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload profile picture"> </div>
							</div>
						</div>
						<div>
							<label class="col s4">Address</label>
							<div class="input-field col s8">
								<input type="text" value="113 phao sun ba lay" class="validate"> </div>
						</div>
						<div>
							<div class="input-field col s8">
								<input type="submit" value="Submit" class="waves-effect waves-light pro-sub-btn" id="pro-sub-btn"> </div>
						</div>
					</form>
				</div>
			</div>
			<div class="db-righ">
				<h4>Notifications(05)</h4>
				<ul>
					<li>
						<a href="#!"> <img src="images/icon/dbr1.jpg" alt="">
							<h5>New blog</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>2 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr2.jpg" alt="">
							<h5>Thanh toán thành công</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>4 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr3.jpg" alt="">
							<h5>Thanh toán thành công</h5>
							<p>All the Lorem Ipsum generators on the</p> <span>10 hours ago</span> </a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr4.jpg" alt="">
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