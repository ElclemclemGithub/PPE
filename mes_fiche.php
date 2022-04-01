<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }
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

$requet = $pdo->prepare("select type_vehicule from  vehicule where id_utilisateur = '';");

$result=$requet->execute();


if ($result == '1'){
    $requet = $pdo->query("select Formuleadd, Fromuleplus  from bareme_moto inner join vehicule on bareme_moto.Pussance_fiscale=vehicule.nombre_chevaux_moto  where id_utilisateur = '".$_SESSION['id']."' and nombre_chevaux_moto = Pussance_fiscale ;");
    
    while($rembkm=$requet->fetch()) {
        $foradd = $rembkm['Formuleadd'];
        $forplu = $rembkm['Fromuleplus'];
    }
    
}else{
    $requet = $pdo->query("select formul_add , formul_plus  from bareme_voiture  inner join vehicule on bareme_voiture.puissance_fiscal =vehicule.nombre_chveaux_voiture where id_utilisateur = '".$_SESSION['id']."' and nombre_chveaux_voiture = puissance_fiscal ;");

    while($rembkm=$requet->fetch()) {
        $foradd = $rembkm['formul_add'];
        $forplu = $rembkm['formul_plus'];
    }
}

//Quand appuier sur boution modif allors il modifie les donnée
if(isset($_POST['modif'])=="modif"){
    
    $datemodif = htmlspecialchars($_POST['date']);
    $libellemodif = htmlspecialchars($_POST['libelle']);
    $montantmodif = htmlspecialchars($_POST['montant']);
    
    if(!empty($datemodif) and !empty($libellemodif) and !empty($montantmodif)){
        
        $requet = $pdo->prepare("update lignefraishorsforfait  set date = '".$datemodif."', libelle = '".$libellemodif."', montant= '".$montantmodif."' where id='".$resultid."';");
        
        $requet->execute();
        
        header('Location: mes_fiche.php');
    }
    
}
//Quand appuier sur boution sup allors il suprime les donnée
if(isset($_POST['sup'])=="sup"){
    
    $requetsup = $pdo->prepare("DELETE FROM lignefraishorsforfait WHERE id = '".$resultid."';");
    
    $requetsup->execute();
    
    header('Location: mes_fiche.php');
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
		<img id="logoGSB" src="image/GSB%20Logo.png"/>
		<h1>Suivi du remboursement des frais</h1>
	</div>
	<div id="menuGauche">
		<div id="info">
		</div>
	<ul id="menuList">
		<li class="smenu"><a href="Accueil.php" title="Page d'accueil">Accueil</a></li>
		<li class="smenu"><a href="deconnexion.php" title="Se déconnecter">Se déconnecter</a></li>
		<li class="smenu"><a href="saisir_fiche.php" title="Saisie de fiche de frais">Saisie fiche de frais</a></li>
		<li class="smenu"><a href="mes_fiche.php" title="Mes fiches de frais">Mes fiches de frais</a></li>
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
            
            <h2>Fiche Frais forfait</h2>
        
                <form method="POST" enctype="multipart/form-data">
                    
                    
                    <?php
                    $choix=202203;
                    if ($choix == "202203"){
                        $horsforfait = $pdo->query('SELECT * from lignefraisforfait where mois="202203";');
                        
                        while($article = $horsforfait->fetch()) {
                            
                            $id = $article['id_utilisateur'];
                            $libelle = $article['idFraisForfait'];
                            $date = $article['mois'];
                            $montant = $article['quantite'];
                            
                            $info[] = $id;
                            $info[] = $libelle;
                            $info[] = $date;
                            $info[] = $montant;
                            
                            $info_all[] = $info;
                            unset($info);
                        }
                        
                        for ($a = 0; count($info_all) > $a; $a++){
                            $uneinfo = $info_all[$a];
                            $info_id = $uneinfo[0];
                            $info_type = $uneinfo[1];
                            $info_date = $uneinfo[2];
                            $info_montant[] = $uneinfo[3];
                        }
                        
////////////////////////////Renboursement/////////////////////////
                        $rbkm= ($info_montant[1]*$foradd)+$forplu;
                        $total = intval("110") + intval("80") + intval("25")+ $rbkm;
///////////////////////////////////////////////////////////////////
                            ?>
                            
                            <div class="affiche_fiches hors_forfait">
                                <div class="fiche">
                                    
                                    <p class="unefiche">Ma fiche:</p>
                                    <p class="date">La dernier modife date de</p>
                                    <input type="texet" name="date" value="<?php echo $info_date; ?>">
                                    <p class="date">Nombre étape effectuer</p>
                                    <input type="texet" name="etp" value="<?php echo $info_montant[0]; ?>">
                                    <p class="date">Nombre de repas</p>
                                    <input type="texet" name="date" value="<?php echo $info_montant[3]; ?>">
                                    <p class="date">Nombre de kilometre effectuer</p>
                                    <input type="texet" name="date" value="<?php echo $info_montant[1]; ?>">
                                    <p class="date">Le nombre de Nuit d'hotel</p>
                                    <input type="texet" name="date" value="<?php echo $info_montant[2]; ?>">
                                    
                                    <p class="montant">Montant du remboursement total: <?php echo $total ?> €</p>
                                    
                                    
                                    
                                    <div class="bouton">
                                        <input type="submit" name="modif'.$a.'" value="Modifier">
                                        <input type="submit" name="sup" value="Suprime">
                                    </div>
                                </div>
                            </div>  
                
                            <?php 
                    }
                    ?> 

                </form>
        
        <?php $horfrais = $pdo->query('SELECT * from lignefraishorsforfait where mois="202112";');
             
             $test =$horfrais->fetch();
             
             echo $test;
        ?>
        
        
            <h2>Fiche Frais horforfait</h2>
         <form method="POST" enctype="multipart/form-data">
             
             
             <?php
                    unset($info_all);
                    $choix=202203;
                    if ($choix == "202203"){
                        $horsforfait = $pdo->query('SELECT * from lignefraishorsforfait where mois="202203";');
                        
                        while($article = $horsforfait->fetch()) {
                            
                            $id = $article['id'];
                            $libelle = $article['libelle'];
                            $date = $article['date'];
                            $montant = $article['montant'];
                            
                            $info[] = $id;
                            $info[] = $libelle;
                            $info[] = $date;
                            $info[] = $montant;
                            
                            $info_all[] = $info;
                            unset($info);
                        }
                        
                        for ($a = 0; count($info_all) > $a; $a++){
                            $uneinfo = $info_all[$a];
                            $info_titre = $uneinfo[0];
                            $info_contenu = $uneinfo[1];
                            $info_type = $uneinfo[2];
                            $info_id = $uneinfo[3];
                            
                            ?>
                            
                            <div class="affiche_fiches hors_forfait">
                                <div class="fiche">
                                    
                                    <p class="unefiche">Ma fiche:</p>
                                    <p class="date">La dernier modife date de</p>
                                    <input type="texet" name="date" value="<?php echo $info_type; ?>">
                                    <p class="justif">Raison</p>
                                    <input type="texet" name="libelle" value="<?php echo $info_contenu; ?>">
                                    <p class="montant">Prix</p>
                                    <input type="texet" name="montant" value="<?php echo $info_id; ?>">
                                    
                                    <div class="bouton">
                                        <input type="submit" name="modif'.$a.'" value="Modifier">
                                        <input type="submit" name="sup" value="Suprime">
                                    </div>
                                </div>
                            </div>  
                
                            <?php
                        }  
                    }
                    ?>
        </form>
        </div>
      </div>
      </body>
    </div>   
</html>