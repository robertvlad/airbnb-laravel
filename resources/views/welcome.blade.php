@extends('layouts.app')
@section('content')

<div class="jumbotron p-3 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <div class="logo_bnb d-flex justify-content-center">
            <img class="img-fluid w-50" src="https://1000logos.net/wp-content/uploads/2023/01/Airbnb-logo.png" alt="logo_bnb">
        </div>
        <h1 class="display-5 fw-bold d-flex justify-content-center">
            Welcome to BoolBnB
        </h1>
        <p class="col-md-12 fs-4 d-flex justify-content-center mt-4">Database per gli Host di BoolBnB</p>
        <a href="{{url('/admin') }}" class="btn btn-primary btn-lg d-flex justify-content-center col-md-4 offset-md-4 mt-5" type="button">Enter</a>
    </div>
</div>

<div class="content">
    <div class="container">
        {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p> --}}
    </div>
</div>
@endsection