<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

if (isset($_GET['idUtilisateur'])) {
    $stmt = $conn->query("SELECT * FROM utilisateur WHERE idUtilisateur=" . $_GET['idUtilisateur']);
    $row = $stmt->fetch();

    $nom = $row->nom;
    $prenom = $row->prenom;
    $courriel = $row->courriel;
    $role = $row->role;
}

?>


<div class="container">
  <h2>Modifier Admin</h2>
  <form class="mt-3 mb-3" action="modifierAdminConfirme.php" method="POST">
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" autocomplete="off" id="nom" placeholder="Nom" name="nomAdmin" value="<?php if (isset($_POST['nomAdmin'])) {
    echo htmlentities($_POST['nomAdmin']);
} elseif (isset($_GET['idUtilisateur'])) {
    echo $nom;
}
?>">
    </div>
    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" class="form-control" autocomplete="off" id="prenom" placeholder="prénom" name="prenomAdmin" value="<?php if (isset($_POST['prenomAdmin'])) {
    echo htmlentities($_POST['prenomAdmin']);
} elseif (isset($_GET['idUtilisateur'])) {
    echo $prenom;
}
?>">
    </div>
    <div class="form-group">
      <label for="courriel">Courriel</label>
      <input type="text" class="form-control" autocomplete="off" id="courriel" placeholder="Courriel" name="courrielAdmin" value="<?php if (isset($_POST['courriel'])) {
    echo htmlentities($_POST['courriel']);
} elseif (isset($_GET['idUtilisateur'])) {
    echo $courriel;
}
?>">
    </div>
    <input type="hidden" name="idUtilisateur" value="<?php if (isset($_GET['idUtilisateur'])) {
    echo $_GET['idUtilisateur'];
}?>">
    <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>