<?php
?>

<h2>Créer des étapes</h2>
<?= $idCircuit ?>
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
        <input type="number" class="form-control" id="nbjours" name="nbjours">
    </div>
    <div id="detailsJours">
    </div>
    <button type="submit" class="btn btn-default">Ajouter une autre étape</button>
    <button class="btn btn-primary">Terminer</button>
</form>

<script>    
    $("#nbjours").on("input", function(){
        let jours = $('#nbjours').val();
        detailsJour = '';
        for(let i = 1; i <= jours; i++){
            detailsJour += '<div style="height:50px; border: 1px solid red;">fggfgfgfg</div>';
        }
        $('#detailsJours').html(detailsJour);
    });
</script>