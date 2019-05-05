<?php

if (isset($_POST['ajouterJours'])) {
    if (!isset($_SESSION['ordre'])) {
        $_SESSION['ordre'] = 0;
    } else {
        $_SESSION['ordre'] = $_SESSION['ordre'] + 1;
    }
        
    if (isset($_POST['titreEtape'])) {
        $titreEtape = $_POST['titreEtape'];
    }
    if (isset($_POST['descriptionEtape'])) {
        $descriptionEtape = $_POST['descriptionEtape'];
    }
    
    try {
        $idCircuit = $_SESSION['idCircuit'];
        $ordre = $_SESSION['ordre'];
            
        $sql3 = "INSERT INTO etape(idCircuit, nom, description, ordre) VALUES($idCircuit, :titre, :description,  $ordre)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(['titre' => $titreEtape, 'description' => $descriptionEtape]);
        $_SESSION['correctEtape'] = true;
        $_SESSION['idEtape'] = $conn->lastInsertId();
        unset($_POST['ajouterJours']);
        //unset($_POST['ajouterEtape']);
    } catch (Exception $r) {
    }



    //inserer jour

    //save jour
    /* if (isset($_SESSION['lieu'])) {
         $lieu = $_SESSION['lieu'];
     }

     if (isset($_POST['hebergement'])) {
         $hebergement = $_POST['hebergement'];
     }
     if (isset($_POST['souper'])) {
         $souper = $_POST['souper'];
     }
     if (isset($_POST['diner'])) {
         $diner = $_POST['diner'];
     }
     if (isset($_POST['typeHebergement'])) {
         $typeHebergement = $_POST['typeHebergement'];
     }
     if (isset($_POST['activites'])) {
         $activites = $_POST['activites'];
     }

     try {
         $idEtape = $_SESSION['idEtape'];

         $sql4 = "INSERT INTO `jour`(`idEtape`, `idHebergement`, `idSouper`, `idDiner`, `idActivite`, `lieu`) VALUES ($idEtape, 1, 1, 1, 1, 'aaa')";
         $stmt4 = $conn->prepare($sql4);
         $stmt4->execute();
         $_SESSION['jourInserted'] = true;
         $_SESSION['correctJour'] = true;
     } catch (Exception $r) {
     }*/

    //unset($_POST['autreEtape']);
}

/*if (isset($_POST['autreJour'])) {
    //$jourNumber++;
    //get last etape
    //done!!*//*
    //save jour
    if (isset($_SESSION['lieu'])) {
        $lieu = $_SESSION['lieu'];
    }

    if (isset($_POST['hebergement'])) {
        $hebergement = $_POST['hebergement'];
    }
    if (isset($_POST['souper'])) {
        $souper = $_POST['souper'];
    }
    if (isset($_POST['diner'])) {
        $diner = $_POST['diner'];
    }
    if (isset($_POST['typeHebergement'])) {
        $typeHebergement = $_POST['typeHebergement'];
    }
    if (isset($_POST['activites'])) {
        $activites = $_POST['activites'];
    }

    try {
        $idEtape = $_SESSION['idEtape'];

        $sql4 = "INSERT INTO `jour`(`idEtape`, `idHebergement`, `idSouper`, `idDiner`, `idActivite`, `lieu`) VALUES ($idEtape, 1, 1, 1, 1, 'aaa')";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->execute();
        $_SESSION['jourInserted'] = true;
        $_SESSION['correctJour'] = true;
    } catch (Exception $r) {
    }
    unset($_POST['autreJour']);
}*/

/*if (isset($_POST['ajouterJours'])) {
    unset($_SESSION['ordre']);
    unset($_SESSION['correctEtape']);
    unset($_SESSION['correctNomCircuit']);
    //unset($_POST['autreJour']);
    unset($_POST['ajouterJours']);
    //unset($_SESSION['jourInserted']);
    unset($_POST['autreEtape']);
}*/
?>

<h2>Créer des étapes</h2>

<form class="mt-3 mb-3" action="creerCircuit.php" method="POST">
  <div class="form-group">
    <label for="titreEtape">Titre</label>
    <input type="text" class="form-control" required id="titreEtape" placeholder="Nom de l'étape" name="titreEtape" value="<?php if (isset($_POST['titreEtape'])/* && !isset($_SESSION['correctEtape'])*/) {
    echo htmlentities($_POST['titreEtape']);
}?>">
  </div>
  <div class="form-group">
    <label for="descriptionEtape">Description</label>
    <textarea class="form-control" id="descriptionEtape" name="descriptionEtape" rows="4"><?php if (isset($_POST['descriptionEtape']) /*&& !isset($_SESSION['correctEtape'])*/) {
    echo htmlentities($_POST['descriptionEtape']);
}?></textarea> 
  </div>

    <button type="submit" name="ajouterJours" class="btn btn-primary">Ajouter Jours</button>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>