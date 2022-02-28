<?php
    session_start();
//connection BDD serveur
    $databases_names = 'GSB';
    $databases_pass = 'azerty';
    $databases_user = 'clement';
//don't change
    $databases_acces = 'localhost';
    $databases_port = '3306';
//connection BDD locale
    $databases_names1 = 'test_gsb';
    $databases_pass1 = '';
    $databases_user1 = 'root';

//requet et test de connection a la bdd
try{
    $pdo = new PDO("mysql:host=$databases_acces;dbname=$databases_names1;charset_utf8;","$databases_user1", "$databases_pass1");
    
    }catch (PDOException $exc){
    
    echo $exc->getMessage();
    exit();
    }

/*Récupere le nombre de ligne de fiche qui on etait crée pour l'utilisateur en cours*/
    $nbfiche = $pdo->prepare("select count(id_utilisateur) from lignefraisforfait where id_utilisateur = '".$_SESSION['id']."'");
    $nbfiche->execute();
    $nbf= $nbfiche->fetch();
    $nbf= $nbf['count(id_utilisateur)'];
    $nbfs= $nbf/4;

$selectfrais= $pdo->prepare("select mois, idFraisForfait, quantite from lignefraisforfait where id_utilisateur ='".$_SESSION['id']."';");
    $selectfrais->execute();
    $desfiche= array();
    
/*Tableaux pour les fiche de frais forfait*/
for($fiche=0; $fiche<$nbf; $fiche++){
    $resultfrais= $selectfrais->fetch();
    $resultfraisdate = $resultfrais['mois'];
    $resultfraisidff = $resultfrais['idFraisForfait'];
    $resultfraisquant = $resultfrais['quantite'];
    array_push($desfiche, $resultfraisdate, $resultfraisidff, $resultfraisquant);
    for($desfiches=0; $desfiches<$nbfs; $desfiches++);
    for($unefiche=0; $unefiche<12; $unefiche++);
        
    
}
echo("###########  ");
print_r($desfiche);

    
/*Récupere les information des fiche de frais qui appartienne a l'utilisateur en cours*/
for($i=0; $i<3; $i++){
    $select= $pdo->prepare("select id, date, libelle, montant from lignefraishorsforfait where id_utlisateur = '".$_SESSION['id']."'");
    $select->execute();
    $result = $select->fetch();
    $resultid = $result['id'];
    $resultdate = $result['date'];
    $resultlibelle = $result['libelle'];
    $resultmontant = $result['montant'];
}
echo("teste");






if(isset($_POST['modif'])=="modif"){
    
    $datemodif = htmlspecialchars($_POST['date']);
    $libellemodif = htmlspecialchars($_POST['libelle']);
    $montantmodif = htmlspecialchars($_POST['montant']);
    
    if(!empty($datemodif) and !empty($libellemodif) and !empty($montantmodif)){
        
        $requet = $pdo->prepare("update lignefraishorsforfait  set date = '".$datemodif."', libelle = '".$libellemodif."', montant= '".$montantmodif."' where id='".$resultid."';");
        
        $requet->execute();
        
        header('Location: Mesfichesdefrais.php');
    }
    
}

if(isset($_POST['sup'])=="sup"){
    
    $requetsup = $pdo->prepare("DELETE FROM lignefraishorsforfait WHERE id = '".$resultid."';");
    
    $requetsup->execute();
    
    header('Location: Mesfichesdefrais.php');
}


?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Intranet du Laboratoire Galaxy Swiss Bourdin</title>
  </head>
  <div class='arrière_plan'>
  <body>
   
    <div id = 'fonds'>
	<div id="entete">
		<img id="logoGSB" src="GSB Logo.png"/>
		<h1>Suivi du remboursement des frais</h1>
	</div>
	<div id="menuGauche">
		<div id="info">
		</div>
	<ul id="menuList">
		<li class="smenu"><a href="Accueil.php" title="Page d'accueil">Accueil</a></li>
		<li class="smenu"><a href="Sedeconnecter.php" title="Se déconnecter">Se déconnecter</a></li>
		<li class="smenu"><a href="Saisiedefiche.php" title="Saisie de fiche de frais">Saisie fiche de frais</a></li>
		<li class="smenu"><a href="Mesfichesdefrais.php" title="Mes fiches de frais">Mes fiches de frais</a></li>
	</ul>
	</div>
	<div id="contenu">
    <h2>Mes fiches de frais</h2>
	<p><strong>Mois à selectionner : 
        </strong>
        </p>
		<center>
		<div class="corps">
             <form method="post" enctype="multipart/form-data">
			<fieldset>
				<label for="mois-selectionner">Mois:</label>

				<select name="mois" id="mois">
					<option value=" ">--Choisir un mois--</option>
                    <option value="202112">12/2021</option>
                    <option value="202201">01/2022</option>
				</select>
			</fieldset>
                 
                 </form>
            
		</div>
		</center>
         <form method="POST" enctype="multipart/form-data"s>
			<?PHP
           // echo ("okkkkk");
     //   if(isset($_POST['mois'])){
          //  $choix =$_POST['mois'];
          //  echo ("okkkkk");
          //    if($choix == "202112"){
            $frais = $pdo->query('SELECT * from lignefraishorsforfait where mois="202112";');
             
            while($article = $frais->fetch()) {
             $titre = $article['id'];
            $contenu= $article['libelle'];
            $type= $article['date'];
            $id = $article['montant'];
    
            $info[] = $titre;
            $info[] = $contenu;
            $info[] = $type;
            $info[] = $id;
    
            $info_all[] =$info;
            unset($info);
 
            }

            for ($a = 0; count($info_all) > $a; $a++){

                $uneinfo = $info_all[$a];
                $info_titre = $uneinfo[0];
                $info_contenu = $uneinfo[1];
                $info_type = $uneinfo[2];
                $info_id = $uneinfo[3];
       
                 echo('<div class="affiche_fiches hors_forfait">
                    <div class="fiche">
                        <p class="unefiche">Ma fiche:</p>
                        <p class="date">La dernier modife date de</p>
                        <input type="texet" name="date" value="'.$info_type.'">
                        <p class="justif">Raison</p>
                         <input type="texet" name="libelle" value="'.$info_contenu.'">
                        <p class="montant">Prix</p>
                         <input type="texet" name="montant" value="'.$info_id.'">
                        <div class="bouton">
                        <input type="submit" name="modif'.$a.'" value="Modifier">
                        
                        
					       <input type="submit" name="sup" value="Suprime">
                        </div>
                    </div>
                </div>');
                
                if(isset($_POST['mondif'])){
                     $supr = $pdo->query('DELET from lignefraishorsforfait where id="'.$info_titre.'";');
                    
                }
                 if(isset($_POST['mondif'])){
                     $supr = $pdo->query('UPDATE lignefraishorsforfait SET libelle = "htmlspecialchars($_POST["libelle"])", date = "htmlspecialchars($_POST["date"])", montant = "htmlspecialchars($_POST["montant"])" where id="'.$info_titre.'";');
                    
                }
                
            }
        //      }
       // }
            ?>
        </form>
        </div>
        </div>
        
      <form method="POST" >
          <div class="affiche_fiches hors_forfait">
                    <div class="fiche">
                        <p class="unefiche">Ma fiche:</p>
                        <p class="date">La dernier modife date de</p>
                        <input type="texet" name="date" value="<?php echo $resultdate ?>">
                        <p class="justif">Raison</p>
                         <input type="texet" name="libelle" value="<?php echo $resultlibelle ?>">
                        <p class="montant">Prix</p>
                         <input type="texet" name="montant" value="<?php echo $resultmontant ?>">
                        <div class="bouton">
                            <input type="submit" name="modifforfait" value="Modifier">
					       <input type="submit" name="supforfait" value="Suprime">
                        </div>
                    </div>
                </div>
        
      
          
      </form>
        
	
  </body>
    </div>
    
</html>