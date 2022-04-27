<?php
require ("logbdd.php");
session_start(); 


$mois = date("Ym");
$mod_date = strtotime($mois."- 1 months");
$mois_mod = date("Ym",$mod_date);
$datemodif = date("Y-m-d");

$total = 0;
$totale =0;

//Quand appuier sur boution sup allors il valide les fiche
if(isset($_POST['confirm'])=="confirm"){
    $final = $totale+$total;
    
    $requetconfirm = $pdo->prepare("update FROM fichefrais set dateModif = '".$datemodif."', montantValide = '".$final."', idEtat= 'VA' WHERE id = '". $choix."' and mois= '". $mois_mod ."';");
    
    $requetconfirm->execute();
    
    header('Location: valid.php');
}

//Quand appuier sur boution sup allors il refuse les fiche

if(isset($_POST['refu'])=="refu"){
    
    $requetconfirm = $pdo->prepare("update FROM fichefrais set dateModif = '".$datemodif."', montantValide = '".$final."', idEtat= 'RS' WHERE id = '". $choix."' and mois= '". $mois_mod ."';");
    
    $requetconfirm->execute();
    
    header('Location: valid.php');
}


//Quand appuier sur boution sup allors il suprime les donnée
if(isset($_POST['sup'])=="sup"){
    
    $requetsup = $pdo->prepare("DELETE FROM fichefrais WHERE id = '".$choix."';");
    
    $requetsup->execute();
    
    header('Location: valid.php');
}

if(isset($_POST['name'])){
    $choix = $_POST['name'];
    //Pour le montant totale du remboursement d'une fiche frais
    $requet = $pdo->prepare("select type_vehicule from  vehicule where id_utilisateur = '';");

    $result=$requet->execute();


    if ($result == '1'){
        $requet = $pdo->query("select Formuleadd, Fromuleplus  from bareme_moto inner join vehicule on bareme_moto.Pussance_fiscale=vehicule.nombre_chevaux_moto  where id_utilisateur = '".$choix."' and nombre_chevaux_moto = Pussance_fiscale ;");
    
        while($rembkm=$requet->fetch()) {
            $foradd = $rembkm['Formuleadd'];
            $forplu = $rembkm['Fromuleplus'];
        }
    
    }else{
        $requet = $pdo->query("select formul_add , formul_plus  from bareme_voiture  inner join vehicule on bareme_voiture.puissance_fiscal =vehicule.nombre_chveaux_voiture where id_utilisateur = '".$choix."' and nombre_chveaux_voiture = puissance_fiscal ;");

        while($rembkm=$requet->fetch()) {
            $foradd = $rembkm['formul_add'];
            $forplu = $rembkm['formul_plus'];
        }
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
   
	<div class="nav-bar">
      <h2><?php echo " ". $_SESSION['nom'] . "   " . $_SESSION["prenom"] ." "
      .$_SESSION['grade'] . ""; ?></h2>
            
          <div class="block">
                 <a href="accueil.php">Accueil</a>
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
                 <a href="vehicul.php">Mon type de véhicule</a>
            </div>
       <br>
           <div class="block">
                <a href="deconnexion.php">Se déconnecter</a>
           </div>
           </div>
	<div id="contenu">
        <h2>Validation de fiche de fairs</h2>
		<center>
		<div class="corps">
             <form method="post" enctype="multipart/form-data">
			<fieldset>
            <label for="Personne">Choisir un clients</label>

				<select name="name" id="name">
					<option value=" ">--Choix du client--</option>
                    <option value="f8">Delforge</option>
                    <option value="a17">Andre</option>
                    <option value="a131">Villechalane</option>
                    <option value="f4">Gest</option>
				</select>
			</fieldset>
                 <input class="btn btn-primary" type="submit" name="recherche" value="Recherche"/>
                 
                 </form>
            <form method="post" enctype="multipart/form-data">
                
                <h3 class="titre">Fiche Frais forfait</h3>
            <?PHP 
        if(isset($_POST['name'])){
            $choix = $_POST['name'];
            
            $horsforfait = $pdo->query('SELECT * from lignefraisforfait where mois="'. $mois_mod.'" and id_utilisateur="'. $choix.'";');
                        
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
                                
                                </div>
                            </div> 
                </form>
        
        
            
         <form method="POST" enctype="multipart/form-data">
             <h3 class="titre">Fiche Frais horforfait</h3>
             
             <?php
                    unset($info_all);
                        $nomconncet = $pdo->query('SELECT nom from utilisateur where  id_utilisateur="'. $choix.'";');
                        $nom = $nomconncet->fetch();
                        
                        $lenom =  $nom["nom"];
                        
                    
                        $horsforfait = $pdo->query('SELECT montant from lignefraishorsforfait where mois="'. $mois_mod.'" and id_utlisateur="'. $choix.'";');
                        
                        while($article = $horsforfait->fetch()) {
                            $montant = $article['montant'];
                            $totale = $totale+$montant;
                        }
                            
                            ?>
                            
                            <div class="affiche_fiches hors_forfait">
                                <div class="fiche">
                                    
                                    
                                    <p class="montant">Mr <?php echo $lenom; ?> à un montant total de <?php echo $totale; ?> € pour les frais hors forfait du mois <?php echo $mois_mod;?></p>
                                    
                                    <div class="bouton">
                                        <input type="submit" name="confirm" value="Confirmer">
                                        <input type="submit" name="refu" value="Refuser">
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
        </center>
      </div>
      </body>
    </div>
    <script src="./js.js" type="text/javascript"></script>
</html>
