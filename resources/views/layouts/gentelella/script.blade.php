<!-- jQuery -->
<script src="{{ asset('asset/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script src="{{ asset('asset/gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('asset/gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('asset/gentelella/vendors/nprogress/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('asset/gentelella/build/js/custom.min.js') }}"></script>

{{--// from dione--}}
<script src="{{ asset('asset/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('asset/vendor/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('asset/vendor/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script src="{{ asset('asset/gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": 10000,
        "extendedTimeOut": 10000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "positionClass": "toast-bottom-full-width",
    };
    @if(Session::has('success'))
    toastr.info("{!! session('success') !!}");
    @endif
    @if(Session::has('error'))
    toastr.info("{!! session('error') !!}");
    @endif
    @if(Session::has('info'))
    toastr.info("{!! session('info') !!}");
    @endif
</script>

@yield('script')
