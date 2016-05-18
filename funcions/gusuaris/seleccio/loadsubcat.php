<?php 
include "config.php";

$parent_cat = $_GET['parent_cat'];

$query = mysql_query("SELECT * FROM usuaris WHERE cursFK = {$parent_cat}");

echo "<option value='#'>Selecciona l'usuari</option>";
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[idusuari]'>$row[nom] $row[cognom1] $row[cognom2]</option>";
}
?>