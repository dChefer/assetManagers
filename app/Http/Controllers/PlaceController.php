<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $name = $request->input('name') ?: null;

        $places = Place::query()->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })->paginate(3);

        return view('places.index', [
            'places' => $places
        ]);
    }


    public function form()
    {
        return view('places.form');
    }


    public function formUpdate(Place $place)
    {
        return view('places.form', [
            'place' => $place
        ]);
    }


    public function store(Request $request)
    {
        $placesData = $request->all();

        Place::create($placesData);

        return redirect('place');
    }


    public function update(Request $request, Place $place)
    {
        $placesData = $request->post();

        $place->update($placesData);

        return redirect()->route('place', $request->query());
    }

    
    public function delete(Place $place)
    {
        $place->delete();

        return response()->json([]);
    }
}
