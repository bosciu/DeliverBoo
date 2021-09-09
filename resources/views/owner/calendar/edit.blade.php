@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Modifica il calendario</h1>
    <div class="container">
        <form action="{{route('owner.calendar.update', $calendar)}}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="restaurantId" value="{{ $restaurant->id }}">
            <h4>In caso di orario continuato compilare solo "Apertura mattina" e "Chiusura sera"</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Giorno</th>
                        <th scope="col">Apertura mattina</th>
                        <th scope="col">Chiusura mattina</th>
                        <th scope="col">Apertura sera</th>
                        <th scope="col">Chiusura sera</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weekDays as $key => $day)
                    <tr>
                        <th scope="row">{{$day[0]}}</th>
                        <td>
                            <input type="time" name="{{$day[1]}}[]" value="{{ $days[$key][0] }}">
                        </td>
                        <td>
                            <input type="time" name="{{$day[1]}}[]" value="{{ $days[$key][1] }}">
                        </td>
                        <td>
                            <input type="time" name="{{$day[1]}}[]" value="{{ $days[$key][2] }}">
                        </td>
                        <td>
                            <input type="time" name="{{$day[1]}}[]" value="{{ $days[$key][3] }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success text-uppercase mt-2">salva e torna al ristorante</button>
        </form>
        <form action="{{route('owner.calendar.destroy', $calendar)}}" method="POST" onsubmit="return confirm('Sicuro di voler cancellare il calendario?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Elimina il calendario</button>
        </form>
    </div>
</div>
@endsection
