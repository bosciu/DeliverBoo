<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar;
use App\Restaurant;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $userId = Auth::id();
        $restaurant = Restaurant::where('id', $id)->firstOrFail();

        if($userId === $restaurant->user_id) {
            $weekDays = config('weekDays');
            return view('owner.calendar.create', compact('id', 'weekDays'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato ad aggiungere il calendario del ristorante.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $restaurant = Restaurant::where('id', $data['restaurantId'])->firstOrFail();
        foreach ($data as $key=>$day) {
            if($key != '_token' && $key != '_method' && $key != 'restaurantId'){
                if($day[0] == null && $day[1] == null && $day[2] == null && $day[3] == null){
                    $data[$key] = null;
                }else {
                    if ($day[2] != null && $day[3] != null) {
                        $data[$key] = $day[2]. '-' . $day[3];
                    }
                    if ($day[1] == null && $day[2] == null) {
                        $data[$key] = $day[0]. '-' . $day[3];
                    }
                    if ($day[0] != null && $day[1] != null) {
                        $data[$key] = $day[0]. '-' . $day[1];
                    }
                    if ($day[0] != null && $day[1] != null && $day[2] != null && $day[3] != null) {
                        $data[$key] = $data[$key] . ' - ' .  $day[2]. '-' . $day[3];
                    }
                    if ($day[0] == null && $day[1] == null && $day[2] == null && $day[3] == null) {
                        $data[$key] = 'Chiuso';
                    }
                }
            }
        }

        $newCalendar = new Calendar();
        $newCalendar->fill($data);
        $newCalendar->save();
        $restaurant->calendar_id = $newCalendar->id;
        $restaurant->save();

        return redirect()->route('owner.restaurants.show', $restaurant)->with('Calendario aggiunto con successo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        $userId = Auth::id();

        if($userId === $calendar->restaurant->user_id) {

            foreach ($calendar->getAttributes() as $key => $value) {

                if ($key != 'id' && $key != 'created_at' && $key != 'updated_at') {                
                    $orari = array();
                    /* Gestione dell'orario continuato */
                    if(Str::startsWith($value, '$$')){
                        $orarioEsploso = explode('$$', $value);
                        $orariSingoli = explode('-', $orarioEsploso[1]);
                        $orari[0] = isset($orariSingoli[0]) ? $orariSingoli[0] : null;
                        $orari[1] = null;
                        $orari[2] = null;
                        $orari[3] = isset($orariSingoli[1]) ? $orariSingoli[1] : null;
                        $days[$key] = $orari;
                    }
                    /* Gestione dell'orario pomeridiano */
                    elseif(Str::startsWith($value, '||')){
                        $orarioEsploso = explode('||', $value);
                        $orariSingoli = explode('-', $orarioEsploso[1]);
                        $orari[0] = null;
                        $orari[1] = null;
                        $orari[2] = isset($orariSingoli[0]) ? $orariSingoli[0] : null;
                        $orari[3] = isset($orariSingoli[1]) ? $orariSingoli[1] : null;
                        $days[$key] = $orari;
                    }
                    /* Gestione dell'orario completo */
                    elseif(Str::contains($value, '//')){
                        $orarioEsploso = explode('//', $value);
                        $orariSingoliMattina = explode('-', $orarioEsploso[0]);
                        $orariSingoliPomeriggio = explode('-', $orarioEsploso[1]);
                        $orari[0] = isset($orariSingoliMattina[0]) ? $orariSingoliMattina[0] : null;
                        $orari[1] = isset($orariSingoliMattina[1]) ? $orariSingoliMattina[1] : null;
                        $orari[2] = isset($orariSingoliPomeriggio[0]) ? $orariSingoliPomeriggio[0] : null;
                        $orari[3] = isset($orariSingoliPomeriggio[1]) ? $orariSingoliPomeriggio[1] : null;
                        $days[$key] = $orari;
                    }
                    /* Gestione orari mattina */
                    else{
                        $orariSingoli = explode('-', $value);
                        $orari[0] = isset($orariSingoli[0]) ? $orariSingoli[0] : null;
                        $orari[1] = isset($orariSingoli[1]) ? $orariSingoli[1] : null;
                        $orari[2] = null;
                        $orari[3] = null;
                        $days[$key] = $orari;
                    }
                }
            }

            $weekDays = config('weekDays');
            $restaurant = $calendar->restaurant;

            return view('owner.calendar.edit', compact('calendar', 'weekDays', 'restaurant', 'days'));
        }  else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a modificare il calendario del ristorante.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar, Restaurant $restaurant)
    {

        $data = $request->all();
        
        $restaurant = Restaurant::where('id', $data['restaurantId'])->firstOrFail();
        foreach ($data as $key=>$day) {
            if($key != '_token' && $key != '_method' && $key != 'restaurantId'){
                if($day[0] == null && $day[1] == null && $day[2] == null && $day[3] == null){
                    $data[$key] = "";
                }else {
                    if ($day[2] != null && $day[3] != null) {
                        $data[$key] = '||' . $day[2]. '-' . $day[3];
                    }
                    if ($day[1] == null && $day[2] == null) {
                        $data[$key] = '$$' . $day[0]. '-' . $day[3] . '$$';
                    }
                    if ($day[0] != null && $day[1] != null) {
                        $data[$key] = $day[0]. '-' . $day[1];
                    }
                    if ($day[0] != null && $day[1] != null && $day[2] != null && $day[3] != null) {
                        $data[$key] = $data[$key] . '//' .  $day[2]. '-' . $day[3];
                    }
                }
            }
        }

        $calendar->update($data);

        return redirect()->route('owner.restaurants.show', $restaurant)->with('Calendario modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $restaurant = $calendar->restaurant;
        $calendar->delete();

        return redirect()
        ->route('owner.restaurants.show', $restaurant)
        ->with('deleted', "Calendario eliminato con successo.");
    }
}
