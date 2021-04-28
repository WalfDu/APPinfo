<?php
$title = 'Profil des patients';
require_once '../headerFooter/header.php';

require '../../model/modelProfilPatients/modelProfilPatients.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}
if(!empty($_POST)){
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM test.utilisateurs WHERE id_Utilisateur =?");
    $statement->execute(array($id));
    Database::disconnect();
    header("location: ../../view/profil/profilPatients.php");
}

function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!-- ----------------------------------------------------------- BANNIERE ---------------------------------------------------------------------------------- -->
<div class="banniere">
    <div class="content">
        <h2>Supprimer l'utilisateur</h2> 
    </div>
    <div class="image">
        <img src="../images/icons/baseline_folder_white_24dp.png" alt="">
    </div>
</div>

<!-- ----------------------------------------------------------- FORMULAIRE ---------------------------------------------------------------------------------- -->

<div class="contenu">
    <form class="formulaire" action="../../view/profil/supprimerProfilPatients.php" role="form" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>    
    <p class="alert">Etes-vous sur de vouloir supprimer ?</p>
    <div class="actions">
            <div class="submit">
                <button type="submit" class="bouton">Oui</button>
            </div>
            <div class="retour">
                <a href="../../view/profil/profilPatients.php" class="retour">Non</a>
            </div>
        </div>
    </form>
</div>

<?php require_once '../headerFooter/footer.php';?>