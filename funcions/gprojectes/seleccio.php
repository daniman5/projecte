<?php
function llistaprojectes(){
    include "../../funcions/connexioSQL.php";
    if(isset($_SESSION['usuari'])){
        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
        $consultaSQL = mysqli_query($connexio, $consulta);
        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

        if($resultat['tipus'] == 'admin'){
            $llista = "SELECT * FROM projecte WHERE idprojecte=".$_POST['sub_cat'];
            $llistaSQL = mysqli_query($connexio,$llista);

            
            
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>ID</th>";
            echo "<th>Nom de Projecte</th>";
            echo "<th>Curs</th>";
            echo "<th>Tutor</th>";
            echo "<th>Enllaç</th>";
            echo "<th>Reiniciar contrasenya</th>";
            echo "<th>Eliminar</th></tr></thead>";

            while($datos = mysqli_fetch_array($llistaSQL,MYSQLI_ASSOC)){
                $curs = "SELECT cnom,matricula FROM curs WHERE idcurs=".$datos['idcursFK'];
                $cursSQL = mysqli_query($connexio, $curs);
                $dcurs = mysqli_fetch_array($cursSQL,MYSQLI_ASSOC);
                
                $tutor = "SELECT * FROM usuaris WHERE idusuari=".$datos['idtutorFK'];
                $tutorSQL = mysqli_query($connexio, $tutor);
                $tutors = mysqli_fetch_array($tutorSQL);
                
                echo "<tbody><tr><td>".$datos['idprojecte']."</td>";
                echo "<td>".$datos['pnom']."</td>";
                echo "<td>".$dcurs['matricula']." | ".$dcurs['cnom']."</td>";
                echo "<td>".$tutors['nom']." ".$tutors['cognom1']." ".$tutors['cognom2']."</td>";
                echo "<td align='center'><a href='https://192.168.21.91/~".$datos['idprojecte']."'><i class='fa fa-link' aria-hidden='true'></i></a></td>";
                echo "<td align='center'><a href='../../form/fprojectes/modprojecte.php?id=".$datos['idprojecte']."'><i class='fa fa-key' aria-hidden='true'></i></a></td>";
                echo "<td align='center'><a href='../../funcions/gprojectes/delprojecte.php?idprojecte=".$datos['idprojecte']."'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr></tbody>";
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