<?php

if (isset($_POST['autre']) || isset($_POST['terminer'])) {
    if (!isset($_SESSION['ordre'])) {
        $_SESSION['ordre'] = 0;
    } else {
        $_SESSION['ordre'] = $_SESSION['ordre'] + 1;
    }
    
    if (isset($_POST['titreEtape'])) {
        $titreEtape = $_POST['titreEtape'];
    }
    if (isset($_POST['descriptionEtape'])) {
        $descriptionEtape = $_POST['descriptionEtape'];
    }
    if (isset($_POST['joursEtape'])) {
        $joursEtape = $_POST['joursEtape'];
    }

    try {
        $idCircuit = $_SESSION['idCircuit'];
        $ordre = $_SESSION['ordre'];
        /* $sql4 = "SELECT * FROM etape WHERE idCircuit = $idCircuit ORDER BY ordre DESC LIMIT 1";
         $stmt4 = $conn->prepare($sql4);
         $stmt4->execute();
         $etape = $stmt4->fetch();

          if ($etape->rowCount() > 0) {
              $ordre = $etape->ordre + 1;
          } else {
              $ordre = 1;
          };*/
        
        $sql3 = "INSERT INTO etape(idCircuit, nom, description, ordre, nbJour) VALUES($idCircuit, :titre, :description,  $ordre, :joursEtape)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(['titre' => $titreEtape, 'description' => $descriptionEtape, 'joursEtape' => $joursEtape]);
        $_SESSION['correctEtape'] = true;

        /*$sql2 = 'SELECT * FROM circuit WHERE titre = :titre';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['titre' => $nomCircuit]);
        $circuit = $stmt2->fetch();
        $idCircuit = $circuit -> idCircuit;*/
        unset($_POST['autre']);
    } catch (Exception $r) {
    }
}

if (isset($_POST['terminer'])) {
    //$_SESSION['ordre'] = 0;
    unset($_SESSION['ordre']);
    unset($_SESSION['correctEtape']);
    unset($_SESSION['correctNomCircuit']);
    unset($_POST['terminer']);
}
?>

<h2>Créer des étapes</h2>

<form class="mt-3" action="creerCircuit.php" method="POST">
  <div class="form-group">
    <label for="titreEtape">Titre</label>
    <input type="text" class="form-control" required id="titreEtape" placeholder="Nom de l'étape" name="titreEtape" value="<?php if (isset($_POST['titreEtape']) && !isset($_SESSION['correctEtape'])) {
    echo htmlentities($_POST['titreEtape']);
}?>">
  </div>
  <div class="form-group">
    <label for="descriptionEtape">Description</label>
    <textarea class="form-control" id="descriptionEtape" name="descriptionEtape" rows="4"><?php if (isset($_POST['descriptionEtape']) && !isset($_SESSION['correctEtape'])) {
    echo htmlentities($_POST['descriptionEtape']);
}?></textarea> 
  </div>
    <div class="form-group">
        <label for="joursEtape">Nombre de jours</label>
        <input type="number" class="form-control" id="joursEtape" min=1 name="joursEtape" value="1">
    </div>
    <div id="detailsJours" class="border mb-3">       
        //
    </div>
    <button type="submit" onclick="ajouterJours()" name="autre" class="btn btn-primary">Ajouter une autre étape</button>
    <button type="submit" name="terminer" class="btn btn-primary">Terminer</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>