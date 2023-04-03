@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Welcome Back Dummy!') }}

                </div>
                
            </div>
            <a href="http://localhost:5174/" class="text-white text-decoration-none d-flex justify-content-center w-100">
                <button class="btn btn-secondary w-100">Back to Apartments Home</button>
            </a>
        </div>
    </div>
</div>
@endsection