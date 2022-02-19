<!-- Vendor scripts -->
<script src="{{ asset('asset/vendor/pacejs/pace.min.js') }}"></script>
<script src="{{ asset('asset/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/vendor/toastr/toastr.min.js') }}"></script>
<!-- App scripts -->
<script src="{{ asset('asset/scripts/luna.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    // $(document).ready(function () {
    //
    //     toastr.options = {
    //         "debug": false,
    //         "newestOnTop": false,
    //         "positionClass": "toast-bottom-right",
    //         "closeButton": true,
    //         "progressBar": true
    //     };
    //
    //     $('.homerDemo1').on('click', function(event){
    //         toastr.info('Info - This is a custom LUNA info notification');
    //     });
    //
    //     $('.homerDemo2').on('click', function(event){
    //         toastr.success('Success - This is a LUNA success notification');
    //     });
    //
    //     $('.homerDemo3').on('click', function(event){
    //         toastr.warning('Warning - This is a LUNA warning notification');
    //     });
    //
    //     $('.homerDemo4').on('click', function(event){
    //         toastr.error('Error - This is a LUNA error notification');
    //     });
    //
    //
    // });
</script>
<script>
    toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-bottom-right",
        "closeButton": true,
        "progressBar": true
    };
    @if(Session::has('success'))
    toastr.success("{!! session('success') !!}");
    @endif
    @if(Session::has('error'))
    toastr.error("{!! session('error') !!}");
    @endif
    @if(Session::has('info'))
    toastr.info("{!! session('info') !!}");
    @endif
</script>
