<script>
    $(document).ready(function() {
		$('#registerForm').submit(function(e) {
				e.preventDefault();
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
				});
				$.ajax({
					'url' : $('#url-register').val(),
					'data': {
						'full_name' : $('#registerName').val(),
						'email' : $('#registerEmail').val(),
						'password' : $('#registerPassword').val(),
						'password_confirmation' : $('#password_confirmation').val()
					},

					'type' : 'POST',
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							if (data.message.full_name) {
								$('.errorName').show().text(data.message.full_name[0]);
							}
							if (data.message.email) {
								$('.errorEmail').show().text(data.message.email[0]);
							}
							if (data.message.password) {
								$('.errorPassword').show().text(data.message.password[0]);
							}
							if (data.message.password_confirmation != undefined) {
								$('.errorConfirm').show().text(data.message.password_confirmation[0]);
							}
						}
						else {
							// alert("Đăng ký thành công, Vui lòng xác nhận email!");
							// window.location.href = "http://localhost:8000/login";
						}	
					}
				});
		})
	});
</script>
