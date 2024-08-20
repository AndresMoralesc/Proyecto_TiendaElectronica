function BuscarNombreApi() {
    let identificacion = $("#Identificacion").val();

    if (identificacion.trim().length >= 9) {
        $.ajax({
            type: 'GET',
            datetype: 'json',
            url: 'https://apis.gometa.org/cedulas/' + identificacion,
            success: function (res) {
                $("#Nombre").val(res.nombre);
            }
        });
    }
    else
    {
        $("#Nombre").val("");
    }

}