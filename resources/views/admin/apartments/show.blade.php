@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Dettaglio dell'apartments: {{ $apartment->title }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.apartments.index') }}">Torna all'elenco</a>
                    </div>
                </div>
            </div>
            <div class="col-12 my-5">
                <div>
                    <img src="{{ $apartment->cover_img }}" alt="{{$apartment->title}}" class="w-50">
                </div>
                <p><strong>Slug: </strong>{{ $apartment->slug }}</p>
                <label class="d-block"><strong>Descrizione appartamento:</strong></label>
                <p>{{ $apartment->description }}</p>
                <p><strong>Numero camere: </strong>{{ $apartment->room_n }}</p>
                <p><strong>Numero camere da letto: </strong>{{ $apartment->bed_n }}</p>
                <p><strong>Numero bagni: </strong>{{ $apartment->bath_n }}</p>
                <p><strong>Metri quadri dell'appartamento: </strong>{{ $apartment->square_meters }}</p>
                <p><strong>Indirizzo: </strong>{{ $apartment->address }}</p>
                <p><strong>Latitudine: </strong>{{ $apartment->latitude }}</p>
                <p><strong>Longitudine: </strong>{{ $apartment->longitude }}</p>
            </div>
        </div>
    </div>

@endsection