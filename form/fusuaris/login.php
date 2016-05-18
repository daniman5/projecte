<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Identificar-se a INS La Pineda - Repositori de projectes</title>

        <link rel="stylesheet" href="css/reset.css">
        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body style='margin: 0px auto; margin-top: 5%'>
        <div class="module form-module">
            <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                <div class="tooltip">Registrar-se</div>
            </div>
        <div class="form">
            <h2>Identificació d'usuari</h2>
            <form action='../../funcions/login/login.php' method="POST">
                <input type="text" placeholder="Usuari" name='usuari' autofocus/>
                <input type="password" placeholder="Contrasenya" name="pw"/>
                <button class="pen-title">Identifircar-se</button>
            </form>
            <br/>
            <a href="javascript:history.go(-1);"><i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true"></i></a>
        </div>
        <div class="form">
            <h2>Creació d'una conta nova</h2>
            <form action='../../funcions/gusuaris/ldapuseradd.php' method="POST">
                <table>
                    <tr>
                        <td colspan="2"><input name='firstname' placeholder='Nom' type='text' required/></td>
                    </tr>
                    <tr>
                        <td><input name='lastname1' placeholder='Primer cognom' type='text' required/></td>
                        <td><input name='lastname2' placeholder='Segon cognom' type='text' required/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input name='email' placeholder='Correu electrònic' type='text' /></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center">
                        <?php
                            include("../../funcions/connexioSQL.php");
                            $consulta= "SELECT * FROM curs";
                            $consultaSQL= mysqli_query($connexio,$consulta);

                            echo "<select name='curs'>";
                            while($datos = mysqli_fetch_array($consultaSQL,MYSQLI_ASSOC)){
                                echo "<option value='".$datos['idcurs']."'>".$datos['cnom']." | ".$datos['matricula']."</option>"; //Mostrem els cursos disponibles per als usuaris nous.
                            }
                            echo "</select>";
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br/></td>
                    </tr>
                    <tr>
                        <td><input name='username' placeholder='Usuari' type='text' required/></td>
                        <td><input name='pw' placeholder='Contrasenya' type='password' required/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type='submit' value='Registrar-se' /></td>
                    </tr>
                </table>
            </form>
            
        </div>
        <!--<div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>-->
        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='js/da0415260bc83974687e3f9ae.js'></script>
        <script src="js/index.js"></script>
  </body>
</html>
