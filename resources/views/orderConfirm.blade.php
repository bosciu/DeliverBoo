@extends('layouts.app')

@section('content')

<div class="content px-3" id="checkout">
    @if (session('success_message'))
        <div class="alert alert-success">
          {{session('success_message')}}
        </div>
        <div class="text-center py-5">
          <h4 class="py-5">Pagamento completato con successo!</h4>
          <h5>Il tuo ordine arriverà tra {{rand(10,45)}} minuti.</h5>
          <a href="/" class="mt-2">Torna alla home!</a>
        </div>
    @elseif (session('error'))
      <div class="alert alert-error">
        {{session('success_message')}}
      </div>
    @else
      <div class="order-detail py-5">
        <h5 class="text-center">Riepilogo oridne</h5>
      </div>
      <div class="form-container pb-5">
        <form method="post" id="payment-form" action="{{url('/checkout')}}">
            @csrf
            @method('POST')
            <section>
                <label for="amount">
                    <div class="input-wrapper amount-wrapper">
                        <h3 class="text-center">Totale: € {{number_format((float)$amount, 2, ',', '')}}</h3>
                        <input id="amount" name="amount" type="hidden" value="{{$amount}}">
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-success w-100" type="submit"><span>Paga</span></button>
        </form>
      </div>
    </div>
    @endif
    <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";
            braintree.dropin.create({
              authorization: client_token,
              selector: '#bt-dropin',
              paypal: {
                flow: 'vault'
              },
/*               option : {
                  verifyCard : true
              } */
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
@endsection
