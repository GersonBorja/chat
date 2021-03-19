<?php

require_once 'conexion.php';

class filtrar extends conexionDb {

    public function quitarComillas($string){
        $nueva = str_replace("'", "", $string);
        $nuevaDos = str_replace('"', '', $nueva);
        return $nuevaDos;
    }

    public function quitarHtml($string){
        $resultado = strip_tags($string);
        return $resultado;
    }
    
    public function quitarEspaciosDemas($string){
        $resultado = trim($string);
        return $resultado;
    }

    public function minusculas($string){
        $resultado = strtolower($string);
        return $resultado;
    }
    
    public function remplazar($search, $replace, $string){
        $resultado = str_replace($search, $replace, $string);
        return $resultado;
    }
    
    public function encriptarString($string){
        $opciones = [
            'cost' => 10
        ];
        $resultado = password_hash($string, PASSWORD_BCRYPT, $opciones);
        return $resultado;
    }
    
}
?>