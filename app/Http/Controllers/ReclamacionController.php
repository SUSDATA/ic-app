<?php

namespace App\Http\Controllers;

use App\Models\Reclamacion;
use App\Models\Motivo;
use App\Models\Servicio;
use App\Models\Red;
use App\Enums\ReclamacionSegmento;
use App\Enums\ReclamacionOperacion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
use Auth;

class ReclamacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        //dd($request->all());

        /*$reclamaciones = Reclamacion::select(
            'reclamaciones.id as reclamacion_id', 
            'code',
            'segmento',
            'operacion',
            'motivo_id',
            'motivos.nombre_a_mostrar as motivo'
        )
        ->join('motivos','motivos.id','=','reclamaciones.motivo_id')->get();

        return Inertia::render('Reclamaciones/IndexDatatable',[
            'reclamaciones' => $reclamaciones
        ]);
        */
        
        
        $reclamaciones = Reclamacion::select('reclamaciones.id', 'code','segmento','operacion','motivo_id','motivos.nombre_a_mostrar as motivo')
		->join('motivos','motivos.id','=','reclamaciones.motivo_id')->paginate(20);	

        //$reclamaciones = Reclamacion::paginate(2);
        $motivos = Motivo::all(); 		

        //dd($reclamaciones);
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

        $motivos = Motivo::all();
        $servicios = Servicio::all();
        $redes = Red::all();
        $segmentos = ReclamacionSegmento::getAllValues();        
        $operaciones = ReclamacionOperacion::getAllValues();
        
        return Inertia::render('Reclamaciones/Create',[            
            'motivos' => $motivos,
            'servicios' => $servicios,
            'redes' => $redes,
            'segmentos' => $segmentos,
            'operaciones' => $operaciones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {                      
        $request->validate([			
            'segmento' => 'required',
            'operacion' => 'required',
			'motivo_id' => 'required|numeric',
            'servicio_id' => 'required|numeric',
            'red_id' => 'required|numeric'
		]);

        $input = $request->all();   
        $input['code'] = uniqid();
        $input['comercial_id'] = Auth::id();
        //dd($input);
		$reclamacion = new Reclamacion($input);
	
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
        //dd($request->all());
        $request->validate([			
            'segmento' => 'required',
            'operacion' => 'required',
			'motivo_id' => 'required|numeric',            
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
    public function createMasiva()
    {
        
        return Inertia::render('Reclamaciones/CreateMasiva');     
    }

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
