<?php

namespace App\Autores;

use App\Autor;

session_start();

require __DIR__."/../../vendor/autoload.php";

if(!isset($_POST["id_autor"])){
    header("Location:index.php");
    die();
}

if(!Autor::existeAutor($_POST["id_autor"])){
    header("Location:index.php");
    die();
}

$id=$_POST["id_autor"];

if(!Autor::existeAutor($id)){
    header("Location:index.php");
    die();
}

Autor::delete($id);

$_SESSION["mensaje"]="Autor eliminado";
header("Location:index.php");