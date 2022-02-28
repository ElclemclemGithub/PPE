<?php
session_start(); 

   



?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Intranet du Laboratoire Galaxy Swiss Bourdin</title>
  </head>
  <div class='arrière_plan'>
  <body>
    <form action="Connexion.php" method="post">
    <div id = 'fonds'>
	<div id="entete">
		<img id="logoGSB" src="GSB Logo.png"/>
		<h1>Suivi du remboursement des frais</h1>
	</div>
	<div id="menuGauche">
		<div id="info">
		</div>
	<ul id="menuList">
        <?php echo " ". $_SESSION['nom'] . " " . $_SESSION["prenom"] ." "; ?>
        <br>
        <?php echo " ".$_SESSION['grade'] . ""; ?>
		<li class="smenu"><a href="Accueil.php" title="Page d'accueil">Accueil</a></li>
		<li class="smenu"><a href="Sedeconnecter.php" title="Se déconnecter">Se déconnecter</a></li>
		<li class="smenu"><a href="Liste_des_frais.php" title="Saisie de fiche de frais">Saisie fiche de frais</a></li>
		<li class="smenu"><a href="Mesfichesdefrais.php" title="Mes fiches de frais">Mes fiches de frais</a></li>
	</ul>
	</div>
	<div id="contenu">
    <h2>Bienvenue sur l'intranet GSB</h2>
        </div>
        </div>
      </form>
      </body>
    </div>
</html>