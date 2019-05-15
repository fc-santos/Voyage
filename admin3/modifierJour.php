<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

if (isset($_GET['idJour'])) {
    $stmt = $conn->query("SELECT * FROM Jour WHERE idJour=" . $_GET['idJour']);
    $row = $stmt->fetch();

    $idJour = $row->idJour;

    $getActivite = $conn->query('SELECT * FROM activite WHERE idActivite = ' . $row->idActivite);
    $activite = $getActivite->fetch();
    $nomActivite = $activite->nom;

    $idLieu = $activite->idLieu;

    $getHebergement = $conn->query('SELECT * FROM hebergement WHERE idHebergement = ' . $row->idHebergement);
    $hebergement = $getHebergement->fetch();
    $nomHebergement = $hebergement->nom;

    if (!isset($idLieu)) {
        $idLieu = $hebergement->idLieu;
    }

    $getDinner = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idDinner);
    $dinner = $getDinner->fetch();
    $nomDinner = $dinner->nom;

    if (!isset($idLieu)) {
        $idLieu = $dinner->idLieu;
    }
    

    $getSouper = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idSouper);
    $souper = $getSouper->fetch();
    $nomSouper = $souper->nom;

    if (!isset($idLieu)) {
        $idLieu = $souper->idLieu;
    }


    $getLieu = $conn->query('SELECT * FROM lieu WHERE idLieu = ' . $idLieu);
    $lieu = $getLieu->fetch();
    $nomLieu = $lieu->nom . " "  . $lieu->ville . " " . $lieu->pays;
}
?>

<div class="container">
  <h2>Modifier jour</h2>
  <form class="mt-3 mb-3" action="modifierJourConfirme.php" method="POST">
  <div class="form-group">
      <label for="lieu">Lieu</label> (<span style="color: red;">Attention: Modifier le lieu implique la perte de tous les données pour le lieu</span>)
      <input type="text" class="form-control" id="lieuModifier" autocomplete="off" placeholder="lieu" name="lieu" value="<?php if (isset($nomLieu)) {
    echo ltrim($nomLieu);
}
?>">
    </div>
    <div class="form-group">
      <label for="hebergement">Hebergement</label>
      <input type="text" class="form-control" id="hebergementModifier" autocomplete="off" placeholder="hebergement" name="hebergement" value="<?php if (isset($_POST['hebergement'])) {
    echo htmlentities($_POST['hebergement']);
} elseif (isset($nomHebergement)) {
    echo $nomHebergement;
}
?>">
    </div>
    <div class="form-group">
      <label for="activite">Activite</label>
      <input type="text" class="form-control" id="activiteModifier" autocomplete="off" placeholder="activite" name="activite" value="<?php if (isset($_POST['activite'])) {
    echo htmlentities($_POST['activite']);
} elseif (isset($nomActivite)) {
    echo $nomActivite;
}
?>">
    </div>
    <div class="form-group">
      <label for="dinner">Dinner</label>
      <input type="text" class="form-control" id="dinnerModifier" autocomplete="off" placeholder="dinner" name="dinner" value="<?php if (isset($_POST['dinner'])) {
    echo htmlentities($_POST['dinner']);
} elseif (isset($nomDinner)) {
    echo $nomDinner;
}
?>">
    </div>
    <div class="form-group">
      <label for="souper">Souper</label>
      <input type="text" class="form-control" id="souperModifier" autocomplete="off" placeholder="souper" name="souper" value="<?php if (isset($_POST['souper'])) {
    echo htmlentities($_POST['souper']);
} elseif (isset($nomSouper)) {
    echo $nomSouper;
}
?>">
    </div>
    <input type="hidden" name="idJour" value="<?= $idJour ?>">
    <input type="hidden" name="idLieu" value="<?= $idLieu ?>">
    <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>