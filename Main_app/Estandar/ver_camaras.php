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

if(empty($_GET['id_camara'])){
    header('Location: registros_camara.php');
}

$idcamara = $_GET['id_camara'];

$sql = mysqli_query($mysqli,"SELECT c.id_camara, c.usuario_id, c.calle_av, c.latitude, c.longitude, c.fecha, c.parroquia, c.barrio, c.foto, c.nombre_Camara, c.tipo_camara,
c.marca_camara, c.modelo_camara, c.megafonia, c.storage, c.usuario_camara, c.contraseña_camara, c.ip_camara,c.puerto_camara,c.puerta_enlace, c.mascara_camara,c.mac_camara, c.piloto_camara, (c.institucion_camara) 
                            as id_institucion, (i.nombre) as institucion_camara
                            FROM  tb_camaras c
                            INNER JOIN tb_institucion_cam i on c.institucion_camara = i.id_institucion 
                            WHERE id_camara = $idcamara");

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('Location: registros_camara.php');
}else{
    $option = '';
    while($data = mysqli_fetch_array($sql)){
        $idcamara   = $data['id_camara'];
        $calle   = $data['calle_av'];
        $latitud   = $data['latitude'];
        $longitud   = $data['longitude'];
        $fecha  = $data['fecha'];
        $parroquia  = $data['parroquia'];
        $barrio  = $data['barrio'];
        $foto  = $data['foto'];
        $Tpcm  = $data['institucion_camara'];
        $nombreCam  = $data['nombre_Camara'];
        $Tipo  = $data['tipo_camara'];
        $marca = $data['marca_camara'];
        $modelo = $data['modelo_camara'];
        $megafonia = $data['megafonia'];
        $storage = $data['storage'];
        $usuarioCam = $data['usuario_camara'];
        $contraseñaCam = $data['contraseña_camara'];
        $IPcam = $data['ip_camara'];
        $puerto = $data['puerto_camara'];
        $puerta = $data['puerta_enlace'];
        $mascara = $data['mascara_camara'];
        $mac = $data['mac_camara'];
        $piloto = $data['piloto_camara'];
        $id_institucion = $data['id_institucion'];
        


        if($id_institucion == 1){
            $option = '<option value="'.$id_institucion.'" select>'.$Tpcm.'</option>';
        }else if($id_institucion == 2){
            $option = '<option value="'.$id_institucion.'" select>'.$Tpcm.'</option>';
    }
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
					<a class="regresar" href="registros_camara.php"><i class="fa fa-arrow-left regresar"> Regresar</i></a>
				</li>
			</ul>
		</div>
    </section>

    <section class="contenido_actualizar" >
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <h1>Registro <?php echo $nombreCam; ?></h1>
                <div class="grupo">
                    <input type="float" name="latitud" id="latitud" value="<?php echo $latitud; ?>" required><span class="barra"></span>
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
                    <input type="text" name="calle_av" id="calle_Av" value="<?php echo $calle; ?>" required><span class="barra"></span>
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
                    <label for="institucion_camara" ></label>

                    <?php
                                    $query_tipo = mysqli_query($mysqli, "SELECT i.id_institucion, i.nombre FROM tb_institucion_cam i"); 
                                    $result_tipo = mysqli_num_rows( $query_tipo); 
                                ?>
                            <select name="institucion_camara" id="institucion_camara">

                                <?php 
                                        echo $option;
                                        if($result_tipo > 0){
                                        while ($Tpcm = mysqli_fetch_array($query_tipo)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tpcm["id_institucion"] ?>"> <?php echo $Tpcm["nombre"] ?></option>
                                
                                <?php 
                                        }

                                        }
                                    
                                ?>
                        </select>
                </div>

                <div class="grupo">
                    <center><img id="photo" alt="Agregar foto" src="<?php echo $foto;?>"></center><br>

                    </div>
                </div>

                <div class="grupo">
                    <input type="text" name="nombre_camara" id="nombre_camara" value="<?php echo $nombreCam; ?>" required><span class="barra"></span>
                    <label>Nombre de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="tipo_camara" id="tipo_camara" value="<?php echo $Tipo; ?>" required><span class="barra"></span>
                    <label>Tipo de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="marca_camara" id="marca_camara" value="<?php echo $marca; ?>" required><span class="barra"></span>
                    <label>Marca de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="modelo_camara" id="modelo_camara" value="<?php echo $modelo; ?>" required><span class="barra"></span>
                    <label>Modelo de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="megafonia" id="mgafonia" value="<?php echo $megafonia; ?>" required><span class="barra"></span>
                    <label>Megafonía</label>
                </div>

                <div class="grupo">
                    <input type="text" name="storage" id="storage" value="<?php echo $storage; ?>" required><span class="barra"></span>
                    <label>Storage Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="usuario_camara" id="usuario_camara" value="<?php echo $usuarioCam; ?>" required><span class="barra"></span>
                    <label>Usuario Cámara </label>
                </div>

                <div class="grupo">
                    <input type="password" name="contraseña_camara" id="contraseña_camara" value="<?php echo $contraseñaCam; ?>" required><span class="barra"></span>
                    <label>Contraseña de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="ip_camara" id="ip_camara" value="<?php echo $IPcam; ?>" required><span class="barra"></span>
                    <label>IP Cámara</label>
                </div>

                <div class="grupo">
                    <input type="number" name="puerto_camara" id="puerto_camara" value="<?php echo $puerto; ?>" required><span class="barra"></span>
                    <label>Puerto Cámara</label>
                </div>

                <div class="grupo">
                    <input type="number" name="puerta_enlace" id="puerta_enlace" value="<?php echo $puerta; ?>" required><span class="barra"></span>
                    <label>Puerta de enlace</label>
                </div>

                <div class="grupo">
                    <input type="text" name="mascara_camara" id="mascara_camara" value="<?php echo $mascara; ?>" required><span class="barra"></span>
                    <label>Máscara IP Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="mac_camara" id="mac_camara" value="<?php echo $mac; ?>" required><span class="barra"></span>
                    <label>Mac de Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="piloto_camara" id="piloto_camara" value="<?php echo $piloto; ?>" required><span class="barra"></span>
                    <label>Piloto de Cámara</label>
                </div>
            
            </div>

        </form><br>
    </section>

    <script src="../scriptsw/script.js"></script>
</body>
</html>