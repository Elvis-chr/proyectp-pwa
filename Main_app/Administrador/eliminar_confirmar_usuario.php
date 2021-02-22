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
        $id_usario = $_POST['idusuario'];                                                                   
        
        $query_delete = mysqli_query($mysqli, "DELETE FROM usuarios WHERE id_usuario = $id_usario "); 
        //$query_delete = mysqli_query($mysqli, "UPDATE usuarios SET  estatus = 0 WHERE id_usuario = $id_usario "); DAR ESTADO

        if($query_delete){
            header("Location: lista_usuario.php");
        }else{
            echo "Error al eliminar";
        }
    }





    if(empty($_REQUEST['id_usuario'])){
        header("Location: lista_usuario.php");
    }else{


        $id_usario = $_REQUEST['id_usuario'];

        $query = mysqli_query($mysqli, "SELECT u.Nombre, u.Apellido, u.Usuario, t.rol
                                        FROM usuarios u
                                        INNER JOIN
                                        tipo_usuario T
                                        ON u.rol_id = t.id
                                        WHERE u.id_usuario = $id_usario");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            while ($data = mysqli_fetch_array($query)) {
                $nombre = $data['Nombre'];
                $apellido = $data['Apellido'];
                $usuario = $data['Usuario'];
                $rol = $data['rol'];
            }
        }else{
            header("Location: lista_usuario.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" type="text/css" href="stilo/style.css">
    <link rel="stylesheet" type="text/css" href="stilo/formulario.css">


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
<body>
<br>
        <section>

            <div class="data_delete">
                <h2>¿Está seguro de eliminar el siguiente registro?</h2>
                <p>Nombres: <span><?php echo $nombre; ?></span></p>
                <p>Apellidos: <span><?php echo $apellido; ?></span></p>
                <p>Usuario: <span><?php echo $usuario; ?></span></p>
                <p>Tipo de usuario: <span><?php echo $rol; ?></span></p>

                <form method="post" action="">
                    <input type="hidden" name="idusuario" value="<?php echo $id_usario; ?>">
                    <a href="lista_usuario.php" class="btn_cancel">CANCELAR</a>
                    <input type="submit" value="ACEPTAR" class="btn_ok">
                </form>
            </div>

        </section>
        
    <!-- Service Worker-->
    <script src="../scriptsw/script.js"></script>
</body>
</html>