<?php

if (isset($_GET['idCircuit'])) {
    $_SESSION['correctNomCircuit'] = true;

    try {
        $idCircuit = $_GET['idCircuit'];
        //$ordre = $_SESSION['ordre'];

        $query = 'SELECT * from circuit WHERE idCircuit=' . $idCircuit;

        $stmt = $conn->query($query);
        while ($row = $stmt->fetch()) {
            $nomCircuit = $row->titre;
            $descriptionCircuit = $row->description;
        }

        

        unset($_POST['ajouterJours']);
    } catch (Exception $r) {
    }



    unset($_POST['ajouterEtape']);
}
  
if (isset($_POST['ajouterEtape'])) {
    unset($_SESSION['ordre']);
    unset($_SESSION['correctEtape']);
    unset($_SESSION['correctNomCircuit']);
    unset($_POST['ajouterJours']);
    unset($_POST['autreEtape']);
    unset($_SESSION['idCircuit']);
    //unset($_POST['nomCircuit']);
    //unset($_POST['descriptionCircuit']);

    if (isset($_POST['nomCircuit'])) {
        $nomCircuit = $_POST['nomCircuit'];
    }
    if (isset($_POST['descriptionCircuit'])) {
        $descriptionCircuit = $_POST['descriptionCircuit'];
    }
    try {
        $sql = "INSERT INTO circuit(titre, description, estActif) VALUES(:titre, :description, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['titre' => $nomCircuit, 'description' => $descriptionCircuit]);
        $_SESSION['correctNomCircuit'] = true;
        $_SESSION['idCircuit'] = $conn->lastInsertId();
        unset($_POST['ajouterEtape']);
        
        
        //il faut prendre le dernier id ajoute a la table circuit et non le nom du circuit
        /*$sql2 = "SELECT * FROM circuit WHERE titre = :titre";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['titre' => $nomCircuit]);
        $circuit = $stmt2->fetch();
        $_SESSION['idCircuit'] = $circuit -> idCircuit;*/
    } catch (Exception $r) {
    }
}
?>

<h2>Créer circuit</h2>
<form class="mt-3 mb-3" action="creerCircuit.php" method="POST">
  <div class="form-group">
    <label for="titrecircuit">Titre</label>
    <input type="text" class="form-control" required id="titrecircuit" placeholder="Nom du Circuit" name="nomCircuit" value="<?php if (isset($_POST['nomCircuit'])) {
    echo htmlentities($_POST['nomCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $nomCircuit;
}?>">
  </div>
  <div class="form-group">
    <label for="descriptioncircuit">Description</label>
    <textarea class="form-control" id="descriptioncircuit" name="descriptionCircuit" rows="4"><?php if (isset($_POST['descriptionCircuit'])) {
    echo htmlentities($_POST['descriptionCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $descriptionCircuit;
}?></textarea>
  </div>
  <div class="form-group">
    <label for="imagecircuit">Image</label>
    <input type="file" id="imagecircuit">
  </div>
  <button type="submit" name="ajouterEtape" class="btn btn-primary">Ajouter des étapes</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>