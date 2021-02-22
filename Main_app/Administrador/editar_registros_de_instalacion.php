<?php
    session_start();                    

    if(isset($_SESSION['usuario'])){

        if($_SESSION['usuario']['rol_id'] != "1"){
            header("Location: ../Operador/indexo.php") && 
            header("Location: ../Estandar/indexe.php");
        }        
    }else{
        header('Location: ../../index.php');
    }

    include "../conexion.php"; 

    $userLogin = $_SESSION['usuario'];
    $result = $userLogin;
  
  
  if(!empty($_POST)){
      $alert='';
      if(empty($_POST['latitud']) || empty($_POST['longitud']) || empty($_POST['fecha']) || empty($_POST['parroquia']) || empty($_POST['direccion'])  || empty(
          $_POST['tipo_componente']) || empty($_POST['id_instalacion'])){ 
              
              $alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
      }else{      
  
          $Lat = $_POST['latitud'];
          $Lon = $_POST['longitud'];
          $Fech = $_POST['fecha'];
          $Parro = $_POST['parroquia'];
          $Dir = $_POST['direccion'];
          $Tpcm = $_POST['tipo_componente'];
          $iduser = $_POST['id_instalacion'];
          //para editar foto pero con este codigo agrego xd
          $nombreimg=$_FILES['foto']['name'];    //imagen
          $Fot=$_FILES['foto']['tmp_name'];     //imagen
          $ruta="../imag_reg";                 //imagen
          $ruta=$ruta."/".$nombreimg;          //imagen
          move_uploaded_file($Fot,$ruta);    //imagen
  
  
          if (empty($_FILES['foto']['name']="")) {
  
                  $query_update = mysqli_query($mysqli,  "UPDATE instalaciones
                  SET latitude = '$Lat', longitude = '$Lon', fecha = '$Fech', parroquia = '$Parro', direccion = '$Dir',
                  tipo_componente = '$Tpcm'
                  WHERE id_instalacion = '$iduser'");
  
              
          }else{
  
              
                  $query_update = mysqli_query($mysqli,  "UPDATE instalaciones
                  SET latitude = '$Lat', longitude = '$Lon', fecha = '$Fech', parroquia = '$Parro', direccion = '$Dir',
                  foto ='$ruta', tipo_componente = '$Tpcm'
                  WHERE id_instalacion = '$iduser'");
          }
  
          
  
              if($query_update){
                  $alert='<p class="msg_save"> Registro actualizado correctamente... </p>';
              }else{
                  $alert='<p class="msg_error"> Error al actualizar registro... </p>';
          }
      }
  }
  
  
  //Mostrar Datos
  
  if(empty($_GET['id_instalacion'])){
      header('Location: registros_de_instalacion.php');
  }
  $idinstalacion = $_GET['id_instalacion'];
  
  $sql = mysqli_query($mysqli,"SELECT i.id_instalacion, i.latitude, i.longitude, i.fecha, i.parroquia, i.direccion, i.foto, i.usuario_id, (i.tipo_componente)
                              as id_componente, (d.tipo) as tipo_componente
                              FROM instalaciones i 
                              INNER JOIN dispositivos d on i.tipo_componente = d.id_componente 
                              WHERE id_instalacion=$idinstalacion");
      
  $result_sql = mysqli_num_rows($sql);
  
  if($result_sql == 0){
      header('Location: registros_de_instalacion.php');
  }else{
      $option = '';
      while($data = mysqli_fetch_array($sql)){
          $idinstalacion   = $data['id_instalacion'];
          $Lat = $data['latitude'];
          $Lon = $data['longitude'];
          $Fech = $data['fecha'];
          $Parro = $data['parroquia'];
          $Dir = $data['direccion'];
          $Fot=$data['foto']; //imagen
          $componente= $data['id_componente'];
          $Tpcm = $data['tipo_componente'];
          $iduser = $data['usuario_id'];
  
          if($componente == 1){
              $option = '<option value="'.$componente.'" select>'.$Tpcm.'</option>';
          }else if($componente == 2){
              $option = '<option value="'.$componente.'" select>'.$Tpcm.'</option>';
      }
    }
  }   
  
   
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Seguridad Ciudadana</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

      <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/logo.png">
	  <link rel="apple-touch-icon" href="./logo.png">
	  <link rel="apple-touch-startup-image" href="./logo.png">
	  <link rel="manifest" href="../.././manifest.json">


<script>
            //<![CDATA[

            var watchId;

            /* Controlamos los tiempos de espera mínimo y máximo de nuestra geolocalización respecto a la petición anterior */

            var PositionOptions = {

                timeout: 5000,

                maximumAge: 60000,

                enableHighAccurace: true // busca la mejor forma de geolocalización (GPS, tiangulación, ...)

            };

            /* Utiliza la geolocalalización solamente cuando se solicita.

            Con PositionOptions aseguramos que la posición no corresponde a caché */

            function initiate_geolocation() {

            if (navigator.geolocation) {

                browserSupportFlag = true;

                var watchId = navigator.geolocation.getCurrentPosition(successCallback, errorCallback, PositionOptions);

            } else {

                document.getElementById("mensaje").innerHTML = "Lo sentimos pero el API de Geolocalización de HTM5 no está disponible para su navegador";

            }

            }

            /* Reitera la geolocalización hasta que la detenemos */

            function watch_geolocation() {

            if (navigator.geolocation) {

                browserSupportFlag = true;  // Para optimizarlo en los navegadores (mis dudas con IE)

                var watchId = navigator.geolocation.watchPosition(successCallback, errorCallback);

            } else {

                document.getElementById("mensaje").innerHTML = "Lo sentimos pero el API de Geolocalización de HTM5 no está disponible para su navegador";

            }

            }

            /* Detenemos la geolocalización reiterada */

            function clear_watch_geolocation() {

            if (navigator.geolocation) {

                navigator.geolocation.clearWatch(watchId);

            } else {

                document.getElementById("mensaje").innerHTML = "Lo sentimos pero el API de Geolocalización de HTM5 no está disponible para su navegador";

            }

            }

            function successCallback(pos) {

          var latitud = pos.coords.latitude.toFixed(6);
          var longitud = pos.coords.longitude.toFixed(6);
          document.getElementById("latitud").value=latitud;
          document.getElementById("longitud").value=longitud;


            };

            /* Posibles errores que se pueden producir en la geolocalización */

            function errorCallback(error) {

            var appErrMessage = null;

            if (error.core == error.PERMISSION_DENIED) {

                appErrMessage = "El usuario no ha concedido los privilegios de geolocalización"

            } else if (error.core == error.POSITION_UNAVAILABLE) {

                appErrMessage = "Posicion no disponible"

            } else if (error.core == error.TIMEOUT) {

                appErrMessage = "Demasiado tiempo intentando obtener la localización del usuario."

            } else if (error.core == error.UNKNOWN) {

                appErrMessage = "Error desconocido"

            } else {

                appErrMessage = "Error insesperado"

            }

            document.getElementById("mensaje").innerHTML = appErrMessage

            };

            //]]>

</script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SEGAPP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="leafle_map.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Sistema de información geográfica</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administracion de usuarios
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="registrar_usuario.php"  
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-plus"></i>
                    <span>Registrar usuarios</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="lista_usuario.php" 
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Lista de Usuarios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administracion de información
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="actividades_push.php" 
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-plus-square"></i>
                    <span>Generar Actividades</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="registros_de_instalaciones.php">
                    <i class="fas fa-list-alt"></i>
                    <span>Registros de instalación</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="reportes.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reportes</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information PERFIL DE USUARIO-->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuario']['Nombre'] ?> 
                                                                                          <?php echo $_SESSION['usuario']['Apellido'] ?></span>
                                <img class="img-profile rounded-circle"
                                src="imagenesp/perfil_administrador.png" >
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil de usuariox
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../salir.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Content Row -->

                    <div class="row">

                    </div>

                    <section id="container">
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
        <center>
            <div class="form">
                <h1>Actualizar Registros</h1>
                <div class="grupo">
                    <input type="float" name="latitud" id="latitud" value="<?php echo $Lat; ?>"  required><span class="barra" ></span>
                    <label>Latitud</label>
                </div>
                <div class="grupo">
                    <input type="float" name="longitud" id="longitud" value="<?php echo $Lon; ?>" required><span class="barra" ></span>
                    <label>Longitud</label>
                </div>

                <div>
                <button type="button" class="button" onclick="initiate_geolocation();">Capturar Coordenadas</button>
                </div>

                <div class="grupo">
                    <input type="date" name="fecha" id="fecha" value="<?php echo $Fech; ?>" required><span class="barra"></span>
                    <label>Fecha</label>
                </div>

                <div class="grupo">
                    <input type="text" name="parroquia" id="parroquia" value="<?php echo $Parro; ?>" required><span class="barra"></span>
                    <label>Parroquia</label>
                </div>

                <div class="grupo">
                    <input type="text" name="direccion" id="direccion" value="<?php echo $Dir; ?>" required><span class="barra"></span>
                    <label>Dirección</label>
                </div>
                <div class="grupo">
                    <center><img id="photo" src="<?php echo $Fot?>" width="150px" height="160px"></center>

                    </div>

                </div>

                <div class="grupo">
                <input type="hidden" name="id_instalacion" id="id_instalación" required="" value="<?php echo $idinstalacion; ?>" ><span class="barra"></span>
                    

                </div>

                <div class="grupo">
                    <label for="tipo_componente"></label>

                    <?php
                                    $query_tipo = mysqli_query($mysqli, "SELECT d.id_componente, d.tipo FROM dispositivos d"); 
                                    $result_tipo = mysqli_num_rows( $query_tipo); 
                                ?>
                            <select name="tipo_componente" id="tipo_componente">

                                <?php 
                                    echo $option;
                                    if($result_tipo > 0){
                                        while ($Tpcm = mysqli_fetch_array($query_tipo)){
                                
                                ?>
                                        <option value="<?php echo $Tpcm["id_componente"] ?>"> <?php echo $Tpcm["tipo"] ?></option>
                                
                                <?php 
                                        }
                                    }
                                    
                                ?>
                        </select>


                </div>
            <button type="submit">Guardar</button>
            </div>

        </form>
    </section>

                    <!-- Content Row -->
                    <div class="row">

                    

                        <!-- Content Column MIRAR BIEN-->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

                        </div>
                    </div>

                </div> 

            </div>
            <!-- End of Main Content -->

            

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->


        

    </div>
    <!-- End of Page Wrapper -->

    

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>





    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>

</body>
</html>
