<?php
session_start();
$title = "Voyage GoAbroad | Mon compte";
$nav = "index";
require 'includes/header.php';
require_once 'controlleur/connexionDB.php';

if (!isset($_SESSION['prenom'])) {
    header('Location: index.php');
    exit();
}

$idUser = $_SESSION['idUtilisateur'];
$erreur = null;
$succes = null;


if (isset($_POST['btnModifierPwd'])) {
    $inputPassword = $_POST['inputPassword'];
    $lenghtPwd = (int)strlen($inputPassword);
    if ($lenghtPwd < 8 || $lenghtPwd > 12) {
        $erreur = "Votre mot de passe doit contenir de 8 à 12 caractères";
    } else {
        $hash = password_hash($inputPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE utilisateur SET password = ? WHERE idUtilisateur = ?";
        $stmt2 = $conn->prepare($updateQuery);
        $stmt2->execute([$hash, $idUser]);
        $succes = "Votre mot de passe a été modifié";
    }
}

if (isset($_POST['btnUpdate'])) {
    $inputSexe = $_POST['inputSexe'];
    $inputAdresse = $_POST['inputAdresse'];
    $inputVille = $_POST['inputVille'];
    $inputCodePostal = $_POST['inputCodePostal'];
    $inputPays = $_POST['inputPays'];
    $updateQuery = "UPDATE utilisateur SET sexe = ?, adresse = ?, ville = ?, codePostal = ?, pays = ? WHERE idUtilisateur = ?";
    $stmt2 = $conn->prepare($updateQuery);
    $stmt2->execute([$inputSexe, $inputAdresse, $inputVille, $inputCodePostal, $inputPays, $idUser]);
    $succes = "Votre profil a été mis à jour";
}


$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$courriel = $_SESSION['courriel'];
$sexe = $_SESSION['sexe'] ? $_SESSION['sexe'] : '';
$adresse = $_SESSION['adresse'] ? $_SESSION['adresse'] : '';
$courriel = $_SESSION['courriel'] ? $_SESSION['courriel'] : '';
$ville = $_SESSION['ville'] ? $_SESSION['ville'] : '';
$codepostal = $_SESSION['codepostal'] ? $_SESSION['codepostal'] : '';
$pays = $_SESSION['pays'] ? $_SESSION['pays'] : '';


$query = "SELECT ct.titre, d.dateDebut, c.nbAdultes, c.nbEnfants, c.resteAPayer FROM circuit as ct
INNER JOIN depart as d ON ct.idCircuit = d.idCircuit
INNER JOIN commande as c ON d.idDepart = c.idDepart WHERE c.idUtilisateur = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$idUser]);
$commandes = $stmt->fetchAll(PDO::FETCH_OBJ);
/*echo '<pre>';
var_dump($commandes);
echo '</pre>';
exit();*/

?>

<div class="container-fluid py-5 px-5">
    <div class="row mb-3">
        <div class="col-sm-12">
            <h1 class="display-5">Votre compte</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if ($erreur) : ?>
                <div id="pwderror" class="alert alert-danger" role="alert">
                    <?= $erreur ?>
                </div>
            <?php endif; ?>
            <?php if ($succes) : ?>
                <div id="msgsuccess" class="alert alert-success" role="alert">
                    <?= $succes ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-user"></i> Mon profil
                    </div>
                </div>
                <button class="btn card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#profil">
                    <span class="float-left">Modifier mot de passe</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </button>
                <button class="btn card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#profil2">
                    <span class="float-left">Mettre à jour profil</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </button>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i> Mes commandes
                    </div>
                </div>
                <button class="btn card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#commandes">
                    <span class="float-left">Voir détails</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Modal Modifier Mot de passe -->
<div class="modal fade" id="profil" tabindex="-1" role="dialog" aria-labelledby="profilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilLabel">Formulaire Modification mot de passe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formModifierPwd" action="" method="post">
                    <div class="form-group">
                        <label for="inputPassword">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required />
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPwd">Confirmation mot de passe</label>
                        <input type="password" class="form-control" id="inputConfirmPwd" name="inputConfirmPwd" required />
                    </div>
                    <input class="btn btn-primary" type="submit" name="btnModifierPwd" value="Modifier">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modifier Profil -->
<div class="modal fade" id="profil2" tabindex="-1" role="dialog" aria-labelledby="profil2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profil2Label">Voici vos informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdate" action="" method="post">
                    <div class="form-group">
                        <label for="inputPrenom">Prénom</label>
                        <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" value="<?= $prenom ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputNom">Nom</label>
                        <input type="text" class="form-control" id="inputNom" name="inputNom" value="<?= $nom ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="inputCourriel">Courriel</label>
                        <input type="email" class="form-control" id="inputCourriel" name="inputCourriel" value="<?= $courriel ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="inputSexe">Sexe</label>
                        <input type="text" class="form-control" id="inputSexe" name="inputSexe" value="<?= $sexe ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputAdresse">Adresse</label>
                        <input type="text" class="form-control" id="inputAdresse" name="inputAdresse" value="<?= $adresse ?>" />
                    </div>
                    <div class="form-group">
                        <label for="inputVille">Ville</label>
                        <input type="text" class="form-control" id="inputVille" name="inputVille" value="<?= $ville ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputCodePostal">Code Postal</label>
                        <input type="text" pattern="[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]" class="form-control" id="inputCodePostal" name="inputCodePostal" value="<?= $codepostal ?>" />
                    </div>
                    <div class="form-group">
                        <label for="inputPays">Pays</label>
                        <input type="text" class="form-control" id="inputPays" name="inputPays" value="<?= $pays ?>">
                    </div>
                    <input class="btn btn-primary" type="submit" name="btnUpdate" value="Mettre à jour">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Commandes-->
<div class="modal fade" id="commandes" tabindex="-1" role="dialog" aria-labelledby="commandesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commandesLabel">Mes commandes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Liste des commandes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Circuit</th>
                                        <th>Départ</th>
                                        <th>Adultes</th>
                                        <th>Enfants</th>
                                        <th>Reste à payer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($commandes as $commande) : ?>
                                        <tr>
                                            <td><?= $commande->titre ?></td>
                                            <td><?= $commande->dateDebut ?></td>
                                            <td><?= $commande->nbAdultes ?></td>
                                            <td><?= $commande->nbEnfants ?></td>
                                            <td>$ <?= $commande->resteAPayer ?></td>
                                            <td><form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr">
                                                <input type="hidden" name="cmd" value="_xclick" />
                                                <input type="hidden" name="business" value="ouellet135@gmail.com" />
                                                <input type="hidden" name="currency_code" value="CAD" />
                                                <input type="hidden" name="item_name" value=<?= $commande->titre ?> />
                                                <input type="hidden" name="amount" value=<?= $commande->resteAPayer ?> />
                                                <input type="image" src="assets/images/paypall4.jpg" style="width:10em" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
                                            </form></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var pwderror = document.getElementById('pwderror');
    if (pwderror != null) {
        setTimeout(function() {
            pwderror.style.display = 'none'
        }, 5000);
    }
    var msgsuccess = document.getElementById('msgsuccess');
    if (msgsuccess != null) {
        setTimeout(function() {
            msgsuccess.style.display = 'none'
        }, 5000);
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        location.reload();

    }
</script>




<?php include 'includes/footer.php' ?>
