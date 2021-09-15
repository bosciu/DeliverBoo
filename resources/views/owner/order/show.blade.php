@extends('layouts.app')

@section('content')
    <div class="container py-4" id="order-show">
        <h2 class="text-center mt-3 mb-5">Riepilogo ordine</h2>
        <div class="row">
            <div class="col-6">
                <h4>Informazioni utente</h4>
                <ul>
                    <li>
                        Nome: {{$order->name}}
                    </li>
                    <li>
                        Cognome: {{$order->surname}}
                    </li>
                    <li>
                        Indirizzo: {{$order->address->address}}
                    </li>
                    <li>
                        Comune: {{$order->address->city}}
                    </li>
                    <li>
                        Codice postale: {{$order->address->zip_code}}
                    </li>
                    <li>
                        Provincia: {{$order->address->province}}
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <h4>Informazioni ordine</h4>
                <ul>
                    @foreach ($order->orderedDishes as $orderedDish)
                    <li>
                       Nome piatto: {{$orderedDish->dish->name}}, € {{number_format((float)$orderedDish->dish->price,2,',','')}} cad.1 x {{$orderedDish->quantity}}
                    </li>
                    @endforeach
                    <li>
                        Spese di spedizione: € {{number_format((float)$order->restaurant->delivery_price,2,',','')}}
                    </li>
                    <li>
                        Sistema di pagamento: {{$order->payment_provider}}
                    </li>
                    <li>
                        Totale ordine: € {{number_format((float)$order->total,2,',','')}}
                    </li>
                </ul>
            </div>
        </div>
        <a href="{{route('owner.order.index')}}" class="btn btn-secondary mt-4">Torna indietro</a>
    </div>
@endsection
