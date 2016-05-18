<?php
session_start();
include "../funcions/connexioSQL.php";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Página de usuario</title>
    </head>
    <body>
        <?php
        echo "<div align=center> ";
        if(isset($_SESSION['usuari'])){
            $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
            $consultaSQL = mysqli_query($connexio, $consulta);
            $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

            if($resultat['tipus'] == 'admin'){
                header("location: admin.php");
            } else {
                header("location: ../index.php");
            }
            echo "<br/><a href='../funcions/logout.php'> Desconnexió </a>";
        } else {
            echo "Primer has d'identificar-te.";
            echo "<br/><a href='../funcions/login/login.php'> Identificar-se </a>";
        }
        echo "</div>";
        ?>
    </body>
</html>