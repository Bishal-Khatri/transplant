@extends('contentmanagement::theme.Stack.layouts.master')

@section('content')
    <section class="text-center imagebg space--lg" data-overlay="3">
        <div class="background-image-holder">
            <img alt="background" src="/themes/stack/img/landing-19.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <h1>Hospital Registration Form</h1>
                    <p class="lead">
                        {{--An innovative collective of like-minded folks making useful and enduring technology products--}}
                    </p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <section>
        <div id="app" class="container">
            <register-hospital/>
        </div>
        <!--end of container-->
    </section>
@endsection
