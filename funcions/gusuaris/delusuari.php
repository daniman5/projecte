<?php
session_start();
include "../connexioLDAP.php";
include "../connexioSQL.php";


echo "<div align='center'>";
if(isset($_SESSION['usuari'])){
    if($_POST){ //Si rebem les dades per $_POST...
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){
            
            $cn = htmlspecialchars($_POST['dnom']);
            $sr = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn"); // Busquem al sistema LDAP si hi ha alguna coincidencia.
            $entrades = ldap_get_entries($ds,$sr);

            if($entrades['count'] > 0){ // Si es troba coincidencia, l'eliminem.
                if ($ds){
                    $sr = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn");
                    $info = ldap_get_entries($ds,$sr);
                    $dn = $info[0]['dn'];
                    ldap_delete($ds,$dn);

                    $eliminar = "DELETE FROM usuaris WHERE usuari='".$_POST['dnom']."'";
                    $eliminarSQL = mysqli_query($connexio, $eliminar);

                    echo "L'usuari: $dn ha sigut eliminat.<br/>";
                    echo "<br/><a href='../../form/fusuaris/delusuari.php'> Enrere </a>";
                }
            } else { // Si no es troba coincidencia vol dir que no existeix.
                echo "Aquest usuari no es troba registrat.";
                echo "<br/><a href='../../form/fusuaris/delusuari.php'> Enrere </a>";
            }
        } else {
            echo "No tens permisos per veure aquest contingut.<br/><br/>";
            echo "<br/><a href='../../index.php'> Enrere </a>";
        }
    } elseif ($_GET){ //Si rebem les dades per $_GET...
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){

            $cn = htmlspecialchars($_GET['dnom']);
            $sr = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn"); // Busquem al sistema LDAP si hi ha alguna coincidencia.
            $entrades = ldap_get_entries($ds,$sr);

            if($entrades['count'] > 0){ // Si es troba coincidencia, l'eliminem.
                if ($ds){
                    $sr = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn");
                    $info = ldap_get_entries($ds,$sr);
                    $dn = $info[0]['dn'];
                    ldap_delete($ds,$dn);
                    
                    // Eliminem les assignacions de l'usuari eliminat.
                    $eliminar = "DELETE FROM usuariprojecte WHERE idusuari='".$_GET['idusuari']."'";
                    $eliminarSQL = mysqli_query($connexio, $eliminar);
                    
                    // Eliminem l'entrada de l'usuari.
                    $eliminar = "DELETE FROM usuaris WHERE usuari='".$_GET['dnom']."'";
                    $eliminarSQL = mysqli_query($connexio, $eliminar);

                    echo "<script languaje='javascript'>alert('L\'usuari $dn ha sigut eliminat correctament.'); window.location='../../menus/admin/gusuaris.php'</script>";
                }
            } else { // Si no es troba coincidencia vol dir que no existeix.
                echo "Aquest usuari no es troba registrat.";
                echo "<br/><a href='../../menus/admin/gusuaris.php'> Enrere </a>";
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
echo "</div>";

ldap_close($ds);
?>