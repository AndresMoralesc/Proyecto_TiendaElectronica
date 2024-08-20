function ValidarCorreo()
{
    let Correo = $("#correoElectronico").val();
    $.ajax({
        type: 'POST',
        url: '../Controllers/usuariosController.php',
        data: { 
            'BuscarUsuario':'BuscarUsuario',
            'Correo' : Correo
        },
        success: function (res) {
            if(res == "OK")
            {
                alert("El correo ingresado no existe");
                $("#btnRecuperar").prop("disabled",true);
            }
            else
            {
                $("#btnRecuperar").prop("disabled",false);
            }
        }
    });
}