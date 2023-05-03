@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Apartments List:</h2>
                </div>
                <div>
                    <a class="btn btn-secondary" href="{{route('admin.apartments.create')}}">Add an Apartment</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message')}}
            </div>
            @endif

            <table class="table table-striped text-center table-responsive">
                <thead>
                    <tr class="bigger-text">
                        <th width="200">Title</th>
                        <th class="d-none d-lg-table-cell">Sponsorship</th>
                        <th class="d-none d-lg-table-cell">New Messages</th>
                        <th class="d-none d-lg-table-cell">Old Messages</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($apartments as $apartment)
                    @if($apartment->user_id == $id)
                    <tr class="medium-text">
                        <td class="ellipsis ellipsis-cont">{{ $apartment->title }}</td>
                        <td class="d-none d-lg-table-cell">
                            @forelse ($apartment->sponsorships as $sponsorship)
                                {{$sponsorship['name']}}
                            @empty
                                <a class="unstyled-link" href="{{ route('admin.sponsorships.index') }}">Sponsor now!</a>
                            @endforelse
                        </td>
                        @php
                            $newMessages = 0;
                            $viewedMessages = 0;
                        @endphp

                        @foreach ($apartment->messages as $message)
                            @if ($message->viewed == false)
                                @php $newMessages++ @endphp
                            @else
                                @php $viewedMessages++ @endphp
                            @endif
                        @endforeach
                        <td class="d-none d-lg-table-cell">
                            {{ $newMessages }} <i class="fas fa-envelope"></i>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            {{ $viewedMessages }} <i class="fas fa-envelope-open"></i>
                        </td>
                        <td>
                            <a href="{{route('admin.apartments.show', $apartment->slug)}}" title="Visualizza apartment" class="btn btn-sm btn-square btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{route('admin.apartments.edit', $apartment->slug)}}" title="Modfica apartment" class="btn btn-sm btn-square btn-warning mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <div class="alert alert-danger">
                        You dont have any Apartment, do you want to Place one? do it <a href="{{route('admin.apartments.create')}}">Here!</a>
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.partials.modal')
@endsection