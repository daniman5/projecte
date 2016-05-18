<?php
    function validar($usuari,$pw){
        $ldaphost = "192.168.1.50";
        $ldapport = "389";
            
        $ds = ldap_connect($ldaphost,$ldapport) or die ("Problemas para conectar con LDAP Server");
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

        if ($ds){
            $ldapaut = ldap_bind($ds,"cn=$usuari,ou=usuaris,dc=lapineda,dc=cat",$pw);
            
            if($ldapaut){
                return 1;
            } else {
                return 0;
            }
        }
    }   
?>