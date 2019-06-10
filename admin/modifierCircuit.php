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

    $stmt1 = $conn->query("SELECT * FROM image WHERE idCircuit=" . $_GET['idCircuit']);
    $row1 = $stmt1->fetch();
    $image = "../" . $row1->url;
}

if (isset($_POST['submit'])) {
    $stmt2 = $conn->query("SELECT * FROM image WHERE idCircuit=" . $_POST['idCircuit']);
    $row2 = $stmt2->fetch();
    $image = null;

    $nomImage = $_POST['nomCircuit'];
    $dossier = "assets/images/";
  
    if ($_FILES['image']['tmp_name'] !== "") {
        $tmp = $_FILES['image']['tmp_name'];
        $fichier = $_FILES['image']['name'];
        $extension = strrchr($fichier, '.');
        if ($extension == '.jpg') {
            $chemin = $dossier . $nomImage . $extension;
            @move_uploaded_file($tmp, "../" . $chemin);
            @unlink($tmp);
            $image = $chemin;
        } else {
            $image = 'assets/images/village.jpg';
        }
    } else {
        $image = 'assets/images/village.jpg';
    }

    $query = "UPDATE `circuit` SET `titre`= :titreAModifier,`description`= :descriptionAModifier WHERE idCircuit=" . $_POST['idCircuit'];
    $stmt = $conn->prepare($query);
    $stmt->execute(['titreAModifier' => $_POST['nomCircuit'], 'descriptionAModifier' => $_POST['descriptionCircuit']]);

    $query1 = "UPDATE `image` SET `url`= '" . $image . "' WHERE idCircuit = " . $_POST['idCircuit'];
    $stmt2 = $conn->prepare($query1);
    $stmt2->execute();
}
?>

<div class="container">
  <h2>Modifier circuit</h2>
  <form class="mt-3 mb-3" action="modifierCircuitConfirme.php" method="POST" enctype="multipart/form-data">
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
    <div>
      <img class="mb-3" style="width:50%;" src="<?= $image ?>">
    </div>
    <input type="file" name="image" accept=".jpg" id="image">
    <label class="lblImage col-sm-6" for="image"><i class="fas fa-upload"></i> Choisir image</label><br>
    <input type="submit" name="submit" class="btn btn-primary">
  </form>
</div>   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>