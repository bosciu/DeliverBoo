@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('created'))
        <div class="alert alert-success">{{ session('created') }}</div>
    @endif

    @if (session('deleted'))
        <div class="alert alert-success">{{ session('deleted') }}</div>
    @endif

    @if (session('updated'))
        <div class="alert alert-success">{{ session('updated') }}</div>
    @endif

    <h1>Pagina show</h1>
    <div class="button-container d-flex flex-column align-items-start">
        @if ($restaurant->calendar_id)
            <a href="{{ route('owner.calendar.edit', $restaurant->calendar_id) }}" class="btn btn-info mb-3">Modifica gli orari del ristorante</a>
        @else
            <a href="{{ route('owner.calendar.create', $restaurant->id) }}" class="btn btn-info mb-3">Aggiungi gli orari del ristorante</a>
        @endif
        <a href="{{ route('owner.restaurants.edit', $restaurant->id) }}" class="btn btn-warning mb-3">Modifica il ristorante</a>
        <a href="{{ route('owner.dish.index', $restaurant->id) }}" class="btn btn-primary mb-3">Menù</a>
        <a href="{{ route('owner.restaurants.index') }}" class="btn btn-secondary mb-3">Torna all'elenco dei ristoranti</a>
    </div>
</div>
@endsection