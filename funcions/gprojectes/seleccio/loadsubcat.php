<?php 
include "config.php";

$parent_cat = $_GET['parent_cat'];

$query = mysql_query("SELECT * FROM projecte WHERE idcursFK = {$parent_cat}");

echo "<option value='#'>Selecciona el projecte</option>";
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[idprojecte]'><strong>ID:</strong> $row[idprojecte] - $row[pnom]</option>";
}
?>