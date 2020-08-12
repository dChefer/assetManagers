<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Manufacturer;
use App\Models\Place;
use Illuminate\Http\Request;

class EquipmentController extends Controller
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
        $model = $request->input('model') ?: null;

        $equipments = Equipment::query()->when($model, function ($query, $model) {
            $query->where('model', 'like', "%$model%");
        })->paginate(3);

        return view('equipment.index', [
            'equipments' => $equipments
        ]);
    }


    public function form()
    {
        return view('equipment.form', [
            'places' => Place::all(),
            'manufacturers' => Manufacturer::all(),
            'categories' => Category::all(),
        ]);
    }


    public function formUpdate(Equipment $equipment)
    {
        $equipment->load('occurrences');

        return view('equipment.form', [
            'equipment' => $equipment,
            'places' => Place::all(),
            'manufacturers' => Manufacturer::all(),
            'categories' => Category::all(),
        ]);
    }


    public function store(Request $request)
    {
        $equipmentsData = $request->all();

        $equipment = Equipment::create($equipmentsData);

        return redirect()->route('equipment_form_update', [
            'equipment' => $equipment->id
        ]);
    }


    public function update(Request $request, Equipment $equipment)
    {
        $equipmentData = $request->post();

        $equipment->update($equipmentData);

        return redirect()->route('equipment_form_update', [
            'equipment' => $equipment->id
        ]);
    }

   
    public function delete(Equipment $equipment)
    {
        $equipment->delete();

        return response()->json([]);
    }
}
