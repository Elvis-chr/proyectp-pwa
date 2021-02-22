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
					<a class="regresar" href="registrar_instalacion.php"><i class="fa fa-arrow-left regresar"> Registrar Pulsante</i></a>
				</li>
			</ul>
		</div>
    </section>




    <section class="contenido_actualizar" >
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <center><h2>Dirección de Pulsador</h2></center>
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
                    <label for="parroquia_pulsador" ></label>
                    <option>Parroquia:</option><br>

                    <?php
                                    $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p"); 
                                    $result_parroquia = mysqli_num_rows( $query_parroquia); 
                                ?>
                            <select name="parroquia_pulsador" id="parroquia_pulsador">
                            <option value="">Seleccione una Parroquia</option>

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
                    <label for="alarma_id" ></label>
                    <option>Alarma ID:</option><br>

                    <?php
                                    $query_idAlarm = mysqli_query($mysqli, "SELECT a.id_alarma, a.funcionario_responsable FROM tb_alarmas a"); 
                                    $result_idAlarm = mysqli_num_rows( $query_idAlarm); 
                                ?>
                            <select name="alarma_id" id="alarma_id">
                            <option value="">Seleccione una Alarma</option>


                                <?php 
                                
                                        while ($TAlarm = mysqli_fetch_array($query_idAlarm)){
                                            
                                
                                ?>
                                        <option value="<?php echo $TAlarm["id_alarma"] ?>"> <?php echo $TAlarm["id_alarma"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>


                <div class="grupo">
                    <label for="circuito" ></label>
                    <option>Circuito:</option><br>

                    <?php
                                    $query_circuito = mysqli_query($mysqli, "SELECT c.id_circuito, c.parroquia_id, c.nombre, p.id_parroquia FROM tb_circuito c
                                                                             INNER JOIN tb_parroquia p ON p.id_parroquia = c.parroquia_id"); 
                                    $result_circuito = mysqli_num_rows( $query_circuito); 
                                ?>
                            <select name="circuito" id="circuito">
                            <option value="">Si existe seleccione uno</option>

                                <?php 
                                
                                        while ($Tcircuito = mysqli_fetch_array($query_circuito)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tcircuito["id_circuito"] ?>"><?php echo $Tcircuito["nombre"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>

                <div class="grupo">
                    <label for="subcircuito" ></label>
                    <option>Subcircuito:</option><br>

                    <?php
                                    $query_subcircuito = mysqli_query($mysqli, "SELECT s.id_subcircuito, s.circuito_id, s.nombre_subcircuito, c.id_circuito FROM tb_subcircuito s
                                                                             INNER JOIN tb_circuito c ON s.circuito_id = c.id_circuito"); 
                                    $result_subcircuito = mysqli_num_rows( $query_subcircuito); 
                                ?>
                            <select name="subcircuito" id="subcircuito">
                            <option value="">Si existe seleccione uno</option>

                                <?php 
                                
                                        while ($Tsubcircuito = mysqli_fetch_array($query_subcircuito)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tsubcircuito["id_subcircuito"] ?>"><?php echo $Tsubcircuito["nombre_subcircuito"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>


                <div class="grupo">
                    <input type="text" name="barrio_pulsador" id="barrio_pulsador" required><span class="barra"></span>
                    <label>Barrio</label>
                </div>


                <div class="grupo">
                    <input type="text" name="calle_pulsador" id="calle_pulsador" required><span class="barra"></span>
                    <label>Calle</label>
                </div>

                <div class="grupo">
                    <input type="text" name="avenida_pulsador" id="avenida_pulsador" required><span class="barra"></span>
                    <label>Avenida</label>
                </div>

                <div class="grupo">
                    <input type="text" name="referencia_pulsador" id="referencia_pulsador" required><span class="barra"></span>
                    <label>Referencia</label>
                </div>

                <center><h2>Fecha</h2></center>

                <div class="grupo">
                    <input type="date" name="año_adquisicion" id="año_Adquisicion" required><span class="barra"></span>
                    <label>Periodo de Adquisición</label>
                </div>

                <div class="grupo">
                    <input type="date" name="fecha_pulsador" id="fecha_pulsador" required><span class="barra"></span>
                    <label>Fecha</label>
                </div>

                <div class="grupo">
                    <input type="time" name="hora_pulsador" id="hora_pulsador" required><span class="barra"></span>
                    <label>Hora de Instalación</label>
                </div>

                <center><h2>Datos Complementarios</h2></center>

                <div class="grupo">
                    <input type="text" name="nombres_pulsante" id="nombres_pulsante" required><span class="barra"></span>
                    <label>Nombres y Apellidos</label>
                </div>

                <div class="grupo">
                    <input type="text" name="cedula_pulsante" id="cedula_pulsante" required><span class="barra"></span>
                    <label>Cédula</label>
                </div>

                <div class="grupo">
                    <input type="tel" pattern="[0-9]{10}"  name="contacto_pulsador" id="contacto_pulsador" required><span class="barra"></span>
                    <label>Télefono</label>
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