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
        if (empty($_POST['usuario_id']) || empty($_POST['latitud']) || empty($_POST['longitud']) || empty($_POST['calle_av']) || empty($_POST['fecha']) || empty($_POST['parroquia']) || empty($_POST['barrio']) || empty($_POST['institucion_camara']) || empty($_FILES['foto'])  || empty(
            $_POST['nombre_camara']) || empty($_POST['tipo_camara']) || empty($_POST['marca_camara']) || empty($_POST['modelo_camara']) || empty($_POST['megafonia']) || empty($_POST['storage']) || empty($_POST['usuario_camara'])|| empty(
            $_POST['contraseña_camara']) || empty($_POST['ip_camara']) || empty($_POST['puerto_camara']) || empty($_POST['puerta_enlace']) || empty($_POST['mascara_camara']) || empty($_POST['mac_camara']) || empty($_POST['piloto_camara']) || empty($_POST['estado_camara']) ){ 
                
                $alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
        }else{ 
        
    
            $Lat = $_POST['latitud'];
            $Lon = $_POST['longitud'];
            $calle = $_POST['calle_av'];
            $Fech = $_POST['fecha'];
            $Parro = $_POST['parroquia'];
            $Barrio = $_POST['barrio'];
            $institucion = $_POST['institucion_camara'];
            $nombreimg=$_FILES['foto']['name']; //imagen
            $Fot=$_FILES['foto']['tmp_name']; //imagen
            $ruta="../imag_reg";                 //imagen
            $ruta=$ruta."/".$nombreimg;        //imagen
            move_uploaded_file($Fot,$ruta);    //imagen
    
            $nombre = $_POST['nombre_camara'];
            $tipo = $_POST['tipo_camara'];
            $marca = $_POST['marca_camara'];
            $modelo = $_POST['modelo_camara'];
            $megafono = $_POST['megafonia'];
            $storage = $_POST['storage'];
            $usuarioCamera = $_POST['usuario_camara'];
            $contraseñaCamera = $_POST['contraseña_camara'];
            $IPCamera = $_POST['ip_camara'];
            $PuertoCamera = $_POST['puerto_camara'];
            $PuertaEnlace = $_POST['puerta_enlace'];
            $mascara = $_POST['mascara_camara'];
            $mac = $_POST['mac_camara'];
            $piloto = $_POST['piloto_camara'];
            $estadoFicha = $_POST['estado_camara'];
            $iduser = $_POST['usuario_id'];
    
    
                $query_insertar = mysqli_query($mysqli, "INSERT INTO tb_camaras (usuario_id, latitude, longitude, calle_av, fecha, parroquia, barrio, foto, institucion_camara, nombre_camara, tipo_camara,
                marca_camara, modelo_camara, megafonia, storage, usuario_camara, contraseña_camara, ip_Camara, puerto_camara, puerta_enlace, mascara_Camara, mac_camara, piloto_camara, estado_camara)
                            VALUES('$iduser','$Lat', '$Lon', '$calle', '$Fech', '$Parro', '$Barrio', '$ruta', '$institucion'  , '$nombre' , '$tipo' , '$marca'
                            , '$modelo' , '$megafono' , '$storage' , '$usuarioCamera' , '$contraseñaCamera' , '$IPCamera' , '$PuertoCamera' , '$PuertaEnlace'
                            , '$mascara' , '$mac' , '$piloto', '$estadoFicha')");
    
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
<br><br><br>
 
    <!-- iNICIA EL CUERPO DE LA PAGINA  -->



<!-- Content Row -->
<div class="container-fluid" >
    <div class="row" id="contenido_actualizar" >
      <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-body" > 
                     <div class="container">
                     
                      
                     <center>  <h2 class="mt-5"> REGISTRAR INSTALACIÓN DE CÁMARA </h2> </center><br><hr class="hr_foto">

                     
                     <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
                     <div class="form" > 
                     <form class="row g-3 needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                     
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
                           <button type="button" class="button"  id="btn_cap_coor" onclick="initiate_geolocation();">Capturar Coordenadas</button>                        
                         </div>
                         
                         <div class="col-md-4">
                           <label for="calle_av" class="form-label">Calle</label>
                           <input type="text" class="form-control" name="calle_av" id="calle_av" placeholder="Calle - Avenida" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="fecha" class="form-label">Fecha</label>
                           <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Nombre de usuario" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                            <!-- parroquia -->
                         <div class="col-md-4">
                           <label for="institucion_camara" class="form-label">Parroquia</label>
                                
                                 <?php
                                    $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p");
                                    $result_parroquia = mysqli_num_rows($query_parroquia); 
                                 ?>
                             <select  name="parroquia" id="parroquia" class="form-select"  required><span class="barra">
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
                         
                         <div class="col-md-4">
                           <label for="barrio" class="form-label">Barrio</label>
                           <input type="text" class="form-control" name="barrio" id="barrio" placeholder="Nombre del barrio" required><span class="barra">
                           
                         </div>
                            <!-- Institucion -->
                         <div class="col-md-4">
                           <label for="institucion_camara" class="form-label">Institución Reponsable</label>
                                
                                 <?php
                                      $query_tipo = mysqli_query($mysqli, "SELECT i.id_institucion, i.nombre FROM tb_institucion_cam i"); 
                                      $result_tipo = mysqli_num_rows( $query_tipo);  
                                 ?>
                             <select  name="institucion_camara" id="institucion_camara" class="form-select" id="validationDefault04" required><span class="barra">
                                       <option value="">Seleccione una opción</option>
                                 <?php
                                     
                                         while ($Tpcm = mysqli_fetch_array($query_tipo)){
                                 
                                 ?>
                                        <option value="<?php echo $Tpcm["id_institucion"] ?>"> <?php echo $Tpcm["nombre"] ?></option>
                                 
                                 <?php 
                                         }
                                    
                                 ?>
                            </select>                                                     
                         </div>

                         <div class="col-md-4">
                            
                         </div>

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
                           <label for="nombre_camara" class="form-label">Nombre de cámara </label>
                           <input type="text" class="form-control" name="nombre_camara" id="nombre_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="tipo_camara" class="form-label">Tipo de cámara </label>
                           <input type="text" class="form-control" name="tipo_camara" id="tipo_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="marca_camara" class="form-label"> Marca de cámara </label>
                           <input type="text" class="form-control" name="marca_camara" id="marca_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="modelo_camara" class="form-label"> Modelo de cámara </label>
                           <input type="text" class="form-control" name="modelo_camara" id="modelo_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="megafonia" class="form-label"> Megafonía </label>
                           <input type="text" class="form-control" name="megafonia" id="megafonia"  required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="storage" class="form-label"> Storage Cámara </label>
                           <input type="text" class="form-control" name="storage" id="storage"  required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="usuario_camara" class="form-label"> Usuario Cámara</label>
                           <input type="text" class="form-control" name="usuario_camara" id="usuario_camara"  required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="contraseña_camara" class="form-label">Contraseña de cámara</label>
                           <input type="password" class="form-control" name="contraseña_camara" id="contraseña_camara" placeholder="*************" required><span class="barra">
                           <div class="invalid-feedback">
                              Proporcione una contraseña válida..
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="ip_camara" class="form-label">IP Cámara</label>
                           <input type="text" class="form-control" name="ip_camara" id="ip_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="puerto_camara" class="form-label">Puerto Cámara</label>
                           <input type="number" class="form-control" name="puerto_camara" id="puerto_camara"  required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="puerta_enlace" class="form-label">Puerta de enlace</label>
                           <input type="text" class="form-control" name="puerta_enlace" id="puerta_enlace" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="mascara_camara" class="form-label">Máscara IP Cámara</label>
                           <input type="text" class="form-control" name="mascara_camara" id="mascara_camara"  required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="mac_camara" class="form-label">Mac de Cámara</label>
                           <input type="text" class="form-control" name="mac_camara" id="mac_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="piloto_camara" class="form-label">Piloto de Cámara</label>
                           <input type="text" class="form-control" name="piloto_camara" id="piloto_camara" required><span class="barra">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                        <div class="col-md-4">
                           <label for="estado_camara" class="form-label">Estado de Cámara</label>
                                
                                 <?php
                                     $query_ficha = mysqli_query($mysqli, "SELECT e.id_estado, e.descripcion FROM estado_ficha e"); 
                                     $result_ficha = mysqli_num_rows( $query_ficha); 
                                 ?>
                             <select  name="estado_camara" id="estado_camara" class="form-select" id="validationDefault04" required><span class="barra">
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
                          <!-- <input type="submit" value="Crear usuario" class="btn_save">  -->
                           <!-- <button  class="btn btn-primary"  type="submit" onclik="exitoso()" >Crear usuario</button> -->
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

