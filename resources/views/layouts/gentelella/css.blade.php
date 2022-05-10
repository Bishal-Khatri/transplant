<!-- Bootstrap -->
<link href="{{ asset('asset/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('asset/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('asset/gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ asset('asset/gentelella/build/css/custom.min.css') }}" rel="stylesheet">

{{--from dione--}}
<link rel="stylesheet" href="{{ asset('asset/vendor/summernote/dist/summernote-bs4.css') }}"/>
<link rel="stylesheet" href="{{ asset('asset/vendor/toastr/toastr.min.css') }}"/>

<style>
    .rounded{
        border-radius: 0.25rem !important;
    }

    img.image-xl {
        width: 128px;
        height: 128px;
    }

    img.image-md {
        width: 32px;
        height: 32px;
    }
    .btn-accent{
        color: #fff;
        background-color: #2A3F54;
        border-color: #2A3F54;
    }
    .btn-accent:hover{
        color: #fff;
        background-color: #2A3F54;
        border-color: #2A3F54;
    }
</style>
@yield('css')
