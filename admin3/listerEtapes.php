<?php
include "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include "includes/header.php";
include "includes/navbar.php";

if (isset($_GET['idCircuit'])) {
    $idCircuit = $_GET['idCircuit'];
}

$stmt = $conn->query('SELECT * FROM etape WHERE idCircuit = ' . $idCircuit);

    $table = '
                <div class="table-wrapper">			
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Étapes</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <div class="search-box">
                                    <div class="input-group">								
                                        <input type="text" id="search" class="form-control" placeholder="Recherche...">
                                        <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th style="width: 200px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $row->nom . '</td>
                                        <td>' . $row->description . '</td>
                                        <td style="width: 200px;">
                                            <div class="col-md-12 choix">
                                                <a href="" data-toggle="modal" data-target="#exampleModal'. $row->idEtape .'"><i class="fa fa-trash" aria-hidden="true" style="color: #ff6666;"></i></a>
                                                <a href="modifierEtape.php?idEtape=' . $row->idEtape . '"><i class="fa fa-pencil" aria-hidden="true" style="color: #00b33c;"></i></a>
                                                <a href="listerJours.php?idEtape=' . $row->idEtape . '" class="btn btn-primary" style="color: white;">Jours</a>
                                                <!-- Modal -->
                                                <div style="color: black;" class="modal fade" id="exampleModal'. $row->idEtape .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: left !important;">
                                                        Êtes-vous certain de vouloir supprimer "' . $row->nom . '"? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" href="gererEtapes.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                            <a type="button" href="deleteEtape.php?idEtape=' . $row->idEtape . '" class="btn btn-primary">Confirmer</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                        }
                $table .= '</tbody>
                        </table>
                    </div>
                ';
?>

<div class="container">
    <?php if (isset($_SESSION['success'])):?>
        <div class="alert-success pt-2 pb-2 mb-2"><?= $_SESSION['success'] ?></div> 
        <?php unset($_SESSION['success']); ?>   
    <?php endif ?>
    <form action="creerCircuit.php" method="GET">
        <button class="btn btn-primary" style="color: white;">Ajouter Étape</button>
        <input type="hidden" name="idCircuit" value="<?= $idCircuit ?>">
    </form>
    <?php
        echo $table;
    ?>
    <a href="gererCircuit.php" class="mb-10"><i class="fas fa-arrow-alt-circle-left"></i> Retourner</a>
</div>


<?php
  include('includes/scripts.php');
  include('includes/footer.php');
?>