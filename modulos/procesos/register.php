<?php

require_once '../crud.php';
require_once '../filtrarString.php';

$filtro = new filtrar();
$peticionesCrud = new miCrud();

$usuario = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($_POST["usuario"])));
$correo = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($_POST["correo"])));
$pass = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($_POST["pass"])));
$genero = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($filtro->minusculas($_POST["genero"]))));
$res = ["status" => "error", "msg" => ""];
#Validar que ningun campo  este vacio
if(empty($usuario) || empty($correo) || empty($pass) || empty($genero)){
    $res["msg"] = "Completa todos los campos";
    echo json_encode($res);
}else{
    # Validar si el correo y usuario ya existen
    $sql = "SELECT nombre, correo FROM usuarios WHERE nombre = '$usuario' OR correo = '$correo'";
    if($peticionesCrud->validarExistencia($sql) === 1){
        $res["msg"] = "Este correo y nombre de usuario ya estan registrados";
        echo json_encode($res);
    }elseif(strlen($pass) < 8){
            $res["msg"] = "Por seguridad escribe una contraseña mayor a 8 caracteres";
            echo json_encode($res);
    }else{
        #Ya filtrado los campos, guardar los datos
        #encriptar clave
        $passEncrypt = $filtro->encriptarString($pass);
        $sqlGuardar = "INSERT INTO usuarios (nombre, correo, pass, sexo) VALUES ('$usuario', '$correo', '$passEncrypt', '$genero')";
        echo $peticionesCrud->insertar($sqlGuardar, "Registro terminado");
    }
}

?>