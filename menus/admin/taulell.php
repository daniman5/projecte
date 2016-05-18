<?php
session_start();
include "../../funcions/connexioSQL.php";

if(isset($_SESSION['usuari'])){
    $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
    $consultaSQL = mysqli_query($connexio, $consulta);
    $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);

    if($resultat['tipus'] != 'admin'){
        header("location: ../../index.php");
    } 
} else {
    header("location: ../../index.php");
}
?>
    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eines administratives</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../../index.php">
                        <img src="../../imatges/logoBack.png" />
                    </a>
                </div>
              
                <span class="logout-spn" >
                    <?php
                        if(isset($_SESSION['usuari'])){
                            echo "<a href='../../funcions/logout.php' style='color:#fff;'>Desconnexió <i class='fa fa-sign-out' aria-hidden='true'></i></a>";
                        } else {
                            echo "<a href='../../index.php' style='color:#fff;'>Identificar-se <i class='fa fa-sign-in' aria-hidden='true'></i></a>";
                        }
                    ?>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li class="active-link">
                        <a href="taulell.php" ><i class="fa fa-desktop "></i>Taulell <span class="badge">Informació</span></a>
                    </li>
                    <li>
                        <a href="gcursos.php"><i class="fa fa-graduation-cap "></i>Cursos  <span class="badge">Pas 1</span></a>
                    </li>
                    <li>
                        <a href="gusuaris.php"><i class="fa fa-user "></i>Usuaris <span class="badge">Pas 2</span></a>
                    </li>
                    <li>
                        <a href="gprojectes.php"><i class="fa fa-book "></i>Projectes <span class="badge">Pas 3</span></a>
                    </li>
                    <li>
                        <a href="gassignacions.php"><i class="fa fa-users "></i>Assignacions <span class="badge">Pas 4</span></a>
                    </li>
                    <li>
                        <a href="gqualificacions.php"><i class="fa fa-gavel"></i>Qualificacions <span class="badge">Pas 5</span></a>
                    </li>

                    <!-- Links Menu -->
                    <!--<li>
                        <a href="#"><i class="fa fa-qrcode "></i>My Link One</a>
                    </li>-->
                    
                </ul>
            </div>
        </nav>
        <!-- /. NAV LATERAL  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Taulell d'administració</h2>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                            <?php
                                echo "<strong>Benvingut ". $_SESSION["usuari"] .".</strong>"
                            ?>
                        </div>
                       
                    </div>
                    </div>
                  <!-- /. ROW  --> 
                <div class="row text-center pad-top" align="center">
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="gusuaris.php" >
                            <i class="fa fa-user fa-5x"></i>
                            <h4>Usuaris</h4>
                            </a>
                        </div>
                    </div> 
                 
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="gassignacions.php" >
                            <i class="fa fa-users fa-5x"></i>
                            <h4>Assignacions</h4>
                            </a>
                      </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="gprojectes.php" >
                            <i class="fa fa-book fa-5x"></i>
                            <h4>Projectes</h4>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="gcursos.php" >
                            <i class="fa fa-graduation-cap fa-5x"></i>
                            <h4>Cursos</h4>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="gqualificacions.php" >
                            <i class="fa fa-gavel fa-5x" aria-hidden="true"></i>
                            <h4>Qualificacions</h4>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <hr/>
                <div class="row text-center pad-top" align="center">
               
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="/phpmyadmin" >
                            <i class="fa fa fa-database fa-5x"></i>
                            <h4>MYSQL</h4>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="div-square">
                            <a href="http://192.168.21.90/phpldapadmin" >
                            <i class="fa fa-cogs fa-5x"></i>
                            <h4>LdapAdmin</h4>
                            </a>
                        </div>
                    </div>
                     
                </div>
                
                <div class="row text-center pad-top">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-18">
                        <p align="left"><strong>Estat del disc dur principal</strong></p>
                        <div class="progress progress-striped active">
                            <?php
                            include "../../funcions/monitor/espai.php";
                                espailliure();
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  --> 
                
                <div class="row">
                    <div class="col-lg-12 ">
                        <br/>
                        <div class="alert alert-danger">
                            <strong>PAGINA DE ICONOS SVG!</strong> LINK -> <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Aqui</a>.
                        </div>
                    </div>
                </div>
                  <!-- /. ROW  --> 
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2016 www.inslapineda.com | Disseny per: Montesinos
                </div>
            </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -Possats al final per a reduir el temps de carrega de la pagina-->
    <!-- JQUERY SCRIPTS -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>
    
   
</body>