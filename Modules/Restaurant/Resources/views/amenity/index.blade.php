@extends('restaurant::layouts.master')
@section('amenity_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Restaurant<br>Amenities<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-culture"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Restaurant Amenities</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <a href="{{ route('restaurant.amenity.create') }}" class="btn btn-accent btn-block mt-1">Add New Amenity</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-filled">
                <div class="panel-heading">
                    Amenity list for restaurant
                </div>
                <div class="panel-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Display Status</th>
                            <th style="width: 180px" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($amenities) AND !blank($amenities))
                            @foreach($amenities as $amenity)
                                <tr>
                                    <td>{{ $amenity->id }}</td>
                                    <td>
                                        @if($amenity->image)
                                            <img alt="image" class="rounded image-md" src="{{ Storage::url($amenity->image) }}">
                                        @else
                                            <img alt="image" class="rounded image-md" src="{{ asset('images/placeholder-dark.jpg') }}">
                                        @endif
                                    </td>
                                    <td>{{ $amenity->name }}</td>
                                    <td>
                                        @if($amenity->status == 'true')
                                            <button class="btn btn-accent btn-sm">Enabled</button>
                                        @else
                                            <button class="btn btn-secondary btn-sm">Disabled</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('restaurant.amenity.edit', $amenity->id) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit</a>

                                            <a href="{{ route('restaurant.amenity.delete', $amenity->id) }}"
                                               class="btn btn-default btn-sm text-danger deleteAmenityModal" >
                                                <i class="fa fa-sticky-note"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No items to display.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        @if(isset($amenities))
            {!! $amenities->links() !!}
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <small>Click <code>Delete</code> button to confirm.</small>
                </div>
                <div class="modal-body">
                    <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteAmenityForm">
                        <button type="submit" class="btn btn-accent">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".deleteAmenityModal").on('click', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $("#deleteAmenityForm").attr('action', url);
                $("#deleteModal").modal('show')
            })
        })
    </script>
    @endsection
