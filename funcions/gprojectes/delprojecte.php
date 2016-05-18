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
            
            $consulta = "SELECT * FROM projecte WHERE idprojecte='".$_GET['idprojecte']."'";
            $consultaSQL = mysqli_query($connexio, $consulta);
            $fila = mysqli_num_rows($consultaSQL);
            
            if($fila <= 0){
                echo "<script languaje='javascript'>alert('Aquest projecte no es troba registrat.'); window.location='../../menus/admin/gprojectes.php'</script>";
            } else {
                $datos = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);
                
                //Eliminar usuari+grup LDAP que permeten connexió d'Apache.
                #Usuari
                $cn = $datos['idprojecte'];
                $recerca = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn");
                $info = ldap_get_entries($ds,$recerca);
                $dn = $info[0]['dn'];
                ldap_delete($ds,$dn);//Eliminació de l'usuari(grup).

                //Taula de projectes
                $eliminar = "DELETE FROM projecte WHERE idprojecte='".$datos['idprojecte']."'";
                $eliminarSQL = mysqli_query($connexio, $eliminar);
                
                
                //Eliminació projecte i usuari SQL
                mysqli_query($connexio, "DROP DATABASE `".$datos['idprojecte']."`"); // Eliminació de la DB.
                mysqli_query($connexio, "DROP USER '".$datos['idprojecte']."'@'localhost'"); // Eliminació de l'usuari.

                echo "<script languaje='javascript'>alert('El projecte amb ID ".$_GET['idprojecte']." ha sigut eliminat correctament. També heu eliminat la seva DB ".$datos['idprojecte']." satisfactòriament.'); window.location='../../menus/admin/gprojectes.php'</script>";
            }
        } else {
            echo "No tens permisos per veure aquest contingut.<br/>";
            echo "<br/><a href='../../index.php'> Enrere </a>";
        }
    } else {
    echo "Primer has d'identificar-te.";
    echo "<br/><a href='../../index.php'> Enrere </a>";
    }
}
echo "</div>";
?>