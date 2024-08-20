<?php
    include_once '../Models/carritoModel.php';

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

function MostrarCarritoTemporal()
{
    $respuesta = MostrarCarritoTemporalModel();

    if($respuesta -> num_rows > 0)
    {
        $datosCarrito = mysqli_fetch_array($respuesta);
        $_SESSION["CantidadTemporal"] = $datosCarrito["CantidadTemporal"];
        $_SESSION["MontoTemporal"] = $datosCarrito["MontoTemporal"];
    }
}

function MostrarCarritoTotal()
{
    $respuesta = MostrarCarritoTotalModel();

    if($respuesta -> num_rows > 0)
    {
        $totalizado = 0;

        while($fila = mysqli_fetch_array($respuesta))
        {
            $totalizado = $totalizado + $fila["Total"];

            echo "<tr>";
            echo "<td>" . $fila["Nombre"] . "</td>";
            echo "<td>" . $fila["Cantidad"] . "</td>";
            echo "<td>" . number_format($fila["Precio"], 2) . "</td>";
            echo "<td>" . number_format($fila["SubTotal"], 2) . "</td>";
            echo "<td>" . number_format($fila["Impuesto"], 2) . "</td>";
            echo "<td>" . number_format($fila["Total"], 2) . "</td>";
            echo "</tr>";
        }
        echo "<tr style='font-weight:bold; color: blue; font-size:14pt;'>";
        echo "<td style='text-align:right' colspan='5'>Total:</td>";
        echo "<td style='text-align:left'>" . number_format($totalizado, 2) . "</td>";
        echo "</tr>";

    }
}

// **// **// Métodos de Pago

if(isset($_POST["btnPagar"]))
{
    ConfirmarPagoModel();
    header("Location: ../Views/verFacturas.php");
}

function VerFacturas()
{
    $respuesta = VerFacturasModel();

    if($respuesta -> num_rows > 0)
    {
        while($fila = mysqli_fetch_array($respuesta))
        {
            echo "<tr>";
            echo "<td>" . $fila["IdMaestro"] . "</td>";
            echo "<td>" . $fila["Fecha"] . "</td>";
            echo "<td>" . number_format($fila["Subtotal"], 2) . "</td>";
            echo "<td>" . number_format($fila["Impuesto"], 2) . "</td>";
            echo "<td>" . number_format($fila["Total"], 2) . "</td>";
            echo "</tr>";
        }
    }
}

?>