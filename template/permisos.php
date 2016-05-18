<?php
session_start();
include "../../funcions/connexioSQL.php";
?>

<?php
if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] == 'admin'){
        
        
        
        
    } else {
        echo "No tens permisos per veure aquest contingut.<br/><br/>";
        echo "<br/><a href='../../index.php'> Enrere </a>";
    }
} else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
}
?>