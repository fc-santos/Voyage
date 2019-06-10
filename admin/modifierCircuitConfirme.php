<?php
include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    $stmt1 = $conn->query("SELECT * FROM image WHERE idCircuit=" . $_POST['idCircuit']);
    $row1 = $stmt1->fetch();
    $image = "../" . $_POST['image'];

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
    
    @header("Location: gererCircuit.php");
}
