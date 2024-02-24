<?php 

    session_start();

    if($_SESSION["role"] == "Admin"){
        header('Location: AdminHP-TAG.html');
    } else {
        header('Location: NonAdminHP-TAG.html');
    }

?>