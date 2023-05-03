@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Messages List:</h2>
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
                    <tr class="bigger-text">
                        <th class="d-none d-sm-table-cell">e-Mail</th>
                        <th>Apartment Name</th>
                        <th class="d-none d-lg-table-cell">Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apartments as $apartment)
                    @foreach ($apartment->messages as $message)
                    @if($apartment->user_id == $id)
                    <tr class="medium-text">
                        <td class="d-none d-sm-table-cell">{{ $message->user_mail }}</td>
                        <td class="ellipsis ellipsis-cont">{{$apartment['title']}}</td>
                        <td class="d-none d-lg-table-cell">{{$message['created_at']}}</td>
                        <td>
                            <a href="{{route('admin.messages.show', $message->id)}}" title="Visualize message" class="btn btn-sm btn-square btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form class="d-inline-block" action="{{route('admin.messages.destroy', $message->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modalmsg" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.partials.modalmsg')
@endsection