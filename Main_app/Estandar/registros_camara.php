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

    $userLogin = $_SESSION['usuario']['id_usuario'];
    $result = $userLogin;


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stilo/style.css">
    <link rel="stylesheet" href="stilo/formulario.css">
    <title>Regitros</title>


    <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
	  <link rel="apple-touch-icon" href="../.././img/logo.png">
	  <link rel="apple-touch-startup-image" href="../.././img/logo.png">
	  <link rel="manifest" href="../.././manifest.json"> 
</head>
<body>

<section class="cabecera_fija_uno">
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

  
  <br>
  <section class="contenido" >
		<div class="barra_registros">
      <center>
    <a href="registros_camara.php" class="btn_new">Cámaras</a>
    <a href="registros_alarmas.php" class="btn_new"> Alarmas</a>
    </center>
    </div>
	</section>
  
  <section class="mapa_gis"  >
        <center><h1>LISTADO DE CÁMARAS</h1><br></center>
          
      <div >
        <table>
                            <tr>
                                <th>ID</th>
                                <th>COMPONENTE</th>
                                <th>ACCIONES</th>
                            </tr>

                            <?php 

                            

                                $query = mysqli_query($mysqli, "SELECT u.id_usuario, u.Nombre, u.Apellido, u.Usuario,c.id_camara, c.usuario_id, c.nombre_camara 
                                                                FROM usuarios u 
                                                                INNER JOIN tb_camaras c ON c.usuario_id = u.id_usuario 
                                                                INNER JOIN tipo_usuario t ON u.rol_id = t.id
                                                                WHERE u.id_usuario = '".$result."'" );

                                $result = mysqli_num_rows($query);
                                if($result >0){
                                    while ($data = mysqli_fetch_array($query)){

                            ?>            
                                <tr>
                                    <td><?php echo $data["id_camara"]?></td>
                                    <td><?php echo $data["nombre_camara"]?></td>
                                    <td>
                                      <center>
                                        <a class="editar"  href="ver_camaras.php?id_camara=<?php echo $data["id_camara"]?>"><i class="fa fa-eye editar"></i></a>
                                      </center>
                                    </td>
                                </tr>
                            <?php

                            }
                            }

                            ?>
        </table>
      </div>

  </section>


  <script src="../scriptsw/script.js"></script>


</body>
</html>