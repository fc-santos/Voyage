<?php
    if (isset($_POST['autreEtape'])) {
        if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        }

        if (isset($_POST['hebergement'])) {
            $hebergement = $_POST['hebergement'];
        }
        if (isset($_POST['souper'])) {
            $souper = $_POST['souper'];
        }
        if (isset($_POST['diner'])) {
            $diner = $_POST['diner'];
        }
        if (isset($_POST['typeHebergement'])) {
            $typeHebergement = $_POST['typeHebergement'];
        }
        if (isset($_POST['activites'])) {
            $activites = $_POST['activites'];
        }

        try {
            $idEtape = $_SESSION['idEtape'];

            $sql4 = "INSERT INTO `jour`(`idEtape`, `idHebergement`, `idSouper`, `idDiner`, `idActivite`, `lieu`) VALUES ($idEtape, 1, 1, 1, 1, 'aaa')";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->execute();
            $_SESSION['correctNomCircuit'] = true;
        } catch (Exception $r) {
        }
        unset($_POST['autreJour']);
    }

    if (isset($_POST['ajouterPlusJours'])) {
        if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        }

        if (isset($_POST['hebergement'])) {
            $hebergement = $_POST['hebergement'];
        }
        if (isset($_POST['souper'])) {
            $souper = $_POST['souper'];
        }
        if (isset($_POST['diner'])) {
            $diner = $_POST['diner'];
        }
        if (isset($_POST['typeHebergement'])) {
            $typeHebergement = $_POST['typeHebergement'];
        }
        if (isset($_POST['activites'])) {
            $activites = $_POST['activites'];
        }

        try {
            $idEtape = $_SESSION['idEtape'];

            $sql4 = "INSERT INTO `jour`(`idEtape`, `idHebergement`, `idSouper`, `idDiner`, `idActivite`, `lieu`) VALUES ($idEtape, 1, 1, 1, 1, 'aaa')";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->execute();
            $_SESSION['correctEtape'] = true;
        } catch (Exception $r) {
        }
        unset($_POST['ajouterPlusJours']);
    }
?>

<h2>Ajouter des jours</h2>

<form class="mt-3" action="creerCircuit.php" method="POST">
    <div id="detailsJours" class="border mb-3">
        <div class="container pt-3 pb-3">
            <h5>Jour <?php //$jourNumber?></h5>
            <div class="row mb-2">
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="lieu">Lieu</label>
                        <input type="text" class="form-control lieu" id="lieu1" autocomplete="off" aria-describedby="textHelp" name="lieu" placeholder="Entrez un lieu">
                        <div class="pl-2" id="livesearchLieu1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                    </div>
                </div>
            </div> 
            <div class="row mb-2">
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="hebergement">Hébergement</label>
                    <input type="text" class="form-control  lieuHebergement" id="hebergement1" autocomplete="off" aria-describedby="textHelp" name="hebergement" placeholder="Entrez un hébergement">
                    <div class="pl-2" id="livesearchhebergement1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="souper">Souper</label>
                        <input type="text" class="form-control lieuSouper" id="souper1" aria-describedby="textHelp" name="souper" placeholder="Entrez un lieu pour souper">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="diner">Dîner</label>
                        <input type="text" class="form-control lieuDiner" id="diner1" aria-describedby="textHelp" name="diner" placeholder="Entrez un lieu pour dîner">             
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="typeHebergement">Type Hébergement</label>
                        <input type="text" class="form-control typeHebergement" id="typeHebergement1" aria-describedby="textHelp" name="typeHebergement" placeholder="Entrez le type d'hébergement">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 mb-2">
                    <div class="form-group">
                        <label for="activites">Activités</label>
                        <input type="text" class="form-control jourActivites" id="activites1" aria-describedby="textHelp" name="activites" placeholder="Entrez des activités">
                    </div>
                </div>
            </div>

            <button type="submit" name="autreEtape" class="btn btn-primary">Ajouter une autre étape</button>
            <button type="submit" name="ajouterPlusJours" class="btn btn-primary">Ajouter Jours</button>
        </div>
    </div>
</form>