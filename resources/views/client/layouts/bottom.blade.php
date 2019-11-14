<script src="{{ asset('bower_components/client_layout/js/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/jquery-ui.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/angular.min.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/materialize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/jquery.mixitup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/custom.js') }}"></script>

<script src="{{ asset('js/client/app.js') }}"></script>
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtqlBL2XudSG3aIwHNNkBcj37CSjrFXqc&callback=initMap&libraries=geometry,places"></script>--}}
//image slide
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
//end
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/client/app.js') }}"></script>
<script>
    @if(session('success'))
    swal('{{ session('success') }}', '', 'success');
    @endif
    @if(session('error'))
    swal('{{ session('error') }}', '', 'error');
    @endif
</script>
@yield('script')


