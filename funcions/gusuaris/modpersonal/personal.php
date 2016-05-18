<?php
session_start();
include "../../connexioLDAP.php"; //connexio a LDAP
include "../../connexioSQL.php"; //connexio a MySQL
?>
        
<?php
if($_POST){
    //Actualitzem les noves dades SQL(sense contrasenya)
    $actualitzacio = "UPDATE usuaris SET nom='".$_POST['nom']."',cognom1='".htmlspecialchars($_POST['cognom1'])."',cognom2='".htmlspecialchars($_POST['cognom2'])."',email='".htmlspecialchars($_POST['email'])."' WHERE usuari='".$_SESSION['usuari']."'";
    $actualitzacioSQL = mysqli_query($connexio, $actualitzacio);
    
    //Actualitzem les noves dades LDAP (sense contrasenya)
    $modificar['givenname'] = $_POST['nom'];
    $modificar['sn'] = $_POST['cognom1']." ".$_POST['cognom2'];

            
    //Creem l'entrada de la contrasenya de LDAP en cas de que l'usuari l'hagi modificat.
    if($_POST['contrasenya']){
        $modificar['userpassword'] = "{SHA}" . base64_encode(sha1( $_POST['contrasenya'], TRUE ) );
    }
    
    //Executem la modificació de tots els paràmetres establers anteriorment.
    $modificarLDAP = ldap_mod_replace($ds,"cn=".$_SESSION['usuari'].",ou=usuaris,dc=lapineda,dc=cat", $modificar);
    
    echo "<script languaje='javascript'>alert('L\'usuari ".$_SESSION['usuari']." ha sigut modificat correctament.'); window.location='../../../menus/usuari/personal.php'</script>";
    
} else {
    header("location: ../../../index.php");
}
?>
