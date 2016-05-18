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
        if($_POST){
            $consulta = "SELECT pnom FROM projecte WHERE pnom='".htmlspecialchars($_POST['gnom'])."'";
            $consultaSQL = mysqli_query($connexio, $consulta);
            $fila = mysqli_num_rows($consultaSQL);

            if($fila > 0){ //El projecte ja existeix.
                echo "<script languaje='javascript'>alert('Aquest projecte ja es troba registrat'); window.location='../../menus/admin/gprojectes.php'</script>";
            } else {
                $inserir = "INSERT INTO projecte (pnom,idcursFK,idtutorFK) VALUES ('".htmlspecialchars($_POST['gnom'])."','".htmlspecialchars($_POST['gcurs'])."','".htmlspecialchars($_POST['tutor'])."')";
                $inserirSQL = mysqli_query($connexio, $inserir);
                
                // Agafem la ID del projecte que acabem de crear per a utilitzarla com a nom de DB i carpeta home.
                $idprojecte = "SELECT idprojecte FROM projecte WHERE pnom='".htmlspecialchars($_POST['gnom'])."'";
                $idprojecteSQL = mysqli_query($connexio, $idprojecte);
                $id = mysqli_fetch_array($idprojecteSQL, MYSQLI_ASSOC);
                
                
                // Afegim una nova base de dades a MySQL i li creem un usuari amb el mateix nom i tots els permisos.
                mysqli_query($connexio, "CREATE USER '".$id['idprojecte']."'@'localhost' IDENTIFIED BY '".$_POST['gpass']."'");//Creació de l'usuari i contrasenya.
                mysqli_query($connexio, "GRANT USAGE ON *.* TO '".$id['idprojecte']."'@'localhost'");//Permisos per utilitzar les bases de dades.
                mysqli_query($connexio, "CREATE DATABASE IF NOT EXISTS `".$id['idprojecte']."`");//Creació de la base de dades.
                mysqli_query($connexio, "GRANT ALL PRIVILEGES ON `".$id['idprojecte']."`.* TO '".$id['idprojecte']."'@'localhost'");//Permisos per a la seva base de dades.
                
                
                // Afegim el projecte(usuari) a LDAP
                $info['objectClass'][0] = "top";
                $info['objectClass'][1] = "person";
                $info['objectClass'][2] = "organizationalPerson";
                $info['objectClass'][3] = "inetOrgPerson";
                $info['objectClass'][4] = "posixAccount";
                
                $info['givenName'] = $id['idprojecte'];
                $info['sn'] = $_POST['gnom'];
                $info['cn'] = $id['idprojecte'];
                $info['uid'] = $id['idprojecte'];
                $info['homeDirectory'] = "/home/".$id['idprojecte']."/public_html/";
                $info['uidNumber'] = 1000;
                $info['gidNumber'] = 500;
                $info['loginShell'] = "/bin/false";
                
                $pw = "TXuRvkhS%2ynIpzz";//Contrasenya estatica -> Sense acces per a usuaris.
                $info['userPassword'] = "{SHA}" . base64_encode(sha1( $pw, TRUE ) );
                
                $r = ldap_add($ds,"cn=".$id['idprojecte'].",ou=grups,dc=lapineda,dc=cat",$info); //Afegim a LDAP l'usuari.
                
                
                echo "<script languaje='javascript'>alert('Heu creat el projecte ".$_POST['gnom']." satisfactòriament amb ID ".$id['idprojecte']." i la seva DB.'); window.location='../../form/fprojectes/addprojecte.php'</script>";
            }
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