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
  if (empty($_POST['usuario_id']) || empty($_POST['latitud']) || empty($_POST['longitud']) || empty($_POST['parroquia_alarma']) || empty($_POST['circuito']) || empty($_POST['subcircuito']) || empty($_POST['tipo_via']) || empty($_POST['barrio_sector']) || empty($_POST['calle_alarma']) || empty($_POST['avenida_alarma']) || empty($_POST['referencia']) || empty($_POST['periodo_adquisicion']) || 
  empty($_POST['fecha_alarma']) || empty($_POST['hora_instalacion']) || empty($_FILES['foto'])  ||  empty($_POST['funcionario_responsable']) || empty($_POST['morador_solicito']) || empty($_POST['cedula_morador']) ||   empty(
      $_POST['telefono_morador']) || empty($_POST['estado_alarma'])){ 
          
          $alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
  }else{ 
      $iduser = $_POST['usuario_id'];
      $Lat = $_POST['latitud'];
      $Lon = $_POST['longitud'];
      $Parro = $_POST['parroquia_alarma'];
      $CircuitoAlarm = $_POST['circuito'];
      $Subcircuito = $_POST['subcircuito'];
      $Tipovia = $_POST['tipo_via'];
      $BarrioSector = $_POST['barrio_sector'];
      $CalleAlarm = $_POST['calle_alarma'];
      $Avalarma = $_POST['avenida_alarma'];
      $Referencia = $_POST['referencia'];
      $Periodo = $_POST['periodo_adquisicion'];
      $FechaAlarm = $_POST['fecha_alarma'];
      $Hora = $_POST['hora_instalacion'];
      
      $nombreimg=$_FILES['foto']['name']; //imagen
      $Fot=$_FILES['foto']['tmp_name']; //imagen
      $ruta="../imagen_alarm";                 //imagen
      $ruta=$ruta."/".$nombreimg;        //imagen
      move_uploaded_file($Fot,$ruta);    //imagen
      
      $Funcionario = $_POST['funcionario_responsable'];
      $NombreSolicit = $_POST['morador_solicito'];
      $CedulaMorador = $_POST['cedula_morador'];
      $ContactoMorador = $_POST['telefono_morador'];
      $EstadoAlarm = $_POST['estado_alarma'];

          $query_insertar = mysqli_query($mysqli, "INSERT INTO tb_alarmas (usuario_id, circuito, subcircuito, parroquia_alarma, barrio_sector, tipo_via, calle_alarma, avenida_alarma, referencia, latitude, longitude,
          periodo_adquisicion, fecha_alarma, hora_instalacion, funcionario_responsable, foto_alarma, morador_solicito, cedula_morador, telefono_morador, estado_alarma)
                      VALUES('$iduser', '$CircuitoAlarm', '$Subcircuito', '$Parro', '$BarrioSector', '$Tipovia', '$CalleAlarm', '$Avalarma', '$Referencia', '$Lat', '$Lon', '$Periodo', '$FechaAlarm', '$Hora', '$Funcionario',
                      '$ruta', '$NombreSolicit', '$CedulaMorador' , '$ContactoMorador' , '$EstadoAlarm')");

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

            var latitud = pos.coords.latitude;
            var longitud = pos.coords.longitude;
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
                      <center>  <h2 class="mt-5"> REGISTRAR INSTALACIÓN DE ALARMA </h2> </center>              
                      <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
                     
                      <div class="form" >
                      
                     <form class="row g-3 needs-validation" novalidate  action="" method="post" enctype="multipart/form-data">
                      <!-- ++++++++++++++++++++++++++++++ -->
                         <div class="col-md-12" >
                            <div id="color_separ_titu">
                               <hr  class="hr_foto">
                                <center ><h4 class="titulo_pulsadores">Dirección de alarmas</h4></center>
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
                         <div class="col-md-3">                        
                           <label for="parroquia_alarma" class="form-label" id="parr_stilo">Parroquia</label>
                           
                                 <?php
                                    $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p");
                                    $result_parroquia = mysqli_num_rows($query_parroquia); 
                                 ?>
                             <select  name="parroquia_alarma" id="parroquia_alarma" class="form-select"  required><span class="barra">
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

                         <!-- CIRCUITO -->
                         <div class="col-md-3">
                           <label for="circuito" class="form-label" id="parr_stilo">Circuito</label>
                                
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
                                                                                   
                            <!-- SUB-CIRCUITO -->
                        <div class="col-md-3">
                        <label for="subcircuito" class="form-label" id="parr_stilo">Subcircuito</label>
                             
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

                      <div class="col-md-3">
                           <label for="tipo_via" class="form-label" id="parr_stilo">Tipo vía</label>
                                
                                 <?php
                                    $query_via = mysqli_query($mysqli, "SELECT v.id_via, v.nombre_tipovia FROM tb_via v"); 
                                    $result_via = mysqli_num_rows( $query_via); 
                                 ?>
                             <select  name="tipo_via" id="tipo_via" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tvia = mysqli_fetch_array($query_via)){
                                 
                                 ?>
                                      <option value="<?php echo $Tvia["id_via"] ?>"> <?php echo $Tvia["nombre_tipovia"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select> 
                        </div>

                          <div class="col-md-4">
                           <label for="barrio_sector" class="form-label"  id="parr_stilo">Barrio</label>    
                           <input type="text" class="form-control" name="barrio_sector" id="barrio_sector" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="calle_alarma" class="form-label"  id="parr_stilo" > Calle </label>
                           <input type="text" class="form-control" name="calle_alarma" id="calle_alarma" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="avenida_alarma" class="form-label"  id="parr_stilo"> Avenida </label>
                           <input type="text" class="form-control" name="avenida_alarma" id="avenida_alarma" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="referencia" class="form-label"  id="parr_stilo"> Referencia </label>
                           <input type="text" class="form-control" name="referencia" id="referencia" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                        <!-- ++++++++++++++++++++++++++++++ -->
                         <div class="col-md-12">
                             <div id="color2_separ_titu">
                              <hr  class="hr_foto">
                                <center><h4 class="titulo_pulsadores">Fecha</h4></center>
                              <hr  class="hr_foto">
                            </div>
                         </div>
                        <!-- ++++++++++++++++++++++++++++++ -->
                        <div class="col-md-4">
                           <label for="periodo_adquisicion" class="form-label"> Año de adquisición </label>
                           <input type="date" class="form-control" name="periodo_adquisicion" id="periodo_adquisicion" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="fecha_alarma" class="form-label"> Fecha </label>
                           <input type="date" class="form-control" name="fecha_alarma" id="fecha_alarma" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="hora_instalacion" class="form-label"> Hora de Instalación </label>
                           <input type="time" class="form-control" name="hora_instalacion" id="hora_instalacion" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <!-- ++++++++++++++++++++++++++++++ -->
                        <div class="col-md-12">
                            <div id="color3_separ_titu">
                              <hr  class="hr_foto">
                               <center><h4 class="titulo_pulsadores">Datos Complementarios</h4></center>
                               <hr  class="hr_foto">
                            </div>
                         </div>
                        <!-- ++++++++++++++++++++++++++++++ -->
                        <!-- agregar foto -->
                        <div class="col-md-8">
                             <hr class="hr_foto">
                            <div class="subir_foto">                                                        
                               <div class="col-md-4" >
                                 <label for="foto" class="form-label">Foto</label>
                                 <input type="file" name="foto" id="foto"  accept="image/x-png,image/jpeg" required >
                               </div>                         
                             </div>
                             <hr class="hr_foto">
                         </div>

                        <div class="col-md-4">
                             
                             <center> <img id="photo" alt="Agregar foto"></center>
                                       
                          <script>
                                 const photo = document.querySelector('#photo');
                                 const camera = document.querySelector('#foto');
                                 camera.addEventListener('change', function(e) {
                                     photo.src = URL.createObjectURL(e.target.files[0]);
                                 });
                         </script>                        
                        </div>
                        <!-- TERMINA agregar foto -->

                        <div class="col-md-4">
                           <label for="funcionario_responsable" class="form-label">Funcionario Responsable </label>
                                
                                 <?php
                                     $query_funcionario = mysqli_query($mysqli, "SELECT f.nombres_apellidos, f.id_funcionario FROM tb_funcionarios f"); 
                                     $result_funcionario = mysqli_num_rows( $query_funcionario); 
                                 ?>
                             <select  name="funcionario_responsable" id="funcionario_responsable" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tfuncionario = mysqli_fetch_array($query_funcionario)){
                                 
                                 ?>
                                      <option value="<?php echo $Tfuncionario["id_funcionario"] ?>"> <?php echo $Tfuncionario["nombres_apellidos"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select> 
                          </div>

                          <div class="col-md-4">
                           <label for="morador_solicito" class="form-label"> Morador Solicitante </label>
                           <input type="text" class="form-control" name="morador_solicito" id="morador_solicito" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="cedula_morador" class="form-label"> Cédula Morador </label>
                           <input type="text" class="form-control" name="cedula_morador" id="cedula_morador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="telefono_morador" class="form-label"> Télefono Morador </label>
                           <input type="text" class="form-control" name="telefono_morador" id="telefono_morador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="telefono_morador" class="form-label"> Télefono Morador </label>
                           <input type="text" class="form-control" name="telefono_morador" id="telefono_morador" required><span class="barra"></span>
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                        </div>

                        <div class="col-md-4">
                           <label for="estado_alarma" class="form-label">Estado de la Alarma </label>
                                
                                 <?php
                                     $query_ficha = mysqli_query($mysqli, "SELECT e.id_estado, e.descripcion FROM estado_ficha e"); 
                                     $result_ficha = mysqli_num_rows( $query_ficha);  
                                 ?>
                             <select name="estado_alarma" id="estado_alarma" class="form-select"  required><span class="barra">
                                        <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tficha = mysqli_fetch_array($query_ficha)){
                                 
                                 ?>
                                      <option value="<?php echo $Tficha["id_estado"] ?>"> <?php echo $Tficha["descripcion"] ?></option>
                                 
                                 <?php 
                                         }                      
                                 ?>
                            </select> 
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

