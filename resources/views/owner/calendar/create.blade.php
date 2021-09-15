@extends('layouts.app')

@section('content')
<div class="container py-4" id="calendar-create">
    <h1>Pagina calendario</h1>
    <div class="row my-none">
        <div class="col-12">
            <form action="{{route('owner.calendar.store')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="restaurantId" value="{{$id}}">
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
                        @foreach ($weekDays as $day)
                        <tr>
                            <th scope="row">{{$day[0]}}</th>
                            <td>
                                <input type="time" name="{{$day[1]}}[]">
                            </td>
                            <td>
                                <input type="time" name="{{$day[1]}}[]">
                            </td>
                            <td>
                                <input type="time" name="{{$day[1]}}[]">
                            </td>
                            <td>
                                <input type="time" name="{{$day[1]}}[]">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-2">SALVA</button>
            </form>
        </div>
    </div>
    <div class="my-block text-center">
        <div>
            Per modificare il calendario ruotare il dispositivo.
        </div>
        <i class="fas fa-sync-alt"></i>
    </div>
</div>
@endsection
