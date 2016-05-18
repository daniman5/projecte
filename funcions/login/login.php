<?php
session_start();

if(isset($_SESSION)){

    error_reporting(0); //important per a no mostrar errors provinents de LDAP

    if($_POST){
        $_SESSION['usuari'] = $_POST['usuari'];
        header("location: ../../permisos/usuari.php");
    } else {
        echo "Escriu un nom d'usuari (no cal contrasenya).";
    }
    //if(validar($_POST['usuari'],hash("sha512",$_POST['pw'])) == 1){
//                    if(validar($_POST['usuari'],$_POST['pw']) == 1){
//                        $_SESSION['usuari'] = $_POST['usuari'];
//                        header("location: permisos/usuari.php");
//                    } else {
//                        echo "Login incorrecto.";
//                    }
} else {
    header("location: ../../index.php");
}
?>