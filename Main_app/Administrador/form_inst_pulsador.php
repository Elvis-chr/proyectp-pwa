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
    if (empty($_POST['usuario_id']) || empty($_POST['alarma_id']) || empty($_POST['latitud']) || empty($_POST['longitud']) || empty($_POST['parroquia_pulsador']) || empty($_POST['circuito']) || empty($_POST['subcircuito']) || empty($_POST['barrio_pulsador']) || empty($_POST['calle_pulsador']) || empty($_POST['avenida_pulsador']) || empty($_POST['referencia_pulsador']) ||
    empty($_POST['año_adquisicion']) ||empty($_POST['fecha_pulsador']) || empty($_POST['hora_pulsador']) ||  empty($_POST['nombres_pulsante']) || empty($_POST['cedula_pulsante']) || empty($_POST['contacto_pulsador'])){ 
            
            $alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
    }else{ 
        $iduser = $_POST['usuario_id'];
        $idalarma = $_POST['alarma_id'];
        $Lat = $_POST['latitud'];
        $Lon = $_POST['longitud'];
        $Parro = $_POST['parroquia_pulsador'];
        $CircuitoP = $_POST['circuito'];
        $SubcircuitoP = $_POST['subcircuito'];
        $BarrioP = $_POST['barrio_pulsador'];
        $CalleP = $_POST['calle_pulsador'];
        $AvPulsador = $_POST['avenida_pulsador'];
        $Referencia = $_POST['referencia_pulsador'];
        $añoAdqui = $_POST['año_adquisicion'];
        $FechaP = $_POST['fecha_pulsador'];
        $Hora = $_POST['hora_pulsador'];        
        $NombreP = $_POST['nombres_pulsante'];
        $CedulaP = $_POST['cedula_pulsante'];
        $ContactoP = $_POST['contacto_pulsador'];


            $query_insertar = mysqli_query($mysqli, "INSERT INTO tb_pulsador (usuario_id, alarma_id, latitude, longitude, circuito_pulsador, subcircuito_pulsador, parroquia_pulsador, barrio_pulsador, calle_pulsador, avenida_pulsador, referencia_pulsador,periodo_adquisicion_pulsador,fecha_pulsador,
            hora_pulsador, nombres_pulsante, cedula_pulsante, contacto_pulsador)
                        VALUES('$iduser', '$idalarma', '$Lat', '$Lon', '$CircuitoP', '$SubcircuitoP', '$Parro', '$BarrioP', '$CalleP', '$AvPulsador', '$Referencia', '$añoAdqui', '$FechaP', '$Hora', '$NombreP', '$CedulaP',
                        '$ContactoP')");

                if($query_insertar){
                    $alert='<p class="msg_save"> Registro guardado correctamente... </p>';
                }else{
                    $alert='<p class="msg_error"> Error al guardar registro... </p>';
                }

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, 
    maximun-scale=1, minimun-scale=1">
    <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/logo.png">
	  <link rel="apple-touch-icon" href="./logo.png">
	  <link rel="apple-touch-startup-image" href="./logo.png">
	  <link rel="manifest" href="../.././manifest.json">
    
    <title>Registro de Instalciones</title>



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="stilo/formulario.css"> 
     <!-- estios propios -->
    <link rel="stylesheet" href="css/estilo_form_edit.css"> 
    <link rel="stylesheet" href="css/estilo_form_edit.css">
    
    
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
 
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
   <a class="navbar-brand" href="indexa.php">SegAPP</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="indexa.php">Inicio <span class="sr-only"></span></a>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span> Servicios </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a id=" hov" class="dropdown-item" href="leafle_map.php">Mapa GIS</a>
              <a  id=" hov" class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
              <a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a>
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
                      <i class="bi bi-caret-down-fill"></i>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                       <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
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
<br><br>

<!-- Content Row -->
<div class="container-fluid" >
    <div class="row" id="contenido_actualizar" >
      <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-body" > 
                     <div class="container">                     
                      <center>  <h2 class="mt-5"> REGISTRAR INSTALACIÓN DE PULSADOR </h2> </center>              
                      <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
                     
                      <div class="form" >
                      
                     <form class="row g-3 needs-validation" novalidate  action="" method="post" enctype="multipart/form-data">
                      <!-- ++++++++++++++++++++++++++++++ -->
                         <div class="col-md-12" >
                            <div id="color_separ_titu1">
                               <hr  class="hr_foto">
                                <center ><h4 class="titulo_pulsadores">Dirección del Pulsador</h4></center>
                               <hr  class="hr_foto">
                            </div>
                         </div>
                        <!-- ++++++++++++++++++++++++++++++ -->
                         <div class="col-md-4">
                           <label for="latitud" class="form-label">Latitud</label>
                           <input type="float" class="form-control" name="latitud" id="latitud" placeholder="" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="longitud" class="form-label">Longitud</label>
                           <input type="float" class="form-control" name="longitud" id="longitud" placeholder="" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4" >
                           <label for="longitude" class="form-label">Coordenadas</label>
                           <button type="button" class="button"  id="btn_cap_coor" onclick="initiate_geolocation();">Capturar </button>                        
                        <br>
                          </div>
                         
                           <!-- parroquia -->
                         <div class="col-md-6">                        
                           <label for="parroquia_pulsador" class="form-label">Parroquia</label>
                           
                                 <?php
                                     $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p"); 
                                     $result_parroquia = mysqli_num_rows( $query_parroquia);
                                 ?>
                             <select  name="parroquia_pulsador" id="parroquia_pulsador" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tparro = mysqli_fetch_array($query_parroquia)){
                                 
                                 ?>
                                         <option value="<?php echo $Tparro["id_parroquia"] ?>"> <?php echo $Tparro["nombre_parroquia"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select>                 
                         </div>

                         <!-- Alarma ID-->
                         <div class="col-md-6">
                           <label for="alarma_id" class="form-label">Alarma ID</label>
                                
                                 <?php                                  
                                   $query_idAlarm = mysqli_query($mysqli, "SELECT a.id_alarma, a.funcionario_responsable FROM tb_alarmas a"); 
                                   $result_idAlarm = mysqli_num_rows( $query_idAlarm);  
                                 ?>
                             <select  name="alarma_id" id="alarma_id" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($TAlarm = mysqli_fetch_array($query_idAlarm)){
                                 
                                 ?>
                                          <option value="<?php echo $TAlarm["id_alarma"] ?>"> <?php echo $TAlarm["id_alarma"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select>  
                                               
                         </div> 
                                                                                   
                            <!-- SUB-CIRCUITO -->
                        <div class="col-md-6">
                        <label for="circuito" class="form-label">Circuito</label>
                             
                        <?php
                                    $query_circuito = mysqli_query($mysqli, "SELECT c.id_circuito, c.parroquia_id, c.nombre, p.id_parroquia FROM tb_circuito c
                                                      INNER JOIN tb_parroquia p ON p.id_parroquia = c.parroquia_id"); 
                                    $result_circuito = mysqli_num_rows( $query_circuito); 
                              ?>
                          <select  name="circuito" id="circuito" class="form-select"  required><span class="barra">
                                     <option value="">Seleccione una opción</option>
                              <?php
                                  
                                      while ($Tcircuito = mysqli_fetch_array($query_circuito)){
                              
                              ?>
                                    <option value="<?php echo $Tcircuito["id_circuito"] ?>"><?php echo $Tcircuito["nombre"] ?></option>
                              
                              <?php 
                                      }                      
                              ?>
                         </select>                      
                      </div>  

                      <div class="col-md-6">
                           <label for="subcircuito" class="form-label">Subcircuito</label>
                                
                                 <?php
                                     $query_subcircuito = mysqli_query($mysqli, "SELECT s.id_subcircuito, s.circuito_id, s.nombre_subcircuito, c.id_circuito FROM tb_subcircuito s
                                                        INNER JOIN tb_circuito c ON s.circuito_id = c.id_circuito"); 
                                     $result_subcircuito = mysqli_num_rows( $query_subcircuito); 
                                 ?>
                             <select  name="subcircuito" id="subcircuito" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tsubcircuito = mysqli_fetch_array($query_subcircuito)){
                                 
                                 ?>
                                       <option value="<?php echo $Tsubcircuito["id_subcircuito"] ?>"><?php echo $Tsubcircuito["nombre_subcircuito"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select> 
                        </div>

                          <div class="col-md-4">
                           <label for="barrio_pulsador" class="form-label">Barrio</label>    
                           <input type="text" class="form-control" name="barrio_pulsador" id="barrio_pulsador" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="calle_pulsador" class="form-label"> Calle </label>
                           <input type="text" class="form-control" name="calle_pulsador" id="calle_pulsador" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="avenida_pulsador" class="form-label"> Avenida </label>
                           <input type="text" class="form-control" name="avenida_pulsador" id="avenida_pulsador" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="referencia_pulsador" class="form-label"> Referencia </label>
                           <input type="text" class="form-control" name="referencia_pulsador" id="referencia_pulsador" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                        <!-- ++++++++++++++++++++++++++++++ -->
                         <div class="col-md-12">
                             <div id="color_separ_titu1">
                              <hr  class="hr_foto">
                                <center><h4 class="titulo_pulsadores">Fecha</h4></center>
                              <hr  class="hr_foto">
                            </div>
                         </div>
                        <!-- ++++++++++++++++++++++++++++++ -->
                        <div class="col-md-4">
                           <label for="año_adquisicion" class="form-label"> Año de adquisición </label>
                           <input type="date" class="form-control" name="año_adquisicion" id="año_adquisicion" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="fecha_pulsador" class="form-label"> Fecha </label>
                           <input type="date" class="form-control" name="fecha_pulsador" id="fecha_pulsador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="hora_pulsador" class="form-label"> Hora de Instalación </label>
                           <input type="time" class="form-control" name="hora_pulsador" id="hora_pulsador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <!-- ++++++++++++++++++++++++++++++ -->
                        <div class="col-md-12">
                            <div id="color_separ_titu1">
                              <hr  class="hr_foto">
                               <center><h4 class="titulo_pulsadores">Datos Complementarios</h4></center>
                               <hr  class="hr_foto">
                            </div>
                         </div>
                        <!-- ++++++++++++++++++++++++++++++ -->
                       
                          <div class="col-md-4">
                           <label for="nombres_pulsante" class="form-label"> Nombres y Apellidos</label>
                           <input type="text" class="form-control" name="nombres_pulsante" id="nombres_pulsante" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="cedula_pulsante" class="form-label"> Cédula </label>
                           <input type="text" class="form-control" name="cedula_pulsante" id="cedula_pulsante" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="contacto_pulsador" class="form-label"> Télefono </label>
                           <input type="tel" pattern="[0-9]{10}"  class="form-control" name="contacto_pulsador" id="contacto_pulsador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>
                  
                        <div class="col-md-4">   
                            <input type="hidden" name="usuario_id" id="usuario_id" required="" value="<?php echo$result['id_usuario']; ?>" ><span class="barra"></span>
                        </div>

                        <div class="col-12">
                           <br>             
                           <button class="btn btn-primary"  type="submit">Guardar</button> 
                           <a class="btn btn-danger" href="registros_de_instalaciones.php" role="button">Cancelar</a>
                       
                     </div>
                                               
                    </form><br>
                   
                   </div>
                  </div>
                </div>  
             </div>   
           </div>   
      </div>                             
</div>


 
<script>

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
'use strict'

// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
.forEach(function (form) {
  form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    }

    form.classList.add('was-validated')
  }, false)
})
})()
</script>


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
   
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>

