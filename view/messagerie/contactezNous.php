<?php
$title = 'Contactez Nous';
require_once '../headerFooter/header.php';
require_once '../../model/BDD/connexionBDD.php';

?><link href="contactezNous.css" rel="stylesheet" /><?php



$matriculeTest = 2;
$matriculeTest = $_SESSION['matricule'];

$conv = recuperationUneDonnee($BDD,"Message", "matricule", $matriculeTest);
$idConversation = $conv['idConversation'];
$conv = recuperationUneDonnee($BDD, "Conversation", "idConversation", $idConversation);

$messages = recuperationMessages($BDD, $idConversation);
$client = recuperationUneDonnee($BDD, "Personne", "matricule", $matriculeTest);

if(!isset($matriculeTest)):
	header('Location: ../login/login.php');

elseif($matriculeTest != 0):
	if($idConversation == null): ?>
		<meta http-equiv="refresh" content="0;url=contactezNous1.php">
	<?php
	else:
?>
	<div class="bandehaut">
		<h1 class="titrePage" style="line-height: 100%">Contactez-nous</h1>
		<i class="sousTitre">Nous sommes là pour vous aider</i>
	</div>

	<div class="titre">
		<h3><?= $conv['titre'] ?></h3>
	</div>

	<div class="conversation"> 
		<div class="messages" id="messages">
			<?php foreach($messages as $singleMessage):
			if($singleMessage['matricule'] == $matriculeTest): ?>
				<p class="envoye">
			<?php else:?>
				<p class="recu">
			<?php endif ?>
			<?= nl2br($singleMessage['contenu']) ?></p>
			<?php endforeach ?>
			<div id="affMessage"></div>
		</div>
	</div>

	<form class="formulaire" method="post" id="Envoyer">
		<textarea
			class="boiteMessage"
			type="text"
			name="message"
			id="message"
			placeholder="Votre message"
		></textarea>
		<br />
		<input 	class="boiteEnvoyer" type="submit" name="Envoyer" value="Envoyer" />
	</form>

	<?php endif;
		elseif(isset($_GET['client'])):
		$idConversation = $_GET['client'];
		$conv = recuperationUneDonnee($BDD, "Conversation", "idConversation", $idConversation);
		$messages = recuperationMessages($BDD, $idConversation);
		
		$client = recuperationUneDonnee($BDD, "Personne", "matricule", $messages[0]['matricule']);
		?>

		<div class="bandehaut">
			<h1 class="titrePage" style="line-height: 100%">Réponse à</h1>
			<i class="sousTitre"><?= $client['prenom'] . ' ' . $client['nom']?></i>
		</div>

		<div class="titre">
			<h3><?= $conv['titre'] ?></h3>
		</div>

		<div class="conversation"> 
			<div class="messages" id="messages">
				<?php
				
					foreach($messages as $singleMessage):
						if($singleMessage['matricule'] == $matriculeTest): ?>
							<p class="envoye">
						<?php else:?>
							<p class="recu">
						<?php endif ?>
					<?= nl2br($singleMessage['contenu']) ?></p>
					<?php endforeach ?>
				<div id="affMessage"></div>
			</div>
		</div>

		<form class="formulaire" method="post" id="Envoyer">
			<textarea
				class="boiteMessage"
				type="text"
				name="message"
				id="message"
				placeholder="Votre message"
			></textarea>
			<br />
			<input class="boiteEnvoyer" type="submit" name="Envoyer" value="Envoyer" />
		</form>

	<?php else:
		$conversations = recuperationConversationsAdmin($BDD);
		$idConversation = 0;
	?>

		<div class="bandehaut">
			<h1 class="titrePage">Choississez le client</h1>
			<i class="sousTitre">à qui vous voulez répondre</i>
		</div>

		<div class="conversation"> 
			<ul class="convAdmin messages" id="messages">
				<?php foreach($conversations as $conversation):
					$message = recuperationMessages($BDD, $conversation['idConversation']);
					$client = recuperationUneDonnee($BDD, "Personne", "matricule", $message[0]['matricule']);
					?>
					<li><a href="./contactezNous.php?client=<?= $conversation['idConversation'] ?>">
					<?= $client['prenom'] . ' ' . $client['nom'] . '<br><em>' .  $conversation['titre'] . '</em>' ?>
					</a></li>
				<?php endforeach ?>
			</ul>
		</div>

	<?php endif;
	require_once '../headerFooter/footer.php';
	?>
<div class="fin"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	var messages = document.getElementById('messages')
	messages.scrollTop = messages.scrollHeight - messages.clientHeight


	$(document).ready(function (){

		$('#Envoyer').on("submit", function(e){
			e.preventDefault()

			var message  = document.getElementById('message').value
			var idConversation  = <?= $idConversation ?>;
			var id = <?= $matriculeTest ?>;
			
			document.getElementById('message').value = ''
			/* if(message != '' && titre != ''){ */
				$.ajax({
					url : '../../model/Messagerie/envoyerMessage.php',
					method : 'post',
					dataType : 'html',
					data : {idConversation: idConversation, message: message, id : id},
					success : function(data){
						$('#affMessage').append(data)
					},
					error : function(e, xhr, s){
						let error = e.responsJSON;
						if(e.status == 403 && typeof error !== 'undefined'){
							alert('Erreur 403')
						}else if(e.status == 404){
							alert('Erreur 404')
						}else if(e.status == 403){
							alert('Erreur 403')
						}else if(e.status == 401){
							alert('Erreur 401')
						}else{
							alert('Erreur Ajax')
						}
					}
				})
			/* } */
		})
	})
</script>