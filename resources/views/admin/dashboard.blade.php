@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Welcome Back Dummy!') }}

                </div>
                <button class="btn btn-secondary"><a href="http://localhost:5174/" class="text-white text-decoration-none">Back to Apartments Home</a></button>
            </div>
        </div>
    </div>
</div>
@endsection