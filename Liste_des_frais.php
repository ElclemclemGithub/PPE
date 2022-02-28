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

if(isset($_POST['clear'])){
    
}

//fiche d'ajout de frait 
        
        
if(isset($_POST['ajout'])=="ajout"){   //Si le post "ajout" est click
    
    //on récuper les donner dans les balise et on les mette dans des variable pour faciliter le transfer
    $etape = htmlspecialchars($_POST['forfaitetap']);
    $distance = htmlspecialchars($_POST['fraiskilo']);
    $nuit = htmlspecialchars($_POST['nuitée']);
    $retauration = htmlspecialchars($_POST['repas']);
    $date = htmlspecialchars($_POST['date']);
    $etp = htmlspecialchars('ETP');
    $ekm = htmlspecialchars('KM');
    $nui = htmlspecialchars('NUI');
    $rep = htmlspecialchars('REP');
  
   // $ok = 'select * from `lignefraisforfait`;'; 
   // $returne = $ok->fetch();
    
    //Si la balise $etape $distance $nuit $retauration sont different de vide alors
    $verife = "insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$date."', '".$etp."', '".$etape."');";
    echo ($verife);
    if(!empty($etape) and !empty($distance)and !empty($nuit) and !empty($retauration)){
        //Etape
        $requet1 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$date."', '".$etp."', '".$etape."');");
        //Distance
        $requet2 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$date."', '".$ekm."', '".$distance."');");
        //Nuit
        $requet3 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$date."', '".$nui."', '".$nuit."');");
        //Restauration
        $requet4 = $pdo->prepare("insert into lignefraisforfait VALUES ('". $_SESSION['id'] ."', '".$date."', '".$rep."', '".$retauration."');");
        
        
        // Execution des requet
        $requet1->execute();
        $requet2->execute();
        $requet3->execute();
        $requet4->execute();
        
        
        
        // Retour sur la page d'accueil.
        header('Location: Accueil.php');

    }
    else{ //Si non ces que tout les balise ne sont pas remplie donc 
        echo('remplir tous les champs');
    }
}


/***********************************************************************************************************************/

if(isset($_POST['updait'])=="updait"){   //Si le post "ajout" est click
    
    
    //on récuper les donner dans les balise et on les mette dans des variable pour faciliter le transfer
    $prix = htmlspecialchars($_POST['prix']);
    $date_horsfrais = htmlspecialchars($_POST['date_horsfrais']);
    $description= htmlspecialchars($_POST['description']);
    
        
     
    if(!empty($date_horsfrais) and !empty($prix) and !empty($description)){
        
        //requet
       $requet = $pdo->prepare("insert into lignefraishorsforfait (id_utlisateur, mois ,libelle, date, montant) VALUES ('". $_SESSION['id'] ."', '".date(Ym)."', '".$description."', '".$date_horsfrais."', '".$prix."');");
        
        
        // Execution des requet
        $requet->execute();
       
        
        // Retour sur la page d'accueil.
        header('Location: Accueil.php');
    }
    else{ //Si non ces que tout les balise ne sont pas remplie donc 
        echo('remplir tous les champs');
    }
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
       </div>
    <form method="POST">
	   <div id="contenu">
           <h2>Renseigner ma fiche de frais du mois de novembre</h2>
		<div class="corps">
			<fieldset>
                <legend>Éléments forfaitisés</legend>
				<p>
					<label for="forfaitetape">* Forfait Étape :</label>
					<input type="text" id="forfaitetape" name="forfaitetap">
				</p>
				<p>
					<label for="fraiskilo">* Frais Kilométrique :</label>
					<input type="text" id="fraiskilo" name="fraiskilo">
				</p>
				<p>
					<label for="nuitée">* Nuitée Hôtel :</label>
					<input type="text" id="nuitée" name="nuitée">
				</p>
				<p>
					<label for="repas">* Repas Restaurant :</label>
					<input type="text" id="repas" name="repas">
				</p>
                <p>
					<label for="date">* Date (AAAAMM):</label>
					<input type="text" id="date" name="date">
				</p>
			</fieldset>
		</div>
			<div class="pied">
				<p>
					<input type="submit" name="ajout" value="Valider">
					<input type="submit" name="clear" value="Effacer">
				</p>
			</div>
        </div>
        
        <div class="contien">
        <h2>Descriptif des éléments hors forfait</h2>
		<div class="corps">
			<fieldset>
				<legend>Nouvel élément hors forfait</legend>
				<p>
					<label for="date">* Date :</label>
					<input type="text" id="date_horsfrais" name="date_horsfrais" required minlength="" maxlength="" size="10">
				</p>
				<p>
					<label for="libellé">* Libellé :</label>
					<input type="text" id="description" name="description" required minlength="" maxlength="" size="50">
				</p>
				<p>
					<label for="prix">* Montant :</label>
					<input type="text" id="prix" name="prix" required minlength="" maxlength="" size="10">
				</p>
			</fieldset>
			</div>
			<div class="pied">
				<p>
					<input type="submit" name="updait" value="Ajouter">
					<input type="submit" name="clear" value="Effacer">
				</p>
			</div>
        </div>
        </form>
    </body>
  </div>  
</html>