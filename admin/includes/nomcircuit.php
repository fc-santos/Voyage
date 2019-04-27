<?php

?>

<form class="mt-3">
  <div class="form-group">
    <label for="titrecircuit">Titre</label>
    <input type="email" class="form-control" id="titrecircuit" placeholder="Nom du Circuit">
  </div>
  <div class="form-group">
    <label for="descriptioncircuit">Description</label>
    <textarea class="form-control" id="descriptioncircuit" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label for="imagecircuit">Image</label>
    <input type="file" id="imagecircuit">
  </div>
  <div class="form-group">
    <label for="date">Date de départ</label>
    <input type="date" class="form-control" id="date">
  </div>
  <button type="submit" class="btn btn-default">Enregistrer</button>
</form>