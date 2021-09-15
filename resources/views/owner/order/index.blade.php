@extends('layouts.app')

@section('content')
    <div class="container text-center py-4" id="orders-index">
        <h1>Pagina ordini</h1>
        <table class="table">
            <thead>
              <tr>
                  <th scope="col">Ristorante</th>
                <th scope="col">Data</th>
                <th scope="col">Stato pagamento</th>
                <th scope="col">Totale</th>
                <th scope="col">Apri</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $restaurant=>$value)
                    @foreach ($value as $index=>$order)  
                    <tr>
                        <td>{{$restaurant}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @if ($order->payment_status == 0)
                            <i class="fas fa-times"></i>
                            @else    
                            <i class="fas fa-check"></i>
                            @endif
                        </td>
                        <td>
                            € {{number_format((float)$order->total,2,',','')}}
                        </td>
                        <td>
                            <a href="{{route('owner.order.show', $order)}}" class="btn btn-primary">Apri</a>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
