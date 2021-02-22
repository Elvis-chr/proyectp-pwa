<?php
    session_start();     

    
   

    if(isset($_SESSION['usuario'])){

        if($_SESSION['usuario']['rol_id'] != "1"){
            header("Location: ../Operador/indexo.php") && 
            header("Location: ../Estandar/indexe.php");
        }        
    }else{
        header('Location: ../../index.php');
    }

    //Mostrar informacion del usuario logeado

    include "../conexion.php"; 

    $userLogin = $_SESSION['usuario'];
    $result = $userLogin;


    if(!empty($_POST)){
      $alert='';                       

    $nombre= $_POST['nombre'];
    $apellido= $_POST['apellido'];
    $correo= $_POST['correo'];
    $contra= $_POST['contraseña'];
    $result_id = $_POST['idusuario'];



    $sql_update = mysqli_query($mysqli, "INSERT INTO perfil_usuario(id_perfil)
                                            VALUES('$result_id')");
  
      $sql_update = mysqli_query($mysqli, "UPDATE usuarios
                                          SET Nombre = '$nombre', Apellido = '$apellido', Correo = '$correo',  Password='$contra'
                                          WHERE id_usuario = '$result_id'");


    if($sql_update){
      $alert='<p class="msg_save"> Usuario actualizado correctamente, Cierre sesion para mostrar cambios </p>';
    }else{
      $alert='<p class="msg_error"> Error al actualizar el usaurio </p>';
  }
}

    
?>

<!DOCTYPE html>
<html>
<head>
	<title>	MENU APP	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	  <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
	  <link rel="apple-touch-icon" href="../.././img/logo.png">
	  <link rel="apple-touch-startup-image" href="../.././img/logo.png"> 
	  <link rel="manifest" href="../.././manifest.json">
      <link rel="stylesheet" href="css/estilo_form_edit.css">
</head>

<body id="page-top">
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="indexa.php">SegAPP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="indexa.php">Inicio <span class="sr-only">(current)</span></a>
        </li>
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Servicios</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
            <a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a>
            <a class="dropdown-item" href="leafle_map.php">Mapa GIS</a>
            <a class="dropdown-item" href="registrar_instalacion.php">Generar Actividades</a>
            <a class="dropdown-item" href="registros_de_instalaciones.php">Registros de instalación</a>
            <a class="dropdown-item" href="reportes.php">Reportes</a>
          </div>
        </li>

      </ul>
     
      <!-- Datos del usuario -->
      <ul class="navbar-nav ml-auto">
          <form class="form-inline mt-2 mt-md-0">
               <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="barra_navegacion">
                          <span class="mr-2 d-none d-lg-inline text-white-500 small">
                                  <?php echo $_SESSION['usuario']['Nombre'] ?> 
                                  <?php echo $_SESSION['usuario']['Apellido'] ?> 
                          </span>
                      <img class="img-profile rounded-circle" src="imagenesp/perfil_administrador.png"  width="30px" height="30px" >
                      <i class="bi bi-caret-down-fill"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                     <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>  
                  </a>
                          <!-- Dropdown - User Information -->
                          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                              aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="editar_usurer_admin.php">
                                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Perfil
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="../salir.php">
                                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Cerrar sesión
                              </a>
                          </div>
              </li>
          </form>
      </ul>
    </div>
  </nav>
<br><br><br>
    <!-- TERMINA LA BARRA DE NAVEGACION -->
  <div class="container bg.info">
    <br>
    <center><h2>DATOS DE USUARIO</h2></center> <br>
        <div class="row"> 

                <div class="col-md-3" id="pnt2">
                     <div class="panel panel-default">
                       <div class="panel-body"> 
                            <div class="container">
                                   <br><br><br>
                                   <center>
                                    
                                     <img class="img-profile rounded-circle" src="imagenesp/perfil_administrador.png"  width="90px" height="90px" >
                                        <hr>
                                    <!-- <p class="mr-2 d-none d-lg-inline text-white-500 small"> -->
                                     <p class="">
                                         <h6> <?php echo $_SESSION['usuario']['Nombre'] ?> </h6>  
                                         <h6> <?php echo $_SESSION['usuario']['Apellido'] ?> </h6>
                                     </p>
                                    
                                   </center>
                                    
                            </div>  
                       </div>   
                     </div>   
                </div> 
        
                <!-- INICIA FORMULARIO   -->
     <div class="col-md-9" id="pnt4">
       <div class="panel panel-default">
         <div class="panel-body" > 
           <div class="container" >
                                
            <div class="alert" >
                <?php echo isset($alert) ? $alert : ''; ?> 
             </div>  
                        
            <form action="indexa.php" method="post" enctype="multipart/form-data">
              <div class="form-group">  
                  <label for="first_name"> Nombres y Apellidos</label>
                   <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $result['Nombre']?> <?php echo $result['Apellido']?>" readonly >
               </div>

               <div class="form-group">
                  <label for="last_name"> Cédula </label>
                  <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $result['cedula'] ?>" readonly>
              </div>

              <div class="form-group">                         
                 <label for="password"> Parroquia </label>
                 <input type="text" class="form-control" name="contraseña" id="parroquia_usuario" value="<?php echo $result['parroquia_usuario'] ?>">
              </div>

              <div class="form-group">                         
                  <label for="password"> Dirección </label>
                  <input type="text" class="form-control" name="contraseña" id="parroquia_usuario" value="<?php echo $result['calle_usuario'] ?>">
              </div><br><br>
              
             <div class="form-group">
                  <label for="last_name"> Rol de usuario </label>
                  <input type="text" class="form-control" name="apellido" id="apellido" value="Administrador" readonly>
             </div>

             <div class="form-group">
                  <label for="email"> Email </label>
                  <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $result['Correo'] ?>">
             </div>

             <div class="form-group">
                 <label for="last_name"> Contacto </label>
                 <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $result['contacto_usuario'] ?>">
             </div>

             <div class="form-group">
                 <br>
                 <center>             
                   <button class="btn btn-lg btn-success" type="button" data-toggle="modal" data-target="#exampleModal">
                        Actualizar
                   </button>                             
                 </center>                                       	
             </div>

            </form>
           </div>  
         </div>   
       </div>   
     </div> 
                
                <!-- TERMINA FORMULARIO   -->    
  </div>
</div>


    <!-- iNICIA EL CUERPO DE LA PAGINA  -->
         <br><br>

        
    <!-- End of Page Wrapper -->

    

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
    <script>
     
     
    
    </script>
</html>