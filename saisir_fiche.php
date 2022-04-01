<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }
################################Log a la basse de donnée##########################################################

//accés serveur SISR
    $databases_names = 'GSB';
    $databases_pass = 'azerty';
    $databases_user = 'clement';

//accés
    $databases_acces = 'localhost';
    $databases_port = '3306';

//accés local
    $databases_names1 = 'test_gsb';
    $databases_pass1 = '';
    $databases_user1 = 'root';

####################################Permet de tester la connexion a la BDD####################################### 

try{
    $pdo = new PDO("mysql:host=$databases_acces;dbname=$databases_names1;charset_utf8;","$databases_user1", "$databases_pass1");

    }   
    catch (PDOException $exc){
    echo $exc->getMessage();
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
      <h2><?php echo " ". $_SESSION['nom'] . " " . $_SESSION["prenom"] ." "; ?></h2>
      <a href="deconnexion.php">Se déconnecter</a>
      <br>
      <a href="saisir_fiche.php">Saisie de fiche de frais</a>
      <br>
      <a href="mes_fiche.php">Mes fiches de frais</a>
      <br>
   </body>
</html> 
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">
   </head>
   <body onLoad="document.fo.login.focus()">
      <br>
      <form method="post" enctype="multipart/form-data">
         <center>Saisie de fiche de frais</center>
         <br>
         Frais fortaitissé
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
         Frais hors-forfait
         <br>
         <input type="text" name="libelle" placeholder="Libelle" /><br />
         <input type="text" name="montant" placeholder="Montant" /><br />
         <input type="text" name="date" placeholder="Date (AAAA-MM-JJ)" /><br />
         <input type="submit" name="valider_horsforfait" value="Valider" />
      </form>
   </body>
</html> 