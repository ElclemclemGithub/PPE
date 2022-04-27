<?php
    require ("logbdd.php");
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }

        
        $iduser = $_SESSION["id"];
        $now = date("Ym");

    if(isset($_POST['valider_forfait'])){
        if(!empty($_POST['étape']) or !empty($_POST['kilométrique']) or !empty($_POST['nuit']) or !empty($_POST['repas'])){
        
            $etap = htmlspecialchars($_POST['étape']);
            $kilo = htmlspecialchars($_POST['kilométrique']);
            $nuit = htmlspecialchars($_POST['nuit']);
            $repa = htmlspecialchars($_POST['repas']);

            $etp = htmlspecialchars('ETP');
            $ekm = htmlspecialchars('KM');
            $nui = htmlspecialchars('NUI');
            $rep = htmlspecialchars('REP');

                //Etape
            $requet1 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$now."', '".$etp."', '".$etap."');");
            //Distance
            $requet2 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$now."', '".$ekm."', '".$kilo."');");
            //Nuit
            $requet3 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$now."', '".$nui."', '".$nuit."');");
            //Restauration
            $requet4 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$now."', '".$rep."', '".$repa."');");


            // Execution des requet
            $requet1->execute();
            $requet2->execute();
            $requet3->execute();
            $requet4->execute();
            echo ("ok");
        
        }
    }
    if(isset($_POST['valider_horsforfait'])){
        if(!empty($_POST['libellé']) or !empty($_POST['montant']) or !empty($_POST['justification'])){
            
            $libe = htmlspecialchars($_POST['libelle']);
            $mont = htmlspecialchars($_POST['montant']);
            $date = htmlspecialchars($_POST['date']);

            $horsforfait = $pdo->prepare("INSERT INTO test_gsb.lignefraishorsforfait (id_utlisateur, mois, libelle, date, montant) VALUES ('".$iduser."', '".$now."', '".$libe."', '".$date."', '".$mont."');");
            print_r($horsforfait);
            $horsforfait->execute(); 
        }
    }

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">
   </head>
   <body onLoad="document.fo.login.focus()">
      <div class="nav-bar">
           <h2><?php echo " ". $_SESSION['nom'] . " " . $_SESSION["prenom"] ." ". $_SESSION['grade'] .""; ?></h2>
           <div class="block">
                <a href="accueil.php">Accueil</a>
            </div>
            <div class="block">
                 <a href="mes_fiche.php">Mes fiches de frais</a>
            </div>
           <div class="block">
                 <a href="vehicul.php">Mon type de véhicule</a>
            </div>
          <?php
                if($_SESSION["grade"]== "comptable"){
                
            ?>
            <div class="block">
                 <a href="valid.php">Validation Fiche de frais</a>
            </div>
       
       <?php
                }    ?>
            <div class="block">
                <a href="deconnexion.php">Se déconnecter</a>
           </div>
          
       </div>
       <br>
       <center><h2>Saisie de fiche de frais</h2></center>
      <form method="post" enctype="multipart/form-data">
         <br>
         <h3 class="titre">Frais fortaitissé</h3>
         <br>
         <input type="text" name="étape" placeholder="Forfait Etape" /><br />
         <input type="text" name="kilométrique" placeholder="Frais Kilométrique"/><br />
         <input type="text" name="nuit" placeholder="Nuitée Hôtel"/><br />
         <input type="text" name="repas" placeholder="Repas Restaurant" /><br />
         <input type="submit" name="valider_forfait" value="Valider" />
      </form>
      <br>
      <form method="post" enctype="multipart/form-data">
         <br>
         <h3 class="titre">Frais hors-forfait</h3>
         <br>
         <input type="text" name="libelle" placeholder="Libelle" /><br />
         <input type="text" name="montant" placeholder="Montant" /><br />
         <input type="text" name="date" placeholder="Date (AAAA-MM-JJ)" /><br />
         <input type="submit" name="valider_horsforfait" value="Valider" />
      </form>
   </body>
    <script src="./js.js" type="text/javascript"></script>
</html> 