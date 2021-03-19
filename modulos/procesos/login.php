<?php
session_start();
require_once '../crud.php';
require_once '../filtrarString.php';

$filtro = new filtrar();
$peticionesCrud = new miCrud();

$usuario = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($_POST["usuario"])));
$pass = $filtro->quitarComillas($filtro->quitarHtml($filtro->quitarEspaciosDemas($_POST["pass"])));
$res = ["status" => "error", "msg" => ""];

#Validar que no mande campos vacios
if(empty($usuario) || empty($pass)){
    $res["msg"] = "Completa todos los campos";
    echo json_encode($res);
}else{
    #Validar si existe el usuario unico
    $sqlConsultar = "SELECT nombre FROM usuarios WHERE nombre = '$usuario'";
    if($rows = $peticionesCrud->validarExistencia($sqlConsultar)){
        #Traer el hash en caso exista el usuario
        $sqlPass = "SELECT id, nombre, correo, pass, sexo FROM usuarios WHERE nombre = '$usuario'";
        $dataUsuario = $peticionesCrud->ver($sqlPass);
    }
    #Se verifica que el usuario y el hash sea correcto
    if($rows === 1 && password_verify($pass, $dataUsuario[0]["pass"])){
        $res["status"] = "ok";
        $res["msg"] = "login correcto";
        echo json_encode($res);
        #Se crea una sesiion
        $_SESSION["id"] = $dataUsuario[0]["id"];
        $_SESSION["nombre"] = $dataUsuario[0]["nombre"];
        $_SESSION["correo"] = $dataUsuario[0]["correo"];
        $_SESSION["sexo"] = $dataUsuario[0]["sexo"];
    }else{
        $res["status"] = "error";
        $res["msg"] = "Datos erroneos";
        echo json_encode($res);
    }
}

?>