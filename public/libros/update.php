<?php

namespace App\Libros;

use App\Autor;
use App\Libro;
use App\Tools;

use function App\mostrarNavbar;

session_start();

require __DIR__."/../../vendor/autoload.php";
include __DIR__."/../../src/navbar.php";

if(!isset($_GET["id"])){
    header("Location:index.php");
    die();
}

//Se comprueba tambien si existe el id que llega por GET
if(!Libro::existeLibro($_GET["id"])){
    header("Location:index.php");
    die();
}

$id=$_GET["id"];

$libro=Libro::whichLibro($id);
$autores=Autor::readAll();

if(isset($_POST["guardar"])){

    $error=false;

    $titulo=$_POST["titulo"];
    $isbn=$_POST["isbn"];
    $autor_id=(int)($_POST["autor_id"]); 

    if(strlen($titulo)<3){
        $error=true;
        $_SESSION["err_titulo"]="** El titulo debe contener al menos 3 caracteres";
    }

    if(strlen($isbn)!=13){
        $error=true;
        $_SESSION["err_isbn"]="** El ISBN debe contener 13 caracteres";
    }

    //Comprueba que el id del autor exista
    if(!Autor::existeAutor($autor_id)){
        $error=true;
        $_SESSION["err_autor"]="** El autor introducido no se encuentra en el sistema";
    }

    //IMAGEN
    $nombreImagen=$libro->portada;
    $mime=Tools::$imagesMIME;

    if($_FILES["file"]["error"]==0){
        if(!in_array($_FILES["file"]["type"],$mime)){
            $error=true;
            $_SESSION["err_imagen"]="** El archivo subido no es de tipo imagen";
        }

        $nombreImagen="/img/".uniqid()."-".$_FILES["file"]["name"];
        
        if(!move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__."/..".$nombreImagen)){
            $nombreImagen=$libro->portada;
            $error=true;
            $_SESSION["err_imagen"]="** Error al intentar guardar la imagen";
        }
    }

    if($error){
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    (new Libro)
    ->setTitulo($titulo)
    ->setIsbn($isbn)
    ->setAutor($autor_id)
    ->setPortada($nombreImagen)
    ->update($id);

    $_SESSION["mensaje"]="Libro actualizado";
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
    <title>Editar Libro</title>
</head>
<body class="bg-dark" style="color: #CDCDCD;">
<?php
    mostrarNavbar();
?>
<div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF']."?id=$id" ?>" method="POST" enctype="multipart/form-data">

            <section class="vh-50 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card" style="border-radius: 1rem; background-color:#212529">
                                <div class="card-body p-5">
                                    <h3 class="fw-bold mb-2 text-uppercase mb-5">Editar libro</h3>

                                    <div class="mb-4">
                                        <label class="form-label" for="titulo">Titulo</label>
                                        <input type="text" id="titulo" class="form-control" name="titulo" required value="<?php echo $libro->titulo ?>"/>
                                        <?php Tools::mostrarError("err_titulo") ?>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="isbn">ISBN</label>
                                        <input type="text" id="isbn" class="form-control" name="isbn" min="13" maxlength="13" required value="<?php echo $libro->isbn ?>"/>
                                        <?php Tools::mostrarError("err_isbn") ?>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="autor">Autor</label> 
                                        <select class="form-select" name="autor_id" id="autores">
                                            <?php 
                                                foreach($autores as $autor){
                                                    $selected=($autor->id_autor==$libro->autor)?"selected":"";
                                                    echo "<option value='{$autor->id_autor}' $selected>{$autor->nombre} {$autor->apellidos}</option>";
                                                    //Como le estoy pasando la id al value cuando se seleccione un autor se envia solo su id, que es lo que hace falta
                                                }
                                            ?> 
                                        </select>
                                        <?php Tools::mostrarError("err_autor") ?>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="file">Portada</label>
                                        <input type="file" id="file" class="form-control" name="file" />
                                        <?php Tools::mostrarError("err_imagen") ?>
                                    </div>

                                    <div class="mb-4 text-center">
                                        <img src="<?php echo "./..$libro->portada"?>" class="rounded" name="imagen" id="imagen" style="width:20rem;height:30rem">
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

<!-- Visualizar imagen subida -->
<script>
    document.getElementById("file").addEventListener('change', cambiarImagen);

    function cambiarImagen(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("imagen").setAttribute('src', event.target.result)
        };
        reader.readAsDataURL(file);
    }
</script>

</body>
</html>
<?php } ?>