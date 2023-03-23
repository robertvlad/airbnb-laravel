@extends('layouts.app');

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="py-3">
                <h2>Aggiungi Appartamento</h2>
            </div>
            <div class="d-flex gap-3 pb-3">
                <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Annulla</a>
            </div>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>                        
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <div>
                <form action="{{ route('admin.apartments.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">TITOLO</label>
                        <input type="text" class="form-control" placeholder="Titolo" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label class="control-label">ADDRESS</label>
                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descrizione</label>
                        <textarea name="description" id="content" cols="30" rows="10" placeholder="Descrizione" class="form-control"></textarea>
                    </div>
                    <div class="d-flex gap-5">
                        <div class="form-group">
                            <label class="control-label">STANZE</label>
                            <input type="number" class="form-control" placeholder="Stanze" id="room_n" name="room_n">
                        </div>
                        <div class="form-group">
                            <label class="control-label">BAGNI</label>
                            <input type="number" class="form-control" placeholder="Bagni" id="bath_n" name="bath_n">
                        </div>
                        <div class="form-group">
                            <label class="control-label">LETTI</label>
                            <input type="number" class="form-control" placeholder="Letti" id="bed_n" name="bed_n">
                        </div>
                        <div class="form-group">
                            <label class="control-label">METRI QUADRATI</label>
                            <input type="number" class="form-control" placeholder="Metri" id="square_meters" name="square_meters">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Sponsorship</label>
                        <select class="form-comntrol" name="sponsorship_id" id="sponsorship_id">
                            <option value="">Seziona gli sponsorship</option>
                            @foreach ($sponsorships as $sponsorship)
                                <option value="{{ $sponsorship->id }}">{{ $sponsorship->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <div class="control-label">Optionals: </div>
                        @foreach ($optionals as $optional)
                        <div class="form-check">
                            <input type="checkbox" value="{{ $optional->id }}" name='optionals[]'>
                            <label class="form-check-label"><i class="{{ $optional->icon}}"></i> {{ $optional->name }}</label>  
                        </div>                          
                        @endforeach
                    </div>
                    <div class="form-group my-2">
                        <button type="submit" class="btn btn-success">Salva</button>                     
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection