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


if (isset($_POST['btnModifier'])) {
    $inputNom = $_POST['inputNom'];
    $inputPrenom = $_POST['inputPrenom'];
    $inputCourriel = $_POST['inputCourriel'];
    $inputPassword = $_POST['inputPassword'];
    $lenghtPwd = (int)strlen($inputPassword);
    if ($lenghtPwd < 8 || $lenghtPwd > 12) {
        $erreur = "Votre mot de passe doit contenir de 8 à 12 caractères";
    } else {
        $hash = password_hash($inputPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE utilisateur SET prenom = ?, nom = ?, courriel = ?, password = ? WHERE idUtilisateur = ?";
        $stmt2 = $conn->prepare($updateQuery);
        $stmt2->execute([$inputPrenom, $inputNom, $inputCourriel, $hash, $idUser]);
        $_SESSION['nom'] = $inputNom;
        $_SESSION['prenom'] = $inputPrenom;
        $_SESSION['courriel'] = $inputCourriel;
        $succes = "Votre profil a été mis à jour";
    }
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$courriel = $_SESSION['courriel'];


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
                    <span class="float-left">Voir détails</span>
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

<!-- Modal Modifier Profil -->
<div class="modal fade" id="profil" tabindex="-1" role="dialog" aria-labelledby="profilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilLabel">Voici vos informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formModifier" action="" method="post">
                    <div class="form-group">
                        <label for="inputPrenom">Prénom</label>
                        <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" value="<?= $prenom ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="inputNom">Nom</label>
                        <input type="text" class="form-control" id="inputNom" name="inputNom" value="<?= $nom ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="inputCourriel">Courriel</label>
                        <input type="email" class="form-control" id="inputCourriel" name="inputCourriel" value="<?= $courriel ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required />
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPwd">Confirmation mot de passe</label>
                        <input type="password" class="form-control" id="inputConfirmPwd" name="inputConfirmPwd" required />
                    </div>
                    <input class="btn btn-primary" type="submit" name="btnModifier" value="Modifier">
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
    }
</script>




<?php include 'includes/footer.php' ?>