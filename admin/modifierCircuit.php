<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";



if (isset($_GET['idCircuit'])) {
    $stmt = $conn->query("SELECT * FROM circuit WHERE idCircuit=" . $_GET['idCircuit']);
    $row = $stmt->fetch();

    $titre = $row->titre;
    $description = $row->description;
}

?>


<div class="container">
  <h2>Modifier circuit</h2>
  <form class="mt-3 mb-3" action="modifierCircuitConfirme.php" method="POST">
    <div class="form-group">
      <label for="titrecircuit">Titre</label>
      <input type="text" class="form-control" autocomplete="off" id="titrecircuit" placeholder="Nom du Circuit" name="nomCircuit" value="<?php if (isset($_POST['nomCircuit'])) {
    echo htmlentities($_POST['nomCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $titre;
}
?>">
    </div>
    <div class="form-group">
      <label for="descriptionCircuit">Description</label>
      <textarea class="form-control" autocomplete="off" id="descriptioncircuit" placeholder="Description du Circuit" name="descriptionCircuit" rows="4"><?php if (isset($_POST['descriptionCircuit'])) {
    echo htmlentities($_POST['descriptionCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $description;
}?></textarea>
    </div>
    <input type="hidden" name="idCircuit" value="<?php if (isset($_GET['idCircuit'])) {
    echo $_GET['idCircuit'];
}?>">
    <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>