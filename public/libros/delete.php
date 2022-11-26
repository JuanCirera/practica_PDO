<?php

namespace App\Libros;

session_start();

use App\Libro;

require __DIR__."/../../vendor/autoload.php";

if(!isset($_POST["id_libro"])){
    header("Location:index.php");
    die();
}

if(!Libro::existeLibro($_POST["id_libro"])){
    header("Location:index.php");
    die();
}

$id=$_POST["id_libro"];

if(!Libro::existeLibro($id)){
    header("Location:index.php");
    die();
}

//Antes de eliminar el objeto de la BD necesito su imagen para borrarla 
$portada=Libro::whichLibro($id)->portada;
Libro::delete($id);

//IMAGEN
if(basename($portada)!="default.jpg"){
    unlink(__DIR__."/..".$portada);
}

$_SESSION["mensaje"]="Libro eliminado";
header("Location:index.php");
