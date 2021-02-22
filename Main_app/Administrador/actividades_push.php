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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Seguridad Ciudadana</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stilo/actividad.css">

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

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SEGAPP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="leafle_map.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Sistema de información geográfica</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administracion de usuarios
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="registrar_usuario.php"  
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-plus"></i>
                    <span>Registrar usuarios</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="lista_usuario.php" 
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Lista de Usuarios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administracion de información
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="actividades_push.php" 
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-plus-square"></i>
                    <span>Generar Actividades</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="registros_de_instalaciones.php">
                    <i class="fas fa-list-alt"></i>
                    <span>Registros de instalación</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="reportes.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reportes</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information PERFIL DE USUARIO-->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuario']['Nombre'] ?> 
                                                                                          <?php echo $_SESSION['usuario']['Apellido'] ?></span>
                                <img class="img-profile rounded-circle"
                                src="imagenesp/perfil_administrador.png" >
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="indexa.php">
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

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Content Row -->

                    <div class="row">

                    </div>

                    <div class="inner contact">
                   
           <!-- Form Area -->
           <div class="contact-form">
               <!-- Form -->

               <form id="contact-us" method="post" action="#">
                   <!-- Left Inputs -->
                   <div class="col-xs-6 wow animated slideInLeft" data-wow-delay=".5s">
                       <!-- Name -->
                       <input type="text" name="detalle_actividad" id="detalle_actividad" required="required" class="form" placeholder="Actividad" />
                       <!-- Email -->
                       <input type="date" name="fecha_actividad" id="fecha_actividad" required="required" class="form" placeholder="Fecha" />
                       
                   </div><!-- End Left Inputs -->
                   <!-- Right Inputs -->
                   <div class="col-xs-6 wow animated slideInRight" data-wow-delay=".5s">
                       <!-- Message -->
                       <input type="text" name="direccion_Actividad" id="direccion_Actividad" required="required" class="form" placeholder="Dirección" />
                       <input type="text" name="user_actividad" id="user_actividad" required="required" class="form" placeholder="Responsable" />                            
                   </div><!-- End Right Inputs -->
                   <!-- Bottom Submit -->
                   <div class="relative fullwidth col-xs-12">
                       <!-- Send Button -->
                       <input type="submit" id="submit" name="submit" value="Enviar" class="form-btn semibold"></input> 
                   </div><!-- End Bottom Submit -->
                   <!-- Clear -->
                   <div class="clear"></div>
               </form>

           </div><!-- End Contact Form Area -->
       </div><!-- End Inner -->
                    <!-- Content Row -->
                    <div class="row">

                    

                        <!-- Content Column MIRAR BIEN-->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

                        </div>
                    </div>

                </div> 

            </div>
            <!-- End of Main Content -->

            

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->


        

    </div>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>

</body>
</html>
