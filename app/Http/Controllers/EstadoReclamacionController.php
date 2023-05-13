<?php

namespace App\Http\Controllers;

use App\Models\EstadoReclamacion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EstadoReclamacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = EstadoReclamacion::all();
        $test = "testString";
        //dd($motivos);
        return Inertia::render('Reclamaciones/Estados/Index',[          
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Reclamaciones/Estados/Create');
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
        $estado = new EstadoReclamacion($request->input());
        $estado->save();
        return redirect('estadoReclamacion');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoReclamacion $estadoReclamacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoReclamacion $estadoReclamacion)
    {
        $test = "testString";        
        return Inertia::render('Reclamaciones/Estados/Edit',[
            'estado' => $estadoReclamacion,
            'test' => $test
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadoReclamacion $estadoReclamacion)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'nombre_a_mostrar' => 'required|max:100'
        ]);
        $estadoReclamacion->update($request->all());
        return redirect('estadoReclamacion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoReclamacion $estadoReclamacion)
    {
        $estadoReclamacion->delete();
        return redirect('estadoReclamacion');
    }
}
