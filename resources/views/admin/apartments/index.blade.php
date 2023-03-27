@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>ELENCO APPARTAMENTI</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi Apartmento</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message')}}
            </div>
            @endif
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Titolo</th>
                        <th>Sponsorizzazione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($apartments as $apartment)
                    @if($apartment->user_id == $id)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>@foreach ($apartment->sponsorships as $sponsorship)
                            {{$sponsorship['name']}}
                        @endforeach</td>
                        <td>
                            <a href="{{route('admin.apartments.show', $apartment->slug)}}" title="Visualizza apartment" class="btn btn-sm btn-square btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{route('admin.apartments.edit', $apartment->slug)}}" title="Modfica apartment" class="btn btn-sm btn-square btn-warning mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form class="d-inline-block" action="{{route('admin.apartments.destroy', $apartment->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-square btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @else
                    <div class="alert alert-danger">
                        Non hai appartamenti
                    </div>
                    @endif
                    @empty
                    <div class="alert alert-danger">
                        Non hai appartamenti
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection