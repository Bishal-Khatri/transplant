@extends('contentmanagement::theme.Stack.layouts.master')

@section('content')
    <section class="text-center height-50">
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <h1>Hospital Registration Form</h1>
                    <p class="lead">
                        An innovative collective of like-minded folks making useful and enduring technology products
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
