<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="es"> <!--<![endif]-->
<head>
<meta charset="utf-8">


<title>INS La Pineda &mdash; Repositori de projectes</title>
<meta name="description" content="Dissenyador de la pàgina: Daniel Montesinos Santos - 2016">
<meta name="author" content="Daniel Montesinos Santos">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================================================================= -->
<link rel="stylesheet" href="../../css/base.css">
<link rel="stylesheet" href="../../css/themes/type.css">
<link rel="stylesheet" href="../../css/themes/color.css">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Favicons
================================================================================================= -->
<link rel="shortcut icon" href="../../imatges/favicons/favicon.ico">
<link rel="apple-touch-icon" href="../../imatges/favicons/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../imatges/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../imatges/favicons/apple-touch-icon-114x114.png">

<!-- JS
================================================================================================= -->
<script src="../../js/libs/modernizr.min.js"></script>
<script src="../../js/libs/jquery-1.8.3.min.js"></script>
<script src="../../js/libs/jquery.easing.1.3.min.js"></script>
<script src="../../js/libs/jquery.fitvids.js"></script>
<script src="../../js/script.js"></script>

</head>
<body>

<!-- Escriu el preloader a la pàgina - això permet als usuaris carregar la pàgina encara que no tinguin el JS habilitat -->
<script type="text/javascript">
    document.write("<div id='sitePreloader'><div id='preloaderImage'><img src='../../imatges/site_preloader.gif' alt='Precarregant' /></div></div>");
</script>

<div class="container">
	
    <!-- Començament capçalera ========================================================================== -->
    <header class="sixteen columns">
        <div id="logo">
            <!--<h1>INS La Pineda</h1>-->
            <img src="../../imatges/logo.png" width="275" height="auto" alt="INS La Pineda"/>
            <h2 style="margin-top: 1px">Repositori de projectes</h2>
        </div>
        <nav style="margin-top:80px">
            <ul>
                <li><button id="workPage">Perfil personal</button></li>
                <li><button id="aboutPage">Els meus projectes</button></li>
                <li><button id="workPage"><a href="../../index.php">Tornar enrere</a></button></li>
            </ul>
        </nav>
        <hr />
    </header>
    <!-- Final de la capçalera ============================================================================ -->
	
    <!-- Començament de la pàgina principal ======================================================================= -->
    <div id="work">
        <h1 align="center" style="color:#0d8ebd">Menú d'usuari</h1>
        <hr />
        <?php
            session_start();
            include("../../funcions/connexioSQL.php");
            
            //Selecció de les dades de l'usuari autenticat actualment.
            $consulta = "SELECT * FROM usuaris WHERE usuari='".$_SESSION['usuari']."'";
            $consultaSQL = mysqli_query($connexio, $consulta);
            $usuari = mysqli_fetch_array($consultaSQL,MYSQLI_ASSOC);
            
            //Selecció de les dades del curs de l'usuari actualment autenticat.
            $consultacurs = "SELECT cnom FROM curs WHERE idcurs=".$usuari['cursFK'];
            $consultacursSQL = mysqli_query($connexio, $consultacurs);
            $curs = mysqli_fetch_array($consultacursSQL,MYSQLI_ASSOC);
            
        ?>
        
            <table style="margin:0px auto;">
                <form class="form" method='POST' action='../../funcions/gusuaris/modpersonal/personal.php'>
                <tr>
                    <th colspan="2" style="padding-bottom:20px"><h3 align="center" style="color:#0d8ebd">Vols modificar alguna cosa <span style="color:#43C0ED"><?php echo $usuari['nom']; ?></span>?</h3></th>
                </tr>
                <tr>
                    <th style="padding-right:20px"><strong>Nom</strong></th>
                    <td align="center"><strong>Curs</strong></td>
                </tr>
                <tr>
                    <td><input style="text-align:center" type="text" name="nom" placeholder="Nom" value="<?php echo $usuari['nom'];?>" required/></td>
                    <td style="text-align:center">
                        <?php echo $curs['cnom']; ?>
                    </td>
                </tr>
                <tr>
                    <th style="padding-right:20px"><strong>Primer cognom</strong></th>
                    <th><strong>Segon cognom</strong></th>
                </tr>
                <tr>
                    <td style="padding-right:20px"><input style="text-align:center" type="text" name="cognom1" placeholder="Primer cognom" value="<?php echo $usuari['cognom1'];?>" required/></td>
                    <td><input style="text-align:center" type="text" name="cognom2" placeholder="Segon cognom" value="<?php echo $usuari['cognom2'];?>" required/></td>
                </tr>
                <tr>
                    <th style="padding-right:20px" colspan="3"><strong>Correu electrònic</strong></th>
                    
                </tr>
                <tr>
                    <td colspan="2" align="center"><input style="text-align:center" type="text" name="email" placeholder="Correu electrònic" value="<?php echo $usuari['email'];?>" required/></td>
                </tr>
                <tr>
                    <th style="padding-right:20px"><strong>Contrasenya</strong></th>
                    <th><strong>Repetir contrasenya</strong></th>
                </tr>
                <tr>
                    <td><input style="text-align:center" type="password" name="contrasenya" placeholder="Nova contrasenya" /></td>
                    <td><input style="text-align:center" type="password" name="contrasenya2" placeholder="Nova contrasenya" /></td>
                </tr>
                
                    
                <!-- En cas de tractar-se d'un usuari tutor, mostrarem el missatge següent.-->
                <?php
                if($usuari['tutor']=="si"){
                    echo "<tr>";
                    echo "<td colspan=2 style='text-align:center;color:red;border:thin solid red;'>Tens assignat el rol de tutor <br/>per algun projecte</td>";
                    echo "</tr>";
                }
                ?>
                
                
                <tr>
                    <th colspan="3" style="padding-top: 20px"><input type='submit' value='Modificar' /></th>
                </tr>
                </form>
            </table>
        
            
    </div>
    <!-- Final de la pàgina principal  ========================================================================= -->

    <!-- Començament de la pàgina d'informació ====================================================================== -->
    <div id="about">
        <h1 align="center" style="color:#0d8ebd">Els meus projectes</h1>
        <hr />
        
        <table>
            <tr>
                <td>
                    <?php
                    $projecte = "SELECT * FROM projecte AS p INNER JOIN usuariprojecte AS up ON p.idprojecte=up.idprojecte INNER JOIN usuaris AS u ON u.idusuari=up.idusuari WHERE u.usuari='".$_SESSION['usuari']."'";
                    $projecteSQL = mysqli_query($connexio, $projecte);
                    $dades = mysqli_fetch_array($projecteSQL,MYSQLI_ASSOC);
                    
                    print_r($dades);
                    
                    
                    
                    ?>
                </td>
            </tr>
        </table>

    </div>
    <!-- Final de la pàgina d'informació ======================================================================== -->

    <!-- Començament del peu de pàgina ========================================================================== -->
    <footer class="sixteen columns">
        <hr />
        <ul id="footerLinks">
            <li>&copy; 2016 INS La Pineda. Tots els drets reservats.</li>
            <li><a href="mailto:hello@.com">hello@example.com</a></li>
            <li><a href="https://www.facebook.com/ins.lapineda" target="_blank">Facebook</a></li>

            <li>Pàgina principal <a href="http://www.inslapineda.cat/" target="_blank">INS La Pineda</a></li>
        </ul>
    </footer>
    <!-- Final del peu de pàgina ============================================================================ -->
		
</div><!-- Tancament del "container" -->
</body>
</html>