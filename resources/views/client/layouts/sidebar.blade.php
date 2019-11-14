<section>
    {{--<div id="modal1" class="modal fade" role="dialog">--}}
        {{--<div class="log-in-pop">--}}
            {{--<div class="log-in-pop-left">--}}
                {{--<h1>Hello... <span></span></h1>--}}
                {{--<p>Đăng nhập</p>--}}
                {{--<h4>Atlantic Hotel</h4>--}}
                {{--<img style="width: 101%;--}}
                    {{--border-radius: 5px;--}}
                    {{--opacity: 0.6" src="{{ asset('bower_components/client_layout/images/about.jpg') }}">--}}
            {{--</div>--}}
            {{--<div class="log-in-pop-right">--}}
                {{--<a href="#" class="pop-close" data-dismiss="modal"><img--}}
                            {{--src="{{ asset('/bower_components/client_layout/images/cancel.png') }}" alt=""/>--}}
                {{--</a>--}}
                {{--<h4>Đăng nhập</h4>--}}
                {{--<p>Đăng nhập để cùng Atlantic trải nghiệm những kì nghỉ tuyệt vời nào!</p>--}}
                {{--<form class="s12">--}}
                    {{--<div>--}}
                        {{--<div class="input-field s12">--}}
                            {{--<input type="text" data-ng-model="name" class="validate">--}}
                            {{--<label>Tên đăng nhập</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<div class="input-field s12">--}}
                            {{--<input type="password" class="validate" autocomplete=off" autofocus="off">--}}
                            {{--<label>Mật khẩu</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<div class="s12 log-ch-bx">--}}
                            {{--<p>--}}
                                {{--<input type="checkbox" id="test5"/>--}}
                                {{--<label for="test5">Ghi nhớ tôi</label>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<div class="input-field s4">--}}
                            {{--<input type="submit" value="Đăng nhập" class="waves-effect waves-light log-in-btn"></div>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<div class="input-field s12"><a href="#" data-dismiss="modal" data-toggle="modal"--}}
                                                        {{--data-target="#modal3">Quên mật khẩu?</a> | <a href="#"--}}
                                                                                                      {{--data-dismiss="modal"--}}
                                                                                                      {{--data-toggle="modal"--}}
                                                                                                      {{--data-target="#modal2">Đăng--}}
                                {{--kí tài khoản</a></div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
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
                <a href="#" class="pop-close" data-dismiss="modal"><img
                            src="{{ asset('bower_components/client_layout/images/cancel.png') }}" alt=""/>
                </a>
                <h4>{{ __('label.register.label') }}</h4>
                {{--<p>Khởi tạo tài khoản để cùng Atlantic trải nghiệm những chuyến du lịch nghỉ dưỡng tốt nhất</p>--}}
                <p>{{ __('label.register.desc') }}</p>
                <form class="s12"
                      {{--action="{{ route('user.register') }}"--}}
                      {{--method="POST"--}}
                >
                    @csrf
                    <div>
                        <div class="input-field s12">
                            <input type="text" data-ng-model="name1" class="validate" name="email" value="{{ old('email' ?? '') }}" id="email">
                            <label>Email</label>
                            <b class="text-danger error-message" data-error="email"></b>
                        </div>
                    </div>
                    <div>
                        <div class="input-field s12">
                            <input type="password" class="validate" name="password" id="password">
                            <label>{{ __('label.register.password') }}</label>
                            <b class="text-danger error-message" data-error="password"></b>

                        </div>
                    </div>
                    <div>
                        <div class="input-field s12">
                            <input type="password" class="validate" name="password_confirmation" id="password_confirmation">
                            <label>{{ __('label.register.password_confirmation') }}</label>
                        </div>
                    </div>

                    <div>
                        <div class="input-field s12">
                            <input type="text" name="full_name" value="{{ old('full_name' ?? '') }}" id="full_name">
                            <label>{{ __('label.register.full_name') }}</label>
                            <b class="text-danger error-message" data-error="full_name"></b>
                        </div>
                    </div>

                    <div>
                        <div class="input-field s12">
                            <input type="text" name="phone" value="{{ old('phone' ?? '') }}" id="phone">
                            <label>{{ __('label.register.phone') }}</label>
                            <b class="text-danger error-message" data-error="phone"></b>
                        </div>
                    </div>

                    <div>
                        <div class="input-field s12">
                            <input type="text" name="address" value="{{ old('address' ?? '') }}" id="address">
                            <label>{{ __('label.register.address') }}</label>
                        </div>
                    </div>
                    <div>
                        <div class="input-field s4">
                            <input type="submit" value="{{ __('label.register.submit') }}" class="waves-effect waves-light log-in-btn btn-submit"></div>
                    </div>
                    <div>
                        <div class="input-field s12"><a href="#" data-dismiss="modal" data-toggle="modal"
                                                        data-target="#modal1">Bạn đã có tài khoản ? Đăng nhập</a></div>
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
                <a href="#" class="pop-close" data-dismiss="modal"><img
                            src="{{ asset('/bower_components/client_layout/images/cancel.png')}}" alt=""/>
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
                            <input type="submit" value="Submit" class="waves-effect waves-light log-in-btn"></div>
                    </div>
                    <div>
                        <div class="input-field s12"><a href="#" data-dismiss="modal" data-toggle="modal"
                                                        data-target="#modal1">Bạn đã có tài khoản ? Đăng nhập</a> | <a
                                    href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal2">Đăng kí tài
                                khoản</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('bower_components/client_layout/js/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/jquery-ui.js') }}"></script>
<script src="{{ asset('bower_components/metronic/vendors/base/vendors.bundle.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/metronic/demo/default/base/scripts.bundle.js') }}"
        type="text/javascript"></script>

<script>
    $(document).ready(function () {
        const urlRegister = "{{ route('user.register') }}";

        $('.btn-submit').on('click', function (){

            $(this).attr('disabled', true);

            let email = $('#email').val();
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
            let full_name = $('#full_name').val();
            let phone = $('#phone').val();
            let address = $('#address').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlRegister,
                method: 'post',
                data: {email, password, password_confirmation, full_name, phone, address},
                success: function (res) {

                    $(".error-message[data-error]").each(function() {
                        if ($(this).data("error")) {
                            $(this).html('');
                        }
                    });

                    if(res.status === 'success') {
                        toastr.success(res.message);
                    }else {
                        toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Thất bại');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    let errors = XMLHttpRequest.responseJSON.errors;

                    for(let key in errors) {
                        let value = errors[key][0];
                        $(".error-message[data-error]").each(function() {
                            $(this).html('');
                            if ($(this).data("error") === key) {
                                $(this).html(value);
                            }
                        });
                    }

                    $(this).attr('disabled', false);

                }
            })
        })
    })
</script>