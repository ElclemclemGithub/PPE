<?php
session_start(); 
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


if (isset($_POST['enregistre'])){
    if(isset($_POST['voi'])){
        if(!empty($_POST['sujet'])){
            if($_POST['sujet'] =="3 CV et mois"){
                $voi1 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chveaux_voiture) values ('". $_SESSION['id'] ."', '0', '3 CV et mois');");
                $voi1->execute();
            }
            if($_POST['sujet'] == "4 CV"){
                $voi2 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chveaux_voiture) values ('". $_SESSION['id'] ."', '0', '4 CV');");
                $voi2->execute();
            }
            if($_POST['sujet'] == "5 CV"){
                $voi3 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chveaux_voiture) values ('". $_SESSION['id'] ."', '0', '5 CV');");
                $voi3->execute();
            }
            if($_POST['sujet'] == "6 CV"){
                $voi4 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chveaux_voiture) values ('". $_SESSION['id'] ."', '0', '6 CV');");
                $voi4->execute();
            }
            if($_POST['sujet'] == "7 CV et plus"){
                $voi5 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chveaux_voiture) values ('". $_SESSION['id'] ."', '0', '7 CV et plus');");
                $voi5->execute();
            }
        }
    }
    elseif(isset($_POST['mot'])){
        if(!empty($_POST['sujet'])){
                if($_POST['sujet'] == "1 ou 2 CV"){
                    $moto1 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chevaux_moto) values ('". $_SESSION['id'] ."', '1', '1 ou 2 CV');");
                    $moto1->execute();
                }
                if($_POST['sujet'] == "3 , 4 et 5 CV"){
                    $moto2 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chevaux_moto) values ('". $_SESSION['id'] ."', '1', '3 , 4 et 5 CV');");
                    $moto2->execute();
                }
                if($_POST['sujet'] == "plus de 5 CV"){
                    $moto3 = $pdo->prepare("insert into vehicule (id_utilisateur, Type_vehicule, nombre_chevaux_moto) values ('". $_SESSION['id'] ."', '1', 'plus de 5 CV');");
                    $moto3->execute();
                }
            
        }
    }
    else{
        echo ("Vueiller donner le type de véhicule que vous disposer ");
    }
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link href="style.css" rel="stylesheet">
   </head>
   <body>
       
       <div id = 'fonds'>
	<div id="entete">
		<img id="logoGSB" src="image/GSB%20Logo.png"/>
		<h1>Suivi du remboursement des frais</h1>
	</div>
       </div>
	<div id="menuGauche">
		<div id="info">
		</div>
	<ul id="menuList">
		<li class="smenu"><a href="accueil.php" title="Page d'accueil">Accueil</a></li>
		<li class="smenu"><a href="deconnexion.php" title="Se déconnecter">Se déconnecter</a></li>
		<li class="smenu"><a href="saisir_fiche.php" title="Saisie de fiche de frais">Saisie fiche de frais</a></li>
		<li class="smenu"><a href="mes_fiche.php" title="Mes fiches de frais">Mes fiches de frais</a></li>
	</ul>
	</div>
    </body>
    
           <h1>Rénségnier votre véhicule</h1>
    
    <form method="post" class="formulaie" enctype="multipart/form-data">
        
        <h3>Veuiller rensergnier le type de véhicule.</h3>
        <div class="block_vehi">
            <input id="voitur" class= "form-check-input" type="radio" name="flexRadioDefault" value="0">
                <label>Véhicule 4 roue</label>
        </div>
        
        <div class="voiture">
            <select name="sujet" id="sujet_voi" required>
                <option value="2" disabled selected hidden>Choisissez le nombre de chevaux de votre véhicule</option>
                <option value="3 CV et mois" >3 CV et mois</option>
                <option value="4 CV" >4 CV</option>
                <option value="5 CV" >5 CV</option>
                <option value="6 CV" >6 CV</option>
                <option value="7 CV et plus" >7 CV et plus</option>
            </select>
        </div>
        
    <br><br>
    
        <div class="block_vehi">
            <input id="mot" class= "form-check-input" type="radio" name="flexRadioDefault" value="1">
            <label>Véhicule 2 roue</label>
        </div>
         <br>
          <div class="moto">
            <select name="sujet" id="sujet_voi" required>
                <option value="0" disabled selected hidden>Choisissez le nombre de chevaux de votre véhicule</option>
                <option value="1 ou 2 CV" >1 ou 2 CV</option>
                <option value="3 , 4 et 5 CV" >3, 4 ou 5 CV</option>
                <option value="plus de 5 CV" >plus de 5 CV</option>
            </select>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" name="enregistre" value="Enregistrer votre véhicule." />
      </form>
    <script src="./js.js" type="text/javascript"></script>
</html>
