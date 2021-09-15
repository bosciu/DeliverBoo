@extends('layouts.app')

@section('content')
    <div class="container text-center py-4 homepage">
        <div class="text-container">
            <h2 class="mb-4">Benvenuto, {{ Auth::user()->name }}</h2>
    
            <a class="btn btn-primary" href="{{ route('owner.restaurants.index') }}">Visualizza i miei ristoranti</a>
            <a class="btn btn-primary " href="{{ route('owner.order.index') }}">Visualizza storico ordini</a>
        </div>

    </div>
@endsection
