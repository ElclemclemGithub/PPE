<?php
session_start();
    require ("logbdd.php");
    
    if($_SESSION["autoriser"]!="oui"){
      header("location: index.php");
      exit();
    }


$mois = date("Y/m");

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
       <div class="nav-bar">
           <h2><?php echo " ". $_SESSION['nom'] . " " . $_SESSION["prenom"] ." ". $_SESSION['grade'] .""; ?></h2>
           <div class="block">
                <a href="accueil.php">Accueil</a>
            </div>
            <div class="block">
                 <a href="saisir_fiche.php">Saisie de fiche de frais</a>
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
   <?php
                if($_SESSION["grade"]== "comptable"){
                
            ?>
    <div id = 'fonds'>
	
	<div id="menuGauche">
		<div id="info">
		</div>
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
					<option value="202203"><?php echo $mois ?></option>
                    <option value="202112">12/2021</option>
                    <option value="202201">01/2022</option>
                    <option value="202202">02/2022</option>
                    <option value="202203">03/2022</option>
				</select>
			</fieldset>
                 
                 </form>
            
		</div>
            <?php } ?>
            
		</center>
            
            
        
                <form method="POST" enctype="multipart/form-data">
                    
                    <h3 class="titre">Fiche Frais forfait</h3>
                    <?php
                    $choix= "202203";
                    if ($choix == "202203"){
                        $horsforfait = $pdo->query('SELECT * from lignefraisforfait where mois="'. $mois.'";');
                        
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
                        echo $total;
                        $_SESSION['total'] = $total;
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
                                    <div class="bouton">
                                        <input type="button" name="PDF" onclick="window.location.href='fpdf/pdf.php';" value="PDF">
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
        
        
            
         <form method="POST" enctype="multipart/form-data">
             <h3 class="titre">Fiche Frais horforfait</h3>
             
             <?php
                    unset($info_all);
                    
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
                                    <div class="bouton">
                                        <input type="button" name="PDF" onclick="window.location.href='fpdf/pdf.php';" value="PDF">
                                    </div>
                                </div>
                            </div>  
                
                            <?php
                        }  
                    ?>
        </form>
        </div>
      </div>
      </body>
    </div>  
    <script src="./js.js" type="text/javascript"></script>
</html>