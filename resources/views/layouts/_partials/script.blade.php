<!-- Vendor scripts -->
<script src="{{ asset('asset/vendor/pacejs/pace.min.js') }}"></script>
<script src="{{ asset('asset/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('asset/vendor/select2/dist/js/select2.js') }}"></script>
<script src="{{ asset('asset/vendor/summernote/dist/summernote-bs4.js') }}"></script>

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
