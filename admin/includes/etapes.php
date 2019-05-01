<?php
?>

<h2>Créer des étapes</h2>
<form class="mt-3" action="addcircuit.php" method="POST">
  <div class="form-group">
    <label for="titreetape">Titre</label>
    <input type="text" class="form-control" required id="titreetape" placeholder="Nom de l'étape" name="nomCircuit" value="<?php if (isset($_POST['titreetape'])) {
    echo htmlentities($_POST['titreetape']);
}?>">
  </div>
  <div class="form-group">
    <label for="descriptionetape">Description</label>
    <textarea class="form-control" id="descriptionetape" name="descriptionetape" rows="10"><?php if (isset($_POST['descriptionetape'])) {
    echo htmlentities($_POST['descriptionetape']);
}?></textarea>
  </div>
    <div class="form-group">
        <label for="nbjours">Nombre de jours</label>
        <input type="number" class="form-control" id="nbjours" name="nbjours" value="0">
    </div>
    <div class="form-group" id="detailsJours" visibility="hidden">
</div>
    <button type="submit" class="btn btn-default">Ajouter une autre étape</button>
    <button class="btn btn-primary">Terminer</button>
</form>