<?php

if (isset($_GET['idEtape'])) {
    $_SESSION['correctEtape'] = true;

    try {
        $_SESSION['idEtape'] = $_GET['idEtape'];
        $idEtape = $_SESSION['idEtape'];

        $query = 'SELECT * from etape WHERE idEtape=' . $idEtape;

        $stmt = $conn->query($query);

        while ($row = $stmt->fetch()) {
            $nomEtape = $row->titre;
            $descriptionEtape = $row->description;
        }
    } catch (Exception $r) {
    }
    unset($_POST['ajouterEtape']);
}

if (isset($_POST['ajouterJours']) || isset($_POST['terminerEtape'])) {
    if (!isset($_SESSION['ordre'])) {
        $_SESSION['ordre'] = 0;
    } else {
        $_SESSION['ordre'] = $_SESSION['ordre'] + 1;
    }
        
    if (isset($_POST['titreEtape']) && $_POST['titreEtape'] != "") {
        $titreEtape = $_POST['titreEtape'];
    } else {
        $titreEtape = "Sans titre";
    }
    if (isset($_POST['descriptionEtape']) && $_POST['descriptionEtape'] != "") {
        $descriptionEtape = $_POST['descriptionEtape'];
    } else {
        $descriptionEtape = "Sans description";
    }
    
    try {
        $idCircuit = $_SESSION['idCircuit'];
        $ordre = $_SESSION['ordre'];
            
        $sql3 = "INSERT INTO etape(idCircuit, nom, description, ordre) VALUES($idCircuit, :titre, :description,  $ordre)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(['titre' => $titreEtape, 'description' => $descriptionEtape]);
        $_SESSION['correctEtape'] = true;
        $_SESSION['idEtape'] = $conn->lastInsertId();
        unset($_POST['ajouterJours']);
        //unset($_POST['ajouterEtape']);
    } catch (Exception $r) {
    }
}
if (isset($_POST['terminerEtape'])) {
    unset($_POST['nomCircuit']);
    unset($_POST['descriptionCircuit']);
    unset($_SESSION['correctEtape']);
    unset($_GET['idCircuit']);
    $_SESSION['success'] = 'Une étape a été ajouté au circuit "' . $idCircuit . '"';
    header("location: listerEtapes.php?idCircuit=" . $_SESSION['idCircuit']);
}
?>

<h2>Créer des étapes</h2>

<form class="mt-3 mb-3" action="creerCircuit.php" method="POST">
  <div class="form-group">
    <label for="titreEtape">Titre</label>
    <input type="text" class="form-control" autocomplete="off" id="titreEtape" placeholder="Nom de l'étape" name="titreEtape" value="<?php if (isset($_POST['titreEtape'])/* && !isset($_SESSION['correctEtape'])*/) {
    echo htmlentities($_POST['titreEtape']);
}?>">
  </div>
  <div class="form-group">
    <label for="descriptionEtape">Description</label>
    <textarea class="form-control" id="descriptionEtape" autocomplete="off" name="descriptionEtape" rows="4"><?php if (isset($_POST['descriptionEtape']) /*&& !isset($_SESSION['correctEtape'])*/) {
    echo htmlentities($_POST['descriptionEtape']);
}?></textarea> 
  </div>

    <button type="submit" name="ajouterJours" class="btn btn-primary">Ajouter Jours</button>
    <button type="submit" name="terminerEtape" class="btn btn-primary">Terminer</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>