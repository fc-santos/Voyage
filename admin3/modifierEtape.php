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

/*Faire le code ici*/

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
                                <th>ID Étape</th>
                                <th>Nom</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $row->idJour . '</td>
                                        <td>' . $row->idEtape . '</td>
                                        <td>' . $row->idHebergement . '</td>
                                        <td>
                                            <div class="col-md-12">
                        
                                                <button class="btn btn-danger" style="color: white;" data-toggle="modal" data-target="#exampleModal'. $row->idJour .'"> Supprimer</button>
                                                <a href="modifierJour.php?idJour=' . $row->idJour . '" class="btn btn-primary" style="color: white;"> Modifier</a>
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
                                                        Êtes-vous certain de vouloir supprimer "' . $row->idJour . '"? 
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