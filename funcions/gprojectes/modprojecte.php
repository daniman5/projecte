<?php
function modprojecte($idprojecte,$gpass){
    
    include "../../funcions/connexioLDAP.php";
    include "../../funcions/connexioSQL.php";
    
    echo "<div align=center>";
    if(isset($_SESSION['usuari'])){
        
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){
            mysqli_query($connexio, "SET PASSWORD FOR '".$idprojecte."'@'localhost' = PASSWORD('".$gpass."')"); //Modificació de la contrasenya de la DB de MySQL.
            echo "<script languaje='javascript'>alert('Contrasenya modificada correctament.'); window.location='../../menus/admin/gprojectes.php'</script>";
        } else {
        echo "Primer has d'identificar-te.";
        echo "<br/><a href='../../index.php'> Enrere </a>";
        }
    }
    echo "</div>";
}
?>