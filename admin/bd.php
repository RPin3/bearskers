<?php

$servidor = "localhost";
$baseDeDatos = "website";
$usuario = "root";
$constrasenia = "";

try{

    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $constrasenia);

}catch(Exception $error){
    echo $error->getMessage();
}
?>