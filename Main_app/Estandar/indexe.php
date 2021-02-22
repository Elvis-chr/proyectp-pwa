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
		if(empty($_POST['idusuario']) || empty($_POST['contacto']) || empty($_POST['correo']) || empty($_POST['parroquia']) || empty($_POST['calle'])){ 

			$alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
	}else{
		$idUsuario = $_POST['idusuario'];
		$contacto  = $_POST['contacto'];
		$correo = $_POST['correo'];
		$parroquia = $_POST['parroquia'];
		$calle = $_POST['calle'];

		$sql_update =  mysqli_query($mysqli, "UPDATE usuarios
												SET Correo = '$correo', contacto_usuario = '$contacto', parroquia_usuario = '$parroquia',
												calle_usuario = '$calle'
												WHERE id_usuario = '$idUsuario'");

		if($sql_update){
			$alert='<p class="msg_save"> Usuario actualizado correctamente, Cierre sesion para mostrar cambios </p>';
		}else{
			$alert='<p class="msg_error"> Error al actualizar perfil de usuario</p>';
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>	Seguridad Ciudadana </title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <!-- Edita Todo el diseño del la APP-->
    <link rel="stylesheet" href="stilo/style.css">
    <!-- Edita la barra superior
    <link rel="stylesheet" href="stilo/formulario.css"> -->

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


	<section class="contenido"  >

		<div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
		<form class="form" action="" method="post" id="registrationForm" enctype="multipart/form-data">

				<div class="container bootstrap snippet">
				<div class="col-sm-3"><!--left col-->

			<br><div class="text-center">
				<img id="photo" src="foto_perfil/perfil_user.png" width="150px" height="160px" alt="avatar" class="cirle">
				<style>
					.cirle{
						border-top-left-radius: 50% 50%;
						border-top-right-radius: 50% 50%;
						border-bottom-right-radius: 50% 50%;
						border-bottom-left-radius: 50% 50%;
					}
				</style>
				<h4><?php echo $_SESSION['usuario']['Nombre']?> <?php echo $_SESSION['usuario']['Apellido']  ?></h4>
				<div class="subir_foto">
				</div>
			</div>				
			</div><!--/col-3-->
			
			<div class="col-sm-9">

					
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						<hr>
						<form action="" method="post" enctype="multipart/form-data">

							<input type="hidden" class="form-control" name="idusuario" id="idusuario" value="<?php echo $result['id_usuario'] ?>" readonly>

							<div class="form-group">
								
								<div >
									<label for="nombre"><h4>Nombres</h4></label>
									<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $result['Nombre']?>" readonly>
								</div>
							</div>
							<div class="form-group">
								
								<div >
									<label for="apellido"><h4>Apellidos</h4></label>
									<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $result['Apellido'] ?>" readonly>
								</div>
							</div>

							<div class="form-group">
								
								<div class="col-xs-6">
									<center><label for="cedula"><h4>Cédula</h4></label></center>
									<input type="number" class="form-control" name="cedula" id="cedula" value="<?php echo $result['cedula']?>" readonly>
								</div>
							</div>

							<div class="col-xs-6">
									<center><label for="rol_id"><h4>Rol de usuario</h4></label></center>
									<input type="text" class="form-control" name="rol_id" id="rol_id" value="Instalador" readonly>
								</div>
							</div>

							<div class="form-group">
								
								<div class="col-xs-6">
								
									<center><label for="contacto"><h4>Contacto</h4></label></center>
									<input type="number" class="form-control" name="contacto" id="contacto" value="<?php echo $result['contacto_usuario'] ?>">
									
								</div>
							</div>

							<div class="form-group">
								
								<div class="col-xs-6">
								<center><label for="correo"><h4>Email</h4></label></center>
									<input type="email" class="form-control" name="correo" id="correo" value="<?php echo $result['Correo'] ?>">
								</div>
							</div>


							<div class="form-group">
								
								<div class="col-xs-6">
								<center><label for="parroquia"><h4>Parroquia</h4></label></center>
									<input type="text" class="form-control" name="parroquia" id="parroquia" value="<?php echo $result['parroquia_usuario'] ?>">
								</div>
							</div>

							<div class="form-group">
								
								<div class="col-xs-6">
								<center><label for="calle"><h4>Calle</h4></label></center>
									<input type="text" class="form-control" name="calle" id="calle" value="<?php echo $result['calle_usuario'] ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
										<br>
										<center>
										<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Actualizar</button>
										</center>
									</div>
							</div>
						</form>					
					</div><!--/tab-pane-->
				</div><!--/tab-content-->

				</div><!--/col-9-->
			</div><br><!--/row-->
		
        
    </section>

	<script src="../scriptsw/script.js"></script>


</body>


</html>