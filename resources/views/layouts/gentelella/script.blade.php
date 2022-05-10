{{--<script src="{{ mix('js/contentmanagement.js') }}"></script>--}}

<!-- jQuery -->
<script src="{{ asset('asset/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
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

@yield('script')
