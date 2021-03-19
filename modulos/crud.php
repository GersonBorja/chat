<?php

require_once 'conexion.php';

class miCrud extends conexionDb {
    
    public function ver($sql){
        $consulta = parent::conexion()->query($sql);
        $res = $consulta->fetch_all(MYSQLI_ASSOC);
        return $res;
    }

    public function validarExistencia($sql){
        $consulta = parent::conexion()->query($sql);
        $res = $consulta->num_rows;
        return $res;
    }

    public function insertar($sql, $msg){
        $consulta = parent::conexion()->query($sql);
        $res = [];
        if($consulta){
            $res["status"] = "ok";
            $res["mensaje"] = $msg;
            return json_encode($res);
        }else{
            $res["status"] = "error";
            $res["mensaje"] = "error al agregar";
            return json_encode($res);
        }
    }
}

?>