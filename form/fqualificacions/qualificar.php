<?php
session_start();
include "../../funcions/connexioSQL.php";
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestió de qualificacions - Qualificar</title>
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
                    <li>
                        <a href="../../menus/admin/gprojectes.php"><i class="fa fa-book "></i>Projectes</a>
                    </li>
                    <li>
                        <a href="../../menus/admin/gassignacions.php"><i class="fa fa-users "></i>Assignacions</a>
                    </li>
                    <li class="active-link">
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
                    <h2>Gestió de qualificacions - Qualificar</h2>   
                    </div>
                </div>              
                 <!-- /. FILA  -->
                <hr/>
                <div class="col-lg-2 col-md-2">
                    <div class="table-responsive">
                        <?php
                            if(isset($_GET['idprojecte'])){
                                $_SESSION['idprojecte'] = $_GET['idprojecte'];
                                
                                $existeix = "SELECT * FROM projectenota WHERE idprojecte='".$_SESSION['idprojecte']."'";
                                $existeixSQL = mysqli_query($connexio, $existeix);
                                $fila = mysqli_num_rows($existeixSQL);
                                if($fila > 0){ //Si la qualificació ja existeix, agafem les dades de la DB i les mostrem.
                                    $dades = "SELECT * FROM projectenota WHERE idprojecte='".$_SESSION['idprojecte']."'";
                                    $dadesSQL = mysqli_query($connexio, $dades);
                                    $resultat = mysqli_fetch_array($dadesSQL, MYSQLI_ASSOC);
                                    
                                    echo "<form method='POST' action='../../funcions/gqualificacions/qualificar.php'>";
                                    echo "<table class='table table-hover'>";
                                    echo "<thead><tr>";
                                    echo "<th>Notes</th>";
                                    echo "<th>Tant per cent (%)</th>";
                                    echo "</tr></thead>";
                                    echo "<tbody><tr>";
                                    echo "<td> <input name='presentacio' placeholder='Presentació' type='text' value='".$resultat['presentacio']."' required/></td>";
                                    echo "<td> <input name='prepercent' placeholder='Percentatge' type='text' value='".$resultat['prepercent']."' required/></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td> <input name='utilitat' placeholder='Utilitat' type='text' value='".$resultat['utilitat']."' required/></td>";
                                    echo "<td> <input name='utipercent' placeholder='Percentatge' type='text' value='".$resultat['utipercent']."' required/></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td> <input name='dificultat' placeholder='Dificultat' type='text' value='".$resultat['dificultat']."' required/></td>";
                                    echo "<td> <input name='difpercent' placeholder='Percentatge' type='text' value='".$resultat['difpercent']."' required/></td>";
                                    echo "</tr><tr>";
                                    echo "<td colspan=2><textarea placeholder='Inserta un comentari' name='comentari' rows='10' cols='55'>".$resultat['comentari']."</textarea></td>";
                                    echo "</tr></tbody>";
                                    echo "<tr><td align=center><a href='../../menus/admin/gqualificacions.php'><i class='fa fa-arrow-circle-o-left fa-3x' aria-hidden='true'></i></a></td>";
                                    echo "<td align=center><input class='btn btn-default' type='submit' value='Qualificar' /></td></tr>";
                                    echo "</table>";
                                    echo "</form>";
                                } else { //Si no existeix qualificació per al projecte deixem els camps sense cap valor.
                                    echo "<form method='POST' action='../../funcions/gqualificacions/qualificar.php'>";
                                    echo "<table class='table table-hover'>";
                                    echo "<thead><tr>";
                                    echo "<th>Notes</th>";
                                    echo "<th>Tant per cent (%)</th>";
                                    echo "</tr></thead>";
                                    echo "<tbody><tr>";
                                    echo "<td> <input name='presentacio' placeholder='Presentació' type='text' required/></td>";
                                    echo "<td> <input name='prepercent' placeholder='Percentatge' type='text' required/></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td> <input name='utilitat' placeholder='Utilitat' type='text' required/></td>";
                                    echo "<td> <input name='utipercent' placeholder='Percentatge' type='text' required/></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td> <input name='dificultat' placeholder='Dificultat' type='text' required/></td>";
                                    echo "<td> <input name='difpercent' placeholder='Percentatge' type='text' required/></td>";
                                    echo "</tr><tr>";
                                    echo "<td colspan=2><textarea placeholder='Inserta un comentari' name='comentari' rows='10' cols='55'></textarea></td>";
                                    echo "</tr></tbody>";
                                    echo "<tr><td align=center><a href='../../menus/admin/gqualificacions.php'><i class='fa fa-arrow-circle-o-left fa-3x' aria-hidden='true'></i></a></td>";
                                    echo "<td align=center><input class='btn btn-default' type='submit' value='Qualificar' /></td></tr>";
                                    echo "</table>";
                                    echo "</form>";
                                    

                                }
                            } else {
                                echo "No s'han rebut dades.";
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