<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }
    
    
?>
<!DOCTYPE html>
<html>
    
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">

   </head>
    
    
   <body onLoad="document.fo.login.focus()">
      <h2><?php echo " ". $_SESSION['nom'] . " " . $_SESSION["prenom"] ." "; ?></h2>
      <h2><?php echo " ".$_SESSION['grade'] . ""; ?></h2>
       
       <div class="nav-bar">
           <div class="block">
                <a href="deconnexion.php">Se déconnecter</a>
           </div>
          <br>
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
       </div>
       
       <div class="contnu">
            <?php
                if($_SESSION["grade"]== "comptable"){
            ?>
            <h1>Les dernier ajout de tout les utilisateur.</h1>
           <?php
                
            ?>
       </div>
       <?php
                }
       ?>
   </body>
    
</html> 