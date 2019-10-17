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
				<div class="db-cent-3">
					<div class="db-cent-table db-com-table">
						<div class="db-title">
							<h3><img src="{{ asset('bower_components/client_layout/images/icon/dbc5.png') }}" alt=""/> Make New Booking</h3>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
						</div>
						<div class="book-form inn-com-form db-form">
							<form class="col s12">
								<div class="row">
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>Full Name</label>
									</div>
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>Email</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>Phone</label>
									</div>
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>Mobile</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>City</label>
									</div>
									<div class="input-field col s6">
										<input type="text" class="validate">
										<label>Country</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>No of adults</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="1">4</option>
										</select>
									</div>
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>No of childrens</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="1">4</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" id="from" name="from">
										<label for="from">Arrival Date</label>
									</div>
									<div class="input-field col s6">
										<input type="text" id="to" name="to">
										<label for="to">Departure Date</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea id="textarea1" class="materialize-textarea" data-length="120"></textarea>
										<label>Message</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="submit" value="submit" class="form-btn"> </div>
								</div>
							</form>
						</div>
					</div>
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