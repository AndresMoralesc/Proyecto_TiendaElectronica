<?php
    include_once 'utilitarios.php';
    include_once '../Controllers/usuariosController.php';

    $datos = ConsultarUsuario($_GET["q"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema MN</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <?php
            MostrarMenu();
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">



                    <div class="card">
                        <div class="card-body login-card-body">
                            <h4 class="login-box-msg">Actualizar Información</h4>

                            <form action="" method="post">

                                <input type="hidden" id="Consecutivo" name="Consecutivo"
                                value="<?php echo $datos["ConsecutivoUsuario"] ?>" >

                                <div class="row">
                                    <div class="col-6">
                                        <input type="email" class="form-control" placeholder="Correo Electrónico"
                                            required id="correoElectronico" name="correoElectronico"
                                            readOnly="true" value="<?php echo $datos["CorreoElectronico"] ?>" >
                                    </div>
                                    <div class="col-6">

                                    <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Contraseña"
                                                                                        id="contrasenna" name="contrasenna">
          <div class="input-group-append">
            <div class="input-group-text">
            <span class="bi bi-eye-slash" id="togglePassword"></span>
  
            </div>
          </div>
        </div>


                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Identificación"
                                            required id="Identificacion" name="Identificacion"
                                            onkeyUp = "BuscarNombreApi();" value="<?php echo $datos["Identificacion"] ?>" >
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Nombre" required
                                            id="Nombre" name="Nombre" readOnly="true" 
                                            value="<?php echo $datos["Nombre"];?>" >
                                    </div>

                                    <div class="col-4">
                                        <select class="form-control" placeholder="Perfil" required id="Perfil"
                                            name="Perfil">
                                            <?php
                                                ConsultarTiposUsuarios($datos["TipoUsuario"]);
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <BR/>

                                <input type="submit" class="btn btn-primary btn-block" value="Actualizar"
                                        id="btnActualizar" name="btnActualizar">

                            </form>

                        </div>
                    </div>
                </div>





        </div>
        </section>
    </div>

    <?php
    MostrarFooter();
  ?>

    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="javascripts/funcionesActualizarUsuario.js"></script>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#contrasenna");

        togglePassword.addEventListener("click", function () {
            
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            this.classList.toggle("bi-eye");
        });

        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
    </script>

</body>

</html>