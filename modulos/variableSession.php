<?php
session_start();

class conectado {

    function __construct(){
        if(isset($_SESSION["id"])){
            $this->id = $_SESSION["id"];
            $this->nombre = $_SESSION["nombre"];
            $this->correo = $_SESSION["correo"];
            $this->sexo = $_SESSION["sexo"];
        }
    }

    public function estado(){
        if(isset($this->id)){
            return true;
        }
    }
    public function desconectado(){
        header("Location: index.html");
    }

}

?>