<?php

namespace App\Enums;

enum ReclamacionSegmento: string
{
    case EmpresasGrandes = 'Empresas Grandes';
    case EmpresasEstrategicas = 'Empresas Estrategicas';
    case Negocios = 'Negocios';

    public static function getAllValues(): Object
    {
        $segmentos = array (
          1 => array(
            'id'=> 'Empresas Grandes',            
            'nombre_a_mostrar' => 'Empresas Grandes',
          ),
          2 => array(
            'id' => 'Empresas Estrategicas',            
            'nombre_a_mostrar' => 'Empresas Estrategicas',
          ),
          3 => array(
            'id' => 'Negocios',
            'nombre_a_mostrar' => 'Negocios',
          )
        );
        
        /*
        foreach (ReclamacionSegmento::cases() as $item){             
                   
        }*/
        
        return collect($segmentos); 
        //return collect(ReclamacionSegmento::cases()); 
}

}

