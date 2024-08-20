<?php
    include_once 'ConexionModel.php';

function MostrarCarritoTemporalModel()
{
    $instancia = Open();
    $IdUsuario = $_SESSION["ConsecutivoUsuario"];

    $sentencia = "CALL MostrarCarritoTemporal('$IdUsuario');";
    $respuesta = $instancia -> query($sentencia);

    Close($instancia);
    return $respuesta;
}

function MostrarCarritoTotalModel()
{
    $instancia = Open();
    $IdUsuario = $_SESSION["ConsecutivoUsuario"];

    $sentencia = "CALL MostrarCarritoTotal('$IdUsuario');";
    $respuesta = $instancia -> query($sentencia);

    Close($instancia);
    return $respuesta;
}

// **// **// Métodos de Pago

function ConfirmarPagoModel()
{
    $instancia = Open();
    $IdUsuario = $_SESSION["ConsecutivoUsuario"];

    $sentencia = "CALL ConfirmarPago('$IdUsuario');";
    $instancia -> query($sentencia);

    Close($instancia);
}

function VerFacturasModel()
{
    $instancia = Open();
    $IdUsuario = $_SESSION["ConsecutivoUsuario"];

    $sentencia = "CALL VerFacturas('$IdUsuario');";
    $respuesta = $instancia -> query($sentencia);

    Close($instancia);
    return $respuesta;
}

?>