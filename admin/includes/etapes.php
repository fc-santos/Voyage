<?php





?>

<form class="mt-3">
    <div class="form-group">
        <label for="titreetape">Titre</label>
        <input type="text" class="form-control" id="titreetape" placeholder="Nom du Circuit">
    </div>
    <div class="form-group">
        <label for="descriptionetape">Description</label>
        <textarea class="form-control" id="descriptionetape" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="nbjours">Nombre de jours</label>
        <div class="input-group">
            <input type="number" min=1 class="form-control" id="nbjours">
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>