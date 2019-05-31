<?php
ob_start();
include "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include "includes/header.php";
include "includes/navbar.php";
//echo $_SESSION['debug'];

if (isset($_GET['idEtape'])) {
    $idEtape = $_GET['idEtape'];
}

if (isset($_GET['idCircuit'])) {
    $idCircuit = $_GET['idCircuit'];
}

/*$getEtape = $conn->query('SELECT * FROM etape WHERE idEtape = ' . $idEtape);
$etape = $getEtape->fetch();*/

$stmt = $conn->query('SELECT * FROM jour WHERE idEtape = ' . $idEtape);

////////////////////////////////////////////////////
//requetes avec les id (idEtape, idLieu, idHebergement, idSouper, idDiner, idActivite)
/*$getEtape = $conn->query('SELECT * FROM etape WHERE idEtape = ' . $idEtape);
$etape = $getEtape->fetch();

$getSouper = $conn->query('SELECT * FROM manger WHERE idManger = 46');// . $idSouper);
$souper = $getSouper->fetch();*/
///////////////////////////////////////////////////////
$jour = 0;
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
                        <col width="50">
                        <col width="130">
                        <col width="130">
                        <col width="130">
                        <col width="130">
                        <col width="130">
                        <col width="150">            
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Lieu</th>
                                <th>Hebergement</th>
                                <th>Activites</th>
                                <th>Dinner</th>
                                <th>Souper</th>
                                <th style="width: 150px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $jour++;
                            $idJour = $row->idJour;
                            //unset($idLieu);
                            ////////////////////////////////////////////////////
                            //requetes avec les id (idEtape, idLieu, idHebergement, idSouper, idDiner, idActivite)
                            

                            $getActivite = $conn->query('SELECT * FROM activite WHERE idActivite = ' . $row->idActivite);
                            $activite = $getActivite->fetch();

                            //$_SESSION['debug'] = $activite != null;
                            
                            /* if (!isset($idLieu) && $activite != null) {
                                 $idLieu = $activite->idLieu;
                                 //$_SESSION['debug'] .= 'SELECT * FROM activite WHERE idActivite = ' . $row->idActivite;
                             }*/

                            

                            $getHebergement = $conn->query('SELECT * FROM hebergement WHERE idHebergement = ' . $row->idHebergement);
                            $hebergement = $getHebergement->fetch();


                            /* if (!isset($idLieu) && $hebergement != null) {
                                 $idLieu = $hebergement->idLieu;
                             }*/

                            $getDinner = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idDinner);
                            $dinner = $getDinner->fetch();

                            /* if (!isset($idLieu) && $dinner != null) {
                                 $idLieu = $dinner->idLieu;
                             }*/

                            $getSouper = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idSouper);
                            $souper = $getSouper->fetch();

                            /*if (!isset($idLieu) && $souper != null) {
                                $idLieu = $souper->idLieu;
                            }*/

                            $getLieu = $conn->query("SELECT * FROM lieu WHERE idLieu = $row->idLieu");
                            //$_SESSION['debug'] = "SELECT * FROM lieu WHERE idLieu = $idLieu";
                            $lieu = $getLieu->fetch();
                            if ($lieu->nom == null && $lieu->ville == null && $lieu->pays == null) {
                                $lieuAMontrer = 'Sans Lieu';
                            } else {
                                $lieuAMontrer = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $lieu->nom . ' ' . $lieu->ville . ' ' . $lieu->pays)));
                            }
                            ///////////////////////////////////////////////////////
                            $table .= ' 
                                    <tr>
                                        <td>' . $jour . '</td>
                                        <td>' . $lieuAMontrer . '</td>
                                        <td>' . $hebergement->nom . '</td>
                                        <td>' . $activite->nom . '</td>
                                        <td>' . $dinner->nom . '</td>
                                        <td>' . $souper->nom . '</td>
                                        <td>
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
                                                        <div class="modal-body" style="text-align: left !important;">
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

<div class="container minimumHeight">
<?php //echo $_SESSION['debug'];?>
<?php //unset($_SESSION['debug']);?>
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
    <a href="<?php if (isset($idCircuit)) {
        echo "listerEtapes.php?idCircuit=$idCircuit";
    } else {
        echo 'gererCircuit.php';
    } ?>" class="mb-10"><i class="fas fa-arrow-alt-circle-left"></i> Retourner</a>
</div>

<?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ob_end_flush();
?>