<?php

namespace App\Http\Controllers;

use App\Models\Motivo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {		
		$motivos = Motivo::all();        
		$test = "testString";
		//dd($motivos);
		return Inertia::render('Reclamaciones/Motivos/Index',[			
			'motivos' => $motivos
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Reclamaciones/Motivos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|max:100']);
		//dd("Test");
        $motivo = new Motivo($request->input());
		$motivo->save();
		return redirect('motivosReclamaciones');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motivo $motivosReclamacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motivo $motivosReclamacione)
    {
        $test = "testString";
        //dd($motivosReclamacione);
        return Inertia::render('Reclamaciones/Motivos/Edit',['motivo' => $motivosReclamacione,'test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motivo $motivosReclamacione)
    {                
        $request->validate(['nombre' => 'required|max:100']);
		$motivosReclamacione->update($request->all());
		return redirect('motivosReclamaciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motivo $motivosReclamacione)
    {
        $motivosReclamacione->delete();
		return redirect('motivosReclamaciones');
    }
}
