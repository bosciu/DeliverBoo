<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Str;
use App\RestaurantType;
use Illuminate\Support\Facades\Storage;
use App\Address;
use App\User;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    private $validationArray = [
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:60',
        'phone' => 'required|string|max:15',
        'take_away' => 'boolean',
        'free_delivery' => 'boolean',
        'delivery_price' => 'required|numeric|max:99',
        'img_path' => 'image|mimes:jpeg,jpg,png,gif,svg,webp|max:10240',
        'address' => 'required|string|max:100',
        'city' => 'required|string|max:60',
        'zip_code' => 'required|string|max:5',
        'province' => 'required|string|max:2',
        'country' => 'max:70',
        'restaurant-types' => 'array|required|min:1|max:4',
        'restaurant-types.*' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $restaurants = Restaurant::where('user_id',$id)->get();
        return view('owner.restaurant.index',compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurantTypes = RestaurantType::all();
        return view('owner.restaurant.create',compact('restaurantTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(array_key_exists('take_away',$request->all())){
            if($request->take_away === "on"){
                $request->merge(['take_away' => true]);
            }
        }
        
        if(array_key_exists('free_delivery',$request->all())){
            if($request->free_delivery === "on"){
                $request->merge(['free_delivery' => true]);
            }
        }

        $data = $request->all();

        $restaurantTypes = array();

        if(array_key_exists('restaurant-types', $data)){
            foreach ($data['restaurant-types'] as $value) {
                $restaurantType = RestaurantType::where('name',$value)->firstOrFail();
                $restaurantTypes[] = $restaurantType->id;
            }
        }
    

        $request->validate($this->validationArray);

        $data['slug'] = Str::of($data['name'])->slug();

        if(array_key_exists('img_path', $data)){
            $data['img_path'] = Storage::put('restaurant_image', $data['img_path']);
        }

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $newRestaurant->user_id = Auth::id();

        $newAddress = new Address();
        $newAddress->address = $data['address'];
        $newAddress->city = $data['city'];
        $newAddress->zip_code = $data['zip_code'];
        $newAddress->province = $data['province'];
        $newAddress->country = $data['country'];
        $newAddress->save();
        $newRestaurant->address_id = $newAddress->id;
        $newRestaurant->save();
        
        if(array_key_exists('restaurant-types',$data)){
            $newRestaurant->restaurantTypes()->attach($restaurantTypes);
        }
        return redirect()->route('owner.restaurants.show', $newRestaurant)->with('created', "Il ristorante $newRestaurant->name è stato creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $userId = Auth::id();

        if($userId === $restaurant->user_id) {
            return view('owner.restaurant.show', compact('restaurant'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a visualizzare il ristorante.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $userId = Auth::id();

        if($userId === $restaurant->user_id) {
            $restaurantTypes = RestaurantType::all();
            $img_path = $restaurant->img_path;

            return view('owner.restaurant.edit', compact('restaurant', 'restaurantTypes', 'img_path'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a modificare il ristorante");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant, User $user)
    {

        if(array_key_exists('take_away',$request->all())){
            if($request->take_away === "on"){
                $request->merge(['take_away' => true]);
            }
        }else{
            $request->merge(['take_away' => false]);
        }
        
        if(array_key_exists('free_delivery',$request->all())){
            if($request->free_delivery === "on"){
                $request->merge(['free_delivery' => true]);
            }
        }else{
            $request->merge(['free_delivery' => false]);
        }

        $data = $request->all();

        $restaurantTypes = array();

        if (array_key_exists('restaurant-types', $data)) {
            foreach ($data['restaurant-types'] as $value) {
                $restaurantType = RestaurantType::where('name', $value)->firstOrFail();
                $restaurantTypes[] = $restaurantType->id;
            }
        }

        $request->validate($this->validationArray);

        $data['slug'] = Str::of($data['name'])->slug();

        if(array_key_exists('img_path', $data)){
            Storage::delete($restaurant->img_path);
            $data['img_path'] = Storage::put('restaurant_image', $data['img_path']);
        }

        $address = $restaurant->address;
        
        if(array_key_exists('restaurant-types',$data)){
            $restaurant->restaurantTypes()->sync($restaurantTypes);
        }

        $address->update($data);
        $restaurant->update($data);

        return redirect()
        ->route('owner.restaurants.show', $restaurant->id)
        ->with('updated', "Il ristorante $restaurant->name è stato modificato con successo");       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        Storage::delete($restaurant->img_path);

        $address = $restaurant->address;
        $address->delete();

        if($restaurant->calendar_id) {
            $calendar = $restaurant->calendar;
            $calendar->delete();
        }

        $restaurant->delete();

        return redirect()
        ->route('owner.restaurants.index')
        ->with('deleted', "$restaurant->name eliminato con successo.");

    }
}
