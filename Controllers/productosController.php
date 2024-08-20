<?php
include_once '../Models/ProductosModel.php';

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

function MostrarProductos()
{
    $respuesta = ConsultarProductosModel();

    if($respuesta -> num_rows > 0)
    {
       echo '<div class="row">';
        while($fila = mysqli_fetch_array($respuesta))
        {
            echo '
                <div class="col-md-3">
                    <div class="info-box bg-info">
                        <span class="info-box-img">
                            <img height="150" width="150" style="border-radius:10px" src="'. $fila["Ruta"] .'" />           
                        </span>
                        <div class="info-box-content">
                            <span style="font-size:14pt" class="info-box-text">'. $fila["Nombre"] . ' <br/> ¢ '. number_format($fila["Precio"]) .'</span>                          
                            <span class="progress-description">
                                Unidades: '. $fila["Stock"] .'
                            </span>';                               
                       
                            if (session_status() != PHP_SESSION_NONE)
                            {
                                echo '<div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cantidad" onkeypress="return onlyNumberKey(event)" maxlength="2" required id="cantidad-'. $fila["IdProducto"] . '">
                                    <div class="input-group-append">
                                        <div class="input-group-text" onclick="ActualizarCarrito('. $fila["IdProducto"] . ',' . $fila["Stock"] . ')">
                                            <span style="font-size:12pt; font-weight:bold;"> + </span>
                                        </div>
                                    </div>
                                </div>';

                            }

                        echo '</div>
                    </div>
                </div>';
        }
        echo '</div>'; 
    }

}

if(isset($_POST["ActualizarCarrito"]))
{
    ActualizarCarritoModel($_POST["IdProducto"],$_POST["CantidadProducto"]);
}


?>