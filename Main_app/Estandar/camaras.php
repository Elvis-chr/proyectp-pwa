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
					<a class="regresar" href="registrar_instalacion.php"><i class="fa fa-arrow-left regresar"> Regresar</i></a>
				</li>
			</ul>
		</div>
    </section>

    <section class="contenido_actualizar" >
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <h1>Instalación de cámaras</h1>
                <div class="grupo">
                    <input type="float" name="latitud" id="latitud"  required><span class="barra"></span>
                    <label>Latitud</label>
                </div>
                <div class="grupo">
                    <input type="float" name="longitud" id="longitud" required><span class="barra" ></span>
                    <label>Longitud</label>
                </div>

                <div>
                <button type="button" class="button" onclick="initiate_geolocation();">Capturar Coordenadas</button>
                </div>

                <div class="grupo">
                    <input type="text" name="calle_av" id="calle_Av" required><span class="barra"></span>
                    <label>Calle - Avenida</label>
                </div>

                <div class="grupo">
                    <input type="date" name="fecha" id="fecha" required><span class="barra"></span>
                    <label>Fecha</label>
                </div>

                <div class="grupo">
                    <label for="institucion_camara" ></label>
                    <option>Parroquia</option><br>

                    <?php
                                    $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p"); 
                                    $result_parroquia = mysqli_num_rows( $query_parroquia); 
                                ?>
                            <select name="parroquia" id="parroquia">

                                <?php 
                                
                                        while ($Tparro = mysqli_fetch_array($query_parroquia)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tparro["id_parroquia"] ?>"> <?php echo $Tparro["nombre_parroquia"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>

                <div class="grupo">
                    <input type="text" name="barrio" id="barrio" required><span class="barra"></span>
                    <label>Barrio</label>
                </div>

                <div class="grupo">
                    <label for="institucion_camara" ></label>
                    <option>Institución Reponsable</option><br>

                    <?php
                                    $query_tipo = mysqli_query($mysqli, "SELECT i.id_institucion, i.nombre FROM tb_institucion_cam i"); 
                                    $result_tipo = mysqli_num_rows( $query_tipo); 
                                ?>
                            <select name="institucion_camara" id="institucion_camara">

                                <?php 
                                
                                        while ($Tpcm = mysqli_fetch_array($query_tipo)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tpcm["id_institucion"] ?>"> <?php echo $Tpcm["nombre"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>

                <div class="grupo">
                    <center><img id="photo" alt="Agregar foto"></center><br>
                    <div class="subir_foto">
                    <center><i class="fa fa-camera"></i> </center>
                    <input type="file" name="foto" id="foto"  accept="image/x-png,image/jpeg" required >
                    </div>
                    <script>
                            const photo = document.querySelector('#photo');
                            const camera = document.querySelector('#foto');
                            camera.addEventListener('change', function(e) {
                                photo.src = URL.createObjectURL(e.target.files[0]);
                            });
                    </script>
                </div>

                <div class="grupo">
                    <input type="text" name="nombre_camara" id="nombre_camara" required><span class="barra"></span>
                    <label>Nombre de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="tipo_camara" id="tipo_camara" required><span class="barra"></span>
                    <label>Tipo de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="marca_camara" id="marca_camara" required><span class="barra"></span>
                    <label>Marca de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="modelo_camara" id="modelo_camara" required><span class="barra"></span>
                    <label>Modelo de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="megafonia" id="mgafonia" required><span class="barra"></span>
                    <label>Megafonía</label>
                </div>

                <div class="grupo">
                    <input type="text" name="storage" id="storage" required><span class="barra"></span>
                    <label>Storage Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="usuario_camara" id="usuario_camara" required><span class="barra"></span>
                    <label>Usuario Cámara </label>
                </div>

                <div class="grupo">
                    <input type="password" name="contraseña_camara" id="contraseña_camara" required><span class="barra"></span>
                    <label>Contraseña de cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="ip_camara" id="ip_camara" required><span class="barra"></span>
                    <label>IP Cámara</label>
                </div>

                <div class="grupo">
                    <input type="number" name="puerto_camara" id="puerto_camara" required><span class="barra"></span>
                    <label>Puerto Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="puerta_enlace" id="puerta_enlace" required><span class="barra"></span>
                    <label>Puerta de enlace</label>
                </div>

                <div class="grupo">
                    <input type="text" name="mascara_camara" id="mascara_camara" required><span class="barra"></span>
                    <label>Máscara IP Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="mac_camara" id="mac_camara" required><span class="barra"></span>
                    <label>Mac de Cámara</label>
                </div>

                <div class="grupo">
                    <input type="text" name="piloto_camara" id="piloto_camara" required><span class="barra"></span>
                    <label>Piloto de Cámara</label>
                </div>


                <div class="grupo">
                    <label for="estado_camara" ></label>
                    <option>Estado de Cámara</option><br>

                    <?php
                                    $query_ficha = mysqli_query($mysqli, "SELECT e.id_estado, e.descripcion FROM estado_ficha e"); 
                                    $result_ficha = mysqli_num_rows( $query_ficha); 
                                ?>
                            <select name="estado_camara" id="estado_camara">

                                <?php 
                                
                                        while ($Tficha = mysqli_fetch_array($query_ficha)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tficha["id_estado"] ?>"> <?php echo $Tficha["descripcion"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>
                
                


                <div class="grupo">
                <input type="hidden" name="usuario_id" id="usuario_id" required="" value="<?php echo$result['id_usuario']; ?>" ><span class="barra"></span>
                </div>
            <button type="submit">Guardar</button>
            </div>

        </form>
    </section>

    <script src="../scriptsw/script.js"></script>
</body>
</html>