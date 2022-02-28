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
		<li class="smenu"><a href="Accueil.php" title="Page d'accueil">Accueil</a></li>
		<li class="smenu"><a href="Sedeconnecter.php" title="Se déconnecter">Se déconnecter</a></li>
		<li class="smenu"><a href="Saisiedefiche.php" title="Saisie de fiche de frais">Saisie fiche de frais</a></li>
		<li class="smenu"><a href="Mesfichesdefrais.php" title="Mes fiches de frais">Mes fiches de frais</a></li>
	</ul>
	</div>
	<div id="contenu">
    <h2>Renseigner ma fiche de frais du mois de novembre</h2>
	<form action="" method="post">
		<div class="corps">
			<fieldset>
				<legend>Éléments forfaitisés</legend>
				<p>
					<label for="forfaitetape">* Forfait Étape :</label>
					<input type="text" id="forfaitetape" name="forfaitetape" required minlength="4" maxlength="8" size="10" value="0">
				</p>
				<p>
					<label for="fraiskilo">* Frais Kilométrique :</label>
					<input type="text" id="fraiskilo" name="fraiskilo" required minlength="4" maxlength="8" size="10" value="0">
				</p>
				<p>
					<label for="nuitée">* Nuitée Hôtel :</label>
					<input type="text" id="nuitée" name="nuitée" required minlength="4" maxlength="8" size="10" value="0">
				</p>
				<p>
					<label for="repas">* Repas Restaurant :</label>
					<input type="text" id="repas" name="repas" required minlength="4" maxlength="8" size="10" value="0">
				</p>
			</fieldset>
		</div>
			<div class="pied">
				<p>
					<input type="button" value="Valider">
					<input type="button" value="Effacer">
				</p>
			</div>
	</form>
	<br>
	<h2>Descriptif des éléments hors forfait</h2>
	<form action="" method="post">
		<div class="corps">
			<fieldset>
				<legend>Nouvel élément hors forfait</legend>
				<p>
					<label for="date">* Date :</label>
					<input type="text" id="date" name="date" required minlength="4" maxlength="8" size="10">
				</p>
				<p>
					<label for="libellé">* Libellé :</label>
					<input type="text" id="libellé" name="libellé" required minlength="4" maxlength="8" size="50">
				</p>
				<p>
					<label for="prix">* Montant :</label>
					<input type="text" id="prix" name="prix" required minlength="4" maxlength="8" size="10">
				</p>
			</fieldset>
			</div>
			<div class="pied">
				<p>
					<input type="button" value="Ajouter">
					<input type="button" value="Effacer">
				</p>
			</div>
	</form>
</div>
        </div>
      </form>
  </body>
    </div>
</html>