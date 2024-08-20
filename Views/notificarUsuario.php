<?php
  include_once '../Controllers/usuariosController.php'
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
      <h4 class="login-box-msg">Notificar Usuario</h4>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo Electrónico"
          required id="correoElectronico" name="correoElectronico" onblur="ValidarCorreo();">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="file" class="form-control"
          required id="adjunto" name="adjunto" >
        </div>

        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Notificar"
            id="btnNotificar" name="btnNotificar">
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
