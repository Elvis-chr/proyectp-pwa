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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, 
    maximun-scale=1, minimun-scale=1">
    <meta name="theme-color" content="#19908D">
	  <meta name="MobileOptimized" content="width">
	  <meta name="HandheldFriendly" content="true">
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	  <link rel="shortcut icon" type="image/png" href="./img/logo.png">
	  <link rel="apple-touch-icon" href="./logo.png">
	  <link rel="apple-touch-startup-image" href="./logo.png">
	  <link rel="manifest" href="../.././manifest.json">
    
    <title>Registro de Instalciones</title>



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="stilo/formulario.css"> 
     <!-- estios propios -->
    <link rel="stylesheet" href="css/estilo_form_edit.css"> 
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
<br><br><br>
    <!-- TERMINA LA BARRA DE NAVEGACION -->

 <!-- INICIA VENTANA MODAL -->   

<!--  
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="">Reporte por fecha</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Reporte por fecha</h5>
    <a href="" class="btn btn-danger" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" role="button"> 
      <i class="bi bi-x"></i>
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
      </svg>
    </a>
      </div>
      <div class="modal-body">
        <form action="reporte_instalaciones.php" method="post" class="form_search">

          <div class="mb-3">
            <center>
            <br>
            <input type="date" name="fecha1">
            <label for="recipient-name" class="col-form-label">Desde: </label>
            <br>       
            <input type="date" name="fecha2"> 
            <label for="recipient-name" class="col-form-label">Hasta:</label>   
          </div><br>
          </center>
        </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="reporte_usuario.php" class=" btn btn-success " type="submit" name="generar_reporte" role="button">
             <span  class="badge ">
              <i class="fas fa-download fa-sm text-white-60"></i> 
             </span>
              Descargar
        </a>
      </div>
    </div>
  </div>
</div>   -->
<!-- Button trigger modal -->

<div class="container-fluid">
 <div class="row" >
  <div class="col-md-12" > 
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Elija Fechas </h5>

            <a href="" class="btn btn-danger" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" role="button"> 
              <i class="bi bi-x"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </a>
          </div>
          <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                     <label for="recipient-name" class="col-form-label">Desde: </label>
                     <input type="date" name="fecha1">     <br>      

                     <label for="recipient-name" class="col-form-label">Hasta:</label>        
                     <input type="date" name="fecha2"> 
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <a href="reporte_usuario.php" class=" btn btn-success " type="submit" name="generar_reporte" role="button">
                 <span  class="badge ">
                  <i class="fas fa-download fa-sm text-white-60"></i> 
                 </span>
                  Descargar
            </a>
          </div>

      </div>
    </div>
   </div>

         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
           Reporte por fecha
         </button>

         <a href="reporte_usuario.php" class=" btn btn-success " role="button">
          <span  class="badge ">
           <i class="fas fa-download fa-sm text-white-60"></i> 
          </span>
           Generar Reporte
         </a>

         <a class="btn btn-secondary" href="form_inst_camara.php" role="button" id="btn_reg_Cam">
            <span  class="badge ">
             <i class="bi bi-person-plus-fill"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
               <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
               <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
              </svg>
             </span>
              Registrar Cámara
         </a> 

         <a class="btn btn-secondary"  href="form_inst_alarma.php" role="button" id="btn_reg_Cam">
            <span  class="badge ">
             <i class="bi bi-person-plus-fill"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
               <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
               <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
              </svg>
             </span>
              Registrar Alarma           
         </a> 

         <a class="btn btn-secondary"  href="form_inst_pulsador.php" role="button">
            <span  class="badge ">
             <i class="bi bi-person-plus-fill"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
               <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
               <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
              </svg>
             </span>
              Registrar Pulsador          
         </a> 


   </div> 
 </div>  
</div> 

<!-- MODAL -->


    <!-- iNICIA EL CUERPO DE LA PAGINA  -->
<div class="container-fluid">
      <center><h3 class="mt-5">REGISTRO DE CÁMARAS ECU 911</h></center>

   <div class="table_responsive">
     <table>
          <tr>
              <th>ID</th>
              <th>RESPONSABLE</th>
              <th>LATITUD</th>
              <th>LONGITUD</th>
              <th> FECHA</th>
              <th>CALLE</th>
              <th>PARROQUIA</th>
              <th>BARRIO</th>
              <th>NOMBRE</th>
              <th>INSTITUCION</th>
              <th>IP</th>
              <th>ACCIÓN</th>   
          </tr>

          <?php 

                //Paginador 
              $sql_register = mysqli_query($mysqli, "SELECT COUNT(*) total_camaras FROM tb_camaras  WHERE institucion_camara = 2");
              $result_register = mysqli_fetch_array($sql_register);
              $total_registro = $result_register['total_camaras'];

              $por_pagina = 5;

              if(empty($_GET['pagina'])){
                $pagina =1;
              }else{
                $pagina = $_GET['pagina'];
              }

              $desde = ($pagina-1)* $por_pagina;
              $total_pagina = ceil($total_registro / $por_pagina);

               $query = mysqli_query($mysqli, "SELECT u.id_usuario, u.Nombre, u.Apellido, c.id_camara, c.latitude, 
                    c.longitude, c.fecha, c.calle_av, c.parroquia, c.barrio, c.institucion_camara, c.nombre_camara, c.ip_camara, i.nombre
                                                    FROM usuarios u
                                                    INNER JOIN tb_camaras c ON c.usuario_id = u.id_usuario
                                                    INNER JOIN tb_institucion_cam i ON c.institucion_camara = i.id_institucion
                                                    INNER JOIN tipo_usuario t ON u.rol_id = t.id 
                                                    WHERE c.institucion_camara = 2
                                                    LIMIT $desde,$por_pagina " );

                    $result = mysqli_num_rows($query);
                    if($result >0){
                    while ($data = mysqli_fetch_array($query)){

           ?>            
             <tr>
                    <td><?php echo $data["id_camara"]?> </td>
                    <td><?php echo $data["Nombre"]?> <?php echo $data["Apellido"]?></td>
                    <td><?php echo $data["latitude"]?></td>
                    <td><?php echo $data["longitude"]?></td>
                    <td><?php echo $data["fecha"]?></td>
                    <td><?php echo $data["calle_av"]?></td>
                    <td><?php echo $data['parroquia']?></td>
                    <td><?php echo $data["barrio"]?></td>
                    <td><?php echo $data["nombre_camara"]?></td>
                    <td><?php echo $data["nombre"]?></td>
                    <td><?php echo $data["ip_camara"]?></td>
              
                    <td>
                       <center>
                       <a class="editar"  href="editar_registros_de_instalacion.php?id_instalacion=<?php echo $data["id_instalacion"]?>"><i class="fa fa-edit editar"></i></a>
                       </center>
                   </td>
              </tr>
            <?php

                }
            }

            ?>

       </table>         
    </div>
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
    </div><br>
</div>          

<!-- TABLA 2 -->   

<div class="container-fluid">
    <center><h3 class="mt-5">REGISTRO DE CÁMARAS - MUNICIPIO DE MANTA</h></center>
    <div class="table_responsive">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>RESPONSABLE</th>
                        <th>LATITUD</th>
                        <th>LONGITUD</th>
                        <th> FECHA</th>
                        <th>CALLE</th>
                        <th>PARROQUIA</th>
                        <th>BARRIO</th>
                        <th>NOMBRE</th>
                        <th>INSTITUCION</th>
                        <th>IP</th>
                        <th>ACCIÓN</th>

                        
                    </tr>

                <?php 

                //Paginador 
              $sql_register = mysqli_query($mysqli, "SELECT COUNT(*) total_camaras FROM tb_camaras  WHERE institucion_camara = 1");
              $result_register = mysqli_fetch_array($sql_register);
              $total_registro = $result_register['total_camaras'];

              $por_pagina = 5;

              if(empty($_GET['pagina'])){
                $pagina =1;
              }else{
                $pagina = $_GET['pagina'];
              }

              $desde = ($pagina-1)* $por_pagina;
              $total_pagina = ceil($total_registro / $por_pagina);

                    $query = mysqli_query($mysqli, "SELECT u.id_usuario, u.Nombre, u.Apellido, c.id_camara, c.latitude, 
                    c.longitude, c.fecha, c.calle_av, c.parroquia, c.barrio, c.institucion_camara, c.nombre_camara, c.ip_camara, i.nombre
                                                    FROM usuarios u
                                                    INNER JOIN tb_camaras c ON c.usuario_id = u.id_usuario
                                                    INNER JOIN tb_institucion_cam i ON c.institucion_camara = i.id_institucion
                                                    INNER JOIN tipo_usuario t ON u.rol_id = t.id 
                                                    WHERE c.institucion_camara = 1
                                                    LIMIT $desde,$por_pagina " );

                    $result = mysqli_num_rows($query);
                    if($result >0){
                        while ($data = mysqli_fetch_array($query)){

                ?>            
                    <tr>
                        <td><?php echo $data["id_camara"]?> </td>
                        <td><?php echo $data["Nombre"]?> <?php echo $data["Apellido"]?></td>
                        <td><?php echo $data["latitude"]?></td>
                        <td><?php echo $data["longitude"]?></td>
                        <td><?php echo $data["fecha"]?></td>
                        <td><?php echo $data["calle_av"]?></td>
                        <td><?php echo $data['parroquia']?></td>
                        <td><?php echo $data["barrio"]?></td>
                        <td><?php echo $data["nombre_camara"]?></td>
                        <td><?php echo $data["nombre"]?></td>
                        <td><?php echo $data["ip_camara"]?></td>

                        
                        <td>
                          <center>
                          <a class="editar"  href="editar_registros_de_instalacion.php?id_instalacion=<?php echo $data["id_instalacion"]?>"><i class="fa fa-edit editar"></i></a>
                          </center>
                        </td>
                    </tr>
            <?php

                }
            }

        ?>
      </table>
   </div>

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
    </div><br>
</div>   

<!-- termina tabla 2-->
   
<!-- TABLA 3 -->  
<div class="container-fluid">
      <center><h3 class="mt-5"> REGISTROS DE ALARMAS </h></center>
   
    <div class="table_responsive">
        <table>
             <tr>
                 <th>ID</th>
                 <th>RESPONSABLE</th>
                 <th>LATITUD</th>
                 <th>LONGITUD</th>
                 <th> FECHA</th>
                 <th>CALLE</th>
                 <th>PARROQUIA</th>
                 <th>BARRIO</th>
                 <th>NOMBRE</th>
                 <th>PULSADOR</th>
                 <th>ACCIÓN</th>

                 
             </tr>

            <?php 

                //Paginador 
                $sql_register = mysqli_query($mysqli, "SELECT COUNT(*) total_alarmas FROM tb_alarmas");
                $result_register = mysqli_fetch_array($sql_register);
                $total_registro = $result_register['total_alarmas'];

                $por_pagina = 5;

                if(empty($_GET['pagina'])){
                $pagina =1;
                }else{
                $pagina = $_GET['pagina'];
                }

                $desde = ($pagina-1)* $por_pagina;
                $total_pagina = ceil($total_registro / $por_pagina);

                    $query = mysqli_query($mysqli, "SELECT u.id_usuario, u.Nombre, u.Apellido, a.id_alarma, a.latitude, 
                    a.longitude, a.fecha, a.calle, a.parroquia, a.barrio, a.nombre_alarma, p.nombres_apellidos
                                                    FROM usuarios u
                                                    INNER JOIN tb_alarmas a ON a.usuario_id = u.id_usuario
                                                    INNER JOIN tb_pulsador p ON a.pulsador_id = p.id_pulsador 
                                                    LIMIT $desde,$por_pagina " );

                    $result = mysqli_num_rows($query);
                    if($result >0){
                        while ($data = mysqli_fetch_array($query)){

              ?>            
                 <tr>
                     <td><?php echo $data["id_alarma"]?> </td>
                     <td><?php echo $data["Nombre"]?> <?php echo $data["Apellido"]?></td>
                     <td><?php echo $data["latitude"]?></td>
                     <td><?php echo $data["longitude"]?></td>
                     <td><?php echo $data["fecha"]?></td>
                     <td><?php echo $data["calle"]?></td>
                     <td><?php echo $data['parroquia']?></td>
                     <td><?php echo $data["barrio"]?></td>
                     <td><?php echo $data["nombre_alarma"]?></td>
                     <td><?php echo $data["nombres_apellidos"]?></td>

                     
                     <td>
                     <center>
                     <a class="editar"  href="editar_registros_de_instalacion.php?id_instalacion=<?php echo $data["id_instalacion"]?>"><i class="fa fa-edit editar"></i></a>
                     </center>
                     </td>
                 </tr>
              <?php

                }
                }

             ?>
      </table>
</div>

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

<!-- termina tabla 3-->
 <script>
   var myModal = document.getElementById('myModal')
   var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
   })
 </script>
       
    <!-- script Modal -->
  <!--   <script>

      var exampleModal = document.getElementById('exampleModal')
      
      exampleModal.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          var button = event.relatedTarget
          // Extract info from data-bs-* attributes
          var recipient = button.getAttribute('data-bs-whatever')
          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          //
          // Update the modal's content.
          var modalTitle = exampleModal.querySelector('.modal-title')
          var modalBodyInput = exampleModal.querySelector('.modal-body input')
            
          modalTitle.textContent = 'Elija Fechas ' + recipient
          modalBodyInput.value = recipient
        })

    </script> -->
    <!-- script Modal -->

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
   
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
