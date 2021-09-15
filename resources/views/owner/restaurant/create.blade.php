@extends('layouts.app')

@section('content')
<div class="container py-5" id="restaurant_create">
    <h2 class="mb-4">Crea un ristorante</h2>
    <form enctype="multipart/form-data" method="POST" action="{{ route('owner.restaurants.store') }}">
        @csrf
        @method('POST')
        <div class="container">
            <div class="row">
                <section class="col-6">
                    <div class="form-group">
                        <label for="name">Nome del ristorante</label>
                        <input required type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del ristorante" value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Inserisci la mail del ristorante" value="{{ old('email') }}">
                        <div class="invalid-feedback">
                            @error('email') {{ $message }} @enderror
                        </div>
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="phone">Numero di telefono</label>
                        <input required type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Inserisci il numero di telefono del ristorante" value="{{ old('phone') }}">
                        <div class="invalid-feedback">
                            @error('phone') {{ $message }} @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <input required type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Inserisci l'indirizzo del ristorante" value="{{ old('address') }}">
                        <div class="invalid-feedback">
                            @error('address') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city">Città</label>
                        <input required type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città del ristorante" value="{{ old('city') }}">
                        <div class="invalid-feedback">
                            @error('city') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip_code">CAP</label>
                        <input required type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" placeholder="Inserisci il CAP del ristorante" value="{{ old('zip_code') }}">
                        <div class="invalid-feedback">
                            @error('zip_code') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="province">Provincia</label>
                        <input required type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" placeholder="Inserisci la provincia del ristorante" value="{{ old('province') }}">
                        <div class="invalid-feedback">
                            @error('province') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country">Stato (inserire solo se estero)</label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="Inserisci lo Stato del ristorante" value="{{ old('country') }}">
                        <div class="invalid-feedback">
                            @error('country') {{ $message }} @enderror
                        </div>
                    </div>
                    
                </section>
                <section class="col-6">

                    <label for="restaurant-type" class="d-block">Tipologie Ristorante (Max 4)</label>
                    <select required onchange="printBadge(this.value)" class="custom-select @error('restaurant-types') is-invalid @enderror" id="restaurant-type">
                        <option selected disabled>Seleziona la tipologia</option>
                        @foreach ($restaurantTypes as $type)
                            <option value="{{$type->name}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <div class="badge-container" id="badge-container">
                    </div>
                    <div class="invalid-feedback">
                        @error('restaurant-types') {{ $message }} @enderror
                    </div>

                    <div class="form-check mb-3 mt-4">
                        <input class="form-check-input @error('take_away') is-invalid @enderror" type="checkbox" id="take_away" {{ old('take_away') ? 'checked' : '' }} name="take_away">
                        <label class="form-check-label" for="take_away">
                            Possibilit&agrave; di ritiro dell'ordine presso il ristorante
                        </label>
                        <div class="invalid-feedback">
                            @error('take_away') {{ $message }} @enderror
                        </div>
                    </div>
            
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('free_delivery') is-invalid @enderror" type="checkbox" id="free_delivery" {{ old('free_delivery') ? 'checked' : '' }} name="free_delivery">
                        <label class="form-check-label" for="free_delivery">
                            Consegna gratuita
                        </label>
                        <div class="invalid-feedback">
                            @error('free_delivery') {{ $message }} @enderror
                        </div>
                    </div>
            
                    <div class="form-group mb-3">
                        <label class="d-block" for="img_path">Immagine ristorante</label>
                        <input required type="file" class="form-control-file @error('img_path') is-invalid @enderror" id="img_path" name="img_path" placeholder="Inserisci l'immagine del ristorante" value="{{ old('img_path') }}">
                        <div class="invalid-feedback">
                            @error('img_path') {{ $message }} @enderror
                        </div>
                        <div class="img_container mt-3">
                            <img src="{{asset('storage/restaurant_image/placeholder-image.png')}}" alt="img" id="edit-image">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="delivery_price">Spese di spedizione</label>
                        <input required type="number" max="100" step="0.01" class="form-control @error('delivery_price') is-invalid @enderror" id="delivery_price" name="delivery_price" placeholder="Inserisci il prezzo del delivery" value="{{ old('delivery_price') }}">
                        <div class="invalid-feedback">
                            @error('delivery_price') {{ $message }} @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success text-uppercase mt-3">Salva</button>
                </section>
            </div>
        </div>
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
        const select = document.getElementById('restaurant-type');
        const badgeContainer = document.getElementById('badge-container');
        var types = [];
        const printBadge = (selectedValue)=> {
            if (selectedValue != "" && !types.includes(selectedValue)){
                 if (types.length<4){
                    types.push(select.value);
                };  
                badgeContainer.innerHTML = "";
                types.forEach((type,index) => {
                    const inputContainer = document.createElement('span');
                    inputContainer.setAttribute('key', type);
                    inputContainer.setAttribute('onClick','deleteBadge(this)');
                    badgeContainer.appendChild(inputContainer);
                    const badge = document.createElement('span'); 
                    badge.classList.add('badge','badge-pill','badge-primary','mt-2','mr-2');  
                    const text = document.createTextNode(type);
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.value = type;
                    input.name = "restaurant-types[]";
                    badge.appendChild(text);
                    inputContainer.appendChild(badge);
                    inputContainer.appendChild(input);
                });
            }     
        }; 
        const deleteBadge = (span)=>{
            const index = types.indexOf(span.getAttribute('key'));
            if(index != -1){
                types.splice(index,1);
                printBadge('');
            }
            span.remove();
        }     
    </script>

</div>
@endsection
