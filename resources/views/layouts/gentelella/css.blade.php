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
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
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


    element.style {
        border: 0;
    }
    .navbar {
        margin-bottom: 0;
    }
    .nav_title {
        width: 230px;
        float: left;
        background: #EDEDED;
        border-radius: 0;
        height: 57px;
        padding: 0;
    }

    .required{
        color: red;
    }
    .right_col{
        min-height: 90vh;
    }

    .toast{
        opacity: 1 !important;
    }

    .text-accent{
        color: #172D44 !important;
    }

    .text-accent-1{
        color: #5A738E !important;
    }

    .bg-accent{
        background-color: #172D44 !important;
    }
    .bg-accent-1{
        background-color: #2A3F54 !important;
    }

    .disabled-link {
        pointer-events: none;
    }
</style>
@yield('css')
