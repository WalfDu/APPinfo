<?php
$title = 'Connectez vous';
require_once '../headerFooter/header.php';

require_once '../../model/Login/loginUtilisateurs.php';
?>

<link href="login.css" rel="stylesheet" />

<section class="sections home text-center">
	<div class="box">
		<form method="POST" class="form">
			<div class="imageForm">
				<a href="../"><img class="img" src="../images/logo/logo.png" alt="logo sensair" /></a>
			</div>
			<div class="contenu">
				<!--affiche un message d'erreur-->
				<div class="entrer">
					<?php if($verif): ?>
					<div class="erreur"><?= $verif ?></div>
					<?php endif ?>
					<p>Veuillez entrer vos identifiants:</p>
					<div class="textArea">
						<input type="text" name="mail" id="mail" placeholder="Email" />
					</div>
					<div class="textArea">
						<input type="password" name="password" id="password" placeholder="Mot de passe"/>
					</div>
				</div>
			
				<div>
					<button class="button" type="submit" name="submit">Se connecter</button>
				</div>
			</div>
			
		</form>
	</div>
</section>

<?php require_once '../headerFooter/footer.php'; ?>
