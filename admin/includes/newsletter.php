<?php
    if (isset($_POST['CreerNewsletter'])) {
        /*if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        } else {
            $lieu = "Sans lieu";
        }*/

        $titre = $_POST['titreNewsletter'];
        $contenu = $_POST['contenuNewsletter'];
        $dateDebut = date('Y-m-d', strtotime($_POST['dateDebut']));
        $dateFin = date('Y-m-d', strtotime($_POST['dateFin']));
        $idUtilisateur = 6;
        

        try {
            $sql = "INSERT INTO `newletter`(`idUtilisateur`, `titre`, `contenu`, `dateDebut`, `dateFin`) VALUES (6, :titre, :contenu, '$dateDebut', '$dateFin')";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute(['titre'=>$titre, 'contenu'=>$contenu]);
        } catch (Exception $r) {
        }
        unset($_POST['CreerNewsletter']);
    }
?>

<h2>Créer un newsletter</h2>

<form class="mt-3" action="creerNewsletter.php" method="POST">
    <div id="detailsNewsletter" class="border mb-3">
        <div class="container pt-3 pb-3">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="titreNewsletter">Titre</label>
                        <input type="text" class="form-control" id="titreNewsletter1" autocomplete="off" aria-describedby="textHelp" name="titreNewsletter" placeholder="Entrez le titre">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateDebut">Date de début</label>
                    <input class="form-control" type="date" name="dateDebut" id="dateDebut" value="<?php echo date('Y-m-d'); ?>" />
                </div>
                <div class="form-group ml-3">
                    <label for="dateFin">Date de fin</label>
                    <input class="form-control" type="date" name="dateFin" id="dateFin" value="<?php echo date('Y-m-d'); ?>" />
                </div>
            </div> 
            <div class="row mb-2">
                <div class="col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <label for="contenuNewsletter">Message</label>
                        <textarea class="form-control" id="contenuNewsletter" autocomplete="off" name="contenuNewsletter" rows="3"></textarea> 
                    </div>                
                </div>                                                
            </div>
            <input type="submit" name="CreerNewsletter" class="btn btn-primary" value="Créer un message">
        </div>
    </div>
</form>