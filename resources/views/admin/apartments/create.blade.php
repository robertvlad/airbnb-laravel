@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="py-3">
                <h2>Add an Apartment</h2>
            </div>
            <div class="d-flex gap-3 pb-3">
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-success">Cancel</a>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <form action="{{ route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input type="text" class="form-control" placeholder="Title" id="title" name="title">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Cover Image</label>
                        <input type="file" name="cover_img" id="cover_img" class="form-control">
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-group my-2">
                        <label class="control-label">Address</label>
                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                    </div>
                    <div class="form-group my-2">
                        <label class="control-label">Description</label>
                        <textarea name="description" id="content" cols="30" rows="10" placeholder="Describe your Apartment" class="form-control"></textarea>
                    </div>
                    <div class="d-flex gap-5">
                        <div class="form-group">
                            <label class="control-label">Rooms</label>
                            <input type="number" class="form-control" placeholder="Rooms" id="room_n" name="room_n">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Bathrooms</label>
                            <input type="number" class="form-control" placeholder="Bathrooms" id="bath_n" name="bath_n">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Beds</label>
                            <input type="number" class="form-control" placeholder="Beds" id="bed_n" name="bed_n">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Square Meters</label>
                            <input type="number" class="form-control" placeholder="Square Meters" id="square_meters" name="square_meters">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Do you want to show this Apartment?</label>
                        <select class="form-comntrol" name="visible" id="visible">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group my-3 d-flex justify-content-around">
                        <div class="control-label">Select Optionals: </div>
                        @foreach ($optionals as $optional)
                        <div class="form-check">
                            <input type="checkbox" value="{{ $optional->id }}" name='optionals[]' class="mx-1">
                            <label class="form-check-label"><i class="{{ $optional->icon}}"></i> {{ $optional->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group my-2">
                        <button type="submit" class="btn btn-secondary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection