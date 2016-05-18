<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>INS La Pineda &mdash; Repositori de projectes</title>
<meta name="description" content="Page description goes here">

<!-- ******************************************************************************************
Set the type and color theme here - the Pro version contains additional themes -->
<link href="../../css/themes/project.css" rel="stylesheet">
<!--  ************************************************************************************* -->

<link href="../../css/themes/project-font-awesome.min.css" rel="stylesheet">
<script src="../../js/vendor/modernizr.js"></script>

</head>
<body>

<div class="top-border"></div>

<div class="row">
<!--	<div class="small-12 medium-12 large-12 small-centered columns">
		<header>		
			<h1><a href="index.html">INS La Pineda &mdash; Repositori de projectes</a></h1>
			<h2><a href="index.html">Design & Art Direction</a></h2>
			
			<div class="logo">
				<a href="index.html"><img src="img/logo.png" alt="Your Name Here" /></a>
			</div>
			
		</header>
	</div>-->
    <div class="small-12 medium-12 large-12 small-centered columns">
        <nav>
            <ul class="inline-list-custom">
                <li><a href="javascript:history.go(-1);"><i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true" style="vertical-align: middle"></i> Tornar enrere</a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="row">
    <div class="small-12 medium-7 large-7 columns">
        <?php
        //session_start();
        if($_GET['id']){
            include("../../funcions/connexioSQL.php");
            $query = "SELECT * FROM projecte WHERE idprojecte=".$_GET['id'];
            $querySQL = mysqli_query($connexio,$query);
            $dades = mysqli_fetch_array($querySQL,MYSQLI_ASSOC);
        } else {
            header("location: ../../404.html");
        }
        
        
        ?>
        <h2><?php echo $dades['pnom']; ?></h2>
        <p style="text-align: justify; text-justify: inter-word">
            <?php echo $dades['descripcio']; ?>
        </p>
    </div>
    <div class="small-12 medium-5 large-5 columns">
        <div class="lined-list">
            <ul>
                <!-- INICI AUTORS -->
                <?php
                    $sub = "SELECT * FROM usuaris AS u INNER JOIN usuariprojecte AS up ON up.idusuari=u.idusuari WHERE up.idprojecte=".$_GET['id'];
                    $subSQL = mysqli_query($connexio, $sub);
                    
                    $autors = '';
                    while($autor = mysqli_fetch_array($subSQL,MYSQLI_ASSOC)){
                        $autors .= $autor['nom']." ".$autor['cognom1'].", ";
                    }
                    $autors = substr($autors, 0, -2);
                    
                ?>
                <li><strong>Autors: </strong> <?php echo $autors; ?></li>
                <!-- FINAL AUTORS -->
                
                <!-- INICI CICLES -->
                <?php
                    $cicle = "SELECT * FROM projecte AS p INNER JOIN curs AS c ON p.idcursFK=c.idcurs";
                    $cicleSQL = mysqli_query($connexio, $cicle);
                    $cicledades = mysqli_fetch_array($cicleSQL,MYSQLI_ASSOC);
                ?>
                <li><strong>Cicle formatiu: </strong> <?php echo $cicledades['cnom']; ?></li>
                <!-- FINAL CICLES -->
                
                <!-- INICI TUTOR -->
                <?php
                    $tutor = "SELECT * FROM usuaris AS u INNER JOIN projecte AS p ON p.idtutorFK=u.idusuari WHERE p.idprojecte=".$_GET['id'];
                    $tutorSQL = mysqli_query($connexio, $tutor);
                    $tutors = mysqli_fetch_array($tutorSQL,MYSQLI_ASSOC);
                ?>
                <li><strong>Tutor: </strong> <?php echo $tutors['nom']." ".$tutors['cognom1']." ".$tutors['cognom2']; ?></li>
                <!-- FINAL TUTOR -->
                
                <!-- INICI MATÈRIA -->
                <li><strong>Matèria: </strong> X</li>
                <!-- FINAL MATÈRIA -->
                
                <!-- INICI PUBLICACIÓ -->
                <li><strong>Publicació: </strong> <?php echo $cicledades['matricula'] ?></li>
                <!-- FINAL PUBLICACIÓ -->
                
                <!-- INICI PUNTUACIÓ -->
                <?php 
                $puntuacio = "SELECT * FROM projectenota AS n INNER JOIN projecte AS p ON p.idprojecte=n.idprojecte WHERE p.idprojecte=".$_GET['id'];
                $puntuacioSQL = mysqli_query($connexio, $puntuacio);
                $puntudades = mysqli_fetch_array($puntuacioSQL,MYSQLI_ASSOC); ?>
                <li><strong>Puntuació:</strong> <?php echo $puntudades['global']; ?></li>
                <!-- FINAL PUNTUACIÓ -->
                
                <!-- INICI URI -->
                <li><strong>URI: </strong> projecte.php?id= <?php echo $_GET['id'] ?></li>
                <!-- FINAL URI -->
                
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="small-12 medium-12 large-12 columns">
        <hr class="project-detail-hr" />

        <!-- Begin project image -->
        <div class="project-img">
            <img src="img/projects/project-01c.png" alt="Project 01c" />
            <h6>Project 01c Caption</h6>
        </div>
        <!-- End project image -->

    </div>
</div>

<div class="row">
    <div class="small-12 medium-12 large-12 columns">
        <p class="back-to-top-holder"><a class="back-to-top"><i class="fa fa-chevron-circle-up fa-3x"></i></a></p>
    </div>
</div>

<div class="row">
    <div class="small-12 medium-12 large-12 columns">
        <footer>
            <ul>
                <li>&copy; 2016 <a href="http://www.inslapineda.cat/">INS La Pineda</a>. Tots els drets reservats.</li>
                <li><a href="mailto:hello@yourname.com"><i class="fa fa-envelope-o"></i> hello@yourname.com</a></li>

                <li>Pàgina principal <a href="http://www.inslapineda.cat/" target="_blank">INS La Pineda</a></li>

            </ul>
            <div class="social-icons">
                <a href="https://www.facebook.com/ins.lapineda" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
            </div>
        </footer>
    </div>
</div>

<script src="../../js/vendor/jquery.min.js"></script>
<script src="../../js/projecte-foundation.min.js"></script>
<script src="../../js/projecte-hawt.js"></script>

</body>
</html>