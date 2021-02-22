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

  $userLogin = $_SESSION['usuario'];
  $result = $userLogin;
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar instalación</title>
    

	<link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

     	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="stilo/style.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 
    
    <meta name="theme-color" content="#19908D">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
    <link rel="apple-touch-icon" href="../.././img/logo.png">
    <link rel="apple-touch-startup-image" href="../.././img/logo.png">
    <link rel="manifest" href="../.././manifest.json">

    <!-- Edita Todo el diseño del la APP-->
    <link rel="stylesheet" href="stilo/style.css">
    <!-- Edita la barra superior-->
    <link rel="stylesheet" href="stilo/formulario.css"> 
   

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


    
    <section class="contenido" ><br>
    <br>
        
                <div>
                <br>
                <center>
                    <a class="btn_registros"  href="camaras.php">CÁMARAS</a>
                </center>
                </div>
                <br><br>
                <div> 
                <center>
                    <a class="btn_registros"  href="alarmas.php">ALARMAS</a>
                </center>
                </div>
                <br>
                
                <div>
                <br>
                <center>
                    <a class="btn_registros"  href="pulsador.php">PULSADOR</a>
                </center>
                </div>
    </section>


    <script src="../scriptsw/script.js"></script>
</body>
</html>