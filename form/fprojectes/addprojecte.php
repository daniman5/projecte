<?php
session_start();
include "../../funcions/connexioSQL.php";
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
                    <h2>Gestió de projectes - Creació d'un projecte</h2>   
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
                                echo "<form method='POST' action='../../funcions/gprojectes/addprojecte.php'>";

                                echo "<div class='row'>";
                                echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
                                echo "<div class='input-group'>";
                                echo "<span class='input-group-addon'><i class='fa fa-briefcase' aria-hidden='true'></i></span>";
                                echo "<input type='text' name='gnom' class='form-control' placeholder='Nom del projecte' />";
                                echo "</div>";
                                echo "<div class='input-group'>";
                                echo "<span class='input-group-addon'><i class='fa fa-key' aria-hidden='true'></i></span>";
                                echo "<input type='password' name='gpass' class='form-control' placeholder='Contrasenya' />";
                                echo "</div>";
                                
                                
                                echo "<div class='input-group' style='margin-top:15px;'>";
                                echo "<p align='center'><strong>Curs</strong></p>";
                                $consulta= "SELECT * FROM curs";
                                $consultaSQL= mysqli_query($connexio,$consulta);

                                echo " <select name='gcurs'>";
                                while($gcurs = mysqli_fetch_array($consultaSQL,MYSQLI_ASSOC)){
                                    echo "<option value='".$gcurs['idcurs']."'>".$gcurs['cnom']." ".$gcurs['matricula']."</option>";
                                }
                                echo "</select>";
                                echo "<br/>";
                                
                                echo "<p align='center'><strong>Tutor</strong></p>";
                                $tutor = "SELECT * FROM usuaris WHERE tutor='si'";
                                $tutorSQL = mysqli_query($connexio, $tutor);
                                
                                echo " <select name='tutor'>";
                                while($tutors = mysqli_fetch_array($tutorSQL,MYSQLI_ASSOC)){
                                    echo "<option value='".$tutors['idusuari']."'>".$tutors['nom']." ".$tutors['cognom1']." ".$tutors['cognom2']."</option>";
                                }
                                echo "</select>";
                                echo "</div>";
                                
                                echo "<br/>";
                                echo "<div class='input-group'>";
                                echo "<table>";
                                echo "<tr><td width='300'><a href='../../menus/admin/gprojectes.php'><i class='fa fa-arrow-circle-o-left fa-4x' aria-hidden='true'></i></a></td>";
                                echo "<td align='right'><input type='submit' class='btn btn-default' value='Afegir' /></td></tr>";
                                echo "</table>";
                                echo "</div>";
                                echo "</div>";
                                echo "</form>";
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