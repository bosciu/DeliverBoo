@extends('layouts.app')

@section('content')
<div class="container" id="dish-index">

  @if (session('created'))
    <div class="alert alert-success">{{ session('created') }}</div>
  @endif

  @if (session('updated'))
    <div class="alert alert-success">{{ session('updated') }}</div>
  @endif

  @if (session('deleted'))
    <div class="alert alert-success">{{ session('deleted') }}</div>
  @endif

  <h1>Index Menù</h1>
  <a href="{{route('owner.dish.create', $id)}}" class="btn btn-primary first-link">Aggiungi un piatto</a>

  @foreach ($categoriesAndDish as $category=>$dishes)
  <h3 class="mb-3 mt-5 text-center">{{$category}}</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Desc</th>
          <th scope="col">Prezzo</th>
          <th scope="col">Vegetariano</th>
          <th scope="col">Vegano</th>
          <th scope="col">Solo a pranzo</th>
          <th scope="col">Solo a cena</th>
          <th scope="col" colspan="2">Azione</th>
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
            <td>
              @if ($dish->vegetarian)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>
            <td>
              @if ($dish->vegan)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>
            <td>
              @if ($dish->lunch_available)
                <i class="fas fa-check"></i>
              @else
                <i class="fas fa-times"></i>
              @endif
            </td>
            <td>
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
