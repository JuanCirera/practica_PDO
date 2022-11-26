<?php

namespace App;

function mostrarNavbar(){

    if(str_contains($_SERVER["REQUEST_URI"], "public/autores")){
        $rutaLibros="./../libros/index.php";
        $rutaAutores="./index.php";
    }elseif(str_contains($_SERVER["REQUEST_URI"], "public/libros")){
        $rutaLibros="./index.php";
        $rutaAutores="./../autores/index.php";
    }


    echo <<<TXT
        <nav class="navbar navbar-expand-lg" style="background-color:#282D32">
            <a class="navbar-brand me-4 ms-4 text-uppercase fw-bold" style="color:#CDCDCD"><i class="fa-solid fa-book-open"></i> Biblioteca</a>
            <div class="container">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{$rutaLibros}">Libros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{$rutaAutores}">Autores</a>
                        </li>
                    </ul>
                    <!-- Left links -->
                    <!-- <div class="d-flex align-items-center">
                        <a href="login.php" class="btn btn-primary me-3">
                            Login
                        </a>
                    </div> -->
                </div>
            </div>
        </nav>
    TXT;
}