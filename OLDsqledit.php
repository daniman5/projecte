<?php
include "funcions/connexioSQL.php";

    $id['idprojecte'] = 2;
    $id['gpass'] = 444;
            
    $SQL = "SET PASSWORD FOR '".$id['idprojecte']."'@'localhost' = PASSWORD('".$id['gpass']."')";
    mysqli_query($connexio, $SQL);
    
?>
