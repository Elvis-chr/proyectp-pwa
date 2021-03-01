<?php 
  require("../conexion.php");
  session_start();                    

  if(isset($_SESSION['usuario'])){

      if($_SESSION['usuario']['rol_id'] != "1"){
          header("Location: ../Operador/indexo.php") && 
          header("Location: ../Estandar/indexe.php");
      }        
  }else{
      header('Location: ../../index.php');
  }

// Foto de perfil
  $userLogin = $_SESSION['usuario'];
  $result = $userLogin;

  // consulta para los marcadores y ventana de información
  $query_alar = mysqli_query($mysqli, "SELECT * FROM tb_alarmas");
  $query_alar2 = mysqli_query($mysqli, "SELECT * FROM tb_alarmas");


?>

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
   
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
	  <link rel="apple-touch-icon" href="../.././img/logo.png">
	  <link rel="apple-touch-startup-image" href="../.././img/logo.png"> 
	  <link rel="manifest" href="../.././manifest.json">
    <link rel="stylesheet" href="css/estilo_form_edit.css">  
    <title>Mapa</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/estilo_form_edit.css">

  <!-- Estilo del mapa  -->
    <style>
      
      #mapCanvas { width: 100%; height: 750px;}
      
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDiXmKPLVa_fgC29whU7ySOU1E-qls3T4"></script>
  <script>
     function initMap() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };

        // Muestra el mapa en la pagina web
        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
        map.setTilt(100);

        // Multiple marcadores utilizando latitud y longitud
        var markers = [
            <?php if($query_alar->num_rows > 0){ 
                while($row = $query_alar->fetch_assoc()){ 
                    echo '["'.$row['barrio_sector'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['calle_alarma'].'"],'; 
                } 
            } 
            ?>
        ];

        // Contenido de las ventana de información
        var infoWindowContent = [
            <?php if( $query_alar2->num_rows > 0){ 
                while($row =  $query_alar2->fetch_assoc()){ ?>
                    ['<div class="info_content">' +
                    '<h3><?php echo $row['barrio_sector']; ?></h3>' +
                    '<p><?php echo $row['calle_alarma']; ?></p>' + '</div>'],
            <?php } 
            } 
            ?>
        ];

        // Agregar multiples marcadores en el mapa 
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // para la ubicación del marcador en el mapa  
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,   
			// icon: markers[i][3],
                title: markers[i][0]
            });

            // agrego la información a la ventana info de los marcadores   
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));   

            // centar mapa
            map.fitBounds(bounds);
        }   

        // nivel de zoom
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(13);
            google.maps.event.removeListener(boundsListener);
        });
     }    

      // Iniciar la funcion de mapa
      google.maps.event.addDomListener(window, 'load', initMap);
  </script>

  </head>

<html>
  <body>
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
              <a id=" hov" class="dropdown-item" href="lista_actividades.php">Actividades</a>
              <a  id=" hov" class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
              <a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a>
              <a class="dropdown-item" href="registrar_funcionario.php">Funcionarios</a>
              <a class="dropdown-item" href="registros_de_camaras.php">Cámaras</a>
              <a class="dropdown-item" href="lista_alarmas.php">Alarmas</a>
              <a class="dropdown-item" href="lista_pulsadores.php">Pulsadores</a>
              <a class="dropdown-item" href="lista_circuitos.php">Circuitos</a>
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
                            <img src="<?php echo $result['foto_usuarios']; ?>" alt="Agregar foto" width="30px" height="30px" class="img-profile rounded-circle">
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
   

   <div id="mapContainer">
      <div id="mapCanvas">    
      </div>
  </div>
  

  
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