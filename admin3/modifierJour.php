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
    $idEtape = $row->idEtape;
    $idSouper = $row->idSouper;
}
?>

<div class="container">
  <h2>Modifier jour</h2>
  <form class="mt-3 mb-3" action="modifierJourConfirme.php" method="POST">
    <div class="form-group">
      <label for="idJour">idJour</label>
      <input type="text" class="form-control" required id="idJour" placeholder="idjour" name="idJour" value="<?php if (isset($_POST['idJour'])) {
    echo htmlentities($_POST['idJour']);
} elseif (isset($_GET['idJour'])) {
    echo $idJour;
}
?>">
    </div>
    <div class="form-group">
      <label for="idEtape">idEtape</label>
      <input type="text" class="form-control" required id="idEtape" placeholder="idEtape" name="idEtape" value="<?php if (isset($_POST['idEtape'])) {
    echo htmlentities($_POST['idEtape']);
} elseif (isset($_GET['idJour'])) {
    echo $idEtape;
}
?>">
    </div>
    <div class="form-group">
      <label for="idSouper">idSouper</label>
      <input type="text" class="form-control" required id="idSouper" placeholder="idSouper" name="idSouper" value="<?php if (isset($_POST['idSouper'])) {
    echo htmlentities($_POST['idSouper']);
} elseif (isset($_GET['idJour'])) {
    echo $idSouper;
}
?>">
    </div>
    <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>