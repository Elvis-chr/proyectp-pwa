<?php
    session_start();                    

    if(isset($_SESSION['usuario'])){

        if($_SESSION['usuario']['rol_id'] != "2"){
            header("Location: ../Administrador/indexa.php") && 
            header("Location: ../Estandar/indexe.php");
        }        
    }else{
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../css/style.css">


      <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/logo.png">
	  <link rel="apple-touch-icon" href="./logo.png">
	  <link rel="apple-touch-startup-image" href="./logo.png">
	  <link rel="manifest" href="../.././manifest.json">
	  
  </head>

</head>
<body>

<div class="wrapper d-flex align-items-stretch">
  <nav id="sidebar">
	   <div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>

				<div class="p-4">
                    <div align="center">
                    <img src="../../img/usuario.png" style=" border-radius: 150px; width:50%; padding:0px;">
                    </div>

                    <div align="center">
                        <h1><a class="logo"> <?php echo $_SESSION['usuario']['Nombre'] ?></a></h1>
                    
                    </div>
                        

	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="#"><span class="fa fa-home mr-3"></span> Inicio</a>
	          </li>
	          <li>
	              <a href="#"><span class="fa fa-user mr-3"></span> Usuarios</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-briefcase mr-3"></span>Registrar instalación</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Reportes</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-globe mr-3"></span> Mapa Gis</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-users mr-3"></span> Comites</a>
	          </li>
	          <li>
              <a href="../salir.php"><span class="fa fa-sign-out mr-3"></span> Cerrar Sesión</a>
	          </li>
	        </ul>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">DEPARTAMENTO DE SEGURIDAD CIUDADANA </h2>
        <p>HOLAA </p>
        <p>SOY ADMIN</p>
      </div>
</div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main2.js"></script>
    <script src="../../script.js"></script>
</body>
</html>
