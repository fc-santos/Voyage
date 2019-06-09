<?php
session_start();
$title = "Voyage GoAbroad | Mon compte";
$nav = "index";
require 'includes/header.php';

if (!isset($_SESSION['prenom'])) {
    header('Location: index.php');
    exit();
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$courriel = $_SESSION['courriel'];

if (isset($_POST['btnModifier'])) { }
?>

<div class="container-fluid py-5 px-5">
    <div class="row mb-3">
        <div class="col-sm-12">
            <h1 class="display-5">Votre compte</h1>
            <hr>
        </div>
    </div>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-user"></i> Votre profil
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
                        Liste des commandes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Circuit</th>
                                        <th>Départ</th>
                                        <th>Nombre d'Adultes</th>
                                        <th>Nombre d'enfants</th>
                                        <th>Restant à payer</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Circuit</th>
                                        <th>Depart</th>
                                        <th>Nombre d'Adultes</th>
                                        <th>Nombre d'enfants</th>
                                        <th>Restant à payer</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>Hope Fuentes</td>
                                        <td>Secretary</td>
                                        <td>San Francisco</td>
                                        <td>41</td>
                                        <td>2010/02/12</td>
                                    </tr>
                                    <tr>
                                        <td>Vivian Harrell</td>
                                        <td>Financial Controller</td>
                                        <td>San Francisco</td>
                                        <td>62</td>
                                        <td>2009/02/14</td>
                                    </tr>
                                    <tr>
                                        <td>Timothy Mooney</td>
                                        <td>Office Manager</td>
                                        <td>London</td>
                                        <td>37</td>
                                        <td>2008/12/11</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




<?php include 'includes/footer.php' ?>