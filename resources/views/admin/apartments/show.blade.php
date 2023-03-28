@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Appartment Details:</h2>
                    <h3 class="my-3">{{ $apartment->title }}</h3>
                </div>
                <div>
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
        <div class="col-12 my-5">
            <div>
                <img src="{{ asset('storage/' .$apartment->cover_img) }}" alt="{{$apartment->title}}" class="w-25 img-fluid">
            </div>
            <label class="d-block"><strong>Appartment Description:</strong></label>
            <p>{{ $apartment->description }}</p>
            <p><strong>Local n.: </strong>{{ $apartment->room_n }}</p>
            <p><strong>Rooms n.: </strong>{{ $apartment->bed_n }}</p>
            <p><strong>Bathrooms: </strong>{{ $apartment->bath_n }}</p>
            <p><strong>Square Meters: </strong>{{ $apartment->square_meters }}</p>
            <p><strong>Adress: </strong>{{ $apartment->address }}</p>
            <p><strong>Sponsorship: </strong>
                @foreach ($apartment->sponsorships as $sponsorship)
                {{$sponsorship['name']}}
                @endforeach
            </p>
            <p><strong>Optionals: </strong>
                @foreach ($apartment->optionals as $optional)
                {{$optional['name']}}
                @endforeach
            </p>
        </div>
    </div>
</div>

@endsection