@extends('layouts.app')

@section('content')
    @if (session('success_message'))
        <div class="alert alert-success">
          {{session('success_message')}}
        </div>
        <div class="text-center">
          <h4 >Pagamento completato con successo!</h4>
          <h5>Il tuo ordine arriverà tra $$generatopre minuti$$ minuti.</h5>
          <a href="/">Torna alla home!</a>
        </div>
    @else
    <div class="content py-4" id="checkout">
      <div class="order-detail">
        <h5 class="text-center">Riepilogo oridne</h5>
      </div>
      <div class="form-container">
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
            <button class="btn btn-success" type="submit"><span>Paga</span></button>
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
