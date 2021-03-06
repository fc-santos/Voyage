<?php
  if (!session_id()) {
      @session_start();
  }

  if (!isset($_SESSION['role'])) {
      header('location: ../index.php');
  } else {
      if ($_SESSION['role'] != 'Admin') {
          header('location: ../index.php');
      }
  }
  
    if (isset($_POST['CreerDepart'])) {
        /*if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        } else {
            $lieu = "Sans lieu";
        }*/

        $idCircuit = $_POST['idCircuitChoisi'];
        $dateDepart = date('Y-m-d', strtotime($_POST['dateDepart']));
        $nbPersonnes = $_POST['nbPersonnes'];
        $prix = $_POST['prix'];

        if (isset($_POST['titrePromotion']) && $_POST['titrePromotion'] != "") {
            $titrePromotion = $_POST['titrePromotion'];
        } else {
            $titrePromotion = 'none';
        }

        if (isset($_POST['rabais']) && $_POST['rabais'] != "") {
            $rabais = $_POST['rabais'];
        } else {
            $rabais = 0;
        }

        if (isset($_POST['departActive'])) {
            $isActive = 0;
        } else {
            $isActive = 1;
        }

        try {
            $sql = "INSERT INTO `depart`(`idCircuit`, `dateDebut`, `nbPlaces`, `prix`, `titrePromotion`, `rabais`, `estActif`) VALUES ($idCircuit, '$dateDepart', $nbPersonnes, $prix, :titrePromotion, $rabais, $isActive)";

            $stmt1 = $conn->prepare($sql);
            $stmt1->execute(['titrePromotion'=>$titrePromotion]);
        } catch (Exception $r) {
        }
        unset($_POST['CreerDepart']);
    }
?>

<h2>Créer un départ</h2>

<form class="mt-3" action="creerDepart.php" method="POST">
    <div id="detailsDepart" class="border mb-3">
        <div class="container pt-3 pb-3">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="circuit">Circuit</label>
                        <input type="text" class="form-control" id="circuit1" autocomplete="off" aria-describedby="textHelp" name="circuit" placeholder="Entrez un circuit">
                        <input type="hidden" id="idCircuitChoisi" name="idCircuitChoisi">
                        <div class="pl-2" id="livesearchCircuit1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateDepart">Date de départ</label>
                    <input class="form-control" type="date" name="dateDepart" id="dateDepart" value="<?php echo date('Y-m-d'); ?>" />
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
                <div class="col-sm-12 col-md-8 mb-2">
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
                <div class="form-check col-sm-12 col-md-2 mb-2" style="text-align: center; padding-top: 40px">
                    <input type="checkbox" name="departActive" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Activer</label>
                </div>
            </div>
            <input type="submit" name="CreerDepart" class="btn btn-primary" value="Créer un départ">
        </div>
    </div>
</form>