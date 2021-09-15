@extends('layouts.app')

@section('content')
<div class="container py-4" id="dish-index">

  @if (session('created'))
    <div class="alert alert-success">{{ session('created') }}</div>
  @endif

  @if (session('updated'))
    <div class="alert alert-success">{{ session('updated') }}</div>
  @endif

  @if (session('deleted'))
    <div class="alert alert-success">{{ session('deleted') }}</div>
  @endif

  <h1>Menù</h1>
  <a href="{{route('owner.dish.create', $id)}}" class="btn btn-primary first-link mr-3">Aggiungi un piatto</a>
  <a href="{{ route('owner.restaurants.show', $id) }}" class="btn btn-secondary first-link">Torna al ristorante</a>

  @foreach ($categoriesAndDish as $category=>$dishes)
    <h3 class="mb-3 mt-1 text-center">
      <span>{{$category}}</span>
    </h3>
    <table class="table table-striped text-left mb-4">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Prezzo</th>
          <th scope="col" class="text-center">Vegetariano</th>
          <th scope="col" class="text-center">Vegano</th>
          <th scope="col" class="text-center">Solo a pranzo</th>
          <th scope="col" class="text-center">Solo a cena</th>
          <th scope="col" colspan="2">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dishes as $dish)
          <tr>
            <th scope="row">{{$dish->name}}</th>

            <td>
              @if (strlen($dish->desc)>15)
                {{substr($dish->desc, 0, 15)}} ...
              @else
                {{$dish->desc}}
              @endif
            </td>

            <td>{{number_format((float)$dish->price,2,',','')}} &euro;</td>

            <td class="text-center">
              @if ($dish->vegetarian)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>

            <td class="text-center">
              @if ($dish->vegan)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>

            <td class="text-center">
              @if ($dish->lunch_available)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>

            <td class="text-center">
              @if ($dish->dinner_available)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>

            <td> 
              <a href="{{ route('owner.dish.edit', $dish) }}">
                <i class="fas fa-edit"></i>
              </a> 
            </td>

            <td> 
              <form action="{{ route('owner.dish.destroy', $dish) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare {{ $dish->name }}?')">
                @csrf
                @method('DELETE')
                <button type="submit">
                  <a class="fas fa-trash-alt"></a>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
       
      </tbody>
    </table>
  @endforeach
</div>
@endsection
