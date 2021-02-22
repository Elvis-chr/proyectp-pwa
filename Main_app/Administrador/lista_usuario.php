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
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="../.././img/logo.png">
	  <link rel="apple-touch-icon" href="../.././img/logo.png">
	  <link rel="apple-touch-startup-image" href="../.././img/logo.png"> 
	  <link rel="manifest" href="../.././manifest.json">
    
    
    <title>Lista de usuarios</title>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<!-- DataTables-->
  

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="stilo/formulario.css"> 
    <link rel="stylesheet" href="css/estilo_form_edit.css">
</head>       

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
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                <span> Servicios </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="leafle_map.php">Mapa GIS</a>
              <a class="dropdown-item" href="registrar_usuario.php">Registrar usuarios</a>
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
<br><br>


<center><h2 class="mt-5">LISTA DE USUARIOS</h2></center>

<div class="container-fluid">
  <div  class="row"  > 
    <div class="col-md-12" >
       <a href="reporte_usuario.php" class="btn btn-success " role="button" id="btn_reporte">
        <span  class="badge ">
         <i class="fas fa-download fa-sm text-white-60"></i> 
        </span>
         Generar reporte 
       </a>
    </div>
  </div>
</div>

<p> 
realice cambio en el boton de descarga reporte 
</p>


<div class="container-fluid">
    
    <form action="buscar_usuario.php" method="get" class="form_search" class="form-inline my-2 my-md-0">
      <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar">
      <input type="submit" value="Buscar" class="btn_search">
    </form>
   
</div> <br><br><br>
 <!-- Begin Page Content -->
 <div class="container-fluid">
            <div class="table_responsive">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>CORREO</th>
                            <th>USUARIO</th>
                            <th>ROL DE USUARIO</th>
                            <th>ACCIONES</th>
                        </tr>

                    <?php 

                    //Paginador 
                  $sql_register = mysqli_query($mysqli, "SELECT COUNT(*) total_usuarios FROM usuarios WHERE estatus = 1 ");
                  $result_register = mysqli_fetch_array($sql_register);
                  $total_registro = $result_register['total_usuarios'];

                  $por_pagina = 6;

                  if(empty($_GET['pagina'])){
                    $pagina =1;
                  }else{
                    $pagina = $_GET['pagina'];
                  }

                  $desde = ($pagina-1)* $por_pagina;
                  $total_pagina = ceil($total_registro / $por_pagina);

                        $query = mysqli_query($mysqli, "SELECT u.id_usuario, u.Nombre, u.Apellido, u.Correo, u.Usuario, t
                        .rol FROM usuarios u INNER JOIN tipo_usuario t ON u.rol_id = t.id LIMIT $desde,$por_pagina " );

                        $result = mysqli_num_rows($query);
                        if($result >0){
                            while ($data = mysqli_fetch_array($query)){

                    ?>            
                        <tr>
                            <td><?php echo $data["id_usuario"]?></td>
                            <td><?php echo $data["Nombre"]?></td>
                            <td><?php echo $data["Apellido"]?></td>
                            <td><?php echo $data["Correo"]?></td>
                            <td><?php echo $data["Usuario"]?></td>
                            <td><?php echo $data['rol']?></td>
                            <td>
                            <center>
                                   <a  href="editar_usuario.php?id_usuario=<?php echo $data["id_usuario"]?>">
                                   <!-- <i class="fa fa-edit editar"></i>  -->
                                    <span  class="badge ">
                                      <i class="bi bi-pencil-square"></i>
                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                         <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                         <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                       </svg>
                                      </span>
                                    </a>
                                    
                                    <a class="" href="eliminar_confirmar_usuario.php?id_usuario=<?php echo $data["id_usuario"]?>">
                                     <!--  <i class="fa fa-trash eliminar"></i> -->
                                     <span  class="badge ">
                                      <i class="bi bi-trash"></i>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>
                                     </span>
                                    </a>  
                              </center>
                            </td>
                        </tr>
                <?php

                    }
                }

            ?>

   </table>                

  <div class="paginador">
        <ul>
          <?php
          if($pagina !=1){ 
          ?>
          <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
          <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
          <?php
          }  
            for ($i=1; $i <= $total_pagina; $i++){
              if($i == $pagina){
                echo '<li class="pageSelected">'.$i.'</li>';
              }else{
                echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
              }
                
            }
            if ($pagina != $total_pagina) {
          ?>
          <li><a href="?pagina=<?php echo $pagina +1; ?>">>></a></li>
          <li><a href="?pagina=<?php echo $total_pagina; ?>">>|</a></li>
          <?php 
            }
          ?>
        </ul>
   </div>
  </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="datatable/dataTables.bootstrap4.min.js"></script>
    <script src="datatable/jquery.dataTables.bootstrap.min.js"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="../scriptsw/script.js"></script>

</body>
</html>
