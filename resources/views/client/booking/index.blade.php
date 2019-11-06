@extends('client.layouts.master')
@section('content')
		<div class="inn-body-section inn-booking">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="head-typo">
							<h2 id="text-head">Atlantic - Đặt phòng</h2>
						</div>
                        <div class="col-md-6">
                            <div class="book-title">
                                <div class="card-hover">
                                    <div class="card">
<!--                                         <div class="card-content">
                                            <div class="image">
                                                <img src="{{ asset('bower_components/client_layout/images/room1.jpg') }}" alt="">
                                            </div>
                                        </div> -->
                                     <img id ="img-detail" src="{{ asset('bower_components/client_layout/images/room1.jpg') }}" alt="">
                                    </div>
                                    <div class="room-detail">
                                    	 <h4 class="">Tên phòng: Master Room</h4>
                                    	 <h4>Giá: 2000000 VNĐ</h4>
                                    	 <h4>Dịch vụ (bấm để xem chi tiết)</h4>
                                    </div>
                                    <ul class="collapsible popout" data-collapsible="accordion">
								<li>
									<div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
									<div class="collapsible-body"><span>lul.</span>
									</div>
								</li>
								<li>
									<div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
									<div class="collapsible-body"><span>lul.</span>
									</div>
								</li>
								<li>
									<div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
									<div class="collapsible-body"><span>lul.</span>
									</div>
								</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
						<div class="book-form inn-com-form">
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
										<label>Cơ sở</label>
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
										<textarea id="textarea12" class="materialize-textarea"></textarea>
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
