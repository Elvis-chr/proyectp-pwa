<?php
    session_start();                    

    if(isset($_SESSION['usuario'])){

        if($_SESSION['usuario']['rol_id'] != "3"){
            header("Location: ../Administrador/indexa.php") && 
            header("Location: ../Operador/indexo.php");
        }        
    }else{
        header('Location: ../../index.php');
	}
	

    include "../conexion.php"; 
    
    $query = mysqli_query($mysqli, "SELECT Nombre, Apellido, id_camara, usuario_id, latitude, longitude, fecha, parroquia, barrio, institucion_camara, nombre_camara  
                                    FROM usuarios 
                                    INNER JOIN tb_camaras 
                                    WHERE usuarios.id_usuario = tb_camaras.usuario_id ");

    $data = [];

        while ($d = mysqli_fetch_assoc($query)){

          $data[] = $d;
        }

?>
<!Doctype html>
<!DOCTYPE html>
<html>
<head>
	<title>	MENU APP	</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="stilo/style.css">
  
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 
  

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  




	<meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
	  <link rel="apple-touch-icon" href="../.././img/logo.png">
	  <link rel="apple-touch-startup-image" href="../.././img/logo.png">
    <link rel="manifest" href="../.././manifest.json">
    

    <style type="text/css">

    /* INICIO MENUS */
    /* FIN MENUS */

    /*inicio leaflet*/
                .leaflet-control-attribution{
                    display:none
                }
                    #map{
                      width: 100%;
                      height: 500px;
                      box-shadow: 5px 5px 5px #888;
                    }
    /*FIN leaflet*/
      </style>


</head>
<body>

	<section class="cabecera_fija_uno" >
		<div class="barra_presentativa">
			<h1 class="heading">Seguridad ciudadana</h1>
		</div>
	</section>

	<section class="cabecera_fija">
		<div class="nav">
			<ul>
				<li>
					<a href="indexe.php"><div class="fa fa-user "></div></a>
				</li>

				<li>
					<a href="registrar_instalacion.php"><div class="fa fa-briefcase "></div></a>
				</li>

				<li>
					<a href="registros_camara.php"><span class="fa fa-sticky-note "></span></a>
				</li>

				<li>
					 <a href="leaflet_mapa.php"><div class="fa fa-globe "></div></a>
				</li>

				<li>
					 <a href="#"><div class="fa fa-users "></div></a>
				</li>

				<li>
					<a href="../salir.php"><div class="fa fa-sign-out "></div></a>
				</li>
			</ul>
		</div>
	</section>

  
  <section class="contenido"  >
    <br>
		<div class="barra_mapa">
      <center>
    <a href="leaflet_mapa.php" class="btn_new"> General</a>
    <a href="leaflet_mapa_camaras.php" class="btn_new">Camaras</a>
    <a href="leaflet_mapa_alarmas.php" class="btn_new">Alarmas</a>
      </center>
    </div>
	</section>
	<section class="mapa_gis" >
        <div id="map"></div>
  </section>

    
    <script>
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
                    zoom: 15
                    });

                    var myIcon = L.icon({
                      iconUrl: '../../iconos/camara.png',
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

                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

                  } 
          
    </script>

 <script src="../scriptsw/script.js"></script>

</body>
</html>





