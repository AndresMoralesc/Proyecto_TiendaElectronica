<?php
include_once '../Models/LoginModel.php';

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_POST["btnIniciarSesion"]))
{
    $correoElectronico = $_POST["correoElectronico"];
    $contrasenna = $_POST["contrasenna"];

    $respuesta = IniciarSesionModel($correoElectronico, $contrasenna);

    if($respuesta -> num_rows > 0)
    {
        $datosUsuario = mysqli_fetch_array($respuesta);
        $_SESSION["ConsecutivoUsuario"] = $datosUsuario["ConsecutivoUsuario"];
        $_SESSION["CorreoElectronico"] = $datosUsuario["CorreoElectronico"];
        $_SESSION["TipoUsuario"] = $datosUsuario["TipoUsuario"];
        $_SESSION["PerfilUsuario"] = $datosUsuario["PerfilUsuario"];

        header("Location: ../Views/principal.php");
    }
    else
    {
        header("Location: ../Views/login.php");
    }
}

if(isset($_POST["btnCerrarSesion"]))
{
    session_destroy();
    header("Location: ../Views/login.php");
}

?>