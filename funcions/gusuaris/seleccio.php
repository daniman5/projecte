<?php
function llistausuaris(){
    include "../../funcions/connexioSQL.php";
    if(isset($_SESSION['usuari'])){
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){

            $llista = "SELECT * FROM usuaris WHERE idusuari=".$_POST['sub_cat'];
            $llistaSQL = mysqli_query($connexio,$llista);

            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>ID</th>";
            echo "<th>Nom</th>";
            echo "<th>Cognoms</th>";
            echo "<th>Usuari</th>";
            echo "<th>Email</th>";
            echo "<th>Curs</th>";
            echo "<th>Privilegis</th>";
            echo "<th>Estat</th>";
            //echo "<th>Perfil</th>";
            echo "<th>Eliminar</th></tr></thead>";

            while($datos = mysqli_fetch_array($llistaSQL,MYSQLI_ASSOC)){
                echo "<tbody><tr align=center><td>".$datos['idusuari']."</td>";
                echo "<td>".$datos['nom']."</td>";
                echo "<td>".$datos['cognom1']." ".$datos['cognom2']."</td>";
                echo "<td>".$datos['usuari']."</td>";
                echo "<td>".$datos['email']."</td>";
                echo "<td>".$datos['cursFK']."</td>";
                echo "<td align=center><a href='../../funcions/gusuaris/rol.php?id=".$datos['idusuari']."&tipus=".$datos['tipus']."'>".$datos['tipus']." <i class='fa fa-refresh' aria-hidden='true'></i></a></td>";
                echo "<td>".$datos['estat']."</td>";
                //echo "<td align='center'><a href='../../funcions/usuari/perfil.php?id=".$datos['idusuari']."'><i class='fa fa-check-square-o' aria-hidden='true'></i></a></td>";
                echo "<td align='center'><a href='../../funcions/gusuaris/delusuari.php?dnom=".$datos['usuari']."&idusuari=".$datos['idusuari']."'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr></tbody>";

            }
            echo "</table>";


        } else {
            echo "No tens permisos per veure aquest contingut.<br/><br/>";
            echo "<br/><a href='../../index.php'> Enrere </a>";
        }
    } else {
        echo "Primer has d'identificar-te.";
        echo "<br/><a href='../../index.php'> Enrere </a>";
    }
}
?>