@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Sponsorships:</h2>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex flex-wrap justify-content-between">
            @foreach($sponsorships as $sponsorship)
            <div class="card p-1 shadow-lg bg-dark text-white m-2" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('img/' . $sponsorship['name'] . '.png') }}" alt="{{ $sponsorship['name'] }}">
                <div class="card-body">
                    <h4 class="card-title text-center">{{ $sponsorship['name'] }}</h4>
                    <p class="card-text">{{ $sponsorship['description'] }}</p>
                </div>
                <hr>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-dark text-white font-size-test">Price: {{ $sponsorship['price'] }} &euro;</li>
                    <li class="list-group-item bg-dark text-white font-size-test">Duration: {{ $sponsorship['duration'] }} hours</li>
                </ul>
                <hr>
                <div class="card-body d-flex flex-column gap-2">
                    <label for="apartments_select">Choose an Apartment</label>
                    <ul name="apartments_select" id="apartments_select" class="list-unstyled ul-sponsorships">
                        @foreach($apartments as $apartment)
                            @if($apartment->user_id == $id)

                                <!-- Controllo se l'appartamento ha già una sponsorship -->

                                @if($apartment->sponsorship()->count() > 0)
                                <!-- L'appartamento ha già una sponsorship -->
                                    @if($apartment->sponsorship)
                                        <li value="{{ $apartment['id'] }}" class="text-success">
                                            <?php

                                            $currentDuration = 0;
                                            $sponsorshipName = '';

                                            if ($apartment->sponsorship->sponsorship_id == 1) {
                                                $currentDuration = 24;
                                                $sponsorshipName = 'Bronze';
                                            }
                                            if ($apartment->sponsorship->sponsorship_id == 2) {
                                                $currentDuration = 72;
                                                $sponsorshipName = 'Silver';
                                            }
                                            if ($apartment->sponsorship->sponsorship_id == 3) {
                                                $currentDuration = 144;
                                                $sponsorshipName = 'Gold';
                                            }

                                            $now = \Carbon\Carbon::now();
                                            $expiresAt = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $apartment->sponsorship->created_at)->addHours($currentDuration);
                                            $remainingHours = $now->diffInHours($expiresAt);
                                            ?>
                                            <span class="text-lime">{{ $apartment['title'] }} (Sponsored - {{ $sponsorshipName }})</span> <br>
                                            <!-- Calcolo della durata rimanente della sponsorship -->
                                            <span class="text-warning">Sponsorship expires in {{ $remainingHours }} hours</span>
                                        </li>
                                        <hr>
                                    @endif
                                @else
                                    <li value="{{ $apartment['id'] }}">
                                        <a href="http://127.0.0.1:8000/admin/payments?id={{ $apartment->id }}&price={{ $sponsorship['price'] }}" class="text-decoration-none text-azure">
                                            {{ $apartment['title'] }} - Pick a sponsorship!
                                        </a>
                                    </li>
                                    <hr>
                                @endif

                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

