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


//Mostrar Datos

if(empty($_GET['id_alarma'])){
    header('Location: registros_alarmas.php');
}

$idalarma = $_GET['id_alarma'];

$sql = mysqli_query($mysqli,"SELECT a.id_alarma, a.usuario_id, a.calle, a.latitude, a.longitude, a.foto_alarma, a.fecha, a.parroquia, a.barrio, a.nombre_alarma, a.tipo_alarma,
a.marca_alarma, a.modelo_alarma, a.nombres_pulsante, a.cedula_pulsante, a.contacto_pulsante, a.direccion_pulsante, a.foto_Cedula 
                            FROM  tb_alarmas a 
                            WHERE id_alarma = $idalarma");

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('Location: registros_alarmas.php');
}else{
    $option = '';
    while($data = mysqli_fetch_array($sql)){
        $idalarma   = $data['id_alarma'];
        $idusuario   = $data['usuario_id'];
        $calle   = $data['calle'];
        $latitud   = $data['latitude'];
        $longitud   = $data['longitude'];
        $foto   = $data['foto_alarma'];
        $fecha   = $data['fecha'];
        $parroquia   = $data['parroquia'];
        $barrio   = $data['barrio'];
        $nombreAlar   = $data['nombre_alarma'];
        $tipoAlar   = $data['tipo_alarma'];
        $marcaAlar   = $data['marca_alarma'];
        $modeloAlar   = $data['modelo_alarma'];

        $nombresApell   = $data['nombres_pulsante'];
        $cedula   = $data['cedula_pulsante'];
        $contacto   = $data['contacto_pulsante'];
        $direccion   = $data['direccion_pulsante'];
        $fotoCed   = $data['foto_Cedula'];

  }
}   




 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stilo/formulario.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="stilo/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 



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

    <section class="cabecera_fija_uno">
		<div class="barra_presentativa_uno">
			<ul>
				<li>
					<a class="regresar" href="registros_alarmas.php"><i class="fa fa-arrow-left regresar"> Regresar</i></a>
				</li>
			</ul>
		</div>
    </section>

    <section class="contenido_actualizar" >
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <h1>Instalación de alarmas</h1>
                <div class="grupo">
                    <input type="float" name="latitud" id="latitud" value="<?php echo $latitud; ?>"  required><span class="barra"></span>
                    <label>Latitud</label>
                </div>
                <div class="grupo">
                    <input type="float" name="longitud" id="longitud" value="<?php echo $longitud; ?>" required><span class="barra" ></span>
                    <label>Longitud</label>
                </div>

                <div>
                <button type="button" class="button" onclick="initiate_geolocation();">Capturar Coordenadas</button>
                </div>

                <div class="grupo">
                    <input type="text" name="calle" id="calle" value="<?php echo $calle; ?>" required><span class="barra"></span>
                    <label>Calle - Avenida</label>
                </div>

                <div class="grupo">
                    <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>" required><span class="barra"></span>
                    <label>Fecha</label>
                </div>

                <div class="grupo">
                    <input type="text" name="parroquia" id="parroquia" value="<?php echo $parroquia; ?>" required><span class="barra"></span>
                    <label>Parroquia</label>
                </div>

                <div class="grupo">
                    <input type="text" name="barrio" id="barrio" value="<?php echo $barrio; ?>" required><span class="barra"></span>
                    <label>Barrio</label>
                </div>


                <div class="grupo">
                    <center><img id="photo" alt="Agregar foto" src="<?php echo $foto; ?>"></center><br>
                </div>

                <div class="grupo">
                    <input type="text" name="nombre_alarma" id="nombre_alarma" value="<?php echo $nombreAlar; ?>" required><span class="barra"></span>
                    <label>Nombre de Alarma</label>
                </div>

                <div class="grupo">
                    <input type="text" name="tipo_alarma" id="tipo_alarma" value="<?php echo $tipoAlar; ?>" required><span class="barra"></span>
                    <label>Tipo de Alarma</label>
                </div>

                <div class="grupo">
                    <input type="text" name="marca_alarma" id="marca_alarma" value="<?php echo $marcaAlar; ?>" required><span class="barra"></span>
                    <label>Marca de alarma</label>
                </div>

                <div class="grupo">
                    <input type="text" name="modelo_alarma" id="modelo_alarma" value="<?php echo $modeloAlar; ?>" required><span class="barra"></span>
                    <label>Modelo de alarma</label>
                </div>

                <div class="grupo">
                <input type="hidden" name="usuario_id" id="usuario_id" required="" value="<?php echo$result['id_usuario']; ?>" ><span class="barra"></span>
                </div>

                <h1>Datos del pulsante</h1>

                <div class="grupo">
                    <input type="text" name="nombres_apellidos" id="nombres_apellidos" value="<?php echo $nombresApell; ?>"  required><span class="barra"></span>
                    <label>Nombres y Apellidos</label>
                </div>

                <div class="grupo">
                    <input type="number" name="cedula" id="cedula" value="<?php echo $cedula; ?>" required><span class="barra"></span>
                    <label>N° de cédula</label>
                </div>

                <div class="grupo">
                    <input type="number" name="contacto" id="contacto" value="<?php echo $contacto; ?>" required><span class="barra" ></span>
                    <label>Contacto</label>
                </div>

                <div class="grupo">
                    <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>" required><span class="barra"></span>
                    <label>Dirección</label>
                </div>


                <div class="grupo">
                    <center><img id="photo" alt="Agregar foto" src="<?php echo $fotoCed;?>"></center><br>
                </div>
            </div>
        </form><br>
    </section>

    <script src="../scriptsw/script.js"></script>
</body>
</html>