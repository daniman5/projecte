<?php
session_start();
include "../connexioSQL.php";
?>

<?php
echo "<div align='center'>";
if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] == 'admin'){
        $consulta = "SELECT idcurs FROM curs WHERE cnom='".htmlspecialchars($_POST['curs'])."' AND matricula='".htmlspecialchars($_POST['matricula'])."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $fila = mysqli_num_rows($consultaSQL);
        if($fila > 0){ //El curs ja esta registrat.
            echo "<script languaje='javascript'>alert('Aquest curs ja es troba registrat'); window.location='../../form/fcursos/addcurs.php'</script>";
        } else { //Registrem el curs nou
            $inserir = "INSERT INTO curs (cnom,matricula) VALUES ('".htmlspecialchars($_POST['curs'])."','".htmlspecialchars($_POST['matricula'])."')";
            $inserirSQL = mysqli_query($connexio, $inserir);
            
            echo "<script languaje='javascript'>alert('S\'ha afegit el curs correctament'); window.location='../../form/fcursos/addcurs.php'</script>";
            
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