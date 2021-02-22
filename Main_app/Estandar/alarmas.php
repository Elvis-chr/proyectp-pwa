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
<body>

<section class="cabecera_fija_uno">
		<div class="barra_presentativa_uno">
			<ul>
				<li>
					<a class="regresar" href="registrar_instalacion.php"><i class="fa fa-arrow-left regresar"> Registrar Alarmas</i></a>
				</li>
			</ul>
		</div>
    </section>




    <section class="contenido_actualizar" >
        <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form">
                <center><h2>Dirección de alarmas</h2></center>
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
                    <label for="parroquia_alarma" ></label>
                    <option>Parroquia:</option><br>

                    <?php
                                    $query_parroquia = mysqli_query($mysqli, "SELECT p.id_parroquia, p.nombre_parroquia FROM tb_parroquia p"); 
                                    $result_parroquia = mysqli_num_rows( $query_parroquia); 
                                ?>
                            <select name="parroquia_alarma" id="parroquia_alarma" required><span class="barra"></span>
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


                <div class="grupo">
                    <label for="circuito" ></label>
                    <option>Circuito:</option><br>

                    <?php
                                    $query_circuito = mysqli_query($mysqli, "SELECT c.id_circuito, c.parroquia_id, c.nombre, p.id_parroquia FROM tb_circuito c
                                                                             INNER JOIN tb_parroquia p ON p.id_parroquia = c.parroquia_id"); 
                                    $result_circuito = mysqli_num_rows( $query_circuito); 
                                ?>
                            <select name="circuito" id="circuito" required><span class="barra"></span>
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

                <div class="grupo">
                    <label for="subcircuito" ></label>
                    <option>Subcircuito:</option><br>

                    <?php
                                    $query_subcircuito = mysqli_query($mysqli, "SELECT s.id_subcircuito, s.circuito_id, s.nombre_subcircuito, c.id_circuito FROM tb_subcircuito s
                                                                             INNER JOIN tb_circuito c ON s.circuito_id = c.id_circuito"); 
                                    $result_subcircuito = mysqli_num_rows( $query_subcircuito); 
                                ?>
                            <select name="subcircuito" id="subcircuito" required><span class="barra"></span>
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

                <div class="grupo">
                    <label for="tipo_via" ></label>
                    <option>Tipo de vía:</option><br>

                    <?php
                                    $query_via = mysqli_query($mysqli, "SELECT v.id_via, v.nombre_tipovia FROM tb_via v"); 
                                    $result_via = mysqli_num_rows( $query_via); 
                                ?>
                            <select name="tipo_via" id="tipo_via" required><span class="barra"></span>
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

                <div class="grupo">
                    <input type="text" name="barrio_sector" id="barrio_sector" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                    <label>Barrio</label>
                </div>


                <div class="grupo">
                    <input type="text" name="calle_alarma" id="calle_alarma" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                    <label>Calle</label>
                </div>

                <div class="grupo">
                    <input type="text" name="avenida_alarma" id="avenida_alarma" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                    <label>Avenida</label>
                </div>

                <div class="grupo">
                    <input type="text" name="referencia" id="referencia" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                    <label>Referencia</label>
                </div>

                <center><h2>Fecha</h2></center>

                <div class="grupo">
                    <input type="number" name="periodo_adquisicion" id="periodo_adquisicion" required><span class="barra"></span>
                    <label>Año de adquisición</label>
                </div>

                <div class="grupo">
                    <input type="date" name="fecha_alarma" id="fecha_alarma" required><span class="barra"></span>
                    <label>Fecha</label>
                </div>

                <div class="grupo">
                    <input type="time" name="hora_instalacion" id="hora_instalacion" required><span class="barra"></span>
                    <label>Hora de Instalación</label>
                </div>

                <center><h2>Datos Complementarios</h2></center>


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
                    <label for="funcionario_responsable" ></label>
                    <option>Funcionario Responsable:</option><br>

                    <?php
                                    $query_funcionario = mysqli_query($mysqli, "SELECT f.nombres_apellidos, f.id_funcionario FROM tb_funcionarios f"); 
                                    $result_funcionario = mysqli_num_rows( $query_funcionario); 
                                ?>
                            <select name="funcionario_responsable" id="funcionario_responsable" required><span class="barra"></span>
                                <option value="">Seleccione un funcionario</option>

                                <?php 
                                
                                        while ($Tfuncionario = mysqli_fetch_array($query_funcionario)){
                                            
                                
                                ?>
                                        <option value="<?php echo $Tfuncionario["id_funcionario"] ?>"><?php echo $Tfuncionario["nombres_apellidos"] ?></option>
                                
                                <?php 
                                        }
                                    
                                ?>
                        </select>
                </div>

                <div class="grupo">
                    <input type="text" name="morador_solicito" id="morador_solicito" onkeyup="javascript:this.value=this.value.toUpperCase();" required><span class="barra"></span>
                    <label>Morador Solicitante</label>
                </div>

                <div class="grupo">
                    <input type="text" name="cedula_morador" id="cedula_morador" required><span class="barra"></span>
                    <label>Cédula Morador</label>
                </div>

                <div class="grupo">
                    <input type="text" name="telefono_morador" id="telefono_morador" required><span class="barra"></span>
                    <label>Télefono Morador</label>
                </div>

                <div class="grupo">
                    <label for="estado_alarma" ></label>
                    <option>Estado de la Alarma:</option><br>

                    <?php
                                    $query_ficha = mysqli_query($mysqli, "SELECT e.id_estado, e.descripcion FROM estado_ficha e"); 
                                    $result_ficha = mysqli_num_rows( $query_ficha); 
                                ?>
                            <select name="estado_alarma" id="estado_alarma" required><span class="barra"></span>
                            <option value="">Seleccione el estado de la alarma</option>

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