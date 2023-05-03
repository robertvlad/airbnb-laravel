<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sponsorships</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('BoolBnB', 'BoolBnB') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>
<body>
    
    <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center mt-5 w-100">
            @if (session('success_message'))
              <div class="alert alert-success w-50">
                  {{ session('success_message') }}
              </div>
            @endif
            @if (count($errors) > 0 )
              <div class="alert alert-danger w-50">
                <ul>
                  @foreach ($errors as $error)
                      <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center mt-3">
            <div class="card shadow-lg w-50 p-5">
              <img class="card-img-top w-50 align-self-center" src="/img/BOOLBNB-removebg-ok.png" alt="logo_bnb">
              <form method="post" id="payment-form" action="{{ url('/admin/checkout') }}">
                @csrf
                  <section class="mt-3">
                      <input type="hidden" name="apartment_id" value="@php $apartment_id = request()->input('id'); echo $apartment_id; @endphp">
                      <input type="hidden" name="price" value="@php $price_id = request()->input('price'); echo $price_id; @endphp">
                      <label for="amount">
                          <span class="input-label">Amount</span>
                          <div class="input-wrapper amount-wrapper">
                              <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="@php $price = request()->input('price'); echo $price; @endphp" disabled>
                          </div>
                      </label>

                      <div class="bt-drop-in-wrapper my-5">
                          <div id="bt-dropin"></div>
                      </div>
                  </section>
                  <input id="nonce" name="payment_method_nonce" type="hidden" />
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit"><span>Pay Now</span></button>
                    <a href="{{ route('admin.sponsorships.index') }}" class="btn btn-secondary">Back to List</a>
                  </div>
              </form>

            </div>
          </div>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.36.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
</body>
</html>
