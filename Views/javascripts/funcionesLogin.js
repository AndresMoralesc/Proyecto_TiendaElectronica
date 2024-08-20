function HabilitarBoton()
{
    let correo = $("#correoElectronico").val();
    let clave = $("#contrasenna").val();

    if(correo.trim() != "" && clave.trim() != "")
    {
        $("#btnIniciarSesion").prop("disabled",false);
    }
    else
    {
        $("#btnIniciarSesion").prop("disabled",true);
    }
}