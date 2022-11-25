<?php

namespace App\public; //TODO: ELIMINAR ESTE ARCHIVO

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
    <title>Register - Biblioteca</title>
</head>
<body class="bg-dark" style="color: #CDCDCD;">

<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <h3 class="text-uppercase text-center"><i class="fa-solid fa-book-open"></i> Biblioteca</h3>
                            <div class="card text-white" style="border-radius: 1rem; background-color:#282D32">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase mb-5">Register</h2>

                                        <div class="form-outline form-white mb-4">

                                            <input type="text" id="user" class="form-control form-control-lg" name="user" required />
                                            <label class="form-label" for="user">Username</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">

                                            <input type="password" id="pwd" class="form-control form-control-lg" name="pwd" required />
                                            <label class="form-label" for="pwd">Password</label>
                                        </div>

                                        <button class="btn btn-outline-info btn-lg px-5 mb-3" name="login" type="submit">Register</button><br>

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