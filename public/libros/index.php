<?php

namespace App\Libros;

session_start();

use App\Autor;
use App\Libro;

use function App\mostrarNavbar; //Esto me lo ha puesto el require 

require __DIR__ . "/../../vendor/autoload.php";
include __DIR__."/../../src/navbar.php";

Autor::crearAutores(40);
$autores = Autor::readAll();
Libro::crearLibros(70);
$libros = Libro::read();

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
    <!-- Me esta dando problemas la navbar y le tengo que forzar algo de css -->
    <link rel="stylesheet" href="./../css/styles.css">
    <title>Practica PDO - Libros</title>
</head>

<body class="bg-dark" style="color: #CDCDCD;">

    <?php
        mostrarNavbar();
    ?>

    <div class="container">

        <!-- <h3 class="text-uppercase text-center mt-5 mb-5"><i class="fa-solid fa-book-open"></i> Biblioteca</h3> -->
        <h3 class=" text-center mt-5 mb-5">Libros</h3>

        <a href="./crear.php" class="btn btn-primary mb-5"><i class="fas fa-add"></i> Nuevo libro</a>

        <?php
        $cont_col = 0;

        foreach ($libros as $libro) {

            //Me traigo el objeto autor al que pertenece el id ligado a libro para mostrar su nombre que queda mejor
            $autor=Autor::whichAutor($libro->autor);

            if ($cont_col == 0) {
                echo "<div class='d-flex flex-row mb-3'>";
            }

            echo <<<TXT
                <div class="card mb-4 me-3" style="width:30rem; background-color:#282d32">
                    <form action="{$_SERVER['PHP_SELF']}" method="POST">
                        <div class="bg-image">
                        <!-- <a href="./update.php?={$libro->id_libro}" cursor="hand"> -->
                                <img src="./..{$libro->portada}" class="img-fluid" style="width:30rem;height:30rem;"/>
                            <!-- </a> -->
                        </div> 
                        <div class="card-body">
                            <h5 class="card-title">{$libro->titulo}</h5>
                            <h6 class="card-title"><b>Autor:</b> {$autor->nombre} {$autor->apellidos}</h6>
                            <p class="card-text"><b>ISBN:</b> {$libro->isbn}</p>
                            
                        <p type="hidden" value="{$libro->id_libro}" name="id_autor"></p>
                        <a class="btn btn-warning" href="./update.php?={$libro->id_libro}" style="color:black"><i class="fas fa-edit"></i></a>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    
                        </div>
                    </form>
                </div>
            TXT;

            $cont_col++;
            if ($cont_col == 3) {
                echo "</div>";
                $cont_col = 0;
            }
        }
        ?> 

    </div>
    
    <?php
        if(isset($_SESSION["mensaje"])){
            echo <<<TXT
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '{$_SESSION['mensaje']}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            TXT;
        }
        unset($_SESSION["mensaje"]);
    ?>
    
</body>

</html>

<!-- Juan Fco Cirera Rosa 2ºDAW - DWES -->