<?php
session_start();
include "../../funcions/gcursos/llistacursos.php";
?>
    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eines administratives - Cursos</title>
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
                    <li>
                        <a href="taulell.php" ><i class="fa fa-desktop "></i>Taulell</a>
                    </li>
                    <li class="active-link">
                        <a href="gcursos.php"><i class="fa fa-graduation-cap "></i>Cursos</a>
                    </li>
                    <li>
                        <a href="gusuaris.php"><i class="fa fa-user "></i>Usuaris</a>
                    </li>
                    <li>
                        <a href="gprojectes.php"><i class="fa fa-book "></i>Projectes</a>
                    </li>
                    <li>
                        <a href="gassignacions.php"><i class="fa fa-users "></i>Assignacions</a>
                    </li>
                    <li>
                        <a href="gqualificacions.php"><i class="fa fa-gavel"></i>Qualificacions </a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        
        <!-- /. NAV LATERAL  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <h2>Gestió de cursos</h2>   
                    </div>
                </div> 
                    
                 <!-- /. FILA  -->
                <hr/>
                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                        <?php
                        llistacursos();
                        ?>
                    </div>
                </div>
                
                 <!-- /. FILA  -->           
            </div>
            
             <!-- /. PAGINA INTERIOR  -->
        </div>
        
         <!-- /. PAGINA INTERIOR  -->
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
