<?php 
$title = 'Ajouter un RDV';
require '../headerFooter/header.php'; 
require_once '../../model/RDV/bootstrap.php';
require_once '../../model/BDD/connexionBDD.php';
//require '../../model/RDV/EventGS.php';
//require '../../model/RDV/events.php';

// on peut faire les fonctions pour valider mais c'est long...

if(!empty($_POST['fin'])){
	extract($_POST);
$debuts =  DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $debut)->format('Y-m-d H:i:s');
$fins =  DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $fin)->format('Y-m-d H:i:s');
insert($BDD, "INSERT INTO PriseDeRDV (matricule, debut, fin, type) VALUES(?,?,?,?)", array($matricule, $debuts, $fins, $type));

header('Location: calendrier.php');
exit;
}
?>

<link rel="stylesheet" href="ajouterRDV.css">

<div class = "hautPage">
	<p class="titrePage"><b>Prendre rendez-vous</b></p>
	<img class="imgCalendrier" src="../images/icons/calendrier.svg" alt="icone profil patient">
</div>
<div class="recherche">
	<p class="indication"><b>Rentrez les informations suivantes pour prendre RDV :</b></p>
<form class="aRemplir" method="post">
	<input width="50px" class="nom" type="text" placeholder="Matricule" name="matricule" id="matricule" required
	value="<?php if(isset($name)) {echo $matricule;} ?>"
	>
	<input type="date" id="date" name="date" required
	value="<?php if(isset($date)) {echo $date;} ?>"
	>
	<input type="time" id="debut" placeholder="HH:MM" name="debut" required
	value="<?php if(isset($debut)) {echo $debut;}?>"
	>
	<input type="time" id="fin" placeholder="HH:MM" name="fin" required
	value="<?php if(isset($fin)) {echo $fin;} ?>"
	>
	<input type = "text" placeholder="Type de test" name="type" id="type" required
	value="<?php if(isset($type)) {echo $type;} ?>"
	></input>
	<button>Ajouter le RDV</button>
</form>
</div>

<?php require '../headerFooter/footer.php' ?>
