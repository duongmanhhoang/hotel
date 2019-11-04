	<section>
		<div id="modal2" class="modal fade" role="dialog">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... <span></span></h1>
					<p>Bạn chưa có tài khoản? Đăng kí ngay thôi nào! Chỉ với vài phút mà thôi!</p>
					<h4>Atlantic Hotel</h4>
					<img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="{{ asset('bower_components/client_layout/images/about.jpg') }}">
				</div>
				<div class="log-in-pop-right">
					<a class="pop-close" data-dismiss="modal"><img src="{{ asset('bower_components/client_layout/images/cancel.png') }}" alt="" />
					</a>
					<h4>Đăng kí tài khoản</h4>
					<p>Khởi tạo tài khoản để cùng Atlantic trải nghiệm những chuyến du lịch nghỉ dưỡng tốt nhất</p>
					<form class="s12" action="{{ route('submitRegister') }}" id="registerForm" method="post">
						{{ csrf_field() }}
						<div>
							<div class="input-field s12">
								<input type="hidden" id="url-register" value="{{route('submitRegister')}}">
								<input type="hidden" id="url-login" value="{{route('login')}}">
								<input type="text" data-ng-model="name1" name="full_name" id="registerName" class="validate" value="{{old('registerName')}}">
								<label>Họ và tên</label>
							</div>
								<b class="text-danger errorName"></b>
						</div>
						<div>
							<div class="input-field s12">
								<input type="text" name="email" id="registerEmail" class="validate" value="{{old('registerEmail')}}">
								<label>Email</label>
							</div>
								<b class="text-danger errorEmail"></b>
						</div>
						<div>
							<div class="input-field s12">
								<input type="password" name="password" id="registerPassword" class="validate">
								<label>Mật khẩu</label>
							</div>
								<b class="text-danger errorPassword"></b>
						</div>
						<div>
							<div class="input-field s12">
								<input type="password" class="validate" name="password_confirmation" id="password_confirmation">
								<label>Nhập lại mật khẩu</label>
							</div>
                                <b class="text-danger errorConfirm"></b>
						</div>
						<div>
							<div class="input-field s4">
								<input id="submit-register" type="submit" value="Đăng kí" class="waves-effect waves-light log-in-btn">
							</div>
						</div>
						<div>
							<div class="input-field s12"> 
								<a href="{{route('login')}}" data-dismiss="modal" data-toggle="modal" data-target="#modal1">
								Bạn đã có tài khoản ? Đăng nhập
								</a> </div>
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
                    opacity: 0.6" src="{{ asset('bower_components/client_layout/images/about.jpg') }}">
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
