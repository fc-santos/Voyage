<?php
if (isset($_GET['idCircuit'])) {
    $_SESSION['correctNomCircuit'] = true;

    try {
        $_SESSION['idCircuit'] = $_GET['idCircuit'];
        $idCircuit = $_SESSION['idCircuit'];

        $query = 'SELECT * from circuit WHERE idCircuit=' . $idCircuit;

        $stmt = $conn->query($query);

        while ($row = $stmt->fetch()) {
            $nomCircuit = $row->titre;
            $descriptionCircuit = $row->description;
        }

        $query2 = 'SELECT * FROM etape WHERE idCircuit = '. $idCircuit .' ORDER BY ordre DESC LIMIT 1';
        $stmt2 = $conn->query($query2);
        
        while ($row = $stmt2->fetch()) {
            $_SESSION['ordre'] = $row->ordre;
        }
    } catch (Exception $r) {
    }
    unset($_POST['ajouterEtape']);
}
  
if (isset($_POST['ajouterEtape']) || isset($_POST['terminer'])) {
    unset($_SESSION['ordre']);
    unset($_SESSION['correctEtape']);
    unset($_SESSION['correctNomCircuit']);
    unset($_POST['ajouterJours']);
    unset($_POST['autreEtape']);
    unset($_SESSION['idCircuit']);


    if (isset($_POST['nomCircuit']) && $_POST['nomCircuit'] != "") {
        $nomCircuit = $_POST['nomCircuit'];
    } else {
        $nomCircuit = "Sans titre";
    }

    $stmt2 = $conn->query('SELECT max(idCircuit)AS id FROM circuit');
    $row = $stmt2->fetch();

    $nomImage = (int)$row->id + 1;
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
    
    if (isset($_POST['descriptionCircuit']) && $_POST['descriptionCircuit'] != "") {
        $descriptionCircuit = $_POST['descriptionCircuit'];
    } else {
        $descriptionCircuit = "Sans description";
    }
    try {
        $sql = "INSERT INTO circuit(titre, description, estActif) VALUES(:titre, :description, 0)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['titre' => $nomCircuit, 'description' => $descriptionCircuit]);
        $_SESSION['correctNomCircuit'] = true;
        $_SESSION['idCircuit'] = $conn->lastInsertId();

        $sql1 = 'INSERT INTO image(idCircuit, url) VALUES(' . $_SESSION['idCircuit'] . ', :image)';
        //var_dump($sql1);
        //exit();
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute(['image' => $image]);
        unset($_POST['ajouterEtape']);
    } catch (Exception $r) {
    }
}

if (isset($_POST['terminer'])) {
    unset($_POST['nomCircuit']);
    unset($_POST['descriptionCircuit']);
    unset($_SESSION['correctNomCircuit']);
    unset($_GET['idCircuit']);
    $_SESSION['success'] = 'Une circuit a été ajouté';
    header("location: gererCircuit.php");
}
?>

<h2>Créer circuit</h2>
<form class="mt-3 mb-3" action="creerCircuit.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="titrecircuit">Titre</label>
    <input type="text" class="form-control" id="titrecircuit" autocomplete="off" placeholder="Nom du Circuit" name="nomCircuit" value="<?php if (isset($_POST['nomCircuit'])) {
    echo htmlentities($_POST['nomCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $nomCircuit;
}?>">
  </div>
  <div class="form-group">
    <label for="descriptioncircuit">Description</label>
    <textarea class="form-control" id="descriptioncircuit" autocomplete="off" name="descriptionCircuit" rows="4"><?php if (isset($_POST['descriptionCircuit'])) {
    echo htmlentities($_POST['descriptionCircuit']);
} elseif (isset($_GET['idCircuit'])) {
    echo $descriptionCircuit;
}?></textarea>
  </div>
  <div class="form-group">
    <label for="imagecircuit">Image</label>
    <input type="file" id="imagecircuit" name="image" accept=".jpg">
  </div>
  <button type="submit" name="ajouterEtape" class="btn btn-primary">Ajouter des étapes</button>
  <button type="submit" name="terminer" class="btn btn-primary">Terminer</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>