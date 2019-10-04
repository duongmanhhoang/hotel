<script src="{{ asset('bower_components/metronic/vendors/base/vendors.bundle.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/metronic/demo/default/base/scripts.bundle.js') }}"
        type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('bower_components/bower/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/bower/js/sweetalert.js') }}"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script>
    @if(session('success'))
        swal('{{ session('success') }}', '', 'success');
    @endif
</script>
