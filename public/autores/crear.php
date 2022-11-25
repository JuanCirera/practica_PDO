<?php

namespace App;


session_start();

if(isset($_POST["crear"])){
    $error=false;

    $nombre=trim($_POST["nombre"]);
    $apellidos=trim($_POST["apellidos"]);

    //Comprobaciones campos
    if(!preg_match('[A-Z][a-z]',$nombre)){
        $error=true;
        $_SESSION["err_nombre"]="**** El nombre no puede contener numeros";
        die();
    }

    if(!preg_match('[A-Z][a-z]',$apellidos)){
        $error=true;
        $_SESSION["err_apellidos"]="**** Los apellidos no pueden contener numeros";
        die();
    }


    if($error){

    }

}


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
    <title>Nuevo autor - Biblioteca</title>
</head>

<body class="bg-dark" style="color: #CDCDCD;">

    <?php
        mostrarNavbar(2);
    ?>

    <div class="container">
        <h3 class="text-uppercase text-center mt-5 mb-5"><i class="fa-solid fa-book-open"></i> Biblioteca</h3>
        <h4 class=" text-center mt-5 mb-5">Nuevo autor</h4>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

            <section class="vh-100">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div style="background-color:#212529">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <div class="form-outline form-white mb-4">

                                            <input type="text" id="nombre" class="form-control form-control-lg" name="nombre" required />
                                            <label class="form-label" for="nombre">Nombre</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">

                                            <input type="password" id="apellidos" class="form-control form-control-lg" name="apellidos" required />
                                            <label class="form-label" for="apellidos">Apellidos</label>
                                        </div>

                                        <button class="btn btn-outline-info btn-lg px-5 mb-3" name="crear" type="submit"><i class="fa-solid fa-add"></i> Crear</button><br>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </form>
    </div>

</body>

</html>