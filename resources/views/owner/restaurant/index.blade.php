@extends('layouts.app') @section('content')
<div class="container" id="restaurant-index">
    @if (session('deleted'))
    <div class="alert alert-success">{{ session("deleted") }}</div>
    @endif @if (session('unauthorized'))
    <div class="alert alert-danger">{{ session("unauthorized") }}</div>
    @endif

    <a href="{{ route('owner.restaurants.create') }}" class="btn btn-primary my-4">Aggiungi un ristorante</a
    >
    <div class="row cards-container py-4">
        @foreach ($restaurants as $restaurant)
        <div class="col-md-4 my-3">
            <div class="card" style="width: 18rem;">
                <div class="img-container">
                    <img
                        src="{{asset('storage/' . $restaurant->img_path)}}"
                        class="card-img-top"
                        alt="{{$restaurant->name}}"
                    />
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$restaurant->name}}</h5>
                    <ul class="card-text">
                        <li>
                            <a
                                href="{{
                                    route('owner.restaurants.show', $restaurant)
                                }}"
                                class="btn btn-primary"
                                >Visualizza il ristorante</a
                            >
                        </li>
                        <li>
                            <a
                                href="{{
                                    route('owner.restaurants.edit', $restaurant)
                                }}"
                                class="btn btn-warning"
                                >Modifica il ristorante</a
                            >
                        </li>
                        <li>
                            <form
                                action="{{
                                    route(
                                        'owner.restaurants.destroy',
                                        $restaurant
                                    )
                                }}"
                                method="POST"
                                onsubmit="return confirm('Sicuro di voler eliminare {{$restaurant->name}}?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Elimina
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection