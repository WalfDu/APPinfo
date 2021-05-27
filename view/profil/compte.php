<br><br><br><br>


<?php 
$title = 'Votre compte';
require_once '../headerFooter/header.php';

if(!isset($_SESSION['matricule'])):
    header('Location: ../login/login.php');
endif;

require '../../controller/traduction/profil/CompteEN.php';



require_once '../../model/Login/loginFunctions.php';
require_once '../../model/BDD/connexionBDD.php';
$personne = recuperationUneDonnee($BDD, "Personne", "matricule", $_SESSION['matricule']);


?><link href="compte.css" rel="stylesheet" /><?php

if($_SESSION['matricule'] == 0):?>

<div class="contenu">
    <div class="contenu1">
        <div class="bienvenue">
            <h1><?php echo $bienvenue ?> <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1>
            <p><?php echo $commentaire?></p>
        </div>
        
        <div class="photo">
            <img src="../images/icons/user.png" class="photoProfil">
            <!--<div class="dateTime">Dernière connexion le : </div>-->
            <div>	<?php if(est_connecte()):?>
           <a href="../login/logout.php" ><button class="deconnexion"><?php echo $deconnexion?></button> </a>
            <?php endif ?></div>
        </div>
        <div class="identite">
            <p><?= $personne['nom']?></p>
            <p><?= $personne['prenom']?></p>
            <p><?= $personne['role']?></p>
        </div>
    </div>
    <div class="contenu2">
        <div class="bienvenue">
            <div class="content">
                <h1><?php echo $bienvenue?> <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1> <br>
                <p><?php echo $commentaire?>
                </p> <br>
            </div>
        </div>
        <div class="boutons">
            <a href="../gererCapteurs/gererCapteurs.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                        <?php echo $capteur?>
                    </p>
            </button></a>
            <a href="profilPatients.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $profil?>
                    </p>
            </button></a>
            <a href="../prendreRDV/calendrier.php">
            <button class="case">
                <img src="../images/icons/calendrier.png" class="image">
                    <p>
                    <?php echo $calendrier?>
                    </p>
            </button></a>
            <a href="../profil/modifProfil.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $modifier?>
                    </p>
            </button></a>
            
        </div>
    </div>
</div>

<?php elseif($_SESSION['matricule'] < 100):?>

<div class="contenu">
    <div class="contenu1">
        <div class="bienvenue">
            <h1> <?php echo $bienvenue?> <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1>
            <p> <?php echo $commentaire?>
            </p>
        </div>
        
        <div class="photo">
            <img src="../images/icons/user.png" class="photoProfil">
            <!--<div class="dateTime">Dernière connexion le : </div>-->
            <div>	<?php if(est_connecte()):?>
           <a href="../login/logout.php" ><button class="deconnexion"> <?php echo $deconnexion?></button> </a>
            <?php endif ?></div>
        </div>
        <div class="identite">
            <p><?= $personne['nom']?></p>
            <p><?= $personne['prenom']?></p>
            <p><?= $personne['role']?></p>
        </div>
    </div>
    <div class="contenu2">
<div class="bienvenue">
            <div class="content">
                <h1><?php echo $bienvenue?> <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1> <br>
                <p><?php echo $commentaire?>
                </p> <br>
            </div>
        </div>
        <div class="bouttons">
            <a href="profilPatients.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $profil?>
                    </p>
            </button></a>
            <a href="../profil/modifProfil.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $modifier?>
                    </p>
            </button></a>
        </div>
        
    </div>
</div>

<?php elseif($_SESSION['matricule'] >= 100): ?>

<div class="contenu">
    <div class="contenu1">
        <div class="bienvenue">
            <h1> <?php echo $bienvenue?> <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1>
            <p><?php echo $commentairePatient?>
            </p>
        </div>
        <div class="photo">
            <img src="../images/icons/user.png" class="photoProfil">
           
            <div>	<?php if(est_connecte()):?>
           <a href="../login/logout.php" ><button class="deconnexion">Se déconnecter</button> </a>
            <?php endif ?></div>
        </div>
        <div class="identite">
            <p><?= $personne['nom']?></p>
            <p><?= $personne['prenom']?></p>
            <p><?= $personne['role']?></p>
        </div>
    </div>
    <div class="contenu2">
        <div class="bienvenue">
            <div class="content">
                <h1>Bienvenue <?= $personne['prenom'] . ' ' . $personne['nom'] ?></h1><br>
                <p>Vous pouvez consulter vos résultats 
                    ainsi que les dates de vos rendez-vous.
                </p><br>
            </div>
        </div>
        <!-- <a href="../prendreRDV/calendrier.php">
            <button class="case">
                <img src="../images/icons/calendrier.png" class="image">
                    <p>
                        Planning
                    </p>
        </button></a> -->
        <div class="boutons">
            <a href="../resultats/mesResultats.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $resultats?>
                    </p>
            </button></a>
            <a href="../profil/modifProfil.php">
            <button class="case">
                <img src="../images/icons/dossier.png" class="image">
                    <p>
                    <?php echo $modifier?>
                    </p>
            </button></a>
        </div>
        
    </div>
</div>

<?php endif ?>

<?php require '../headerFooter/footer.php'; ?>