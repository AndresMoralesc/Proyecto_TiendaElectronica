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
            if(res != "OK")
            {
                alert(res);
                $("#btnRegistrarse").prop("disabled",true);
            }
            else
            {
                $("#btnRegistrarse").prop("disabled",false);
            }
        }
    });
}