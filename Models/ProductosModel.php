<?php
    include_once 'ConexionModel.php';

function ConsultarProductosModel()
{
    $instancia = Open();
    
    $sentencia = "CALL ConsultarProductos();";
    $respuesta = $instancia -> query($sentencia);

    Close($instancia);
    return $respuesta;
}

function ActualizarCarritoModel($IdProducto,$CantidadProducto)
{
    $instancia = Open();
    
    $IdUsuario = $_SESSION["ConsecutivoUsuario"];

    $sentencia = "CALL ActualizarCarrito($IdProducto,$CantidadProducto,$IdUsuario);";
    $instancia -> query($sentencia);

    Close($instancia);
}

