<?php
ob_start();
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

//$loginUrl = $gClient->createAuthUrl();

if (isset($_SESSION['givenName'])) {
    header("Location: index.php");
    exit();
}

$erreur = null;
$success = null;

if (isset($_POST['btnCreer'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $password = $_POST['mdp'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('SELECT prenom, nom, courriel FROM utilisateur WHERE courriel = ?');
    $stmt->execute([$courriel]);
    $user = $stmt->fetch();
    if ($user) {
        $erreur = "Un compte avec ce courriel existe déjà. Veuillez spécifier un autre.";
    } else {
        $stm = $conn->prepare('INSERT INTO utilisateur (prenom, nom, courriel, password) VALUES (?,?,?,?)');
        $result = $stm->execute([$prenom, $nom, $courriel, $hash]);
        if ($result) {
            $success = "Compte créé avec succès! Vous pouvez vous connecter maintenant.";
        } else {
            $erreur = "ERREUR!";
        }
    }
}

?>

<div class="container">
<h4 class="mb-4">Choisissez l'une des options</h4>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
        <label class="form-check-label" for="inlineRadio1">À partir des membres</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
        <label class="form-check-label" for="inlineRadio2">Créer à nouveau</label>
    </div>
</div>

<div class="Container">
<form class="mt-3" action="creerDepart.php" method="POST">
    <div id="detailsDepart" class="border mb-3">
        <div class="container pt-3 pb-3">
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" autocomplete="off" aria-describedby="textHelp" name="nom" placeholder="Entrez le nom">                        
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" autocomplete="off" aria-describedby="textHelp" name="prenom" placeholder="Entrez le prénom">                        
                </div>
            </div>
            <div class="row mb-2">
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="nbPersonnes">Nb de personnes</label>
                    <input type="number" class="form-control" id="nbPersonnes" autocomplete="off" aria-describedby="textHelp" name="nbPersonnes" placeholder="Nombre de personnes" value=1 min=1>                    
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" step="0.01" class="form-control" id="prix" autocomplete="off" aria-describedby="textHelp" name="prix" placeholder="Entrez le prix">    
                </div>
            </div>
                                                
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-10 mb-2">
                    <div class="form-group">
                        <label for="titrePromotion">Titre Promotion</label>
                        <input type="text" class="form-control" id="titrePromotion" autocomplete="off" aria-describedby="textHelp" name="titrePromotion" placeholder="Entrez un titre pour la promotion">     
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 mb-2">
                    <div class="form-group">
                        <label for="rabais">rabais</label>
                        <input type="number" step="0.01" class="form-control" id="rabais" autocomplete="off" aria-describedby="textHelp" name="rabais" placeholder="Rabais">
                    </div>
                </div>
            </div>
            <input type="submit" name="CreerDepart" class="btn btn-primary" value="Créer un départ">
        </div>
    </div>
</form>
</div>

<script>
    var msg1 = document.getElementById('msg1');
    var msg2 = document.getElementById('msg2');
    if (msg1 != null) {
        setTimeout(function() {
            msg1.style.display = 'none'
        }, 5000);
    }
    if (msg2 != null) {
        setTimeout(function() {
            msg2.style.display = 'none'
        }, 5000);
    }
</script>

<?php
  include_once "includes/scripts.php";
  include_once "includes/footer.php";
  ob_end_flush();
?>