<?php

include("funcions/connexioLDAP.php");
//
//$sr = "cn=dani,ou=usuaris,dc=lapineda,dc=cat";
//$entry = ldap_first_entry($ds,$r);
//$atributos = ldap_get_attributes($ds, $entry);
//
//echo $atributos["count"] . " atributos mantenidos por esta entrada:<p>";
//
//for ($i=0; $i < $atributos["count"]; $i++) {
//    echo $atributos[$i] . "<br />";
//}


$comp = ldap_search($ds,"dc=lapineda,dc=cat","cn=dani");
$entrades = ldap_get_entries($ds, $comp);



echo "object";
echo "<br/>";
print_r($entrades[0]['objectclass']);
echo "<br/>";
echo "given";
echo "<br/>";
print_r($entrades[0]['givenname']);
echo "<br/>";
echo "sn";
echo "<br/>";
print_r($entrades[0]['sn']);
echo "<br/>";
echo "cn";
echo "<br/>";
print_r($entrades[0]['cn']);
echo "<br/>";
echo "uid";
echo "<br/>";
print_r($entrades[0]['uid']);
echo "<br/>";
echo "shell";
echo "<br/>";
print_r($entrades[0]['loginshell']);
echo "<br/>";
echo "pass";
echo "<br/>";
print_r($entrades[0]['userpassword']);
echo "<br/>";
echo "home";
echo "<br/>";
print_r($entrades[0]['homedirectory']);
echo "<br/>";
echo "dn";
echo "<br/>";
print_r($entrades[0]['dn']);
?>