<?php
$succes = null;
$correct = false;

 if (isset($_POST['nomCircuit'])) {
     $nomCircuit = $_POST['nomCircuit'];
 }
 if (isset($_POST['descriptionCircuit'])) {
     $descriptionCircuit = $_POST['descriptionCircuit'];
 }

 if (isset($_POST['nomCircuit'])) {
     try {
         $sql = 'INSERT INTO circuit(titre, description, estActif) VALUES(:titre, :description, 0)';
         $stmt = $conn->prepare($sql);
         $stmt->execute(['titre' => $nomCircuit, 'description' => $descriptionCircuit]);
         $correctNomCircuit = true;
         $_SESSION['actionPage'] = 'Ajouter des étapes';
     } catch (Exception $r) {
     }
 }
?>

<form class="mt-3" action="addcircuit.php" method="POST" id="formCreateCircuit")">
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
  <button type="submit" class="btn btn-default">Enregistrer</button>
</form>