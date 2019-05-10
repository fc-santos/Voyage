<?php
include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    $query = "UPDATE `etape` SET `nom`= :titreAModifier,`description`= :descriptionAModifier WHERE idEtape=" . $_POST['idEtape'];
    $stmt = $conn->prepare($query);
    $stmt->execute(['titreAModifier' => $_POST['nomEtape'], 'descriptionAModifier' => $_POST['descriptionEtape']]);

    $query = "SELECT * from etape WHERE idEtape=" . $_POST['idEtape'];
    $stmt = $conn->query($query);

    while ($row = $stmt->fetch()) {
        $idCircuit = $row->idCircuit;
    }
    
    @header("Location: listerEtapes.php?idCircuit=" . $idCircuit);
}
