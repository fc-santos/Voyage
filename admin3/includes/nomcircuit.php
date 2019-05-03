<?php
  
if (isset($_POST['submit'])) {
    if (isset($_POST['nomCircuit'])) {
        $nomCircuit = $_POST['nomCircuit'];
    }
    if (isset($_POST['descriptionCircuit'])) {
        $descriptionCircuit = $_POST['descriptionCircuit'];
    }
    try {
        $sql = "INSERT INTO circuit(titre, description, estActif) VALUES(:titre, :description, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['titre' => $nomCircuit, 'description' => $descriptionCircuit]);
        $_SESSION['correctNomCircuit'] = true;

        $sql2 = "SELECT * FROM circuit WHERE titre = :titre";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['titre' => $nomCircuit]);
        $circuit = $stmt2->fetch();
        $_SESSION['idCircuit'] = $circuit -> idCircuit;
        unset($_POST['submit']);
    } catch (Exception $r) {
    }
}
?>

<h2>Créer circuit</h2>
<form class="mt-3 mb-3" action="creerCircuit.php" method="POST">
  <div class="form-group">
    <label for="titrecircuit">Titre</label>
    <input type="text" class="form-control" required id="titrecircuit" placeholder="Nom du Circuit" name="nomCircuit" value="<?php if (isset($_POST['nomCircuit'])) {
    echo htmlentities($_POST['nomCircuit']);
}?>">
  </div>
  <div class="form-group">
    <label for="descriptioncircuit">Description</label>
    <textarea class="form-control" id="descriptioncircuit" name="descriptionCircuit" rows="10"><?php if (isset($_POST['descriptionCircuit'])) {
    echo htmlentities($_POST['descriptionCircuit']);
}?></textarea>
  </div>
  <div class="form-group">
    <label for="imagecircuit">Image</label>
    <input type="file" id="imagecircuit">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>