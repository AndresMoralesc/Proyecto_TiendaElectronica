<?php
include_once '../Controllers/loginController.php';
include_once '../Controllers/carritoController.php';

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

function MostrarMenu()
{

  if($_SESSION["CorreoElectronico"] == null)
  {
    header("Location: ../Views/login.php");
  }

  MostrarCarritoTemporal();

  echo '
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="principal.php" class="btn">Inicio</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        
        <form action="" method="post">
          <input type="submit" class="btn" value="Cerrar Sesión"
                id="btnCerrarSesion" name="btnCerrarSesion">
        </form>

      </li>

      <li class="nav-item d-none d-sm-inline-block">
      Unidades: '. $_SESSION["CantidadTemporal"] .'
      &nbsp;&nbsp;&nbsp; ¢'. number_format($_SESSION["MontoTemporal"],2) .'
      </li>

  </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="principal.php" class="brand-link">
        <span class="brand-text font-weight-light">Sistema Web MN</span>
      </a>

      <div class="sidebar">
       
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"> ' . $_SESSION["CorreoElectronico"] . ' <br/> ' . $_SESSION["PerfilUsuario"] . ' </a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Usuarios<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="usuarios.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Información</p>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Compras<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pagos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Procesar Pago</p>
                  </a>
                </li>
                <li class="nav-item">
                <a href="verFacturas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver Facturas</p>
                </a>
              </li>
              </ul>
            </li>


          </ul>
        </nav>
      </div>
    </aside>
  ';
}

function MostrarFooter()
{
  echo '
  <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
      </div>
      <strong>&copy; 2023</strong>
    </footer>
  ';
}

?>