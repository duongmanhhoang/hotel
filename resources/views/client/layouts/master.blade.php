<!DOCTYPE html>
<html lang="en">

@include ('client.layouts.head')

<body data-ng-app="">
	<section>
@include ('client.layouts.header')
@yield('content')
					
	</section>
@include ('client.layouts.footer')
@include ('client.layouts.sidebar')
@include ('client.layouts.bottom')
</body>

</html>