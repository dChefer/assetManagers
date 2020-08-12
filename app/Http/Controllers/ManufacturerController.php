<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
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

        $manufacturers = Manufacturer::query()->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })->paginate(3);

        return view('manufacturers.index', [
            'manufacturers' => $manufacturers
        ]);
    }


    public function form()
    {
        return view('manufacturers.form');
    }


    public function formUpdate(Manufacturer $manufacturer)
    {
        return view('manufacturers.form', [
            'manufacturer' => $manufacturer
        ]);
    }


    public function store(Request $request)
    {
        $manufacturesData = $request->all();

        Manufacturer::create($manufacturesData);

        return redirect('manufacturer');
    }


    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturesData = $request->post();

        $manufacturer->update($manufacturesData);

        return redirect()->route('manufacturer', $request->query());
    }

    
    public function delete(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json([]);
    }
}
