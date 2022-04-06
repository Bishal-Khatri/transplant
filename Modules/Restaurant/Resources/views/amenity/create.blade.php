@extends('restaurant::layouts.master')
@section('amenity_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Restaurant<br>Amenity<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-culture"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Create/Update Restaurant Amenity</h3>
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
                    <form method="POST" action="{{ route('restaurant.amenity.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $amenity->id ?? null }}">
                        <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Amenity Name" value="{{ isset($amenity) ? $amenity->name : old('name') }}">
                            @error('name')
                            <span class="form-text small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="category-image">Image</label>
                            <input type="file" id="category-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg">
                            @error('image')
                            <span class="form-text small text-danger">{{ $message }}</span>
                            @enderror
                            <img src="{{ isset($amenity->image) ? Storage::url($amenity->image) : asset('images/placeholder-dark.jpg') }}" alt="" id="cat-image-preview" name="image" class="rounded image-xl">
                        </div>

                        @if(isset($amenity))
                            <a href="{{ route('restaurant.amenity.index') }}" class="btn btn-default">Discard</a>
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
