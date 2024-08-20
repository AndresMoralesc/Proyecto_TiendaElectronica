<?php
    include_once 'utilitarios.php';
    include_once '../Controllers/carritoController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema MN</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>¢ SubTotal</th>
                    <th>¢ Impuesto</th>   
                    <th>¢ Total</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                  MostrarCarritoTotal();
                ?>
            </tbody>
        </table>

        <br/>

        <?php

          if($_SESSION["CantidadTemporal"] != 0)
          {
            echo '<form action="" method="POST">
                    <input type="submit" value="Procesar Pago" class="btn btn-warning"
                    id="btnPagar" name="btnPagar" >
                </form>';
          }

        ?>

       

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

</body>
</html>