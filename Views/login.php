<?php
  include_once '../Controllers/loginController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Web</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="card">
    <div class="card-body login-card-body">
      <h4 class="login-box-msg">Iniciar Sesión</h4>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo Electrónico"
          required id="correoElectronico" name="correoElectronico" onkeyup="HabilitarBoton();">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña"
          required id="contrasenna" name="contrasenna" onkeyup="HabilitarBoton();">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesión"
            disabled id="btnIniciarSesion" name="btnIniciarSesion">
          </div>
        </div>
      </form>
      <br/>

      <p class="mb-1">
        <a href="recuperarUsuario.php">Olvidó su contraseña?</a>
      </p>

      <p class="mb-0">
        <a href="registrarUsuario.php" class="text-center">Crear una cuenta!</a>
      </p>

      <p class="mb-0">
        <a href="notificarUsuario.php" class="text-center">Notificar!</a>
      </p>

    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="javascripts/funcionesLogin.js"></script>
</body>
</html>
