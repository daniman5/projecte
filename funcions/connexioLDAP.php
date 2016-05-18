<?php
//$ldaphost = "192.168.21.90";
$ldaphost = "192.168.1.50";
$ldapport = "389";
#$ldapport = "636";
            
$ldapuser = "admin";
$ldappw = "q1w2e3r4";

$ds = ldap_connect($ldaphost,$ldapport) or die ("Problemas para conectar con LDAP Server");
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

$r = ldap_bind($ds,"cn=admin,dc=lapineda,dc=cat","$ldappw") or die ("No se ha podido conectar, contacta con un administrador."); //Connexio a LDAP amb credencials d'administrador.
?>