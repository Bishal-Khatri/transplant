@extends('restaurant::layouts.master')
@section('appointment_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Appointments<br>Listing<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-culture"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Appointments Listing</h3>
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
                            <a href="{{ route('appointment.create') }}" class="btn btn-accent btn-block mt-1">Add New Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-filled">
                <div class="panel-heading">
                    Appointment listing
                </div>
                <div class="panel-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Contact Number</th>
                            <th>Description</th>
                            <th style="width: 180px" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($appointments) AND !blank($appointments))
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->title }}</td>
                                    <td>{{ $appointment->category->name ?? '' }}</td>
                                    <td>
                                      {{ $appointment->contact }}
                                    </td>
                                    <td>
                                      {{ $appointment->description }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('appointment.delete', $appointment->id) }}"
                                               class="btn btn-default btn-xs text-danger deleteAppointmentModal" >
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
        @if(isset($appointments))
            {!! $appointments->links() !!}
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
                    <form action="" id="deleteAppointmentForm">
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
            $(".deleteAppointmentModal").on('click', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $("#deleteAppointmentForm").attr('action', url);
                $("#deleteModal").modal('show')
            })
        })
    </script>
    @endsection
