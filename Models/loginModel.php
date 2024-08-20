<?php
    include_once 'ConexionModel.php';

function IniciarSesionModel($correoElectronico, $contrasenna)
{
    $instancia = Open();
    
    $sentencia = "CALL IniciarSesion('$correoElectronico','$contrasenna');";
    $respuesta = $instancia -> query($sentencia);

    Close($instancia);
    return $respuesta;
}

?>