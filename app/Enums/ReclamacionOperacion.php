<?php

namespace App\Enums;

enum ReclamacionOperacion: string
{
	case Fija = 'Fija';
    case Movil = 'Movil';

    public static function getAllValues(): Object
    {
        $segmentos = array (
          1 => array(
            'id'=> 'Fija',            
            'nombre_a_mostrar' => 'Fija',
          ),
          2 => array(
            'id' => 'Movil',            
            'nombre_a_mostrar' => 'Movil',
          )
        );
        
        /*
        foreach (ReclamacionSegmento::cases() as $item){             
                   
        }*/
        
        return collect($segmentos); 
        //return collect(ReclamacionSegmento::cases()); 
}


}

