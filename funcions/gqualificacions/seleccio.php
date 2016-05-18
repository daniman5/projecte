<?php
function qualificacio(){
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
            //echo "<th>Curs</th>";
            echo "<th>Presentació</th>";
            echo "<th>Utilitat</th>";
            echo "<th>Dificultat</th>";
            echo "<th>Final</th>";
            echo "<th>Enllaç</th>";
            echo "<th>Modificar</th></tr></thead>";

            while($datos = mysqli_fetch_array($llistaSQL,MYSQLI_ASSOC)){
                $curs = "SELECT cnom,matricula FROM curs WHERE idcurs=".$datos['idcursFK'];
                $cursSQL = mysqli_query($connexio, $curs);
                $dcurs = mysqli_fetch_array($cursSQL,MYSQLI_ASSOC);
                
                $notes = "SELECT * FROM projectenota WHERE idprojecte=".$datos['idprojecte']; 
                $notesSQL = mysqli_query($connexio, $notes);
                $fila = mysqli_fetch_row($notesSQL);
                
                
                if($fila > 0){
                    $notes = "SELECT * FROM projectenota WHERE idprojecte=".$datos['idprojecte']; 
                    $notesSQL = mysqli_query($connexio, $notes);
                    $nota = mysqli_fetch_array($notesSQL,MYSQLI_ASSOC);
                    echo "<tbody><tr><td>".$datos['idprojecte']."</td>";
                    echo "<td>".$datos['pnom']."</td>";
                    //echo "<td>".$dcurs['matricula']." | ".$dcurs['cnom']."</td>";
                    if($nota['presentacio'] >= 5){
                        echo "<td align='center' style='background:#A4FFA9'>".$nota['presentacio']." (".$nota['prepercent']."%)</td>";
                    } else {
                        echo "<td align='center' style='background:#FFA4A4'>".$nota['presentacio']." (".$nota['prepercent']."%)</td>";
                    }
                    if($nota['utilitat'] >= 5){
                        echo "<td align='center' style='background:#A4FFA9'>".$nota['utilitat']." (".$nota['utipercent']."%)</td>";
                    } else {
                        echo "<td align='center' style='background:#FFA4A4'>".$nota['utilitat']." (".$nota['utipercent']."%)</td>";
                    }
                    if($nota['dificultat'] >= 5){
                        echo "<td align='center' style='background:#A4FFA9 '>".$nota['dificultat']." (".$nota['difpercent']."%)</td>";
                    } else {
                        echo "<td align='center' style='background:#FFA4A4'>".$nota['dificultat']." (".$nota['difpercent']."%)</td>";
                    }

                    if($nota['global'] >= 5){
                        echo "<td align='center' style='color:white;background:green'>".$nota['global']."</td>";
                    } else {
                        echo "<td align='center' style='color:white;background:red'>".$nota['global']."</td>";
                    }

                    echo "<td align='center'><a href='https://192.168.21.91/~".$datos['idprojecte']."'><i class='fa fa-link' aria-hidden='true'></i></a></td>";
                    echo "<td align='center'><a href='../../form/fqualificacions/qualificar.php?idprojecte=".$datos['idprojecte']."'><i class='fa fa-pencil' aria-hidden='true'></i></a></td></tr></tbody>";
                } else {
                    echo "<tbody><tr><td>".$datos['idprojecte']."</td>";
                    echo "<td>".$datos['pnom']."</td>";
                    echo "<td align='center'> - </td>";
                    echo "<td align='center'> - </td>";
                    echo "<td align='center'> - </td>";
                    echo "<td align='center'> - </td>";
                    
                    echo "<td align='center'><a href='https://192.168.21.91/~".$datos['idprojecte']."'><i class='fa fa-link' aria-hidden='true'></i></a></td>";
                    echo "<td align='center'><a href='../../form/fqualificacions/qualificar.php?idprojecte=".$datos['idprojecte']."'><i class='fa fa-pencil' aria-hidden='true'></i></a></td></tr></tbody>";
                }
                
            }
            
            echo "</table>";
            
            // Mostrem el comentari del projecte.
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>Comentari del projecte</th></tr>";
            if(isset($nota)){
                echo "<tbody><tr><td>".$nota['comentari']."</td></tr></tbody>";
            } else {
                echo "<tbody><tr><td>No hi ha cap comentari.</td></tr></tbody>";
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