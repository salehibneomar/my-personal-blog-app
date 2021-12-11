<script src="{{ asset('backend/assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function(){
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}'); 
            @endforeach
        @endif

        @if (Session::has('alertMsg'))
            @if (Session::get('alertType')=='success')
                toastr.success("{{ Session::get('alertMsg') }}"); 
            @elseif (Session::get('alertType')=='error')
                toastr.error("{{ Session::get('alertMsg') }}");
            @else
                toastr.info("{{ Session::get('alertMsg') }}");        
            @endif
        @endif
    });
</script>

@yield('extra_script')