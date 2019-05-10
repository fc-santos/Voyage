<?php
include "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include "includes/header.php";
include "includes/navbar.php";

if (isset($_GET['idEtape'])) {
    $idEtape = $_GET['idEtape'];
}

$stmt = $conn->query('SELECT * FROM jour WHERE idEtape = ' . $idEtape);

////////////////////////////////////////////////////
//requetes avec les id (idEtape, idLieu, idHebergement, idSouper, idDiner, idActivite)
$getEtape = $conn->query('SELECT * FROM etape WHERE idEtape = ' . $idEtape);
$etape = $getEtape->fetch();

$getSouper = $conn->query('SELECT * FROM manger WHERE idManger = 46');// . $idSouper);
$souper = $getSouper->fetch();
///////////////////////////////////////////////////////

$table = '
                <div class="table-wrapper">			
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Jours</b></h2>
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
                                <th>Etape</th>
                                <th>Souper</th>
                                <th style="width: 150px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $etape->nom . '</td>
                                        <td>' . $souper->nom . '</td>
                                        <td style="width: 150px;">
                                            <div class="col-md-12 choix">                  
                                                <a href="" data-toggle="modal" data-target="#exampleModal'. $row->idJour .'"><i class="fa fa-trash" aria-hidden="true" style="color: #ff6666;"></i></a>
                                                <a href="modifierJour.php?idJour=' . $row->idJour . '"><i class="fa fa-pencil" aria-hidden="true" style="color: #00b33c;"></i></a>
                                                <!-- Modal -->
                                                <div style="color: black;" class="modal fade" id="exampleModal'. $row->idJour .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        Êtes-vous certain de vouloir supprimer ce jour? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" href="gererJours.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                            <a type="button" href="deleteJour.php?idJour=' . $row->idJour . '" class="btn btn-primary">Confirmer</a>
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
        <?php unset($_SESSION['success']);?>
    <?php endif ?>
    <form action="creerCircuit.php" method="GET">
        <button class="btn btn-primary" style="color: white;">Ajouter Jour</button>
        <input type="hidden" name="idEtape" value="<?= $idEtape ?>">
    </form>
    <?php
        echo $table;
    ?>
</div>


<?php
  include('includes/scripts.php');
  include('includes/footer.php');
?>