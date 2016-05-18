<?php
session_start();
include "../connexioSQL.php";
?>

<?php
if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] == 'admin'){
        $existeix = "SELECT * FROM projectenota WHERE idprojecte='".$_SESSION['idprojecte']."'";
        $existeixSQL = mysqli_query($connexio, $existeix);
        $fila = mysqli_num_rows($existeixSQL);
        
        // Realització de la mitja global.
        $notapre = $_POST['presentacio'] * $_POST['prepercent'] / 100;
        $notautil = $_POST['utilitat'] * $_POST['utipercent'] / 100;
        $notadif = $_POST['dificultat'] * $_POST['difpercent'] / 100;
        $global = $notapre + $notautil + $notadif;
        
        if($fila > 0){ // Si existeix una qualificació, la modifiquem.
            
            $edicio = "UPDATE projectenota SET presentacio=".$_POST['presentacio'].",utilitat=".$_POST['utilitat'].",dificultat=".$_POST['dificultat'].",global=".$global.",prepercent=".$_POST['prepercent'].",utipercent=".$_POST['utipercent'].",difpercent=".$_POST['difpercent'].",comentari='".$_POST['comentari']."' WHERE idprojecte='".$_SESSION['idprojecte']."'";
            $edicio = mysqli_query($connexio, $edicio);
            echo "<script languaje='javascript'>alert('Has realitzat la qualificació correctament.'); window.location='../../menus/admin/gqualificacions.php'</script>";
            
            print_r($_POST);
        } else { // Si no existeix una qualificació, la creem.

            $insercio = "INSERT INTO projectenota (idprojecte,presentacio,utilitat,dificultat,global,prepercent,utipercent,difpercent,comentari) VALUES (".$_SESSION['idprojecte'].",".$_POST['presentacio'].",".$_POST['utilitat'].",".$_POST['dificultat'].",".$global.",".$_POST['prepercent'].",".$_POST['utipercent'].",".$_POST['difpercent'].",'".$_POST['comentari']."')";
            $insercioSQL = mysqli_query($connexio, $insercio);
            echo "<script languaje='javascript'>alert('Has realitzat la qualificació correctament.'); window.location='../../menus/admin/gqualificacions.php'</script>";
            
            print_r($_POST);
        }
    } else {
        echo "No tens permisos per veure aquest contingut.<br/><br/>";
        echo "<br/><a href='../../index.php'> Enrere </a>";
    }
} else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
}
?>