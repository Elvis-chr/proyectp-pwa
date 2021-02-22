<?php
    $mysqli = new mysqli('localhost', 'root', '', 'progressivewebapp');
    if($mysqli->connect_errno):
        echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
    endif;
?>