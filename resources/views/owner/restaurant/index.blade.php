@extends('layouts.app')

@section('content')
<div class="container">

  @if (session('deleted'))
    <div class="alert alert-success">{{ session('deleted') }}</div>
  @endif

  @if (session('unauthorized'))
    <div class="alert alert-danger">{{ session('unauthorized') }}</div>
  @endif

  <a href="{{ route('owner.restaurants.create') }}" class="btn btn-primary mb-4">Aggiungi un ristorante</a>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nome del ristorante</th>
        <th scope="col">Apri</th>
        <th scope="col">Modifica</th>
        <th scope="col">Elimina</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($restaurants as $restaurant)
        <tr>
          <td>{{ $restaurant->name }}</td>
          <td> 
            <a href="{{ route('owner.restaurants.show', $restaurant) }}">
              <i class="fas fa-search"></i>
            </a> 
          </td>
          <td> 
            <a href="{{ route('owner.restaurants.edit', $restaurant) }}">
              <i class="fas fa-edit"></i>
            </a> 
          </td>
          <td> 
            <form action="{{ route('owner.restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare {{ $restaurant->name }}?')">
              @csrf
              @method('DELETE')
              <button type="submit">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
