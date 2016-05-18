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
            
            // Eliminem l'assignació que hem fet a l'usuari.
            $eliminar = "DELETE FROM usuariprojecte WHERE idusuari='".$_GET['idusuari']."' AND idprojecte='".$_GET['idprojecte']."'";
            $eliminarSQL = mysqli_query($connexio, $eliminar);
            
            // Modificació de la carpeta personal de l'usuari(LDAP) assignat a la del projecte per la de /noroot sense permisos.
            $modificar['homeDirectory'] = "/home/noroot";
            $mod = ldap_mod_replace($ds,"cn=".$dades['usuari'].",ou=usuaris,dc=lapineda,dc=cat", $modificar);
            
            
            echo "<script languaje='javascript'>alert('L\'assignació del projecte ".$_GET['idprojecte']." ha sigut eliminada.'); window.location='../../menus/admin/gassignacions.php'</script>";

            
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