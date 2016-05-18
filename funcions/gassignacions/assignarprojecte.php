<?php
session_start();
include "../connexioSQL.php";
include "../connexioLDAP.php";
?>

<?php
echo "<div align=center>";
if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] == 'admin'){
        if($_GET){
            $usu = "SELECT * FROM usuaris WHERE idusuari=".$_GET['idusuari'];
            $usuSQL = mysqli_query($connexio, $usu);
            $dades = mysqli_fetch_array($usuSQL,MYSQLI_ASSOC);
            
            //Inserció de l'usuari a la base de dades usuari/projecte.
            $assignament = "INSERT INTO usuariprojecte (idusuari,idprojecte) VALUES (".$_GET['idusuari'].",".$_GET['idprojecte'].")";
            $assignamentSQL = mysqli_query($connexio, $assignament);
            
            //Modificació de la carpeta personal de l'usuari assignat a la del projecte.
            $modificar['homeDirectory'] = "/home/".$_GET['idprojecte'];
            $mod = ldap_mod_replace($ds,"cn=".$dades['usuari'].",ou=usuaris,dc=lapineda,dc=cat", $modificar);
            
            echo "<script languaje='javascript'>alert('El projecte ".$_GET['idprojecte']." assignat correctament a l\'usuari ".$dades['nom']." ".$dades['cognom1']." ".$dades['cognom2']."'); window.location='../../menus/admin/gassignacions.php'</script>";

            
        } else {
            echo "No s'han rebut dades per a l'assignament.";
        }
        
    } else {
        echo "No tens permisos per veure aquest contingut.<br/>";
        echo "<br/><a href='../../index.php'> Enrere </a>";
    }
} else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
}
echo "</div>";
?>