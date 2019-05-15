<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

if (isset($_GET['idEtape'])) {
    $stmt = $conn->query("SELECT * FROM etape WHERE idEtape=" . $_GET['idEtape']);
    $row = $stmt->fetch();

    $titre = $row->nom;
    $description = $row->description;
}

?>


<div class="container">
  <h2>Modifier étape</h2>
  <form class="mt-3 mb-3" action="modifierEtapeConfirme.php" method="POST">
    <div class="form-group">
      <label for="titreetape">Titre</label>
      <input type="text" class="form-control" autocomplete="off" id="titreetape" placeholder="Nom de l'étape" name="nomEtape" value="<?php if (isset($_POST['nomEtape'])) {
    echo htmlentities($_POST['nomEtape']);
} elseif (isset($_GET['idEtape'])) {
    echo $titre;
}
?>">
    </div>
    <div class="form-group">
      <label for="descriptionEtape">Description</label>
      <textarea class="form-control" autocomplete="off" id="descriptionetape" placeholder="Description de l'étape" name="descriptionEtape" rows="4"><?php if (isset($_POST['descriptionEtape'])) {
    echo htmlentities($_POST['descriptionEtape']);
} elseif (isset($_GET['idEtape'])) {
    echo $description;
}?></textarea>
    </div>
    <input type="hidden" name="idEtape" value="<?php if (isset($_GET['idEtape'])) {
    echo $_GET['idEtape'];
}?>">
    <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>