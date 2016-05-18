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
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/themes/type.css">
<link rel="stylesheet" href="css/themes/color.css">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Favicons
================================================================================================= -->
<link rel="shortcut icon" href="images/favicons/favicon.ico">
<link rel="apple-touch-icon" href="images/favicons/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-touch-icon-114x114.png">

<!-- JS
================================================================================================= -->
<script src="js/libs/modernizr.min.js"></script>
<script src="js/libs/jquery-1.8.3.min.js"></script>
<script src="js/libs/jquery.easing.1.3.min.js"></script>
<script src="js/libs/jquery.fitvids.js"></script>
<script src="js/script.js"></script>

</head>
<body>

<!-- Escriu el preloader a la pàgina - això permet als usuaris carregar la pàgina encara que no tinguin el JS habilitat -->
<script type="text/javascript">
    document.write("<div id='sitePreloader'><div id='preloaderImage'><img src='imatges/site_preloader.gif' alt='Precarregant' /></div></div>");
</script>

<div class="container">
	
    <!-- Començament capçalera ========================================================================== -->
    <header class="sixteen columns">
        <div id="logo">
            <!--<h1>INS La Pineda</h1>-->
            <img src="imatges/logo.png" width="275" height="auto" alt="INS La Pineda"/>
            <h2 style="margin-top: 1px">Repositori de projectes</h2>
        </div>
        <nav style="margin-top:80px">
            <ul>
                <li><button id="workPage">Projectes</button></li>
                <li><button id="aboutPage">Informació</button></li>
                <?php
                    session_start();
                    include("funcions/connexioSQL.php");
                    if(isset($_SESSION['usuari'])){
                        $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
                        $consultaSQL = mysqli_query($connexio, $consulta);
                        $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

                    if($resultat['tipus'] != 'admin'){
                        echo '<li><button"><a href="menus/usuari/personal.php">Àrea personal</a></button></li>';
                        echo '<li><button"><a href="funcions/logout.php">Sortir</a></button></li>';
                    } else {
                        echo '<li><button><a href="menus/admin/taulell.php">Àrea personal</a></button></li>';
                        echo '<li><button"><a href="funcions/logout.php">Sortir</a></button></li>';
                    }
                } else {
                    echo '<li><button><a href="form/fusuaris/login.php">Identificar-se</a></button></li>';
                }
                ?>
            </ul>
        </nav>
        <hr />
    </header>
    <!-- Final de la capçalera ============================================================================ -->
	
    <!-- Començament de la pàgina principal ======================================================================= -->
    <div id="work">
        <h1 align="center" style="color:#0d8ebd">Projectes destacats</h1>
        <hr />
            <div id="overview" class="sixteen columns">
                <h3>A <strong>INS La Pineda</strong> pensem que les oportunitats no ocorren, les fabriquem nosaltres.</h3>
                <hr />
            </div>

            <!-- Començament de la primera columna de la pàgina principal -->
            <div class="six columns" id="col1">
                <h3 align="center">SMX</h3>

                    <!-- Començament del projecte ================================================================= -->
                    <?php
                        $projecte = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs INNER JOIN projectenota AS n ON n.idprojecte=p.idprojecte WHERE c.cnom='CFGM - SMX' ORDER BY n.global DESC LIMIT 3";
                        $projecteSQL = mysqli_query($connexio, $projecte);


                        while($projecte = mysqli_fetch_array($projecteSQL,MYSQLI_ASSOC)){ 

                        $puntuacio = "SELECT * FROM projectenota AS n INNER JOIN projecte AS p ON p.idprojecte=n.idprojecte WHERE p.idprojecte=".$projecte['idprojecte'];
                        $puntuacioSQL = mysqli_query($connexio, $puntuacio);
                        $puntudades = mysqli_fetch_array($puntuacioSQL,MYSQLI_ASSOC); ?>

                            <div class="project">
                                <div class="projectThumbnail">
                                    <svg class="thumbnailMask"></svg>
                                    <div class="projectThumbnailHover">
                                        <?php echo "<h4>".$projecte['pnom']."</h4>";
                                        echo "<h5>Puntuació: ".$puntudades['global']."</h5>"; ?>
                                    </div>

                                    <img src="imatges/projectes/projecte.jpg" alt="Projecte" class="thumbnailImage" />
                                </div>

                                <div class="projectInfo">
                                    <h4><?php echo $projecte['pnom']; ?></h4>
                                    <div class="projectNavCounter"></div>
                                    <div class="projectNav">
                                        <div class="projectNavEnlarge"><button class="enlargeButton" onClick="window.location.href='menus/usuari/projecte.php?id=<?php echo $projecte['idprojecte'] ?>'">Pantalla completa</button></div>
                                        <div class="projectNavClose"><button class="closeButton">Tancar</button></div>
                                        <div class="projectNavButtons"><button class="prev"></button><button class="next"></button></div>
                                    </div>
                                    <p>
                                        <?php echo $projecte['descripcio']; ?>
                                    </p>
                                    <ul>
                                        <?php 

                                            $sub = "SELECT * FROM usuaris AS u INNER JOIN usuariprojecte AS up ON up.idusuari=u.idusuari WHERE up.idprojecte=".$projecte['idprojecte'];
                                            $subSQL = mysqli_query($connexio, $sub);
                                        ?>
                                        <li><strong>Autors: </strong>
                                            <?php   
                                                $autors = '';
                                                while($autor = mysqli_fetch_array($subSQL,MYSQLI_ASSOC)){
                                                    $autors .= $autor['nom']." ".$autor['cognom1'].", ";
                                                }
                                                $autors = substr($autors, 0, -2);
                                                echo $autors;
                                            ?>

                                        </li>
                                        <li><strong>Cicle formatiu: </strong> 
                                            <?php

                                                $cicle = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs";
                                                $cicleSQL = mysqli_query($connexio, $cicle);
                                                $cicledades = mysqli_fetch_array($cicleSQL,MYSQLI_ASSOC);

                                                echo $cicledades['cnom'];

                                            ?>
                                        </li>
                                        <li><strong>Any: </strong><?php echo $cicledades['matricula']; ?></li>
                                    </ul>
                                </div>
                            </div>
                    <?php   } ?>

                    <!-- Final del projecte =================================================================== -->

            </div>
            <!-- Final de la primera columna (col1) -->

            <!-- Començament de la segona columna de la pàgina principal -->
            <div class="six columns" id="col2">
                <h3 align="center">ASIX</h3>
                <!-- Començament del projecte ================================================================= -->
                    <?php
                        $projecte = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs INNER JOIN projectenota AS n ON n.idprojecte=p.idprojecte WHERE c.cnom='CFGS - ASIX' ORDER BY n.global DESC LIMIT 3";
                        $projecteSQL = mysqli_query($connexio, $projecte);


                        while($projecte = mysqli_fetch_array($projecteSQL,MYSQLI_ASSOC)){ 

                        $puntuacio = "SELECT * FROM projectenota AS n INNER JOIN projecte AS p ON p.idprojecte=n.idprojecte WHERE p.idprojecte=".$projecte['idprojecte'];
                        $puntuacioSQL = mysqli_query($connexio, $puntuacio);
                        $puntudades = mysqli_fetch_array($puntuacioSQL,MYSQLI_ASSOC); ?>

                            <div class="project">
                                <div class="projectThumbnail">
                                    <svg class="thumbnailMask"></svg>
                                    <div class="projectThumbnailHover">
                                        <?php echo "<h4>".$projecte['pnom']."</h4>";
                                        echo "<h5>Puntuació: ".$puntudades['global']."</h5>"; ?>
                                    </div>

                                    <img src="imatges/projectes/projecte.jpg" alt="Projecte" class="thumbnailImage" />
                                </div>

                                <div class="projectInfo">
                                    <h4><?php echo $projecte['pnom']; ?></h4>
                                    <div class="projectNavCounter"></div>
                                    <div class="projectNav">
                                        <div class="projectNavEnlarge"><button class="enlargeButton" onClick="window.location.href='menus/usuari/projecte.php?id=<?php echo $projecte['idprojecte'] ?>'">Pantalla completa</button></div>
                                        <div class="projectNavClose"><button class="closeButton">Tancar</button></div>
                                        <div class="projectNavButtons"><button class="prev"></button><button class="next"></button></div>
                                    </div>
                                    <p>
                                        <?php echo $projecte['descripcio']; ?>
                                    </p>
                                    <ul>
                                        <?php 

                                            $sub = "SELECT * FROM usuaris AS u INNER JOIN usuariprojecte AS up ON up.idusuari=u.idusuari WHERE up.idprojecte=".$projecte['idprojecte'];
                                            $subSQL = mysqli_query($connexio, $sub);
                                        ?>
                                        <li><strong>Autors: </strong>
                                            <?php   
                                                $autors = '';
                                                while($autor = mysqli_fetch_array($subSQL,MYSQLI_ASSOC)){
                                                    $autors .= $autor['nom']." ".$autor['cognom1'].", ";
                                                }
                                                $autors = substr($autors, 0, -2);
                                                echo $autors;
                                            ?>

                                        </li>
                                        <li><strong>Cicle formatiu: </strong> 
                                            <?php

                                                $cicle = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs";
                                                $cicleSQL = mysqli_query($connexio, $cicle);
                                                $cicledades = mysqli_fetch_array($cicleSQL,MYSQLI_ASSOC);

                                                echo $cicledades['cnom'];

                                            ?>
                                        </li>
                                        <li><strong>Any: </strong><?php echo $cicledades['matricula']; ?></li>
                                    </ul>
                                </div>
                            </div>
                    <?php   } ?>

                    <!-- Final del projecte =================================================================== -->
            </div>
            <!-- Final de la segona columna (col2) -->
            
            <!-- Començament de la tercera columna de la pàgina principal -->
            <div class="six columns" id="col3">
                <h3 align="center">DAW</h3>
                <!-- Començament del projecte ================================================================= -->
                    <?php
                        $projecte = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs INNER JOIN projectenota AS n ON n.idprojecte=p.idprojecte WHERE c.cnom='CFGS - DAW' ORDER BY n.global DESC LIMIT 3";
                        $projecteSQL = mysqli_query($connexio, $projecte);


                        while($projecte = mysqli_fetch_array($projecteSQL,MYSQLI_ASSOC)){ 

                        $puntuacio = "SELECT * FROM projectenota AS n INNER JOIN projecte AS p ON p.idprojecte=n.idprojecte WHERE p.idprojecte=".$projecte['idprojecte'];
                        $puntuacioSQL = mysqli_query($connexio, $puntuacio);
                        $puntudades = mysqli_fetch_array($puntuacioSQL,MYSQLI_ASSOC); ?>

                            <div class="project">
                                <div class="projectThumbnail">
                                    <svg class="thumbnailMask"></svg>
                                    <div class="projectThumbnailHover">
                                        <?php echo "<h4>".$projecte['pnom']."</h4>";
                                        echo "<h5>Puntuació: ".$puntudades['global']."</h5>"; ?>
                                    </div>

                                    <img src="imatges/projectes/projecte.jpg" alt="Projecte" class="thumbnailImage" />
                                </div>

                                <div class="projectInfo">
                                    <h4><?php echo $projecte['pnom']; ?></h4>
                                    <div class="projectNavCounter"></div>
                                    <div class="projectNav">
                                        <div class="projectNavEnlarge"><button class="enlargeButton" onClick="window.location.href='menus/usuari/projecte.php?id=<?php echo $projecte['idprojecte'] ?>'">Pantalla completa</button></div>
                                        <div class="projectNavClose"><button class="closeButton">Tancar</button></div>
                                        <div class="projectNavButtons"><button class="prev"></button><button class="next"></button></div>
                                    </div>
                                    <p>
                                        <?php echo $projecte['descripcio']; ?>
                                    </p>
                                    <ul>
                                        <?php 

                                            $sub = "SELECT * FROM usuaris AS u INNER JOIN usuariprojecte AS up ON up.idusuari=u.idusuari WHERE up.idprojecte=".$projecte['idprojecte'];
                                            $subSQL = mysqli_query($connexio, $sub);
                                        ?>
                                        <li><strong>Autors: </strong>
                                            <?php   
                                                $autors = '';
                                                while($autor = mysqli_fetch_array($subSQL,MYSQLI_ASSOC)){
                                                    $autors .= $autor['nom']." ".$autor['cognom1'].", ";
                                                }
                                                $autors = substr($autors, 0, -2);
                                                echo $autors;
                                            ?>

                                        </li>
                                        <li><strong>Cicle formatiu: </strong> 
                                            <?php

                                                $cicle = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs WHERE p.idprojecte=".$projecte['idprojecte'];
                                                $cicleSQL = mysqli_query($connexio, $cicle);
                                                $cicledades = mysqli_fetch_array($cicleSQL,MYSQLI_ASSOC);

                                                echo $cicledades['cnom'];

                                            ?>
                                        </li>
                                        <li><strong>Any: </strong><?php echo $cicledades['matricula']; ?></li>
                                    </ul>
                                </div>
                            </div>
                    <?php   } ?>

                    <!-- Final del tercer projecte =================================================================== -->
            </div>
            <!-- Final de la tercera columna (col3) -->
            
    </div>
    <!-- Final de la pàgina principal  ========================================================================= -->

    <!-- Començament de la pàgina d'informació ====================================================================== -->
    <div id="about">

            <!-- Començament de la primera columna ==================================================================== -->
            <div class="eight columns">

                    <h3>About page header</h3>
                    <p>
                    Type &amp; Grids is a HTML5 template that focuses on typography and grids. It's responsive which means it looks great on all devices from desktops to laptops to tablets and mobile phones. It's super-customizable and comes with lots of nicely designed type and color themes. Download the <a href="http://www.typeandgrids.com/downloads/type_and_grids_free.zip">free zip file</a> to get started!
                    </p>

                    <h4>Subheader lorem ipsum</h4>
                    <p>
                            10% of every sale is donated to the <strong><a href="http://www.audubon.org/" target="_blank">National Audubon Society</a></strong>. Audubon's mission: To conserve and restore natural ecosystems, focusing on birds, other wildlife, and their habitats for the benefit of humanity and the earth's biological diversity.
                    </p>

                    <h4>Subheader lorem ipsum</h4>
                    <p>
                            Type &amp; Grids comes with 19 different type theme CSS files and 28 different color theme CSS files. You can easily mix and match the type and color themes to create a unique design for your site. No CSS knowledge is needed and all of the fonts shown in the <a href="http://demo.typeandgrids.com" target="_blank">demo</a> are included. 58 different background textures come with the download as well.
                    </p>

                    <ul class="disc">
                            <li>Simple to set up and update &ndash; all of the content is inside a single "index.html" page</li>
                            <li>Contains 19 type themes and 28 color themes which gives you over 500 unique design combinations &ndash; 58 background textures are included as well</li>
                            <li>Each type theme is meticulously handcrafted to ensure attention is paid to the small typographic details</li>
                            <li>Fully responsive design &ndash; looks great on all devices from desktops to laptops to tablets and mobile phones</li>
                            <li>Swipe-enabled with hardware accelerated transitions &ndash; works super-smoothly on touch devices like the iPhone and iPad</li>
                            <li>Coded using the latest HTML5/CSS3 standards and all code is <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fdemo.typeandgrids.com%2F" target="_blank">W3C valid</a> and cross-browser compatible</li>
                            <li>Video support &ndash; easily embed your videos from Vimeo or YouTube</li>
                            <li>Clean and semantic SEO-friendly code</li>
                            <li>Design featured on the <a href="http://www.thefwa.com/shortlist/jeremiah-shoaf" target="_blank">FWA Public Shortlist</a>, <a href="http://creattica.com/css/jeremiah-shoaf/90288" target="_blank">Creattica</a> and numerous other design sites</li>
                            <li><a href="http://www.typeandgrids.com/support/" target="_blank">Support and documentation</a> is available but everything is so simple to set up you probably won't need it</li>
                    </ul>

                    <h4>Subheader lorem ipsum</h4>
                    <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac ante arcu, quis auctor sapien. Morbi magna leo, dapibus a pulvinar et, pharetra scelerisque felis. Mauris massa magna, gravida vitae convallis sagittis, sagittis ac ipsum. Integer arcu justo, vehicula vel accumsan ac, venenatis in massa. Curabitur in dui in urna interdum ullamcorper. Pellentesque ut imperdiet libero.
                    </p>

                    <blockquote>
                            &ldquo;Lorem ipsum dolor sit amet, <a href="http://www.google.com" target="_blank">consectetur adipiscing</a> elit. Donec ac ante arcu, quis auctor sapien. Morbi magna leo, dapibus a pulvinar et, pharetra scelerisque felis. Mauris massa magna, gravida vitae convallis sagittis, sagittis ac ipsum. Integer arcu justo, vehicula vel accumsan ac, venenatis in massa. Curabitur in dui in urna interdum ullamcorper. Pellentesque ut imperdiet libero.&rdquo;
                            <cite>John Doe, <a href="http://www.google.com" target="_blank">Google</a></cite>
                    </blockquote>

                    <h4>Subheader lorem ipsum</h4>
                    <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac ante arcu, quis auctor sapien. Morbi magna leo, dapibus a pulvinar et, pharetra scelerisque felis. Mauris massa magna, gravida vitae convallis sagittis, sagittis ac ipsum. Integer arcu justo, vehicula vel accumsan ac, venenatis in massa. Curabitur in dui in urna interdum ullamcorper. Pellentesque ut imperdiet libero.
                    </p>

                    <h4>Subheader lorem ipsum</h4>
                    <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac ante arcu, quis auctor sapien. Morbi magna leo, dapibus a pulvinar et, pharetra scelerisque felis. Mauris massa magna, gravida vitae convallis sagittis, sagittis ac ipsum. Integer arcu justo, vehicula vel accumsan ac, venenatis in massa. Curabitur in dui in urna interdum ullamcorper. Pellentesque ut imperdiet libero.
                    </p>

            </div>
            <!-- Final de la primera columna ====================================================================== -->

            <!-- Começament de la segona columna ==================================================================== -->
            <div class="eight columns">

                    <img src="imatges/about.jpg" alt="About" />

                    <ul class="linedList">
                            <li><strong>Location:</strong> Stockholm, Sweden</li>
                            <li><strong>Email:</strong> <a href="mailto:hello@ivandesignostrom.com">hello@ivandesignostrom.com</a></li>
                            <li><strong>R&eacute;sum&eacute;:</strong> <a href="resume.pdf">resume.pdf</a></li>
                            <li><strong>LinkedIn:</strong> <a href="http://www.linkedin.com/" target="_blank">www.linkedin.com/in/ivandesignostrom</a></li>
                    </ul>

            </div>
            <!-- Final de la segona columna ====================================================================== -->

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