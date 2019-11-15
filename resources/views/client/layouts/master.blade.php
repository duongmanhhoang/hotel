<!DOCTYPE html>
<html lang="en">

@include ('client.layouts.head')
<body data-ng-app="">
<section>
    @include ('client.layouts.header')
    @yield('content')
    @include ('client.layouts.booking')
</section>
@include ('client.layouts.footer')
@include('client.layouts.chat')
@include ('client.layouts.bottom')
@include ('client.layouts.sidebar')
</body>
</html>
