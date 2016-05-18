<?php
function llistacursos(){
    include "../../funcions/connexioSQL.php";
    if(isset($_SESSION['usuari'])){
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);


        if($resultat['tipus'] == 'admin'){
            $llista = "SELECT * FROM curs ORDER BY matricula DESC"; //Seleccionem tots els cursos amb ordre DESCENDENT.
            $llistaSQL = mysqli_query($connexio,$llista);

            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>ID</th>";
            echo "<th>Nom del cicle</th>";
            echo "<th>Matrícula</th>";
            echo "<th>Eliminar</th></tr></thead>";

            while($datos = mysqli_fetch_array($llistaSQL,MYSQLI_ASSOC)){
                echo "<tbody><tr><td>".$datos['idcurs']."</td>";
                echo "<td>".$datos['cnom']."</td>";
                echo "<td>".$datos['matricula']."</td>";
                echo "<td align='center'><a href='../../funcions/gcursos/delcurs.php?idcurs=".$datos['idcurs']."'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr></tbody>";
            }
            echo "</table>";

            echo "<table class='table'>";
            echo "<tr><td><a class='btn btn-success' href='../../form/fcursos/addcurs.php'> Crear curs </a></td></tr>";
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