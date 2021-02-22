<?php
    session_start();

    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['rol_id'] == "1"){
            header('Location: Main_app/Administrador/indexa.php');
        } else if($_SESSION['usuario']['rol_id'] == "2"){
            header('Location: Main_app/Operador/indexo.php');
        }else if($_SESSION['usuario']['rol_id'] == "3"){
            header('Location: Main_app/Estandar/indexe.php');
        }
    }
?>

                                                            
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguridad Ciudadana</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&display=swap">
-->    <link rel="stylesheet" href="CSS/main.css"> 


      <meta name="theme-color" content="#35a19a">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/segapp.jpg">
	  <link rel="apple-touch-icon" href="./img/segapp.jpg">
	  <link rel="apple-touch-startup-image" href="./img/segapp.jpg">
	  <link rel="manifest" href="./manifest.json">

 <link rel="shortcut icon" type="image/png" href="./img/LOGO CON FONDO.png">
<!-- 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<!-- 
    <div class="error">
        <span> Datos de ingreso no validos, Intentelo de nuevo </span>
    </div>

    <div class="main">
            <form action="" id="formlg">
                <img class="logo" src="Img/sesion.png">
                <input type="text" name="usuariolg" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Usuario" required />
                <input type="password" name="passlg" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Contraseña" required />
                <input type="submit" class="botonlg" value="Iniciar Sesion" />
            </form>    
        <br>

     </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="script.js"></script> -->

<!-- Inicia el nuevo login  -->
<br>
<br>
<div class="error" >
     <center> <span> Datos de ingreso no validos, Intentelo de nuevo </span> </center> 
</div>


<div class="container h-100">
	<div class="d-flex justify-content-center h-100">
		<div class="user_card">
			<div class="d-flex justify-content-center">
				<div class="brand_logo_container">
					<!-- <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo"> -->
                       <img  class="brand_logo" alt="Logo" src="Img/LOGO CON FONDO.png">
                   </div>
			</div>
			<div class="d-flex justify-content-center form_container">
				<form id="formlg">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="usuariolg" pattern="[A-Za-z0-9_-]{1,15}"  class="form-control input_user" value="" placeholder="Usuario" require>
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="passlg" pattern="[A-Za-z0-9_-]{1,15}" class="form-control input_pass" value="" placeholder="Contraseña" require>
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<!-- <input type="checkbox" class="custom-control-input" id="customControlInline">
							<label class="custom-control-label" for="customControlInline">Remember me</label> -->
						</div>
					</div> 
					<div class="d-flex justify-content-center mt-3 login_container">
			 		<!-- <button type="button" name="button" class="btn login_btn">Login</button>   -->
					  <!-- <button type="submit" name="button" class="btn login_btn" class="botonlg" > Login </button>					   -->
					  <input type="submit" class="botonlg" value="Iniciar Sesion" />  
			   		</div>
				</form>
			</div>
	
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					<!-- Don't have an account? <a href="#" class="ml-2">Sign Up</a> -->
				</div>
				<div class="d-flex justify-content-center links">
					<!-- <a href="#">Forgot your password?</a> -->
				</div>
			</div>
		</div>
	</div>
</div>



<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
<script src="script.js"></script> 

</body>
</html>