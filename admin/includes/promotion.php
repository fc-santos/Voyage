<?php





?>

<form class="mt-3">
    <div class="form-group">
        <label for="titrepromo">Titre</label>
        <input type="email" class="form-control" id="titrepromo" placeholder="Titre de la promotion">
    </div>
    <div class="form-group">
        <label for="rabais">Rabais (en pourcentage)</label>
        <div class="input-group">
            <input type="number" min=1 class="form-control" id="rabais" placeholder="Pourcentage du rabais">
        </div>
    </div>
    <div class="form-group">
        <label for="datedebut">Date de début</label>
        <input type="date" class="form-control" id="date">
    </div>
    <div class="form-group">
        <label for="datefin">Date de fin</label>
        <input type="date" class="form-control" id="datefin">
    </div>
    <button type="submit" class="btn btn-default">Enregistrer</button>
</form>