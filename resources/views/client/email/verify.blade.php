<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Xác nhận đăng ký</h2>

        <div>
            
            <p>
                Cảm ơn bạn đã đăng ký tài khoản với hệ thống của chúng tôi.<br>
                Vui lòng xác nhận bằng đường dẫn dưới đây để hoàn tất đăng ký.
            </p><br>
            @if ( Cookie::get('token_cookie') != null )
            <a href="{{ route('verifyRegister', Cookie::get('token_cookie')) }}">
                Link
            </a>
            @endif
            <br/>

        </div>

    </body>
</html>