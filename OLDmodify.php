<?php
session_start();
include "funcions/connexioLDAP.php";
?>

<?php
echo "<div align='center'>";
echo "<h1>Modificació d'entrades</h1>";
echo "<form method='POST' action=''>";
echo "<table border=0>";
echo "<tr>";
echo "<td colspan=2> <input name='persona' placeholder='Usuari a modificar' type='text' /></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=2> <input name='droot' placeholder='Nova carpeta personal' type='text' /></td>";
echo "</tr>";
echo "<tr><td align=center height=50><input type='submit' value='Modificar' /></td>";
echo "<td align=center><a href='../../menus/admin/gprojectes.php'> Enrere </a></td></tr>";
echo "</table>";
echo "</div>";

if($_POST){
    $modificar['homeDirectory'] = "/home/".$_POST['droot'];
    $mod = ldap_mod_replace($ds,"cn=".$_POST['persona'].",ou=usuaris,dc=lapineda,dc=cat", $modificar);
    echo "L'usuari ".$_POST['persona']." ha sigut modificat.";
}
?>