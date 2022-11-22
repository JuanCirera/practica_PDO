<?php

namespace App;

require __DIR__ . "/../vendor/autoload.php";

Autor::crearAutores(40);
$autores = Autor::read();
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
    <title>Practica PDO - Inicio</title>
    <style>
        a:link {
            color: #CDCDCD;
        }

        a:visited {
            color: #CDCDCD;
        }

        a:hover {
            color: white;
        }

    </style>
</head>

<body class="bg-dark" style="color: #CDCDCD;">

    <nav class="navbar navbar-expand-lg" style="background-color:#282D32">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Biblioteca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mis libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center">
                    <a href="login.php" class="btn btn-primary me-3">
                        Login
                    </a>
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>

    <div class="container">

        <h5 class="text-center my-4">Biblioteca</h5>

        <?php
        $cont_col = 0;

        foreach ($libros as $libro) {

            if ($cont_col == 0) {
                echo "<div class='d-flex flex-row mb-3'>";
            }

            echo <<<TXT
                <div class="card mb-4 me-3" style="width:30rem; ">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="{$libro->portada}" class="img-fluid" style="width:30rem;height:30rem;"/>
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body" style="color:black">
                        <h5 class="card-title">{$libro->titulo}</h5>
                        <h6 class="card-title"><b>Autor:</b> {$libro->autor}</h6>
                        <p class="card-text"><b>ISBN:</b> {$libro->isbn}</p>
                    </div>
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

</body>

</html>

<!-- Juan Fco Cirera Rosa 2ºDAW - DWES -->