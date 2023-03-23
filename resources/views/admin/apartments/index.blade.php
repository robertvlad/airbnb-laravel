@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>ELENCO APPARTAMENTI</h2>
                    </div>
                    <div>
                        <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi Post</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message')}}
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titolo</th>
                            <th>Slug</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                        <tr>
                            <th scope="row">{{ $apartment->id }}</th>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->slug }}</td>
                            <td>
                                <a href="{{route('admin.apartments.show', $apartment->slug)}}" title="Visualizza apartment" class="btn btn-sm btn-square btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('admin.apartments.edit', $apartment->slug)}}" title="Modfica apartment" class="btn btn-sm btn-square btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{-- <form class="d-inline-block" action="{{route('admin.apartments.destroy', $apartment->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td scope="row">
                                Nessun post, aggiungilo da <a href="{{route('admin.apartments.create')}}">qui</a> 
                            </td>
                        </tr>        
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection