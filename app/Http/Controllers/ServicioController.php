<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        $test = "testString";
        //dd($);
        return Inertia::render('Servicios/Index',[          
            'servicios' => $servicios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Servicios/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required|max:100',
            'nombre_a_mostrar' => 'required|max:100'
        ]);
        //dd("Test");
        $servicio = new Servicio($request->input());
        $servicio->save();
        return redirect('servicio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        $test = "testString";        
        return Inertia::render('Servicios/Edit',[
            'servicio' => $servicio,
            'test' => $test
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'nombre_a_mostrar' => 'required|max:100'
        ]);
        $servicio->update($request->all());
        return redirect('servicio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect('servicio');
    }
}
