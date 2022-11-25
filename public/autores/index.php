<?php

namespace App\Autores;

use App\Autor;

use function App\mostrarNavbar;

require __DIR__ . "/../../vendor/autoload.php";
include __DIR__."/../../src/navbar.php";

$autores = Autor::read();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- sweetAlert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./../css/styles.css">
    <title>Practica PDO - Autores</title>
</head>

<body class="bg-dark" style="color: #CDCDCD;">

    <?php
        mostrarNavbar();
    ?>

    <div class="container">

        <!-- <h3 class="text-uppercase text-center mt-5 mb-5"><i class="fa-solid fa-book-open"></i> Biblioteca</h3> -->
        <h3 class=" text-center mt-5 mb-5">Autores</h3>
        <a href="./crear.php" class="btn btn-primary mb-5"><i class="fas fa-add"></i> Nuevo autor</a>

        <table class="table" style="color:#CDCDCD">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($autores as $autor){
                        echo <<<TXT
                            <tr>
                                <th scope="row">{$autor->id_autor}</th>
                                <td>{$autor->nombre} {$autor->apellidos}</td>
                                <td>
                                    <form action="{$_SERVER['PHP_SELF']}" method="POST">
                                        <input type="hidden" value="{$autor->id_autor}" name="id_autor"></input>
                                        <a class="btn btn-warning" href="./update.php?={$autor->id_autor}" style="color:black"><i class="fas fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        TXT;
                    }
                ?> 
            </tbody> 
        </table> 

</body>

</html>

<!-- Juan Fco Cirera Rosa 2ºDAW - DWES -->