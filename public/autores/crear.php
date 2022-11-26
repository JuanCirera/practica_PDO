<?php

namespace App\Autores;

use App\Autor;
use App\Tools;

use function App\mostrarNavbar;

require __DIR__."/../../vendor/autoload.php";
include __DIR__."/../../src/navbar.php";

session_start();

if(isset($_POST["guardar"])){
    $error=false;

    $nombre=trim($_POST["nombre"]);
    $apellidos=trim($_POST["apellidos"]);

    //Comprobaciones campos
    if(strlen($nombre)<3){
        $error=true;
        $_SESSION["err_nombre"]="** El nombre debe tener al menos 3 caracteres";
        //Aqui no se pueden meter die(), para eso esta el if($error)
    }

    if(strlen($apellidos)<3){
        $error=true;
        $_SESSION["err_apellidos"]="** Los apellidos deben tener al menos 3 caracteres";
    }

    if($error){
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    (new Autor)
    ->setNombre($nombre)
    ->setApellidos($apellidos)
    ->create();

    $_SESSION["mensaje"]="Autor creado";
    header("Location:index.php");

}else{

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
    <title>Nuevo autor - Biblioteca</title>
</head>

<body class="bg-dark" style="color: #CDCDCD;">

    <?php
       mostrarNavbar();
    ?>

    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <section class="vh-50 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card" style="border-radius: 1rem; background-color:#212529">
                                <div class="card-body p-5">
                                    <h3 class="fw-bold mb-2 text-uppercase mb-5">Nuevo autor</h3>

                                    <div class="mb-4">
                                        <label class="form-label" for="nombre">Nombre</label>
                                        <input type="text" id="nombre" class="form-control" name="nombre" required />
                                        <?php Tools::mostrarError("err_nombre") ?>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="apellidos">Apellidos</label>
                                        <input type="text" id="apellidos" class="form-control" name="apellidos" required />
                                        <?php Tools::mostrarError("err_apellidos") ?>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary px-3 mt-4" name="guardar"><i class="fas fa-save"></i> Guardar</button>
                                    <button type="reset" class="btn btn-outline-info px-3 mt-4"><i class="fas fa-broom"></i> Limpiar</button>
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
<?php } ?>