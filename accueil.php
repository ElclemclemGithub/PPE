<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }
    
$mois= date("Ym");
?>
<!DOCTYPE html>
<html>
    
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">

   </head>
    
    
   <body onLoad="document.fo.login.focus()">
       <div class="nav-bar">
      <h2><?php echo " ". $_SESSION['nom'] . "   " . $_SESSION["prenom"] ." "
      .$_SESSION['grade'] . ""; ?></h2>
       
       
           <div class="block">
                <a href="saisir_fiche.php">Saisie de fiche de frais</a>
            </div>
          <br>
            <div class="block">
                 <a href="mes_fiche.php">Mes fiches de frais</a>
            </div>
          <br>
           <div class="block">
                 <a href="vehicul.php">Mon type de véhiucle</a>
            </div>
           <br>
            <?php
                if($_SESSION["grade"]== "comptable"){
                
            ?>
            <div class="block">
                 <a href="valid.php">Validation Fiche de frais</a>
            </div>
       
       <?php
                }    ?>
       <br>
           <div class="block">
                <a href="deconnexion.php">Se déconnecter</a>
           </div>
           </div>
       
           <?php
           if($_SESSION["grade"]== "comptable"){
           ?>
           <div class="contnue">
           <h2>Bienvenus sur la partie comtable vous avez la possibiliter de valider les fiche de frais d'un clients.</h2>
       </div>
       <?php
                }
       ?>
   </body>
    <script src="./js.js" type="text/javascript"></script>
</html> 