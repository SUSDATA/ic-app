<?php

namespace App\Http\Controllers;

use App\Models\Red;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redes = Red::all();
        $test = "testString";
        //dd($);
        return Inertia::render('Redes/Index',[          
            'redes' => $redes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Redes/Create');
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
        $red = new Red($request->input());
        $red->save();
        return redirect('red');
    }

    /**
     * Display the specified resource.
     */
    public function show(Red $red)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Red $red)
    {
        $test = "testString";        
        return Inertia::render('Redes/Edit',[
            'red' => $red,
            'test' => $test
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Red $red)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'nombre_a_mostrar' => 'required|max:100'
        ]);
        $red->update($request->all());
        return redirect('red');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Red $red)
    {
        $red->delete();
        return redirect('red');
    }
}
