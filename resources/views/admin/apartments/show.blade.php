@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5 mb-4">
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
        <div class="col-12 ">
            <div class="cards mb-3" id="cards-search">
                <img src="{{ asset('storage/' .$apartment->cover_img) }}" alt="{{$apartment->title}}" class="img-fluid img-show cards-img">
            </div>
            <hr class="my-5">
            <p class="d-block"><i class="me-2 fas fa-house-user"></i><strong>Description:</strong> <span class="text-secondary">{{ $apartment->description }}</span></p>
            <p><i class="me-2 fas fa-door-closed"></i><strong>Local n.: </strong> <span class="text-secondary">{{ $apartment->room_n }}</span></p>
            <p><i class="me-2 fas fa-bed"></i><strong>Rooms n.: </strong><span class="text-secondary">{{ $apartment->bed_n }}</span></p>
            <p><i class="me-2 fas fa-shower"></i><strong>Bathrooms: </strong><span class="text-secondary">{{ $apartment->bath_n }}</span></p>
            <p><i class="me-2 fas fa-house-chimney"></i><strong>Square Meters: </strong><span class="text-secondary">{{ $apartment->square_meters }}</span></p>
            <p><i class="me-2 fab fa-periscope"></i><strong>Address: </strong><span class="text-secondary">{{ $apartment->address }}</span></p>
            <p><i class="me-2 fas fa-star"></i><strong>Sponsorship: </strong><span class="text-secondary">
                @foreach ($apartment->sponsorships as $sponsorship)
                {{$sponsorship['name']}}
                @endforeach
            </span>
            </p>
            <p><i class="me-2 fas fa-list"></i><strong>Optionals: </strong><span class="text-secondary">
                @foreach ($apartment->optionals as $optional)
                {{$optional['name']}},
                @endforeach
            </span>
            </p>
        </div>
        <hr class="mt-5">
    </div>
</div>

@endsection