<?php
include "../connexioLDAP.php"; //connexio a LDAP
include "../connexioSQL.php"; //connexio a MySQL
?>


        
<?php
if($_POST){
    # Afegim variables per facilitar la localitzacio i gestio de les dades.
    # htmlspecialchars l'utilitzarem per a no tenir problemes d'injeccio de codi.
    $cn = htmlspecialchars($_POST['username']);
    $pw = htmlspecialchars($_POST['pw']);
    $primerNom = htmlspecialchars($_POST['firstname']);
    $cognom1 = htmlspecialchars($_POST['lastname1']);
    $cognom2 = htmlspecialchars($_POST['lastname2']);

    $comp = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn"); //Busquem a LDAP entrades amb aquest usuari.
    $entrades = ldap_get_entries($ds, $comp); //Transformem en resultat en una array d'entrades (contador).

    if($entrades['count'] > 0){ //Si hi han entrades = usuari ja registrat.
        echo "<script languaje='javascript'>alert('Aquest usuari ja es troba registrat.'); window.location='../../index.php'</script>";//Mostrem un missatge de confirmacio i l'usuari creat. 
    } else {

        # Afegim l'usuari a LDAP
        $r = ldap_bind($ds,"cn=admin,dc=lapineda,dc=cat","$ldappw"); //Connexio a LDAP amb credencials d'administrador.

        $info['objectClass'][0] = "top";
        $info['objectClass'][1] = "person";
        $info['objectClass'][2] = "organizationalPerson";
        $info['objectClass'][3] = "inetOrgPerson";
        $info['objectClass'][4] = "posixAccount";

        $info['givenName'] = $primerNom;
        $info['sn'] = $cognom1." ".$cognom2;
        //$info['cn'] = $primerNom." ".$cognom1." ".$cognom2; En principio no es necesario.
        $info['uid'] = $cn;
        $info['homeDirectory'] = "/home/noroot";
        $info['uidNumber'] = 1000;
        $info['gidNumber'] = 500;
        $info['loginShell'] = "/bin/false";
        $info['userPassword'] = "{SHA}" . base64_encode(sha1( $pw, TRUE ) );


        $r = ldap_add($ds,"cn=$cn,ou=usuaris,dc=lapineda,dc=cat",$info); //Afegim a LDAP l'usuari.


        # Afegim l'usuari a MySQL sense contrasenyes.
        $inserir = "INSERT INTO usuaris (nom,cognom1,cognom2,usuari,email,cursFK,tipus) VALUES ('".$info['givenName']."','".$_POST['lastname1']."','".$_POST['lastname2']."','".$info['uid']."','".$_POST['email']."','".$_POST['curs']."','normal')"; //Query per MySQL.
        $inserirSQL = mysqli_query($connexio, $inserir); // Execucio de la Query.


        # Comprovacio dels registres instroduits.
        $sr = ldap_search($ds,"dc=lapineda,dc=cat","cn=$cn"); //Busquem a l'arbre LDAP l'usuari nou per verificar-lo.
        $info = ldap_get_entries($ds,$sr); //Agafem les entrades de la cerca anterior.

        ldap_close($ds);
        echo "<script languaje='javascript'>alert('L\'usuari ha sigut creat correctament.'); window.location='../../form/fusuaris/login.php'</script>";//Mostrem un missatge de confirmacio i l'usuari creat. 
    }

    echo "<a href='../../index.php'>Iniciar sesió</a>";
} else {
    header("location: ../../form/fusuaris/registre.php");
}

?>
