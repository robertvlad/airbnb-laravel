@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Messages:</h2>
                </div>
                <div>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
        <div class="col-12 my-5">
            <p><i class="me-2 fas fas fa-paper-plane"></i><strong>Mail From:</strong> {{ $message->user_mail }}</p>
            <p><i class="me-2 fas fa-envelope-open-text"></i><strong>Content:</strong> {{ $message->message }}</p>
        </div>
        <hr>
    </div>
</div>

@endsection