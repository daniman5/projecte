<?php 
// dades per a la connexio a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','projectes'); 
define('DB_USER','root'); 
define('DB_PASS','siditas');

$connexio = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die ("No se ha podido conectar con MySQL");
?>