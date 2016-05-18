<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
session_start();
include "../../funcions/gcursos/llistacursos.php";
include "../../funcions/connexioSQL.php";
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
                    <li class="active-link">
                        <a href="../../menus/admin/gcursos.php"><i class="fa fa-graduation-cap "></i>Cursos</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gusuaris.php"><i class="fa fa-user "></i>Usuaris</a>
                    </li>
                    <li>
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
                    <h2>Gestió de cursos - Afegir</h2>   
                    </div>
                </div>              
                 <!-- /. FILA  -->
                <hr/>
                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                        <?php
                        if(isset($_SESSION['usuari'])){
                            $consulta = "SELECT tipus FROM usuaris WHERE usuari = '".$_SESSION["usuari"]."'";
                            $consultaSQL = mysqli_query($connexio, $consulta);
                            $resultat = mysqli_fetch_array($consultaSQL, MYSQLI_ASSOC);
                            
                            if($resultat['tipus'] == 'admin'){
                                echo "<div align='center'>";
                                echo "<form method='POST' action='../../funcions/gcursos/addcurs.php'>";
                                echo "<table border=0>";
                                echo "<tr>";
                                echo "<td colspan=2> <select name='curs'>";
                                echo "<option value='CFGM - SMX'>CFGM - SMX - Sistemes Microinformàtics i Xarxes</option>";
                                echo "<option value='CFGS - ASIX'>CFGS - ASIX - Administració de Sistemes Informàtics en Xarxa</option>";
                                echo "<option value='CFGS - DAW'>CFGS - DAW - Desenvolupament d'Aplicacions en entorns Web</option>";
                                echo "</select></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan=2 align='center'> <select name='matricula'>";
                                for($i = 2015; $i < 2025; $i++){
                                    echo "<option value='".$i."-".($i+1)."'>".$i."-".($i+1)."</option>";
                                }
                                echo "</select>";
                                echo "</tr>";
                                echo "<tr><td align=center><a href='../../menus/admin/gcursos.php'><i class='fa fa-arrow-circle-o-left fa-4x' aria-hidden='true'></i></a></td>";
                                echo "<td align=center height=50><input class='btn btn-default' type='submit' value='Afegir' /></td></tr>";
                                echo "</table>";
                                echo "</div>";
                                
                            } else {
                                echo "No tens permisos per veure aquest contingut.<br/><br/>";
                                echo "<br/><a href='../../index.php'> Enrere </a>";
                            }
                        } else {
                            echo "Primer has d'identificar-te.";
                            echo "<br/><a href='../../index.php'> Enrere </a>";
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