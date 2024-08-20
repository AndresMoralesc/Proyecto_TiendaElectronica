<?php
    include_once 'utilitarios.php';
    include_once '../Controllers/usuariosController.php';
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
                    <th>Correo Electrónico</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Tipo Usuario</th>
                    <th>Estado</th>   
                    <th>Acciones</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                  ConsultarUsuarios();
                ?>
            </tbody>
        </table>

      </div>
    </section>
  </div>

  <?php
    MostrarFooter();
  ?>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inactivar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Está seguro de inactivar el usuario?
        <input type="hidden" id="IdModal">
      </div>
      <div class="modal-footer">
        <button type="button" onclick="InactivarUsuario();" class="btn btn-primary">Procesar</button>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var myDataId = $(event.relatedTarget).attr('data-id'); 
  $("#IdModal").val(myDataId);
})
</script>

</body>
</html>