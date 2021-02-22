<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="stilo/actividad.css">

</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="indexa.php">SegAPP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="indexa.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Servicios</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
              <a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a>
              <a class="dropdown-item" href="leafle_map.php">Mapa GIS</a>
              <a class="dropdown-item" href="registrar_instalacion.php">Generar Actividades</a>
              <a class="dropdown-item" href="registros_de_instalaciones.php">Registros de instalación</a>
              <a class="dropdown-item" href="reportes.php">Reportes</a>
            </div>
          </li>

        </ul>
       
        <!-- Datos del usuario -->
        <ul class="navbar-nav ml-auto">
            <form class="form-inline mt-2 mt-md-0">
                 <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="barra_navegacion">
                            <span class="mr-2 d-none d-lg-inline text-white-500 small">
                                    <?php echo $_SESSION['usuario']['Nombre'] ?> 
                                    <?php echo $_SESSION['usuario']['Apellido'] ?> 
                            </span>
                        <img class="img-profile rounded-circle" src="imagenesp/perfil_administrador.png"  width="30px" height="30px" >  
                    </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="editar_usurer_admin.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../salir.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                </li>
            </form>
        </ul>
      </div>
    </nav>
    <br><br><br><br>



            <div class="inner contact">
           
                <!-- Form Area -->
                <div class="contact-form">
                    <!-- Form -->
                    <h1>ACTIVIDADES</h1>
                    <form id="contact-us" method="post" action="#">
                        <!-- Left Inputs -->
                        <div class="col-xs-6 wow animated slideInLeft" data-wow-delay=".5s">
                            <!-- Name -->
                            <input type="text" name="detalle_actividad" id="detalle_actividad" required="required" class="form" placeholder="Actividad" />
                            <!-- Email -->
                            <input type="date" name="fecha_actividad" id="fecha_actividad" required="required" class="form" placeholder="Fecha" />
                            
                        </div><!-- End Left Inputs -->
                        <!-- Right Inputs -->
                        <div class="col-xs-6 wow animated slideInRight" data-wow-delay=".5s">
                            <!-- Message -->
                            <input type="text" name="direccion_Actividad" id="direccion_Actividad" required="required" class="form" placeholder="Dirección" />
                            <input type="text" name="user_actividad" id="user_actividad" required="required" class="form" placeholder="Responsable" />                            
                        </div><!-- End Right Inputs -->
                        <!-- Bottom Submit -->
                        <div class="relative fullwidth col-xs-12">
                            <!-- Send Button -->
                            <button type="submit" id="submit" name="submit" class="form-btn semibold">Send Message</button> 
                        </div><!-- End Bottom Submit -->
                        <!-- Clear -->
                        <div class="clear"></div>
                    </form>

                </div><!-- End Contact Form Area -->
            </div><!-- End Inner -->
    
</body>
</html>




