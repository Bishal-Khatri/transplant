@extends('restaurant::layouts.master')
@section('amenity_active') active @stop
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
                    <h3 class="m-b-xs">Create/Update Appointment Listing Data</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <form method="POST" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $appointment->id ?? null }}">
                        <div class="form-group mb-4">
                            <label for="name">Title</label>
                            <input type="text" name="title" class="form-control" id="name" placeholder="Title" value="{{ isset($appointment) ? $appointment->title : old('title') }}">
                            @error('title')
                            <span class="form-text small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $appointment->description ?? old('description') }}</textarea>
                            @error('description')
                            <span class="form-text small text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(isset($appointment))
                            <a href="{{ route('appointment.index') }}" class="btn btn-default">Discard</a>
                            <button type="submit" class="btn btn-accent">Update</button>
                        @else
                            <button type="submit" class="btn btn-accent">Save</button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
