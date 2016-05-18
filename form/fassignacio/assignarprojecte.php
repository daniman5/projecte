<?php
session_start();
include('../../funcions/gassignacions/seleccio/config.php');
include('../../funcions/gassignacions/seleccio.php');
include '../../funcions/connexioSQL.php';

$query_parent = mysql_query("SELECT * FROM curs") or die("Query failed: ".mysql_error());

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
    <title>Eines administratives - Assignació</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
    <!-- Script necessari per a l'execucio del combo depentendt-->
    <script type="text/javascript" src="../../assets/js/jquery.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {

             $("#parent_cat").change(function() {
                     $(this).after('<div id="loader"><img src="../../assets/img/loading.gif" alt="carregan subcategoria" /></div>');
                     $.get('../../funcions/gusuaris/seleccio/loadsubcat.php?parent_cat=' + $(this).val(), function(data) {
                             $("#sub_cat").html(data);
                             $('#loader').slideUp(200, function() {
                                     $(this).remove();
                             });
                     });
             });

     });
     </script>
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
                    <li class="active-link">
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
                    <h2>Gestió d'assignació d'un projecte</h2>   
                    </div>
                </div>              
                 <!-- /. FILA  -->
                <hr/>
                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                        <form method="POST" action='assignarprojecte.php'>
                            <table class='table table-striped table-bordered'>
                                <tr>
                                    <td>
                                        <label for="category">Curs </label>
                                    </td>
                                    <td>
                                        <select name="parent_cat" id="parent_cat">
                                            <option value="#">Selecciona el curs </option>
                                            <?php while($row = mysql_fetch_array($query_parent)): ?>
                                            <option value="<?php echo $row['idcurs']; ?>"><?php echo $row['1']." | ".$row['2']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label>Usuari </label></td>
                                    <td><select name="sub_cat" id="sub_cat"></select></td>
                                </tr>
                                <tr>
                                    <td colspan='2' align="right"><input class='btn btn-default' type='submit' value='Seleccionar' /></td>
                                </tr>
                            </table>
                        </form>
                        
                        <?php
                        
                            if(isset($_POST['sub_cat'])){
                                
                                $projectes = "SELECT * FROM projecte WHERE idcursFK='".$_POST['parent_cat']."'";
                                $projectesSQL = mysqli_query($connexio, $projectes);
                                
                                echo "<table class='table table-striped table-bordered table-hover'>";
                                echo "<thead><tr><th>ID</th>";
                                echo "<th>Nom de Projecte</th>";
                                echo "<th>Curs</th>";
                                echo "<th>Enllaç</th>";
                                echo "<th>Assignar projecte</th></tr></thead>";

                                while($datos = mysqli_fetch_array($projectesSQL,MYSQLI_ASSOC)){
                                    $curs = "SELECT cnom,matricula FROM curs WHERE idcurs=".$datos['idcursFK'];
                                    $cursSQL = mysqli_query($connexio, $curs);
                                    $dcurs = mysqli_fetch_array($cursSQL,MYSQLI_ASSOC);

                                    echo "<tbody><tr><td>".$datos['idprojecte']."</td>";
                                    echo "<td>".$datos['pnom']."</td>";
                                    echo "<td>".$dcurs['matricula']." | ".$dcurs['cnom']."</td>";
                                    echo "<td align='center'><a href='https://192.168.21.91/~".$datos['idprojecte']."'><i class='fa fa-link' aria-hidden='true'></i></a></td>";
                                    echo "<td align='center'><a href='../../funcions/gassignacions/assignarprojecte.php?idprojecte=".$datos['idprojecte']."&idusuari=".$_POST['sub_cat']."'><i class='fa fa-wrench' aria-hidden='true'></i></a></td></tr></tbody>";
                                }

                                echo "</table>";
                                
                                
                               
                            }
                        
                        ?>
                        
                        <a href='../../menus/admin/gassignacions.php'><i class='fa fa-arrow-circle-o-left fa-4x' aria-hidden='true'></i></a>
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