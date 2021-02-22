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

    include "../conexion.php";

    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['Nombre']) || empty($_POST['Apellido']) || empty($_POST['Correo']) || empty($_POST['Usuario']) 
         || empty($_POST['rol_id'])){ 
                
                $alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
        }else{                                                              
            
            $idUsuario  = $_POST['idUsuario'];
            $nombre = $_POST['Nombre'];
            $apellido = $_POST['Apellido'];
            $email = $_POST['Correo'];
            $user = $_POST['Usuario'];
            $contra = $_POST['Password'];
            $rol = $_POST['rol_id'];


            $query =  mysqli_query($mysqli, "SELECT * FROM usuarios 
                                            WHERE (Usuario = '$user' AND id_usuario != $idUsuario)
                                            OR (Correo = '$email' AND id_usuario != $idUsuario)");
            $result = mysqli_fetch_array($query);

            if($result > 0){
                $alert='<p class="msg_error">El correo o el usuario ya existe</p>';
            }else{

                if(empty($_POST['Password'])){
                    $sql_update =  mysqli_query($mysqli, "UPDATE usuarios
                                                           SET Nombre = '$nombre', Apellido = '$apellido', Correo = '$email',
                                                           Usuario = '$user',  rol_id='$rol'
                                                           WHERE id_usuario = '$idUsuario'");
                }else{
                    $sql_update =  mysqli_query($mysqli, "UPDATE usuarios
                                                           SET Nombre = '$nombre', Apellido = '$apellido', Correo = '$email',
                                                           Usuario = '$user', Password = '$contra', rol_id='$rol'
                                                           WHERE id_usuario = '$idUsuario'");
                }

                    if($sql_update){
                        $alert='<p class="msg_save"> Usuario actualizado correctamente </p>';
                    }else{
                        $alert='<p class="msg_error"> Error al actualizar el usaurio </p>';
                    }
            }

        }
    }


    //Mostrar Datos

    if(empty($_GET['id_usuario'])){
        header('Location: lista_usuario.php');
    }
    $iduser = $_GET['id_usuario'];

    $sql = mysqli_query($mysqli,"SELECT u.id_usuario, u.Nombre, u.Apellido, u.Correo, u.Usuario, (u.rol_id) 
            as id, (t.rol) as rol_id 
            FROM usuarios u 
            INNER JOIN tipo_usuario t on u.rol_id = t.id 
            WHERE id_usuario= $iduser");
        
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header('Location: lista_usuario.php');
    }else{
        $option = '';
        while($data = mysqli_fetch_array($sql)){
            $iduser   = $data['id_usuario'];
            $nombre   = $data['Nombre'];
            $apellido = $data['Apellido'];
            $correo   = $data['Correo'];
            $usuario  = $data['Usuario'];
            $idrol    = $data['id'];
            $rol      = $data['rol_id'];

            if($idrol == 1){
                $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
            }else if($idrol == 2){
                $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
            }else if($idrol == 3){
                $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
            }
        }
    }   



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Seguridad Ciudadana</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stilo/formulario.css">

        <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

      <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/logo.png">
	  <link rel="apple-touch-icon" href="./logo.png">
	  <link rel="apple-touch-startup-image" href="./logo.png">
	  <link rel="manifest" href="../.././manifest.json">
    
      <!-- estios propios -->      
    <link rel="stylesheet" type="text/css" href="stilo/formulario.css">
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
            <a class="nav-link" href="indexa.php">Inicio <span class="sr-only"></span></a>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span> Servicios </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a id=" hov" class="dropdown-item" href="leafle_map.php">Mapa GIS</a>
              <a  id=" hov" class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
              <a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a>
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
    <!--
    <main role="main" class="container">
      <div class="jumbotron">
       
      </div>
    </main>    --> 
<br><br><br>

 <!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Content Row -->
  <div class="row">
      
  </div>

  <div class="form_register">
    
  
 <div class="container-fluid">
    <div class="row"  id="pnt" >
      <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" > 
                     <div class="container" >
                     <center>  <h2 class="mt-5"> ACTUALIZAR USUARIO </h2> </center><br>
                     <div class="alert" ><?php echo isset($alert) ? $alert : ''; ?></div>
                     
                     <div class="form_register" >
                     <form class="row g-3 needs-validation" novalidate  action="" method="post" >
                         <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>"> 
                
                         <div class="col-md-4">
                           <label for="Nombre" class="form-label">Nombres</label>
                           <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombres completos" required value="<?php echo $nombre; ?>">
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="Apellido" class="form-label">Apellidos</label>
                           <input type="text" class="form-control" name="Apellido"  id="Apellido" placeholder="Apellidos completos" required value="<?php echo $apellido; ?>" >
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="Correo" class="form-label">Correo </label>
                           <div class="input-group has-validation">
                             <span class="input-group-text" id="inputGroupPrepend">@</span>
                             <input type="text" class="form-control" name="Correo" id="Correo" aria-describedby="inputGroupPrepend" required value="<?php echo $correo; ?>" >
                             <div class="invalid-feedback">
                               Elija un nombre de usuario.
                             </div>
                           </div>
                         </div>

                         <div class="col-md-4">
                           <label for="Usuario" class="form-label">Usuario</label>
                           <input type="text" class="form-control" name="Usuario" id="Usuario" placeholder="Nombre de usuario" required value="<?php echo $usuario; ?>" >
                           <div class="valid-feedback">
                             ¡Se ve bien!
                           </div>
                         </div>

                        
                         <div class="col-md-5">
                           <label for="Password" class="form-label">Contraseña</label>
                           <input type="password" class="form-control" name="Password" id="Password" placeholder="*************" required>
                           <div class="invalid-feedback">
                              Proporcione una contraseña válida..
                           </div>
                         </div>

                         <div class="col-md-3">
                           <label for="rol_id" class="form-label">Tipo de usuario</label>
                                
                                 <?php
                                     $query_rol = mysqli_query($mysqli, "SELECT * FROM tipo_usuario ");
                                     $result_rol = mysqli_num_rows( $query_rol); 
                                 ?>
                             <select  name="rol_id" id="rol_id" >

                                 <?php
                                     if($result_rol > 0){
                                         while ($rol = mysqli_fetch_array($query_rol)){
                                 
                                 ?>
                                         <option  value="<?php echo $rol["id"] ?>"> <?php echo $rol["rol"] ?></option>
                                 
                                 <?php 
                                         }
                                     }
                                 ?>
                            </select>
                           <div class="invalid-feedback">
                             Seleccione un estado válido.
                           </div>
                         </div>
                         
                         <div class="col-12">
                           <br>
                          <!-- <input type="submit" value="Crear usuario" class="btn_save">  -->
                           <button  class="btn btn-success"  type="submit"  class="btn_save">Actualizar usuario</button>
                           
                           
                            <a href="lista_usuario.php" class=" btn btn-warning " role="button" >Cancelar</a>
                        </div>
                      </form>
                      </div>

                    </div>  
                </div>   
            </div>   
        </div>                             
    </div>
 </div>
 <br>




<script>

    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>


 <!-- TERMINA FORMULARIO   -->    
 
    


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





    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>

</body>
</html>
