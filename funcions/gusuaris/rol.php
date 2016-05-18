<?php
session_start();
include "../connexioSQL.php";


if(isset($_SESSION['usuari'])){
    if($_GET){ 
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){
            if($_GET['tipus'] == "admin"){
                $modificar = "UPDATE usuaris SET tipus='normal' WHERE idusuari=".$_GET['id'];
                $modificarSQL = mysqli_query($connexio, $modificar);
                echo "<script languaje='javascript'>alert('L\'usuari ha sigut establert com a usuari NORMAL correctament.'); window.location='../../menus/admin/gusuaris.php'</script>";
            }else {
                if($_GET['tipus'] == "normal"){
                    $modificar = "UPDATE usuaris SET tipus='admin' WHERE idusuari=".$_GET['id'];
                    $modificarSQL = mysqli_query($connexio, $modificar);
                    echo "<script languaje='javascript'>alert('L\'usuari ha sigut establert com a usuari ADMINISTRADOR correctament.'); window.location='../../menus/admin/gusuaris.php'</script>";

                }
            }
            
        } else {
            echo "No tens permisos per veure aquest contingut.<br/><br/>";
            echo "<br/><a href='../../index.php'> Enrere </a>";
        }
    }
} else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
}
?>