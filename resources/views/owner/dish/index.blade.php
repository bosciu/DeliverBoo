@extends('layouts.app')

@section('content')
<div class="container">

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
  <a href="{{route('owner.dish.create', $id)}}" class="btn btn-primary">Aggiungi un piatto</a>

  @foreach ($categoriesAndDish as $category=>$dishes)
  <h3 class="mb-2">{{$category}}</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Prezzo</th>
          <th scope="col" colspan="3">Azione</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dishes as $dish)
          <tr>
            <th scope="row">{{$dish->name}}</th>
            <td>{{number_format((float)$dish->price,2,',','')}} &euro;</td>
            <td> 
              <a href="{{ route('owner.dish.show', $dish) }}">
                <i class="fas fa-search"></i>
              </a> 
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
                  <i class="fas fa-trash-alt"></i>
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
