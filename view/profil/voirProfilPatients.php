<?php
$title = 'Profil des patients';
require_once '../headerFooter/header.php';

if(!isset($_SESSION['matricule'])):
    header('Location: ../login/login.php');
endif;

require '../../model/BDD/connexionBDD.php';
require '../../controller/traduction/profil/modifProfil.php';
require_once '../../controller/fonctions.php';

if(!empty($_GET['id'])){
	$matricule = checkInput($_GET['id']);
}

$personne = recuperationUneDonnee($BDD, 'Personne', 'matricule', $matricule);
?>
<link href="voirProfilPatients.css" rel="stylesheet" />

<div class="principal">
	<form>
		<div class="gauche">
			<div class="contenu">	
				<div class="title">
					<p class="textSize">
					<?= $personne['nom'] . ' ' . $personne['prenom'] ?>
					<p> 
				</div>
				<div class="form-group">
					<li><label for="Matricule"> <?= $matricule1 ?> </label> <br>
					<input class="champ" type="text"  id=Matricule2 name="matricule2" value=" <?= $personne['matricule'] ?>" readonly></li>
					<li class="espacement"><label for="Mail"><?= $mail ?></label><br>
					<input type="email" class="champ" id=Mail name="mail" value=" <?= $personne['mail'] ?>" readonly></li>
				</div>
				<div class="form-group">
					<li><label for="Telephone"><?= $tel ?></label><br>
					<input type="tel" class="champ" id=Telephone name="telephone" value=" <?= '0' . $personne['telephone'] ?>" readonly></li>
					<li class="espacement"><label for="dateDeNaissance"><?= $datenaissance ?></label><br>
					<input type="text" class="champ" id=DateDeNaissance name="dateDeNaissance" value=" <?php
					setlocale(LC_TIME, 'fr_FR.utf-8','fra'); 
					$date = new DateTime($personne['date de naissance']);
					echo (strftime("%A %e %B %Y", date_timestamp_get($date))); ?>" readonly></li>
				</div>
				<div class="form-group"> 
					<li> <label for="genre"> <?= $sexe ?></label> <br>
					<input type="text " class="champ" id=genre name="genre" value="<?= ($personne['sexe'] == 0) ? 'Non précisé' : ($personne['sexe'] == 1) ? 'Homme' : 'Femme' ?>" readonly> </li>
					<li class="espacement"><label for="Numss"><?= $NSS ?></label> <br>
					<input type="text"  class="champ" id=Numss name="num_ss" value="<?= $personne['numero de securite social'] ?>" readonly></li>
				</div>
				<div class="form-group">
					<li><label for="Poids"><?= $poids ?></label><br>
					<input type="text"  class="champ" id=Poids name="poids" value=" <?= $personne['poids'] ?>" readonly></li>
					<li class="espacement"><label for="Taille"><?= $taille ?></label><br>
					<input type="text" class="champ" id=Taille name="taille" value="<?= $personne['taille'] ?>" readonly></li>
				</div>
				<div class="form-group">
					<li><label for="AdresseRue"><?= $adresse ?></label><br>
					<input type="text" class="champ" id=AdresseRue name="adresseRue" value="<?= $personne['adresse'] ?>" readonly></li>
				</div>
				<div class="form-group">
					<li><label for="AdresseVille"><?= $ville ?></label><br>
					<input type="text" class="champ" id=AdresseVille name="adresseVille" value="<?= $personne['ville'] ?>" readonly></li>
					<li class="espacement"><label for="CodePostale"><?= $CodePostal ?> :</label><br>
					<input type="text" class="champ" id=CodePostal name="codePostal" value="<?= $personne['code postal'] ?>" readonly></li>
				</div>
				<div class="form-group">
					<li><label for="Role"><?= $role ?></label><br>
					<input type="text" class="champ" id=Role name="role" value="<?= $personne['role'] ?>" readonly></li>
					<li class="espacement"><label for="Medecin"><?= $medecin ?> </label><br>
					<input type="text" class="champ" id=Medecin name="medecin" value="<?php
					$medecin = recuperationUneDonnee($BDD, 'Personne', 'matricule', $personne['medecin']);
					echo $medecin['nom'] . ' ' . $medecin['prenom'] . ' (matricule: ' . $personne['medecin'] . ')';
					?>" readonly></li>
				</div>
			</div>	
		</div>
	</form>
</div>
<div class="title2">
	<p class ="titre">Dernier(s) test(s) passé(s)</p>
	<a class="acces" href="../resultats/mesResultats.php?id=<?= $_GET['id'] ?>"> Accéder aux résultats</a>	
</div> 

<?php require_once '../headerFooter/footer.php';?>