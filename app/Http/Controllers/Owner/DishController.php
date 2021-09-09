<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\DishCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    private $validationArray = [
        'dish_category_id' => 'required|exists:dish_categories,id',
        'restaurant_id' => 'exists:restaurants,id',
        'name' => 'required|string|max:100',
        'desc' => 'required|string',
        'price' => 'required|numeric|max:99',
        'img_path.*' => 'image|max:10240',
        'vegetarian' => 'boolean',
        'vegan' => 'boolean',
        'lunch_available' => 'boolean',
        'dinner_available' => 'boolean',

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userId = Auth::id();
        $restaurant = Restaurant::where('id', $id)->firstOrFail();

        if($userId === $restaurant->user_id) {
            $dishes = Dish::where('restaurant_id', $id)->orderBy('updated_at', 'DESC')->get();

            $categoriesId = [];
            $categories = [];
            $categoriesAndDish = [];
           
            foreach($dishes as $dish) {
                if(!in_array($dish->dish_category_id,$categoriesId)) {
                    $categoriesId[]=$dish->dish_category_id;
                    $categories[$dish->dishCategory->name]=$dish->dishCategory;

                    foreach($categories as $name=>$category) {
                        $categoriesAndDish[$name] = Dish::where('dish_category_id',$category->id)->where('restaurant_id',$id)->get();
                    }
                }
            }

            return view('owner.dish.index', compact('id','categoriesAndDish'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a visualizzare il menù di questo ristorante.");
        }
    }

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
            $dishCategories = DishCategory::all();
            return view('owner.dish.create', compact('dishCategories', 'id'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato ad aggiungere piatti per questo ristorante.");
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
        /* Trasformo on in bool */
        if(array_key_exists('vegetarian',$request->all())){
            if($request->vegetarian === "on"){
                $request->merge(['vegetarian' => true]);
            }
        }
        
        if(array_key_exists('vegan',$request->all())){
            if($request->vegan === "on"){
                $request->merge(['vegan' => true]);
            }
        }

        if(array_key_exists('lunch_available',$request->all())){
            if($request->lunch_available === "on"){
                $request->merge(['lunch_available' => true]);
            }
        }

        if(array_key_exists('dinner_available',$request->all())){
            if($request->dinner_available === "on"){
                $request->merge(['dinner_available' => true]);
            }
        }

        $request->validate($this->validationArray);
        $data = $request->all();

        if(array_key_exists('img_path', $data)){
            $data['img_path'] = Storage::put('dish_image', $data['img_path']);
        }

        $newDish = new Dish();
        $newDish->fill($data);
        $newDish->save();

        return redirect()->route('owner.dish.index', $data['restaurant_id'])->with('created', 'Piatto aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $userId = Auth::id();

        if($userId === $dish->restaurant->user_id) {
            return view('owner.dish.show',compact('dish'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a visualizzare i piatti per questo ristorante.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $userId = Auth::id();

        if($userId === $dish->restaurant->user_id) {
            $dishCategories = DishCategory::all();

            return view('owner.dish.edit',compact('dish','dishCategories'));
        } else {
            return redirect()->route('owner.restaurants.index')->with('unauthorized', "Non sei autorizzato a modificare i piatti per questo ristorante.");
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        if(array_key_exists('vegetarian',$request->all())){
            if($request->vegetarian === "on"){
                $request->merge(['vegetarian' => true]);
            }
        }else{
            $request->merge(['vegetarian' => false]);
        }
        
        if(array_key_exists('vegan',$request->all())){
            if($request->vegan === "on"){
                $request->merge(['vegan' => true]);
            }
        }else{
            $request->merge(['vegan' => false]);
        }

        if(array_key_exists('lunch_available',$request->all())){
            if($request->lunch_available === "on"){
                $request->merge(['lunch_available' => true]);
            }
        }else{
            $request->merge(['lunch_available' => false]);
        }

        if(array_key_exists('dinner_available',$request->all())){
            if($request->dinner_available === "on"){
                $request->merge(['dinner_available' => true]);
            }
        }else{
            $request->merge(['dinner_available' => false]);
        }

        $request->validate($this->validationArray);
        $data = $request->all();


        if(array_key_exists('img_path', $data)){
            Storage::delete($dish->img_path);
            $data['img_path'] = Storage::put('dish_image', $data['img_path']);
        }

        $dish->update($data);

        return redirect()->route('owner.dish.index', $dish->restaurant_id)->with('updated', "$dish->name modificato con successo");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        Storage::delete($dish->img_path);

        $restaurant_id=$dish->restaurant_id;

        $dish->delete();

        return redirect()
        ->route('owner.dish.index',$restaurant_id)
        ->with('deleted', "$dish->name eliminato con successo.");
    }
}
