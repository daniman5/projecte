<?php
session_start();
include "../../funcions/gprojectes/modprojecte.php";
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eines administratives - Projectes</title>
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
                            echo "<a href='../../OLDindex.php' style='color:#fff;'>Identificar-se <i class='fa fa-sign-in' aria-hidden='true'></i></a>";
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
                        <a href="../../menus/admin/taulell.php" ><i class="fa fa-desktop "></i>Taulell</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gcursos.php"><i class="fa fa-graduation-cap "></i>Cursos</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gusuaris.php"><i class="fa fa-user "></i>Usuaris</a>
                    </li>
                    <li class="active-link">
                        <a href="../../menus/admin/gprojectes.php"><i class="fa fa-book "></i>Projectes</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gassignacions.php"><i class="fa fa-users "></i>Assignacions</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gqualificacions.php"><i class="fa fa-gavel"></i>Qualificacions </a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        
        <!-- /. NAV LATERAL  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <h2>Gestió de projectes</h2>   
                    </div>
                </div>              
                 <!-- /. FILA  -->
                <hr/>
                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                        <?php
                            if(isset($_GET['id'])){
                                $_SESSION['idprojecte'] = $_GET['id'];
                                echo "<div align='center'>";
                                echo "<h2>Modificar contrasenya</h2>";
                                echo "<form method='POST' action='modprojecte.php'>";
                                echo "<table border=0>";
                                echo "<tr>";
                                echo "<td colspan=2> <input name='gpass' placeholder='Nova contrasenya' type='password' required/></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=2> <input name='gpass2' placeholder='Repetir contrasenya' type='password' required/></td>";
                                echo "</tr>";
                                echo "<tr><td align=center><a href='../../menus/admin/gprojectes.php'><i class='fa fa-arrow-circle-o-left fa-3x' aria-hidden='true'></i></a></td>";
                                echo "<td align=center height=50><input class='btn btn-default' type='submit' value='Modificar' /></td></tr>";
                                echo "</table>";
                                echo "</form>";
                                echo "</div>";
                            } else {
                                if(isset($_POST['gpass2'])){ //Si la variable de contrasenya s'ha establert...
                                    if($_POST['gpass1'] = $_POST['gpass2']){ //comparem les contrasenyes i si coincideixen executem la funció de modificació de projecte. 
                                        modprojecte($_SESSION['idprojecte'],$_POST['gpass2']);
                                    } else {
                                        echo "Les contrasenyes no coincideixen";
                                        echo "<a href='../../menus/admin/gprojectes.php'><i class='fa fa-arrow-circle-o-left fa-3x' aria-hidden='true'></i></a>";
                                    }

                                }
                            }
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
</html>