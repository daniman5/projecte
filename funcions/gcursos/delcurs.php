<?php
session_start();
include "../../funcions/connexioSQL.php";
?>

<?php
echo "<div align='center'>";
if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] == 'admin'){
        if($_GET){ //Si rebem dades per $_GET...
            $eliminar = "DELETE FROM curs WHERE idcurs='".$_GET['idcurs']."'"; //Eliminel l'entrada del curs.
            $eliminarSQL = mysqli_query($connexio, $eliminar);
            echo "<script languaje='javascript'>alert('S\'ha eliminat el curs correctament'); window.location='../../menus/admin/gcursos.php'</script>";
        } else {
            echo "Hi ha problemes amb la selecció del curs.";
        }
    } else {
        echo "No tens permisos per veure aquest contingut.<br/><br/>";
        echo "<br/><a href='../../index.php'> Enrere </a>";
    }
} else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
}
echo "</div>";
?>