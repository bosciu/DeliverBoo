@extends('layouts.app')

@section('content')
    <div id="restaurant-show" class="container py-3">
        @if (session('created'))
            <div class="alert alert-success">{{ session('created') }}</div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-success">{{ session('deleted') }}</div>
        @endif

        @if (session('updated'))
            <div class="alert alert-success">{{ session('updated') }}</div>
        @endif

        <h1>{{ $restaurant->name }}</h1>

        {{-- button container top --}}
        <div class="button-container mt-3 mb-5">

            <a href="{{ route('owner.restaurants.edit', $restaurant->id) }}" class="btn btn-warning mr-3">Modifica il ristorante</a>

            @if ($restaurant->calendar_id)
                <a href="{{ route('owner.calendar.edit', $restaurant->calendar_id) }}" class="btn btn-info mr-3">Visualizza e modifica gli orari del ristorante</a>
            @else
                <a href="{{ route('owner.calendar.create', $restaurant->id) }}" class="btn btn-info mr-3">Aggiungi gli orari del ristorante</a>
            @endif

            <a href="{{ route('owner.dish.index', $restaurant->id) }}" class="btn btn-primary mr-3">Vai al menù</a>
        </div>
        {{-- /button container top --}}

        <section class="details row mb-2">

            {{-- restaurant details --}}
            <div class="col-md-6">
                <ul class="mb-4">
                    <li>
                        <h4>
                            <i class="fas fa-envelope"></i>
                            Mail: {{ $restaurant->email }}
                        </h4>
                    </li>
    
                    <li>
                        <h4>
                            <i class="fas fa-phone"></i>
                            Telefono: {{ $restaurant->phone }}
                        </h4>
                    </li>
    
                    <li>
                        <h4>
                            <i class="fas fa-utensils"></i>
                            Ritiro presso il ristorante: 
                            @if ($restaurant->take_away == 0)
                                <span>
                                    No
                                </span>
                            @else
                                <span>
                                    S&igrave;
                                </span>
                            @endif
                        </h4>
                    </li>
    
                    <li>
                        <h4>
                            <i class="fas fa-truck"></i>
                            Spedizione gratuita: 
                            @if ($restaurant->free_delivery == 0)
                                <span>
                                    No
                                </span>
                            @else
                                <span>
                                    S&igrave;
                                </span>
                            @endif
                        </h4>
                    </li>
    
                    <li >
                        <h4>
                            <i class="fas fa-dollar-sign"></i>
                             Spese di spedizione: {{ $restaurant->delivery_price }} &euro;
                        </h4>
                    </li>
                </ul>
            </div>
            {{-- /restaurant details --}}
            <div class="col-md-6">
                {{-- restaurant image --}}
                <div class="restaurant-image">
                    <img src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->name }} immagine">
                </div>
                {{-- /restaurant image --}}
            </div>

        </section>

        {{-- button container bottom --}}
        <div class="button-container my-4">
            <a href="{{ route('owner.restaurants.index') }}" class="btn btn-secondary mb-3">Torna ai ristoranti</a>
        </div>
        {{-- /button container bottom --}}

    </div>
@endsection