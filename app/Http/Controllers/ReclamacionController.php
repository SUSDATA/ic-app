<?php

namespace App\Http\Controllers;

use App\Models\Reclamacion;
use App\Models\Motivo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class ReclamacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $reclamaciones = Reclamacion::select('reclamaciones.id', 'code','segmento','operacion','motivo_id','motivos.nombre as motivo')
		->join('motivos','motivos.id','=','reclamaciones.motivo_id')->paginate(25);
		        
        //$reclamaciones = Reclamacion::paginate(2);
        //dd($reclamaciones->perPage());        
		$motivos = Motivo::all(); 
		//dd($motivos);
        return Inertia::render('Reclamaciones/Index',[
			'reclamaciones' => $reclamaciones,
			'motivos' => $motivos,
            'perPagePagination' => $reclamaciones->perPage()
		]);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
			'code' => 'required|max:100',
			'motivo_id' => 'required|numeric'
		]);
		$reclamacion = new Reclamacion($request->input());
		$reclamacion->save();
		return redirect('reclamaciones');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reclamacion $reclamacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reclamacion $reclamacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reclamacion $reclamacione)
    {
        $request->validate([
			'code' => 'required|max:100',
			'motivo_id' => 'required|numeric'
		]);
		$reclamacione->update($request->input());
		return redirect('reclamaciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamacion $reclamacione)
    {
        $reclamacione->delete();
		return redirect('reclamaciones');
    }
	
	/***** custom added functions *****/
	
	/**
     * .
     */
	public function reclamacionesPorusuario()
    {
        $data = Reclamacion::select(DB::raw('count(reclamaciones.id) as count, motivos.nombre'))
		->join('motivos','motivos.id','=','reclamaciones.motivo_id')
		->groupBy('motivos.nombre')->get();
        //dd($data);
        return Inertia::render('Reclamaciones/Graficas',['data' => $data]);		
    }
	
	/**
     * .
     */
	public function reportes()
    {
        $reclamaciones = Reclamacion::select('reclamaciones.id', 'code','segmento','operacion','motivo_id','motivos.nombre as motivo')
		->join('motivos','motivos.id','=','reclamaciones.motivo_id')->get();		
		
        $motivos = Motivo::all();
        //dd($reclamaciones);
		return Inertia::render('Reclamaciones/Reportes',[
			'reclamaciones' => $reclamaciones,
			'motivos' => $motivos
		]);
    }
	
}
