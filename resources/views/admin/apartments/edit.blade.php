@extends('layouts.admin')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Modifica un appartamento</h2>
                    </div>
                    <div>
                        <a href="{{route('admin.apartments.index')}}" class="btn btn-sm btn-primary">Torna all'elenco</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{route('admin.apartments.update', $apartment->slug)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group my-2">
                        <label class="control-label">Titolo</label>
                        <input type="text" class="form-control" placeholder="Inserisci il titolo" id="title" name="title" value="{{old('title') ?? $apartment->title}}">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Immagine di copertina</label>
                        <div class="mb-3">
                            <p>WORK IN PROGRESS</p>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Sponsorships</label>
                        <select name="sponsorship_id" id="sponsorship_id" class="form-control">
                                <option value="">Seleziona la sponsorship</option>
                            @foreach ($sponsorships as $sponsorship)
                                <option value="{{$sponsorship->id}}" {{$sponsorship->id == old('sponsorship_id', $apartment->sponsorship_id) ? 'selected' : ''}}>
                                    {{$sponsorship->name}}
                                </option>
                            @endforeach
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
                        <label class="control-label">Descrizione</label>
                        <textarea class="form-control" placeholder="Inserisci la descrizione" name="description" id="description">{{old('description') ?? $apartment->description}}</textarea>
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Numero di stanze</label>
                        <input type="number" class="form-control" placeholder="Inserisci il numero di stanze" id="room_n" name="room_n" value="{{old('room_n') ?? $apartment->room_n}}">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Numero di letti</label>
                        <input type="number" class="form-control" placeholder="Inserisci il numero di letti" id="bed_n" name="bed_n" value="{{old('bed_n') ?? $apartment->bed_n}}">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Numero di bagni</label>
                        <input type="number" class="form-control" placeholder="Inserisci il numero di bagni" id="bath_n" name="bath_n" value="{{old('bath_n') ?? $apartment->bath_n}}">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Metri quadri</label>
                        <input type="number" class="form-control" placeholder="Inserisci il numero metri quadri" id="square_meters" name="square_meters" value="{{old('square_meters') ?? $apartment->square_meters}}">
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Indirizzo</label>
                        <input type="text" class="form-control" placeholder="Inserisci l'indirizzo" id="address" name="address" value="{{old('address') ?? $apartment->address}}">
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-success btn-sm">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection