<?php

function Open()
{
    $servidor = "127.0.0.1";
    $usuario = "root";
    $contrasena = "";
    $baseDatos = "proyectomn_bd";  

    return mysqli_connect($servidor, $usuario, $contrasena, $baseDatos);
}

function Close($instancia)
{
    mysqli_close($instancia);
}

?>