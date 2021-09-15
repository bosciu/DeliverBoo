@extends('layouts.app')

@section('content')
<div class="container py-4" id="dish_create">
    <h4>Pagina creazione piatto</h4>
    <form action="{{route('owner.dish.update',$dish)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="restaurant-type" class="d-block">Seleziona la categoria del piatto</label>
        <select required class="custom-select @error('dish_category_id') is-invalid @enderror mb-3" id="dish-category" name="dish_category_id">
            <option selected disabled>Seleziona la tipologia</option>

            @foreach ($dishCategories as $category)
                <option value="{{$category->id}}" {{ ($category->id == old('category_id', $dish->dish_category_id)) ? 'selected' : '' }}>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('dish_category_id') {{ $message }} @enderror
        </div>
    
        <div class="form-group">
            <label for="text">Inserisci il nome del piatto</label>
            <input required type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del piatto" value="{{ old('name',$dish->name) }}">
            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div>
        </div>
    
        <div class="form-group">
            <label for="desc">Inserisci la descrizione del piatto</label>
            <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Inserisci la descrizione del piatto">{{old('desc',$dish->desc)}}</textarea>
            <div class="invalid-feedback">
                @error('desc') {{ $message }} @enderror
            </div>
        </div>
    
        <div class="form-group">
            <label for="price">Prezzo</label>
            <input required type="number" max="100" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci il prezzo del piatto" value="{{ old('price',$dish->price) }}">
            <div class="invalid-feedback">
                @error('price') {{ $message }} @enderror
            </div>
        </div>
    
        <div class="form-group mb-3">
            <label class="d-block" for="img_path">Immagine piatto</label>
            <input  type="file" class="@error('img_path') is-invalid @enderror" id="img_path" name="img_path" placeholder="Inserisci l'immagine del ristorante" value="{{ old('img_path') }}">
            <div class="invalid-feedback">
                @error('img_path') {{ $message }} @enderror
            </div>
            <div class="img_container mt-3">
                <img src="{{ asset('storage/' .$dish->img_path) }}" alt="img" id="edit-image">
            </div>
        </div>

        <div class="form-group mb-3">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Vegetariano</th>
                    <th scope="col">Vegano</th>
                    <th scope="col">Disponibile solo a pranzo</th>
                    <th scope="col">Disponibile solo a cena</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td scope="row">
                        <input @error('vegetarian') is-invalid @enderror type="checkbox" id="vegetarian" {{ old('vegetarian',$dish->vegetarian) ? 'checked' : '' }} name="vegetarian">
                    </td>
                    <td>
                        <input @error('vegan') is-invalid @enderror type="checkbox" id="vegan" {{ old('vegan',$dish->vegan) ? 'checked' : '' }} name="vegan">
                    </td>
                    <td>
                        <input @error('lunch_available') is-invalid @enderror type="checkbox" id="lunch_available" {{ old('lunch_available',$dish->lunch_available) ? 'checked' : '' }} name="lunch_available">
                    </td>
                    <td>
                        <input @error('dinner_available') is-invalid @enderror type="checkbox" id="dinner_available" {{ old('dinner_available',$dish->dinner_available) ? 'checked' : '' }} name="dinner_available">
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="invalid-feedback">
                @error('vetegarian') {{ $message }} @enderror
            </div>
            <div class="invalid-feedback">
                @error('vegan') {{ $message }} @enderror
            </div>
            <div class="invalid-feedback">
                @error('lunch_available') {{ $message }} @enderror
            </div>
            <div class="invalid-feedback">
                @error('dinner_available') {{ $message }} @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success text-uppercase mt-3">Salva</button>
    </form>


    <script>
        const imgInp = document.getElementById('img_path');
        const editImage = document.getElementById('edit-image');
        imgInp.onchange = ()=>{
          const [image] = imgInp.files
          if (image) {
            editImage.src = URL.createObjectURL(image)
          }
        }         
    </script>
</div>
@endsection
