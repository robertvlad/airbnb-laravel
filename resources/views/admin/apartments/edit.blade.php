@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Modify Appartment</h2>
                </div>
                <div>
                    <a href="{{route('admin.apartments.index')}}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
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
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message')}}
            </div>
        @endif
        <div class="col-12">
            <form action="{{route('admin.apartments.update', ['apartment' => $apartment['slug']])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group my-2">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" placeholder="Inserisci il titolo" id="title" name="title" value="{{old('title') ?? $apartment['title']}}">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Cover Image</label>
                    <div><img src="{{ asset('storage/' .$apartment->cover_img ) }}" class="w-25 my-3"></div>
                    <input type="file" name="cover_img" id="cover_img" class="form-control">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Do you want to Show your Apartment?</label>
                    <select class="form-comntrol" name="visible" id="visible">
                        <option value="1" {{$apartment->visible == old('visible', $apartment->visible) ? 'selected' : ''}}>Yes</option>
                        <option value="0" {{$apartment->visible == old('visible', $apartment->visible) ? 'selected' : ''}}>No</option>
                    </select>
                </div>
                <div class="form-group my-3">
                    <div class="control-label">Optionals</div>
                    @foreach ($optionals as $optional)
                    <div class="form-check @error('optionals') is-invalid @enderror">
                        @if ($errors->any())
                        <input type="checkbox" value="{{$optional->id}}" name="optionals[]" {{in_array($optional->id, old('optionals', [])) ? 'checked' : ''}} class="form-check-input">
                        <label class="form-check-label">{{$optional->name}}</label>
                        @else
                        <input type="checkbox" value="{{$optional->id}}" name="optionals[]" {{$apartment->optionals->contains($optional) ? 'checked' : ''}} class="form-check-input">
                        <label class="form-check-label">{{$optional->name}}</label>
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="form-group my-2">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" placeholder="Describe your Apartment" name="description" id="description">{{old('description') ?? $apartment['description']}}</textarea>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Number of Rooms</label>
                    <input type="number" class="form-control" placeholder="Input the number of Rooms" id="room_n" name="room_n" value="{{old('room_n') ?? $apartment['room_n']}}">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Number of Beds</label>
                    <input type="number" class="form-control" placeholder="Input the number of Beds" id="bed_n" name="bed_n" value="{{old('bed_n') ?? $apartment['bed_n']}}">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Number of Bathrooms</label>
                    <input type="number" class="form-control" placeholder="Input the number of Bathrooms" id="bath_n" name="bath_n" value="{{old('bath_n') ?? $apartment['bath_n']}}">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Square Meters</label>
                    <input type="number" class="form-control" placeholder="Input Apartment dimension in Square Meters" id="square_meters" name="square_meters" value="{{old('square_meters') ?? $apartment['square_meters']}}">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Address</label>
                    <input type="text" class="form-control" placeholder="Input the Address" id="address" name="address" value="{{old('address') ?? $apartment['address']}}">
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection