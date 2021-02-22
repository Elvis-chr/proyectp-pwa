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

    $sql_usuariostotal = mysqli_query($mysqli, "SELECT COUNT(*) total_usuarios FROM usuarios");

    $result_usuarios = mysqli_fetch_array($sql_usuariostotal);
    $total_usuarios = $result_usuarios['total_usuarios'];


    $sql_totalcamaras = mysqli_query($mysqli, "SELECT COUNT(*) total_camaras 
    FROM tb_camaras");

    $result_camara = mysqli_fetch_array($sql_totalcamaras);
    $total_registro = $result_camara['total_camaras'];


    $sql_totalalarma = mysqli_query($mysqli, "SELECT COUNT(*) total_alarma 
    FROM tb_alarmas");

    $result_alarma = mysqli_fetch_array($sql_totalalarma);
    $total_alarma = $result_alarma['total_alarma'];


    $totalReg = ($total_registro + $total_alarma);



    $query_alar = mysqli_query($mysqli, "SELECT Nombre, Apellido, id_alarma, usuario_id, calle, latitude, longitude, fecha, parroquia, barrio, nombre_alarma  
                                          FROM usuarios
                                          INNER JOIN tb_alarmas
                                          WHERE usuarios.id_usuario = tb_alarmas.usuario_id");

    $data_alar = [];

        while ($a = mysqli_fetch_assoc($query_alar)){

          $data_alar[] = $a;
        }


    $query = mysqli_query($mysqli, "SELECT Nombre, Apellido, id_camara, usuario_id, latitude, longitude, fecha, parroquia, barrio, institucion_camara, nombre_camara  
                                    FROM usuarios 
                                    INNER JOIN tb_camaras 
                                    WHERE usuarios.id_usuario = tb_camaras.usuario_id ");

    $data = [];

        while ($d = mysqli_fetch_assoc($query)){

          $data[] = $d;
        }

    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
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
    <title>Mapa SIG</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- 
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> -->
  <!-- este script pertenece a google map -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <!-- Estilos propios-->
  <link rel="stylesheet" href="css/estilo_form_edit.css">
  
  <style type="text/css">
                
                    #map{
                    height: 70vh;
                    width:160vh;
                    margin:auto;
                    }

              
</style>

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
    <!--
    <main role="main" class="container">
      <div class="jumbotron">
       
      </div>
    </main>    --> 
<br><br><br>
    <!-- TERMINA LA BARRA DE NAVEGACION -->
                <!-- Begin Page Content -->
<div class="container-fluid" >
       <br>
      <!-- Page Heading -->
      
      <div class="d-sm-flex align-items-center justify-content-between mb-4" >
          <h2 class="h3 mb-0 text-gray-800" class="mt-5" >SISTEMA DE INFORMACIÒN GEOGRÀFICA</h2>
           <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
             <i class="fas fa-download fa-sm text-white-50"></i> 
             
             Generar reporte
          </a>
      </div>
      <br>
      <!-- Content Row  botones de informacion -->
      <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total de camaras instaladas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_registro; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-camera fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total de alarmas instaladas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_alarma; ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-siren-on fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registro Total
                                            de camaras y alarmas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">    <?php echo $totalReg; ?></div>
                                                </div>
                                                <div class="col">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total de usuarios registrados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_usuarios;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      </div>  
           
<!-- Content Row  ubicacion del mapa -->
  <div class="container">
     <div class="row">
        <div class="col-md-12">
          <div class="form-group">           
              <label for="latitud"> Latitud</label>
              <input type="text" id="latitud"  class="form-group" > 
              
              <label for="longitud"> Longitud </label>
            <input type="text" id="longitud"  class="form-group" >
          </div>
        </div>        
      </div>

      <div class="row" >
        <div class="col-md-12" >
           <div id="map"> </div>
        </div>
      </div>       
  </div>          
  
</div>
  
<!-- Footer -->
 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; Your PWA 2020</span>
         </div>
     </div>
 </footer>
            <!-- End of Footer -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
   
   <!-- ****************************************************   -->
    <script>
  /*       
        function initMap() {
          const ubicacion = new localizacion(function() {
            const myLatLng = {lat: ubicacion.latitude, lng: ubicacion.longitude };
            var texto = '<p> <i class="fas fa-street-view"></i> <b>Instalador</b>: ${d.Nombre} ${d.Apellido}</p>'+
            ' <p> <i class="fas fa-street-view"></i> <b>Camara</b>: ${d.nombre_camara} </p> '+
            ' <p> <i class="fas fa-compass"></i>   <b>Fecha</b>: ${d.fecha}  </p>' +
            ' <p>   <i class="fas fa-compass"></i> <b>Parroquia</b>: ${d.parroquia} </p>' +
            ' <p>  <i class="fas fa-compass"></i>  <b>Barrio</b>: ${d.barrio}   </p>'   +
            '  <p>  <i class="fas fa-map-pin"></i> <b>Latitud y Longitud</b>: ${d.latitude} / ${d.longitude}  </p> ' +
            '  <p>  <i class="fas fa-map-pin"></i> <b>Institución</b>: ${d.institucion_camara} </p>'
                       
              const opciones = {
                center: myLatLng,
                zoom: 13
              }       
                    
              var map = document.getElementById("map");       
              const mapa =  new google.maps.Map(map,opciones);   
              const  marcador = new google.maps.Marker({
                position: myLatLng,
                map: mapa,
                draggable:true,
                title: "Camara",

              });
                     

          });
  }  */

  let map;

       function initMap() {
          const myLatLng = {lat:-0.966342, lng: -80.708485 };
        
          map = new google.maps.Map(document.getElementById("map"), {
            center: myLatLng,
            zoom: 13,
          }); 
              // agrego marcador desplasable draggable:true 
          marcador = new google.maps.Marker({
              position: myLatLng,
              map,
              draggable:true,
              title: "Hello World!",
          });
              // obtengo la posiciones y las envio a los imput 
            marcador.addListener('dragend',function(event) {
            document.getElementById('latitud').value = this.getPosition().lat();
            document.getElementById('longitud').value = this.getPosition().lng();
            
          })

        //  diseño de los marcadores para camara y alarma
        /* var iconoC = {
          url:"../../iconos/camara.png",
          size: new google.maps.Size(30, 30),
          // origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(-3, -76),
          scaledSize: new google.maps.Size(22, 94)
        };
         
        var iconoA = {
          url:"../../iconos/alarma.png",
          size: new google.maps.Size(30, 30),
          // origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(-3, -76),
          scaledSize: new google.maps.Size(22, 94)
        };
           */
          
        

  }); 

        
       
    </script>
      <!-- ****************************************************  -->
<!-- Link de mapa de google CON API -->
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDiXmKPLVa_fgC29whU7ySOU1E-qls3T4&callback=initMap">
   </script>
    <!-- Pertenece a leaflex -->
  <!--   <script>
                getLocation();


                  function getLocation() {
                    if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(showPosition);
                    } 
                  }

                  function showPosition(position) {

                    let lat = position.coords.latitude;
                    let long = position.coords.longitude;

                    var map = L.map('map', {
                    center: [ lat , long],
                    zoom: 13
                    });

                    var myIcon = L.icon({
                      iconUrl: '../../iconos/camara.png',
                      iconSize: [30, 30],
                      iconAnchor: [22, 94],
                      popupAnchor: [-3, -76],
                  });


                  var myIcon2 = L.icon({
                      iconUrl: '../../iconos/alarma.png',
                      iconSize: [30, 30],
                      iconAnchor: [22, 94],
                      popupAnchor: [-3, -76],
                  });

                    //L.marker([lat, long]).addTo(map);// Mi ubicacion
 

                    let data = <?php echo json_encode($data);?>

                    data.map(function(d) {
                      L.marker([d.latitude, d.longitude], {
                        icon: myIcon
                      }).addTo(map).bindPopup(`
                      <p>
                        <i class="fas fa-street-view"></i>
                        <b>Instalador</b>: ${d.Nombre}
                         ${d.Apellido}
                      </p>

                      <p>
                        <i class="fas fa-street-view"></i>
                        <b>Camara</b>: ${d.nombre_camara}
                      </p>
                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Fecha</b>: ${d.fecha}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Parroquia</b>: ${d.parroquia}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Barrio</b>: ${d.barrio}
                      </p>

                      <p>
                        <i class="fas fa-map-pin"></i>
                        <b>Latitud y Longitud</b>: ${d.latitude} /
                        ${d.longitude}
                      </p>

                      <p>
                        <i class="fas fa-map-pin"></i>
                        <b>Institución</b>: ${d.institucion_camara}
                      </p>
                      `);
                    });

                    let data_alar = <?php echo json_encode($data_alar);?>

                    data_alar.map(function(a) {
                      L.marker([a.latitude, a.longitude], {
                        icon:myIcon2
                      }).addTo(map).bindPopup(`
                      <p>
                        <i class="fas fa-street-view"></i>
                        <b>Instalador</b>: ${a.Nombre}
                         ${a.Apellido}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Fecha</b>: ${a.fecha}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Parroquia</b>: ${a.parroquia}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Barrio</b>: ${a.barrio}
                      </p>

                      <p>
                        <i class="fas fa-compass"></i>
                        <b>Nombre</b>: ${a.nombre_alarma}
                      </p>

                      <p>
                        <i class="fas fa-map-pin"></i>
                        <b>Latitud y Longitud</b>: ${a.latitude} /
                        ${a.longitude}
                      </p>

                      `);;
                    });

                    console.log(data);

                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

                  } 
          
          </script>
-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>