	<section>
		<div id="modal1" class="modal fade" role="dialog">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... <span></span></h1>
					<p>Đăng nhập</p>
					<h4>Atlantic Hotel</h4>
					<img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="images/about.jpg">
				</div>
				<div class="log-in-pop-right">
					<a href="#" class="pop-close" data-dismiss="modal"><img src="{{ asset('/bower_components/client_layout/images/cancel.png') }}" alt="" />
					</a>
					<h4>Đăng nhập</h4>
					<p>Đăng nhập để cùng Atlantic trải nghiệm những kì nghỉ tuyệt vời nào!</p>
					<form class="s12">
						<div>
							<div class="input-field s12">
								<input type="text" data-ng-model="name" class="validate">
								<label>Tên đăng nhập</label>
							</div>
						</div>
						<div>
							<div class="input-field s12">
								<input type="password" class="validate">
								<label>Mật khẩu</label>
							</div>
						</div>
						<div>
							<div class="s12 log-ch-bx">
								<p>
									<input type="checkbox" id="test5" />
									<label for="test5">Ghi nhớ tôi</label>
								</p>
							</div>
						</div>
						<div>
							<div class="input-field s4">
								<input type="submit" value="Đăng nhập" class="waves-effect waves-light log-in-btn"> </div>
						</div>
						<div>
							<div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal3">Quên mật khẩu?</a> | <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal2">Đăng kí tài khoản</a> </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="modal2" class="modal fade" role="dialog">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... <span></span></h1>
					<p>Bạn chưa có tài khoản? Đăng kí ngay thôi nào! Chỉ với vài phút mà thôi!</p>
					<h4>Atlantic Hotel</h4>
					<img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="images/about.jpg">
				</div>
				<div class="log-in-pop-right">
					<a href="#" class="pop-close" data-dismiss="modal"><img src="{{ asset('/bower_components/client_layout/images/cancel.png')}}" alt="" />
					</a>
					<h4>Đăng kí tài khoản</h4>
					<p>Khởi tạo tài khoản để cùng Atlantic trải nghiệm những chuyến du lịch nghỉ dưỡng tốt nhất</p>
					<form class="s12">
						<div>
							<div class="input-field s12">
								<input type="text" data-ng-model="name1" class="validate">
								<label>Tên đăng nhập</label>
							</div>
						</div>
						<div>
							<div class="input-field s12">
								<input type="email" class="validate">
								<label>Email id</label>
							</div>
						</div>
						<div>
							<div class="input-field s12">
								<input type="password" class="validate">
								<label>Mật khẩu</label>
							</div>
						</div>
						<div>
							<div class="input-field s12">
								<input type="password" class="validate">
								<label>Nhập lại mật khẩu</label>
							</div>
						</div>
						<div>
							<div class="input-field s4">
								<input type="submit" value="Đăng kí" class="waves-effect waves-light log-in-btn"> </div>
						</div>
						<div>
							<div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal1">Bạn đã có tài khoản ? Đăng nhập</a> </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="modal3" class="modal fade" role="dialog">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... <span></span></h1>
					<h4>Atlantic Hotel</h4>
					<img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="images/about.jpg">
				</div>
				<div class="log-in-pop-right">
					<a href="#" class="pop-close" data-dismiss="modal"><img src="{{ asset('/bower_components/client_layout/images/cancel.png')}}" alt="" />
					</a>
					<h4>Quên mật khẩu</h4>
					<p>Nhận lại mật khẩu ngay thôi nào</p>
					<form class="s12">
						<div>
							<div class="input-field s12">
								<input type="text" data-ng-model="name3" class="validate">
								<label>Tên đăng nhập hoặc địa chỉ email</label>
							</div>
						</div>
						<div>
							<div class="input-field s4">
								<input type="submit" value="Submit" class="waves-effect waves-light log-in-btn"> </div>
						</div>
						<div>
							<div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal1">Bạn đã có tài khoản ? Đăng nhập</a> | <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal2">Đăng kí tài khoản</a> </div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>