 <?php
    include_once 'utilitarios.php';
    include_once '../Controllers/productosController.php';
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
                 
                     <?php
                        MostrarProductos();
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

<script>

    function onlyNumberKey(evt) {
              
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function ActualizarCarrito(IdProducto, Inventario)
    {
        let CantidadProducto = $("#cantidad-" + IdProducto).val();

        if(CantidadProducto > Inventario)
        {
            alert("La cantidad supera el stock del producto");
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: '../Controllers/productosController.php',
                data: { 
                    'ActualizarCarrito':'ActualizarCarrito',
                    'IdProducto' : IdProducto,
                    'CantidadProducto' : CantidadProducto
                },
                success: function (res) {

                    alert("Carrito actualizado correctamente");
                    window.location.href = "principal.php"
                }
            });
        }

    }

</script>

 </body>

 </html>