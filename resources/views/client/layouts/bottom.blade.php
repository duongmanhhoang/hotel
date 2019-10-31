<script src="{{ asset('bower_components/client_layout/js/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/jquery-ui.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/angular.min.js') }}"></script>
<script src="{{ asset('bower_components/client_layout/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/materialize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/jquery.mixitup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/client_layout/js/custom.js') }}"></script>
<script src="{{ asset('js/client/app.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    @if(session('success'))
    swal('{{ session('success') }}', '', 'success');
    @endif
    @if(session('error'))
    swal('{{ session('error') }}', '', 'error');
    @endif
</script>
